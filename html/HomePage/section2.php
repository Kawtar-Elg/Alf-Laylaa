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

    <style>
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            font-size: 2rem;
            color: var(--primary-gold);
            z-index: 10;
            cursor: pointer;
            transition: color 0.3s ease, opacity 0.3s ease;
        }

        .carousel-btn:disabled {
            color: #ccc !important;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .left-btn {
            left: -5rem;
        }

        .right-btn {
            right: -5rem;
        }
    </style>

</head>

<body>

    <!-- Animated Background -->
    <div class="bg-animation" id="bgAnimation"></div>

    <!-- Hotels Grid -->
    <section class="hotels-grid-section2">
        <div class="container">
            <h1 class="hero-title-section2 text-center py-5">Discover the Best Hotels in Morocco !</h1>
            <div class="row">
                <div class="position-relative">
                    <button id="prevBtn" class="carousel-btn left-btn" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button id="nextBtn" class="carousel-btn right-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <div id="cityCarousel" class="row g-4 justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>