<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar login -->

    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container px-0">
            <a class="navbar-brand" href="../index.html"><img src="/images/logo.svg" alt="" /></a>
            <div class="d-flex align-items-center order-lg-3 ms-lg-3">
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center bd-theme"
                            type="button" aria-expanded="false" data-bs-toggle="dropdown"
                            aria-label="Toggle theme (auto)">
                            <i class="bi theme-icon-active"></i>
                            <span class="visually-hidden bs-theme-text">Toggle theme</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi theme-icon bi-sun-fill"></i>
                                    <span class="ms-2">Light</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi theme-icon bi-moon-stars-fill"></i>
                                    <span class="ms-2">Dark</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi theme-icon bi-circle-half"></i>
                                    <span class="ms-2">Auto</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <a href="signin.html" class="btn btn-outline-primary me-2">S'inscrire'</a>
                    <a href="publish.html" class="btn btn-primary  d-none d-md-block">

                        <img class="mx-1" src="images/navbar/components/icon-wrapper-h.svg" alt="add icon"
                            height="16" width="16">
                        Publier un trajet
                    </a>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-default5" aria-controls="navbar-default5" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar top-bar mt-0"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>
            <!-- Button -->
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbar-default5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- main section -->
    <section class="container-fluid px-2 pt-1" style="width: 95%;">

        <div class=" py-4 rounded-2" style="background-color: #380094; padding-inline: 8rem;">
            <!-- hero title -->
            <div class="text-center text-light" style="margin-top: 2rem;margin-bottom: 4rem;">
                <img class="mb-4" src="images/chba7/OBJECTS.png" alt="" height="280" width="280"">
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
                            <input type="text" class="form-control" id="inputDestination"
                                placeholder="Destination" aria-label="Destination">
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
                <h5 class="text-left text-light mb-3">Trajets à proximité</h5>
                <div>
                    <div class="card col-md-5 px-4 py-3 shadow">
                        <!-- Card header -->
                        <div class=""> <img src="images/voiture-rounded.png" alt="car" height="50"
                                width="50">
                        </div>
                        <!-- Card body -->
                        <div class="d-flex justify-content-between my-2">
                            <!-- depart -->
                            <div class="col-md-6">
                                <h6>Centre comercial Bab Ezzouar</h6>
                                <p class="text-secondary mb-0 pb-0"><span>8:00</span><span> -</span> 29 Dec, 2023</p>
                                <p class="mt-0 pt-0 text-secondary"><img class="me-1" src="images/driver.svg"
                                        alt="driver icon" height="15" width="15">Hadjer Bouchenine</p>

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

        </div>

    </section>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
