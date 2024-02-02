<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function reserver(Request $request, $tripId)
    {
        // 1. Vérifier si le trip existe
        $trip = Trip::findOrFail($tripId);

        // 2. Vérifier si le nombre de places disponibles est supérieur à 10
        if ($trip->places_disponibles <= 0) {
            return redirect()->back()->with('message', 'Désolé, il n\'y a plus de places disponibles pour ce voyage.');
        }

        // 3. Créer une nouvelle réservation
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->trip_id = $tripId;
        $reservation->save();

        // 4. Décrémenter le nombre de places disponibles
        $trip->decrement('places_disponibles');

        // 5. Rediriger avec un message de réussite
        return redirect()->back()->with('message', 'Réservation effectuée avec succès.');
    }
}

/*
class ReservationController extends Controller
{
    // Middleware pour s'assurer que l'utilisateur est authentifié
    public function __construct()
    {
        $this->middleware('auth')->except('faireReservation');
    }

    public function faireReservation(Request $request, $tripId)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour effectuer une réservation.');
        }

        // Trouver le voyage correspondant à l'ID
        $trip = Trip::findOrFail($id);


        // Vérifier si le nombre de places est supérieur à 0
        if ($trip->places_disponibles <= 0) {
            return redirect()->back()->with('message', 'Désolé, il n\'y a plus de places disponibles pour ce voyage.');
        }

        // Décrémenter le nombre de places disponibles
        $trip->decrement('places_disponibles');

        // Créer une nouvelle réservation
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id; 
        $reservation->trip_id = $tripId;
        $reservation->save();

        // Rediriger avec un message de réussite.
        return redirect()->back()->with('message', 'Réservation effectuée avec succès.');
    }
}*/
