<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Découvrir notre Hotels</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../../css/BeforAuthSection2.css">
        
</head>

<body>
    <!-- Loading overlay -->
    
    <!-- Animated background -->
    <div class="bg-animation" id="bgAnimation"></div>

    <!-- Hotels Grid -->
    <section class="hotels-grid-section2">
        <div class="container">
            <h1 class="hero-title-section2 text-center py-5">Discover the Best Hotels in Morocco !</h1>
            <div class="row">
                <!-- Casa Blanca Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section2" data-aos="fade-up">
                        <div class="card-image-container-section2">
                            <img src="../../assets/casaNight.jpg" alt="CasaBlanca Hotel" class="card-image">
                            <div class="card-overlay-section2"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section2">
                            <h3 class="destination-name-section2">
                                Casa Blanca
                                <img src="https://flagcdn.com/w40/ma.png" alt="Morocco Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section2" onclick="viewDestination('CasaBlanca')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Paris Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section2" data-aos="fade-up">
                        <div class="card-image-container-section2">
                            <img src="../../assets/paris.jpg" alt="Paris Hotel" class="card-image">
                            <div class="card-overlay-section2"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section2">
                            <h3 class="destination-name-section2">
                                Paris
                                <img src="https://flagcdn.com/w40/fr.png" alt="France Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section2" onclick="viewDestination('Paris')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bali Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section2" data-aos="fade-up">
                        <div class="card-image-container-section2">
                            <img src="../../assets/balii.jpg"
                                alt="Bali Hotel" class="card-image">
                            <div class="card-overlay-section2"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section2">
                            <h3 class="destination-name-section2">
                                Bali
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section2" onclick="viewDestination('Bali')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
<script src="../../js/section2.js"></script>

</html>