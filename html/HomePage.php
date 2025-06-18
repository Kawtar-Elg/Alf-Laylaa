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
    <link href="../css/section2.css" rel="stylesheet">
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
</head>


<body>
    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top my-navbar">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#">
                    <img src="../assets/logo.png" alt="Logo" class="logo-img">
                </a>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav d-flex gap-4">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#hotels">Our Hotels</a></li>
                        <li class="nav-item"><a class="nav-link" href="#reviews">Reviews</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                    </ul>
                </div>

                <a class="btn-login text-light" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </div>
        </nav>

    </header>
    <section id="home" class="hero-section">
        <!-- Video Background -->
        <video autoplay muted loop class="video-background">
            <source src="../assets/video1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Dark overlay -->
        <div class="overlay"></div>

        <!-- Content on top of video -->
        <div class="container">
            <div class="row align-items-center">
                <!-- First Column - Welcome Text -->
                <div class="col-md-6">
                    <div class="hero-content">

                        <p class="hero-subtitle">Commencez votre expérience 5 étoiles avec -20%
                            sur votre première réservation !</p>
                        <button type="submit" class="btn btn-search">Réclamer maintenant ! </button>
                    </div>
                </div>

                <!-- Second Column - Booking Form -->
                <div class="col-md-6">
                    <div class="form-container animate_animated animate_fadeInUp">
                        <h1 class="form-title">
                            <!--  <i class="fas fa-hotel"></i> -->
                            Find Your Stay
                        </h1>

                        <div id="successMessage" class="success-message">
                            <i class="fas fa-check-circle"></i>
                            Booking request submitted successfully!
                        </div>

                        <div id="errorMessage" class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            Please fill in all required fields.
                        </div>

                        <form id="reservationForm" method="POST">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Destination
                                </label>
                                <input type="text" class="form-control" name="destination"
                                    placeholder="Where are you going?" required>
                            </div>

                            <div class="date-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-check"></i>
                                        Check In
                                    </label>
                                    <input type="date" class="form-control" name="checkin" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-times"></i>
                                        Check Out
                                    </label>
                                    <input type="date" class="form-control" name="checkout" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-bed"></i>
                                    Room Type
                                </label>
                                <select class="form-select" name="room_type" required>
                                    <option value="">Select Room Type</option>
                                    <option value="standard">Standard Room</option>
                                    <option value="deluxe">Deluxe Room</option>
                                    <option value="suite">Suite</option>
                                    <option value="presidential">Presidential Suite</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-users"></i>
                                    Guests
                                </label>

                                <div class="guest-counter">
                                    <span class="guest-type">Adults</span>
                                    <div class="counter-controls">
                                        <button type="button" class="counter-btn" onclick="updateCounter('adults', -1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="counter-value" id="adults-count">2</span>
                                        <button type="button" class="counter-btn" onclick="updateCounter('adults', 1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="guest-counter mt-3">
                                    <span class="guest-type">Children</span>
                                    <div class="counter-controls">
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('children', -1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="counter-value" id="children-count">0</span>
                                        <button type="button" class="counter-btn"
                                            onclick="updateCounter('children', 1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>


                    <input type="hidden" name="adults" id="adults-input" value="2">
                    <input type="hidden" name="children" id="children-input" value="0">

                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Search Hotels
                    </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section>
        <div class="container">
            <!-- Main Carousel -->
            <div id="destinationCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="destination-card casablanca">
                                    <div class="card-content">
                                        <h2 class="card-title">Casablanca</h2>
                                        <p class="card-subtitle">Découvrez la capitale économique du Maroc</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Casablanca')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card marrakech">
                                    <div class="card-content">
                                        <h2 class="card-title">Marrakech</h2>
                                        <p class="card-subtitle">La perle rouge du Maroc et ses traditions</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Marrakech')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card tanger">
                                    <div class="card-content">
                                        <h2 class="card-title">Tanger</h2>
                                        <p class="card-subtitle">Porte de l'Afrique sur la Méditerranée</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Tanger')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background: url('../assets/fes.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Fès</h2>
                                        <p class="card-subtitle">La capitale spirituelle du Maroc</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Fès')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background: url('../assets/agadir.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Agadir</h2>
                                        <p class="card-subtitle">Soleil, plages et modernité</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Agadir')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background: url('../assets/rabat.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Rabat</h2>
                                        <p class="card-subtitle">La capitale administrative du royaume</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Rabat')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background:  url('../assets/chafchaoun.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Chefchaouen</h2>
                                        <p class="card-subtitle">La perle bleue du Rif</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Chefchaouen')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background: url('../assets/essauira.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Essaouira</h2>
                                        <p class="card-subtitle">La cité des vents atlantiques</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Essaouira')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="destination-card"
                                    style="background:url('../assets/ourzazat.jpg') center/cover;">
                                    <div class="card-content">
                                        <h2 class="card-title">Ouarzazate</h2>
                                        <p class="card-subtitle">La porte du désert</p>
                                        <button class="btn btn-reserver" onclick="reserveDestination('Ouarzazate')">
                                            <i class="fas fa-plane me-2"></i>Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#destinationCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#destinationCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <!-- Promotional Banner -->
            <!-- <div class="promo-banner">
                <div class="special-offer">SPECIAL OFFER</div>
                <div class="promo-content">
                    <h3 class="promo-title">Commencez votre expérience 5 étoiles avec -20%</h3>
                    <p class="promo-subtitle">sur votre première réservation !</p>
                    <button class="btn btn-promo" onclick="claimPromo()">
                        <i class="fas fa-gift me-2"></i>Réclamer maintenant !
                    </button>
                </div>
            </div> -->
        </div>

        <!-- here insert the code of -->

        <?php include 'section3.php'; ?>

    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="/js/section1.js"></script>
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.my-navbar');
            if (window.scrollY > 800) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

</body>


</html>