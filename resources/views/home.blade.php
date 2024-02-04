@include('includes.header')
<!-- main section -->
<section class="container-fluid px-2 pt-1" style="width: 95%;">

    <div class=" py-4 rounded-5" style="background-color: #380094; padding-inline: 8rem;">
        <!-- hero title -->
        <div class="text-center text-light" style="margin-top: 2rem;margin-bottom: 4rem;">
            <img class="mb-4" src="images/chba7/OBJECTS.png" alt="" height="220" width="220">
            <h1 class=" display-">Covoiturage au meilleur prix</h1>
            <p>Covoiturez vers des milliers de destinations à petits prix.</p>
        </div>
        <!-- search bar-->
        <div class="mt-4 bg-light " style="margin-bottom: 4rem;">
            <form class="row g-3 bg-light pb-4 rounded-2 px-3" method="POST" action="{{ route('search-trip') }}">
                @csrf
                <div class="col-md-3">
                    <label for="inputLocation" class="form-label">De</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputLocation" placeholder="Location"
                            aria-label="Départ" name="depart" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="inputDestination" class="form-label">
                        à</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputDestination" placeholder="Destination"
                            aria-label="Destination" name="destination" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="inputDate" class="form-label">Date</label>
                    <input type="datetime-local" class="form-control" id="inputDate" name="datetime">
                </div>
                <div class="col-md-2">
                    <label for="inputPassengers" class="form-label"> Passengers</label>
                    <input type="number" class="form-control" id="inputPassengers" placeholder="1"
                        aria-label="Number of passengers" name="places_disponibles">
                </div>
                <div class="col-md-2 pt-2">
                    <label class="invisible">Search</label>
                    <button type="submit" class="btn btn-primary form-control"><i class="bi bi-search"></i>
                        Search</button>
                </div>
            </form>

        </div>
        <!-- trajets a proximités -->
        <div class="my-4">
            <h5 class="text-left text-light mb-3">Trajets à proximité</h5>
            <div class="d-flex justify-content-between gap-2" id="trip-cards-container">


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
    // Get user's location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            console.log(latitude, longitude);

            // Send location to server
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('find-closest-trips') }}",
                type: "POST",
                data: {
                    latitude: latitude,
                    longitude: longitude
                },
                success: function(response) {

                    // Handle response (display closest trips)
                    console.log('Response from server:', response);
                    displayClosestTrips(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred while sending the request:');
                    console.log('Error:', error);
                    console.log('Status:', status);
                    console.log('Response Text:', xhr.responseText);
                    console.log('Response JSON:', xhr.responseJSON);
                }
            });
        });
    }

    function displayLoaderCards() {
        var tripCardsContainer = $("#trip-cards-container");
        tripCardsContainer.empty(); // Clear existing trip cards

        // Create loader cards
        for (var i = 0; i < 3; i++) {
            var loaderCardHtml = `
            <div class="card px-4 py-3 shadow flex-fill d-flex flex-row gap-3">
                <div class="spinner-grow spinner-grow-sm text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow spinner-grow-sm text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow spinner-grow-sm text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
            tripCardsContainer.append(loaderCardHtml); // Append loader card to container
        }
    }

    displayLoaderCards();

    // Function to display closest trips
    function displayClosestTrips(trips) {
        var tripCardsContainer = $("#trip-cards-container");
        tripCardsContainer.empty(); // Clear existing trip cards


        // Loop through fetched trips and create HTML for each trip card

        trips.forEach(function(trip) {
            let tripDate = new Date(trip.trip.heure_depart);
            // Format date and time separately
            let formattedDate = tripDate.toLocaleDateString(); // Format date
            let formattedTime = tripDate.toLocaleTimeString();
            let cardHtml = `
                <div class="card px-4 py-3 shadow flex-fill">
                    <!-- Card header -->
                    <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50" width="50"> </div>
                    <!-- Card body -->
                    <div class="d-flex justify-content-between my-2">
                        <!-- depart -->
                        <div class="col-md-6">
                            <h6>${trip.trip.depart}</h6>
                        </div>
                        <div class="me-3"> <img src="images/arrowPink.svg" alt="arrow"></div>
                        <!-- destination -->
                        <div class="col-md-5">
                            <h6>${trip.trip.destination}</h6>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 pb-0"><span>${formattedDate}</span> - <span>${formattedTime}</span></p>
                    <p class="mt-0 pt-0 text-secondary text-nowrap"><img class="me-1" src="images/driver.svg" alt="driver icon" height="15" width="15">${trip.trip.prix} DA</p>
                    <!-- Card footer -->
                    <div class=" d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill me-2"></i> ${trip.trip.places_disponibles}
                        </div>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal" data-trip-id=${trip.trip.id}>
                             Réserver
                             </button>


                    </div>
                </div>
            `;
            tripCardsContainer.append(cardHtml); // Append trip card to container
        });
    }

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
