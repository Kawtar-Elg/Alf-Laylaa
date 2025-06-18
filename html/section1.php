<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Najma - Luxury Hotel Experience</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="../css/section1.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">


</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-crown crown-icon"></i>
                Hotel Najma
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hotels">Our Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="#" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Video Background -->
    <section id="home" class="hero-section">
        <video autoplay muted loop class="video-background">
            <source src="../assets/video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>

        <div class="hero-content">
            <h1 class="hero-title">Welcome To Hotel Najma</h1>
            <p class="hero-subtitle">Experience luxury redefined in the heart of Morocco</p>
        </div>

        <!-- Booking Form Section -->
        <div class="booking-section">
            <div class="booking-form-horizontal">
                <form id="bookingForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" id="destination"
                                placeholder="Ville, aéroport, région, point d'intérêt ou nom de...">
                        </div>

                        <div class="form-group">
                            <label for="checkin">Arrivée le</label>
                            <input type="date" class="form-control" id="checkin">
                            <small class="date-display" id="checkinDisplay">0 nuit</small>
                        </div>

                        <div class="form-group">
                            <label for="checkout">Départ le</label>
                            <input type="date" class="form-control" id="checkout">
                            <small class="date-display" id="checkoutDisplay">Sélection de la...</small>
                        </div>

                        <div class="form-group">
                            <label for="guests">Chambres et voyageurs</label>
                            <select class="form-select" id="guests">
                                <option selected>1 chambre, 2 adultes, 0 enfant</option>
                                <option value="1">1 chambre, 1 adulte, 0 enfant</option>
                                <option value="2">1 chambre, 2 adultes, 1 enfant</option>
                                <option value="3">2 chambres, 4 adultes, 0 enfant</option>
                                <option value="4">2 chambres, 4 adultes, 2 enfants</option>
                            </select>
                        </div>

                        <div class="form-group search-group">
                            <button type="submit" class="btn btn-search">
                                <i class="fas fa-search me-2"></i>Rechercher
                            </button>
                        </div>
                    </div>

                    <div class="form-extras">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="businessTravel">
                            <label class="form-check-label" for="businessTravel">
                                <i class="fas fa-briefcase me-2"></i>Je voyage pour le travail
                            </label>
                        </div>

                        <div class="star-rating-section">
                            <label class="form-label">Nombre d'étoiles</label>
                            <div class="star-rating">
                                <span class="star" data-rating="2">2 <i class="fas fa-star"></i></span>
                                <span class="star" data-rating="3">3 <i class="fas fa-star"></i></span>
                                <span class="star" data-rating="4">4 <i class="fas fa-star"></i></span>
                                <span class="star" data-rating="5">5 <i class="fas fa-star"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login to Hotel Najma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-search">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="/js/section1.js">
</body>
</html >