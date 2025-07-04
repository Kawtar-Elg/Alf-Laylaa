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
    <link rel="stylesheet" href="../../css/BeforAuthSection3.css">

</head>

<body>
    <!-- Animated background -->
    <div class="bg-animation" id="bgAnimation"></div>

    <!-- Hotels Grid -->
    <section class="hotels-grid-section3">
        <div class="container">
            <h1 class="hero-title-section3 text-center py-5">Discover the Best Hotels in Morocco !</h1>
            <p class="hero-subtitle-section3 text-center">iscount Découvrer notre iscount Découviscount Découvrer notiscoun
                t Découviscount Découvrer notre Hotele !rer notre Hotele !re Hotele !rer notre
                Hotele !Hotele !</p>
            <div class="row">

                <!-- FIRST HOTEL -->
                <div class=" col-md-4">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../../assets/hotel1.png" alt="firsthotel" class="card-hotel">
                            <div class="card-overlay-section3"></div>
                            <div class="card-content-section3">
                                <div>
                                    <h2 class="card-title">Barcélo </h2>
                                </div>
                                <div style="color: gold;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <a href="#" class="view-btn-section3" onclick="viewDestination('CasaBlanca')" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Paris Card -->
                <div class=" col-md-4">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../../assets/hotel2.png" alt="firsthotel" class="card-hotel">
                            <div class="card-overlay-section3"></div>
                            <div class="card-content-section3">
                                <div>
                                    <h2 class="card-title"> Ibis Casa Blanca</h2>
                                </div>
                                <div style="color: gold;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <button class="favorite-btn" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <a href="#" class="view-btn-section3" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="viewDestination('CasaBlanca')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bali Card -->
                <div class=" col-md-4">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../../assets/hotel3.png" alt="firsthotel" class="card-hotel">
                            <div class="card-overlay-section3"></div>
                            <div class="card-content-section3">
                                <div>
                                    <h2 class="card-title">Hilton Garden lnn</h2>
                                </div>
                                <div style="color: gold;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <button class="favorite-btn" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <a href="#" class="view-btn-section3" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="viewDestination('CasaBlanca')">
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

</html>