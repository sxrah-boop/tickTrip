@include('includes.header')
<h1>my reservations</h1>
@foreach($reservations as $reservation)
        <p>ID de la réservation : {{ $reservation->id }}</p>
        <p>ID de l'utilisateur : {{ $reservation->user_id }}</p>
        <p>ID du voyage : {{ $reservation->trip_id }}</p>
        <p>Créé à : {{ $reservation->created_at }}</p>
        <p>Mis à jour à : {{ $reservation->updated_at }}</p>
        <!-- Ajoutez d'autres champs de réservation que vous souhaitez afficher -->
    @endforeach

    

@include('includes.footer')