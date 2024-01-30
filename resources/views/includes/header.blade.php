<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Local Bootstrap CSS (Replace with your path) -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>


<body>
    <!-- navbar login -->

    <nav class="navbar navbar-expand-lg mb-2">
        <div class="container px-0">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/logo.svg" alt="" /></a>
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
                    <a href="" class="btn btn-primary  d-none d-md-block me-2">

                        <img class="mx-1" src="images/navbar/components/icon-wrapper-h.svg" alt="add icon" height="16"
                            width="16">
                        Publier un trajet
                    </a>
                    <!-- Check if the user is authenticated -->
                    @auth
                    <!-- If the user is authenticated, show profile image and name -->
                  
                    <div class="dropdown">
    <a href="#" class="ms-2 me-2 d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="rounded-circle me-2" src="images/navbar/profile.svg" alt="Profile Image" height="38" width="38">
        <span>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
        <li><a class="dropdown-item" href="{{ route('profile.showProfile') }}">My Profile</a></li>
        <li><a class="dropdown-item" href="#">My Reservations</a></li>
        <div class="dropdown-divider"></div>
        <li><a class="dropdown-item" href="">Logout</a></li>
    </ul>
</div>



                    @else
                    <!-- If the user is not authenticated, show sign-up button -->
                    <a href="{{ route('registration') }}" class="btn btn-outline-primary me-2">S'inscrire</a>
                    @endauth

                    
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
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
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