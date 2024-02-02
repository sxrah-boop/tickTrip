@include('includes.header')
<!-- main section -->
<section class="h-100">
    <div class="d-flex flex-column align-items-center justify-center h-100 py-4">
        <div class=" py-4 rounded-4" style="background-color: #380094;width: 95%;">
            <div class="container d-flex align-items-center justify-content-center ">
                <form class=" d-flex flex-row g-0 bg-light rounded-4 px-2 py-2">
                    <div class="flex-grow-1">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" id="inputLocation" placeholder="Départ"
                                aria-label="Depart">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" id="inputDestination" placeholder="Destination"
                                aria-label="Destination">
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="input-group input-group-lg">
                            <input type="datetime-local" class="form-control" id="inputDate">
                        </div>
                    </div>
                    <div class="">
                        <div class="input-group input-group-lg">
                            <input type="number" class="form-control" id="inputPassengers" placeholder="1"
                                aria-label="Number of passengers">
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary btn-lg  form-control">
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
                        <p class="mb-0">Centre comercial Bab Ezzouar</p>
                    </div>
                    <div class=""> <img src="images/arrowFaded.svg" alt="arrow"></div>
                    <!-- destination -->
                    <div class="">
                        <p class="mb-0">View Kouba Ecole superieure</p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2" id="trip-cards-container">


            </div>

        </div>

    </div>
</section>
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
                    <div class="d-flex gap-2 align-items-center my-2">
                        <!-- depart -->
                        <div class="">
                            <h5 class="mb-0">${trip.trip.depart}</h5>
                        </div>
                        <div class=""> <img src="images/arrowPink.svg" alt="arrow"></div>
                        <!-- destination -->
                        <div class="">
                            <h5 class="mb-0">${trip.trip.destination}</h5>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 pb-0"><span>${formattedDate}</span> - <span>${formattedTime}</span></p>
                    <p class="mt-0 pt-0 text-secondary text-nowrap"><img class="me-1" src="images/driver.svg" alt="driver icon" height="15" width="15">${trip.trip.prix}</p>
                    <!-- Card footer -->
                    <div class=" d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="bi bi-people-fill"></i> ${trip.trip.places_disponibles}
                            <span>Places disponibles</span>
                        </div>
                        <a href="#" class="d-flex align-items-center text-decoration-none" style="color: #380094;">Reserver<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            `;
            tripCardsContainer.append(cardHtml); // Append trip card to container
        });
    }
</script>

