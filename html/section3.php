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
        <link rel="stylesheet" href="../css/section3.css">
        <link rel="stylesheet" href="../css/backgroundAnimated.css">
        
</head>

<body>
    <!-- Loading overlay -->
    <div class="loading-overlay-section3" id="loadingOverlay">
        <div class="spinner-section3"></div>
    </div>

    <!-- Animated background -->
    <!-- <div class="bg-animation" id="bgAnimation"></div> -->

    <!-- Hotels Grid -->
    <section class="hotels-grid-section3">
        <div class="container">
            <h1 class="hero-title-section3 text-center py-5">Discover the Best Hotels in Morocco !</h1>
            <div class="row">
                <!-- Casa Blanca Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../assets/casaNight.jpg" alt="CasaBlanca Hotel" class="card-image">
                            <div class="card-overlay-section3"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <h3 class="destination-name-section3">
                                Casa Blanca
                                <img src="https://flagcdn.com/w40/ma.png" alt="Morocco Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section3" onclick="viewDestination('CasaBlanca')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Paris Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../assets/paris.jpg" alt="Paris Hotel" class="card-image">
                            <div class="card-overlay-section3"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <h3 class="destination-name-section3">
                                Paris
                                <img src="https://flagcdn.com/w40/fr.png" alt="France Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section3" onclick="viewDestination('Paris')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bali Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="../assets/balii.jpg"
                                alt="Bali Hotel" class="card-image">
                            <div class="card-overlay-section3"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <h3 class="destination-name-section3">
                                Bali
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn-section3" onclick="viewDestination('Bali')">
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
<script src="../js/section3.js"></script>
<script>
    // Generate celestial orbs
    function createCelestialOrbs() {
        const container = document.getElementById('cosmicWrapper');
        const orbCount = 200;

        for (let i = 0; i < orbCount; i++) {
            const orb = document.createElement('div');
            orb.className = 'celestial-orb';

            // Random size classification
            const sizes = ['micro-star', 'mid-star', 'mega-star'];
            const randomSize = sizes[Math.floor(Math.random() * sizes.length)];
            orb.classList.add(randomSize);

            // More aureate gems - 50/50 mix
            if (Math.random() < 0.5) {
                orb.classList.add('aureate-gem');
            }

            // Random horizontal position
            orb.style.left = Math.random() * 100 + '%';
            orb.style.top = '-10px'; // Start above screen

            // Random animation delay and duration
            orb.style.animationDelay = Math.random() * 5 + 's';

            // Random fall duration
            const fallDuration = Math.random() * 4 + 6; // 6-10 seconds
            orb.style.animationDuration = `3s, ${fallDuration}s`;

            container.appendChild(orb);
        }
    }

    // Generate cosmic meteors
    function createCosmicMeteors() {
        const container = document.getElementById('cosmicWrapper');

        setInterval(() => {
            if (Math.random() < 0.3) {
                const meteor = document.createElement('div');
                meteor.className = 'cosmic-meteor';

                // Random starting position
                meteor.style.left = Math.random() * 100 + 'px';
                meteor.style.top = Math.random() * window.innerHeight + 'px';

                container.appendChild(meteor);

                // Remove after animation
                setTimeout(() => {
                    meteor.remove();
                }, 3000);
            }
        }, 2000);
    }

    // Generate ethereal dust
    function createEtherealDust() {
        const container = document.getElementById('cosmicWrapper');
        const dustCount = 50;

        for (let i = 0; i < dustCount; i++) {
            const dust = document.createElement('div');
            dust.className = 'ethereal-dust';

            dust.style.left = Math.random() * 100 + '%';
            dust.style.top = '-5px'; // Start above screen
            dust.style.animationDelay = Math.random() * 8 + 's';
            dust.style.animationDuration = `8s, ${(Math.random() * 4 + 10)}s`; // 10-14s fall

            container.appendChild(dust);
        }
    }

    // Generate astral connections
    function createAstralConnections() {
        const container = document.getElementById('cosmicWrapper');

        setInterval(() => {
            if (Math.random() < 0.2) {
                const line = document.createElement('div');
                line.className = 'astral-line';

                line.style.left = Math.random() * 100 + '%';
                line.style.top = Math.random() * 100 + '%';
                line.style.transform = `rotate(${Math.random() * 360}deg)`;

                container.appendChild(line);

                setTimeout(() => {
                    line.remove();
                }, 4000);
            }
        }, 3000);
    }

    // Initialize all cosmic animations
    document.addEventListener('DOMContentLoaded', function() {
        createCelestialOrbs();
        createEtherealDust();
        createCosmicMeteors();
        createAstralConnections();
    });

    // Add celestial interaction
    document.addEventListener('mousemove', function(e) {
        const orbs = document.querySelectorAll('.celestial-orb');
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        orbs.forEach((orb, index) => {
            if (index % 10 === 0) { // Only affect every 10th orb for performance
                const speed = 0.5;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;

                orb.style.transform = `translate(${x * 20}px, ${y * 20}px) scale(1.2)`;
            }
        });
    });

    // Reset orb positions when mouse leaves
    document.addEventListener('mouseleave', function() {
        const orbs = document.querySelectorAll('.celestial-orb');
        orbs.forEach(orb => {
            orb.style.transform = '';
        });
    });
</script>

</html>