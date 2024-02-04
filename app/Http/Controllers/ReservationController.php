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

        // 3. Vérifier si le nombre de places demandées est disponible
        $placesRequested = $request->places_reservees;
        if ($placesRequested > $trip->places_disponibles) {
            return response()->json(['message' => 'Désolé, le nombre de places demandées est supérieur au nombre de places disponibles.'], 400);
        }
        // 4. Créer une nouvelle réservation
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->trip_id = $tripId;
        $reservation->places_reservees = $placesRequested; // Save the number of places in the reservation
        $reservation->save();

        // 5. Décrémenter le nombre de places disponibles
        $trip->decrement('places_disponibles', $placesRequested);

        // 6. Rediriger avec un message de réussite
        return response()->json(['message' => 'Réservation effectuée avec succès.'], 200);

    }
}

