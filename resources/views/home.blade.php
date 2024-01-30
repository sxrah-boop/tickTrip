
@include('includes.header')
    <!-- main section -->
    <section class="container-fluid px-2 pt-1" style="width: 95%;">

        <div class=" py-4 rounded-2" style="background-color: #380094; padding-inline: 8rem;">
            <!-- hero title -->
            <div class="text-center text-light" style="margin-top: 2rem;margin-bottom: 4rem;">
                <img class="mb-4" src="images/chba7/OBJECTS.png" alt="" height="280" width="280"" >
            <h1 class=" display-">Covoiturage au meilleur prix</h1>
                <p>Covoiturez vers des milliers de destinations à petits prix.</p>
            </div>
            <!-- search bar-->
            <div class="mt-4 bg-light " style="margin-bottom: 6rem;">
                <form class="row g-3 bg-light pb-4 rounded-2 px-3">
                    <div class="col-md-3">
                        <label for="inputLocation" class="form-label">From</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputLocation" placeholder="Location"
                                aria-label="Départ">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputDestination" class="form-label">
                            to</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputDestination" placeholder="Destination"
                                aria-label="Destination">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="datetime-local" class="form-control" id="inputDate">
                    </div>
                    <div class="col-md-2">
                        <label for="inputPassengers" class="form-label"> Passengers</label>
                        <input type="number" class="form-control" id="inputPassengers" placeholder="1"
                            aria-label="Number of passengers">
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
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-left text-light mb-3">Trajets à proximité</h5>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link me-3"
                            style="color:white;border: 1.2px solid white; border-radius: 5Px;padding: 12%;"
                            onclick="prevSlide()">
                            <i class="bi bi-arrow-bar-left"></i>
                        </button>
                        <button class="btn btn-link"
                            style="color:white; border: 1.2px solid white; border-radius: 5Px;padding: 12%;"
                            onclick="nextSlide()">
                            <i class="bi bi-arrow-bar-right"></i>
                        </button>
                    </div>
                </div>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="cardContainer">
                        <div class="carousel-item active">
                            <div class="row">
                                <!-- Your cards here -->
                                <div class="card col-md-5 px-4 py-3 shadow me-4">
                                    <!-- Card header -->
                                    <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50"
                                            width="50">
                                    </div>
                                    <!-- Card body -->
                                    <div class="d-flex justify-content-between my-2">
                                        <!-- depart -->
                                        <div class="col-md-6">
                                            <h6>Centre comercial Bab Ezzouar</h6>
                                            <p class="text-secondary mb-0 pb-0"><span>8:00</span><span> -</span> 29 Dec,
                                                2023</p>
                                            <p class="mt-0 pt-0 text-secondary"><img class="me-1"
                                                    src="images/driver.svg" alt="driver icon" height="15"
                                                    width="15">Hadjer Bouchenine</p>

                                        </div>
                                        <div class="me-3"> <img src="images/arrowPink.svg" alt="arrow"></div>

                                        <!-- destination -->
                                        <div class="col-md-5">
                                            <h6>Vieux Kouba Ecole Normale</h6>
                                        </div>
                                    </div>

                                    <!-- Card footer -->
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people-fill me-2"></i>
                                            2
                                        </div>
                                        <a href="#" class="d-flex align-items-center text-decoration-none"
                                            style="color: #380094;">
                                            Reserver
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card col-md-5 px-4 py-3 shadow me-4">
                                    <!-- Card header -->
                                    <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50"
                                            width="50">
                                    </div>
                                    <!-- Card body -->
                                    <div class="d-flex justify-content-between my-2">
                                        <!-- depart -->
                                        <div class="col-md-6">
                                            <h6>Centre comercial Bab Ezzouar</h6>
                                            <p class="text-secondary mb-0 pb-0"><span>8:00</span><span> -</span> 29 Dec,
                                                2023</p>
                                            <p class="mt-0 pt-0 text-secondary"><img class="me-1"
                                                    src="images/driver.svg" alt="driver icon" height="15"
                                                    width="15">Hadjer Bouchenine</p>

                                        </div>
                                        <div class="me-3"> <img src="images/arrowPink.svg" alt="arrow"></div>

                                        <!-- destination -->
                                        <div class="col-md-5">
                                            <h6>Vieux Kouba Ecole Normale</h6>
                                        </div>
                                    </div>

                                    <!-- Card footer -->
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people-fill me-2"></i>
                                            2
                                        </div>
                                        <a href="#" class="d-flex align-items-center text-decoration-none"
                                            style="color: #380094;">
                                            Reserver
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more carousel items here -->
                    </div>
                </div>
            </div>

            

            
        </div>
        

    </section>
    
    


@include('includes.footer')

