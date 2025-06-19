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
    <link href="../css/section4.css" rel="stylesheet">
    <link href="../css/section5.css" rel="stylesheet">
    <link href="../css/section6.css" rel="stylesheet">
    <link href="../css/section2.css" rel="stylesheet">
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

    <div class="main-container">

        <section class="container">
            <div>
                <nav class="navbar navbar-expand navbar-custom px-5 py-3">
                    <div class="container-fluid d-flex justify-content-around">
                        <a class="nav-link active" href="#">Aperçu</a>
                        <a class="nav-link" href="#">Chambres</a>
                        <a class="nav-link" href="#">Avis des voyageurs</a>
                        <a class="nav-link" href="#">Services et équipements</a>
                    </div>
                </nav>
            </div>

            <div class="mt-4 position-relative">
                <div class="price">/ 380 £</div>
                <h1 class="hotel-title">Marina Hotel</h1>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i> Secteur Touristique, Agadir - <a href="#">Voir sur la
                        carte</a>
                </div>

                <div class="container mt-4">
                    <div class="row">
                        <!-- Partie Gauche -->
                        <div class="col-4 d-flex align-items-center justify-content-center p-0">
                            <div class="image-container" style="background-image: url('./assets/hotel-pic-01.png');">
                            </div>
                        </div>

                        <!-- Partie Droite -->
                        <div class="col-8 d-flex flex-column justify-content-between">
                            <!-- Première ligne -->
                            <div class="d-flex justify-content-between mb-3">
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-02.png?text=Room+Image');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-03.png');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-04.png');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-05.png');">
                                    </div>
                                </div>
                            </div>

                            <!-- Deuxième ligne -->
                            <div class="d-flex justify-content-between">
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-06.png');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-07.png');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-08.png');">
                                    </div>
                                </div>
                                <div class="w-25 p-1">
                                    <div class="image-container"
                                        style="background-image: url('./assets/hotel-pic-02.png');">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex ">
                    <div class="description mt-4 col-6">
                        <h3>Description de l'établissement</h3>
                        <p>
                            Ouvert depuis : 2023<br>
                            Nombre de chambres : 130<br>
                            En choisissant Crowne Plaza Marseille Le Dome by IHG, vous serez au cœur de Marseille, à 2
                            min
                            en
                            voiture de Palais Longchamp et à 6 min de Vieux-Port de Marseille. Cet hôtel se trouve à 4,4
                            km
                            de
                            Grand
                            Port Maritime de Marseille et à 5,7 km de Stade Vélodrome.
                        </p>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-start"> <button
                            class="btn btn-custom mt-3">Selectionner un chambre !</button></div>
                </div>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-center">
                <button class="btn btn-custom ">Aucune chambre n'est disponible pour les dates que vous avez
                    sélectionnées. Vous pouvez cependant
                    réserver pour les dates suivantes :</button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column justify-content-center mb-5">
                    <div class="wpcarousel-container-x9k2">
                        <button class="wpcarousel-nav-d4h8 wpprev-btn-z8x5" id="wpPrevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div class="wpcarousel-wrapper-h3s1" style="overflow: hidden;">
                            <div class="wpcarousel-track-m7n4" id="wpCarouselTrack">
                                <!-- Package Cards -->
                                <div class="wppackage-card-b5q8 wpactive-state-r3t7">
                                    <div class="wpcard-date-l6w1">Sam. 24 mai-Dim. 25 mai</div>
                                    <div class="wpcard-price-p9e3">À partir de 316 €</div>
                                </div>

                                <div class="wppackage-card-b5q8">
                                    <div class="wpcard-date-l6w1">Sam. 31 mai-Dim. 1 juin</div>
                                    <div class="wpcard-price-p9e3">À partir de 295 €</div>
                                </div>

                                <div class="wppackage-card-b5q8">
                                    <div class="wpcard-date-l6w1">Sam. 7 juin-Dim. 8 juin</div>
                                    <div class="wpcard-price-p9e3">À partir de 340 €</div>
                                </div>

                                <div class="wppackage-card-b5q8">
                                    <div class="wpcard-date-l6w1">Sam. 14 juin-Dim. 15 juin</div>
                                    <div class="wpcard-price-p9e3">À partir de 275 €</div>
                                </div>

                                <div class="wppackage-card-b5q8">
                                    <div class="wpcard-date-l6w1">Sam. 21 juin-Dim. 22 juin</div>
                                    <div class="wpcard-price-p9e3">À partir de 380 €</div>
                                </div>

                                <div class="wppackage-card-b5q8">
                                    <div class="wpcard-date-l6w1">Sam. 28 juin-Dim. 29 juin</div>
                                    <div class="wpcard-price-p9e3">À partir de 310 €</div>
                                </div>
                            </div>
                        </div>

                        <button class="wpcarousel-nav-d4h8 wpnext-btn-k2j9" id="wpNextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                    </div>
                    <div class="wpcarousel-indicators-s1v6" id="wpIndicators">
                        <!-- Indicators will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <div class="room-container d-flex flex-column">
                        <!-- Room Image -->
                        <div class="image-container" style="background-image: url('./assets/hotel-pic-01.png');">
                        </div>
                        <!-- Room Details -->
                        <div class="room-details description">
                            <h3><i class="fas fa-bed"></i> 2 lits simples</h3>
                            <div class="room-info">
                                <p><i class="fas fa-smoking-ban"></i>Non-fumeurs</p>
                                <p><i class="fas fa-ruler-combined"></i>23 m²</p>
                                <p><i class="fas fa-snowflake"></i> Climatisation</p>
                                <p><i class="fas fa-bath"></i> Salle de bains</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <!-- Card Group -->
                    <div class="card-group">

                        <div class="card-header1">
                            Prix d'aujourd'hui
                        </div>
                        <div class="card-header">
                            Occupation
                        </div>
                        <div class="card-header">
                            Vos préférences
                        </div>
                        <!-- First Card -->
                        <div
                            class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-coffee"></i> Excellent petit déjeuner pour 22,00 €
                                        (facultatif)</li>
                                    <li class="mb-2"><i class="fas fa-times-circle"></i> Annulation gratuite avant le 23
                                        mai, 16 h 00</li>
                                    <li class="mb-2"><i class="fas fa-check-circle"></i> Confirmation immédiate</li>
                                    <li class="mb-2"><i class="fas fa-money-bill-alt"></i> Préréception en ligne</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Second Card -->
                        <div class="card">

                            <div
                                class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                                <i class="fas fa-user"></i>
                                <span>+4</span>
                            </div>
                        </div>
                        <!-- Third Card -->
                        <div
                            class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                            <div class="card-body">
                                <div class="price-discount">
                                    Reduction special ! -15%
                                </div>
                                <p>233 £ / night</p>
                                <p class="price-current">330£</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button class="reservation-button">Réserver</button>
                                <i class="far fa-heart heart-icon"></i>
                            </div>
                        </div>
                        <!-- Fourth Card -->
                        <div
                            class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-coffee"></i> Excellent petit déjeuner pour 22,00 € (facultatif)
                                    </li>
                                    <li><i class="fas fa-times-circle"></i> Annulation gratuite avant le 23 mai, 16 h 00
                                    </li>
                                    <li><i class="fas fa-check-circle"></i> Confirmation immédiate</li>
                                    <li><i class="fas fa-money-bill-alt"></i> Préréception en ligne</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Fifth Card -->
                        <div
                            class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                                <span>+5</span>
                            </div>
                        </div>
                        <!-- Sixth Card -->
                        <div
                            class="card bg-transparent rounded-2 d-flex align-items-center justify-content-center text-start">
                            <div class="card-body">
                                <div class="price-discount">
                                    Frais et taxes inclus plus que 2 !
                                </div>
                                <p>105 €</p>
                                <p>98 €</p>
                                <p>+ 2 € taxes et frais</p>
                                <p class="price-current">330£</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button class="reservation-button">Réserver</button>
                                <i class="far fa-heart heart-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- Custom JS -->

    <script src="../js/section1.js"></script>
    <script src="../js/ticket_carousel.js"></script>
    <script>
        window.addEventListener('scroll', function() {
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