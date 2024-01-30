<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Trip;
use GuzzleHttp\Client;


use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function index()
    {
        return view('trips.index');
    }

    public function create()
    {
        return view('trips.create');
    }
    public function store(Request $request)
    {
        $user_id = $request->session()->get('loginId');
        $validator = Validator::make($request->all(), [
            'depart' => 'required',
            'destination' => 'required',
            'heure_depart' => 'required',
            'places_disponibles' => 'required',
            'prix' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = new Client();
        $response = $client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'q' => $request->depart,
                'format' => 'json',
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        // Extract latitude and longitude
        $latitude = $body[0]['lat'] ?? null;
        $longitude = $body[0]['lon'] ?? null;

        $trip = new Trip();
        $trip->depart = $request->depart;
        $trip->latitude = $latitude;
        $trip->longitude = $longitude;
        $trip->destination = $request->destination;
        $trip->heure_depart = $request->heure_depart;
        $trip->places_disponibles = $request->places_disponibles;
        $trip->place_reserve = 0;
        $trip->prix = $request->prix;
        $trip->user_id = $user_id;
        $trip->save();

        return redirect()->route('home')
            ->with('success', 'Trip created successfully.');
    }


    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.update', compact('trip'));
    }


    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'depart' => 'required',
            'destination' => 'required',
            'heure_depart' => 'required',
            'places_disponibles' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($trip) {
                    if ($value < $trip->place_reserve) {
                        $fail("The number of available places must be greater than or equal to the number of reserved places ({$trip->place_reserve}).");
                    }
                },
            ],
            'prix' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $trip = Trip::findOrFail($id);
        if ($trip->user_id != $request->session()->get('loginId')) {
            return redirect()->route('home')
                ->with('error', 'You are not authorized to update this trip.');
        }
        if ($trip->place_reserve > $request->places_disponibles) {
            // return validation error

        }
        $trip->depart = $request->depart;
        $trip->destination = $request->destination;
        $trip->heure_depart = $request->heure_depart;
        $trip->places_disponibles = $request->places_disponibles;
        $trip->prix = $request->prix;
        $trip->save();

        return redirect()->route('home')
            ->with('success', 'Trip updated successfully.');
        }


}
