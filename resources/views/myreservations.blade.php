@include('includes.header')
<h1 class="text-center px-2 py-2">My Reservations</h1>
<section class="h-100">
    <div class="d-flex flex-column align-items-center justify-center h-100 py-4">
        <div class=" py-4 rounded-4" style="background-color: #380094;width: 95%;">
            <div class="container d-flex align-items-center justify-content-center ">
                 <div class="d-flex flex-column gap-2" id="trip-cards-container" style="width:70%;">
                     @foreach ($reservations as $reservation)
                        <div class="card px-4 py-3 shadow flex-fill" >
                             <!-- Card header -->
                             <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50" width="50"> </div>
                             <!-- Card body -->
                             <div class="d-flex justify-content-between my-2">
                            <!-- depart -->
                            <div class="col-md-6">
                            <h6>{{ $reservation->trip->depart }}</h6>
                            </div>
                        <div class="me-3"> <img src="images/arrowPink.svg" alt="arrow"></div>
                        <!-- destination -->
                        <div class="col-md-5">
                            <h6>{{ $reservation->trip->destination }}</h6>
                        </div>
                    </div>
                    <p class="text-secondary mb-0 pb-0"><span>{{ $reservation->trip->heure_depart }}</span> - <span></span></p>
                    <p class="mt-0 pt-0 text-secondary text-nowrap"><img class="me-1" src="images/driver.svg" alt="driver icon" height="15" width="15">{{ $reservation->trip->prix }} DA</p>
                    <!-- Card footer -->
                    <div class=" d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill me-2"></i>{{ $reservation->trip->place_reserve }}
                        </div>
                       
                     </button>
                    </div>
                </div>
                @endforeach
            </div>
            </div>

        </div>

    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


@include('includes.footer')