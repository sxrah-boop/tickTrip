@include('includes.header')
<!-- main section -->
<section class="h-100">
    <div class="d-flex flex-column align-items-center justify-center h-100 py-4">
        <div class=" py-4 rounded-4" style="background-color: #380094;width: 95%;">
            <div class="container d-flex align-items-center justify-content-center ">
                <form class=" d-flex flex-row g-0 bg-light rounded-4 px-3 py-3" method="POST"
                    action="{{ route('search-trip') }}">
                    @csrf
                    <div class="col-md-3">
                        <label for="inputLocation" class="form-label">De</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputLocation" placeholder="Location"
                                aria-label="Départ" name="depart" value={{ $searchData['depart'] }} >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputDestination" class="form-label">
                            à</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputDestination" placeholder="Destination"
                                aria-label="Destination" name="destination" value={{ $searchData['destination']}}>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="inputDate" name="datetime" value={{$searchData['datetime'] }}>
                    </div>
                    <div class="col-md-2">
                        <label for="inputPassengers" class="form-label"> Passengers</label>
                        <input type="number" class="form-control" id="inputPassengers" placeholder="1"
                            aria-label="Number of passengers" name="places_disponibles" value={{ $searchData['places_disponibles'] }}>
                    </div>
                    <div class="col-md-2 pt-2">
                        <label class="invisible">Search</label>
                        <button type="submit" class="btn btn-primary form-control"><i class="bi bi-search"></i>
                            Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container py-4" style="width:95%; max-width:700px">
            <div class="px-3 pb-2">
                <h3>Aujourd’hui</h3>
                <div class="d-flex align-items-center gap-2 my-2 text-secondary">
                    <!-- depart -->
                    <div class="">
                        <p class="mb-0">{{ $searchData['depart'] }}</p>
                    </div>
                    <div class=""> <img src="images/arrowFaded.svg" alt="arrow"></div>
                    <!-- destination -->
                    <div class="">
                        <p class="mb-0">{{ $searchData['destination'] }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2" id="trip-cards-container">
                @foreach ($trips as $trip)
                <div class="card px-4 py-3 shadow flex-fill">
                    <!-- Card header -->
                    <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50" width="50"> </div>
                    <!-- Card body -->
                    <div class="d-flex justify-content-between my-2">
                        <!-- depart -->
                        <div class="col-md-6">
                            <h6>{{ $trip->depart }}</h6>
                        </div>
                        <div class="me-3"> <img src="images/arrowPink.svg" alt="arrow"></div>
                        <!-- destination -->
                        <div class="col-md-5">
                            <h6>{{ $trip->destination }}</h6>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 pb-0"><span>{{ $trip->heure_depart }}</span></p>
                    <p class="mt-0 pt-0 text-secondary text-nowrap"><img class="me-1" src="images/driver.svg" alt="driver icon" height="15" width="15">{{ $trip->prix }} DA</p>
                    <!-- Card footer -->
                    <div class=" d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill me-2"></i>{{ $trip->places_disponibles }}
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal" data-trip-id={{$trip->id}}>
                            Réserver
                            </button>
                    </div>
                </div>
                @endforeach

            </div>

        </div>

    </div>
</section>

<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Combien de places voulez-vous réserver ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="placesInput">Nombre de places</label>
                <input type="number" id="placesInput" class="form-control" placeholder="Nombre de places"
                    min="1" value="1">
            </div>
            <div id="reservationMessages"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="reserveBtn" onclick="reserver()">Valider</button>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function reserver(){
            let places_reservees = $('#placesInput').val(); // Get the number of places from the input field
            let tripId = $('#reserveBtn').data('trip-id'); // Get the trip ID from the modal data attribute

            // Send a reservation request to the server
            $.ajax({
            url: '/reserver/' + tripId, // URL for the reservation endpoint
            method: 'POST',
            data: { places_reservees: places_reservees }, // Data to send in the request (number of places)
            success: function(response) {
                // Handle successful reservation
                console.log('Reservation successful:', response);
                $('#reservationMessages').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                // Refresh the page after a delay
                setTimeout(function() {
                    $('#reservationModal').modal('hide');
                    window.location.reload();
                }, 3000); // Refresh after 2 seconds (adjust as needed)
            },
            error: function(xhr, status, error) {
                // Handle reservation error
                console.error('Error occurred during reservation:', error);
                let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error occurred during reservation. Please try again later.';
                $('#reservationMessages').html('<div class="alert alert-danger" role="alert">' + errorMessage + '</div>');
            }
            });
    }

        // Handle reservation modal
        document.addEventListener('DOMContentLoaded', function () {
        // When the modal is shown, update its title with the trip ID
        $('#reservationModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let tripId = button.data('trip-id'); // Extract trip ID from data-* attributes
        let modal = $(this);
        modal.find('#reserveBtn').data('trip-id', tripId);
        });

        // Handle reservation button click
        $('#reserveBtn').on('click', function () {
        var places = $('#placesInput').val(); // Get the number of places from the input field
        console.log('Number of places reserved:', places);
        // Here you can perform any further actions, such as sending a reservation request to the server
        // Remember to close the modal if needed: $('#reservationModal').modal('hide');
        });
    });

</script>
