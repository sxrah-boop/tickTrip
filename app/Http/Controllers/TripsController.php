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
        $user = auth()->user();
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
        $trip->user_id = $user->id;
        $trip->save();

        return redirect()->route('home')
            ->with('success', 'Trip created successfully.');
    }


    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.update', compact('trip'));
    }

    public function searchPage()
    {
        return view('trips.search');
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

    public function findClosestTrips(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // Get all trips from the database
        $trips = Trip::all();

        // Calculate distance between user's location and each trip's location
        $tripsWithDistance = [];
        foreach ($trips as $trip) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                $trip->latitude,
                $trip->longitude
            );
            $tripsWithDistance[] = [
                'trip' => $trip,
                'distance' => $distance,
            ];
        }

        // Sort trips by distance
        usort($tripsWithDistance, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Display three closest trips to the user
        $closestTrips = array_slice($tripsWithDistance, 0, 3);

        return response()->json($closestTrips);

    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
            // Haversine formula to calculate distance between two points
            $earthRadius = 6371; // Earth's radius in kilometers
            $deltaLat = deg2rad($lat2 - $lat1);
            $deltaLon = deg2rad($lon2 - $lon1);
            $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($deltaLon / 2) * sin($deltaLon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $earthRadius * $c;
            return $distance;
    }


    public function search(Request $request)
    {
            // Récupérez les données de recherche depuis la requête
            $depart = $request->input('depart');
            $destination = $request->input('destination');
            $datetime = $request->input('datetime');
            $places_disponibles = $request->input('places_disponibles');

            // Mettez en œuvre la logique de recherche ici, par exemple :
            $trips = Trip::where('depart', 'like', "%$depart%")
                     ->where('destination', 'like', "%$destination%")
                     ->where('heure_depart', '=', $datetime);

                   // if ($datetime) {
                                // $trips->where('datetime', '=', $datetime);
                                //}

                    if ($places_disponibles) {
                         $trips->where('places_disponibles', '>=', $places_disponibles);
                    }

            $trips = $trips->get();

            $searchData = [
                'depart' => $depart,
                'destination' => $destination,
                'datetime' => $datetime,
                'places_disponibles' => $places_disponibles,
            ];
            // Passez les résultats à la vue de résultats de recherche
            return view('trips.search-results', compact('trips'), compact('searchData'));
    }



}
