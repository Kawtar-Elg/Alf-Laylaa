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
        :root {
            --primary-gold: #FFD700;
            --dark-bg: #0a0a0a;
            --card-bg: rgba(255, 255, 255, 0.05);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            color: var(--text-light);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated background particles */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--primary-gold);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        /* Header styles */
        .hero-section {
            padding: 120px 0 80px;
            text-align: center;
        }

        .hero-title {
            font-family: 'Dancing Script', cursive;
            font-size: 4.5rem;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 20px rgba(255, 215, 0, 0.3);
            }

            to {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 30px rgba(255, 215, 0, 0.6);
            }
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card styles */
        .hotels-grid {
            padding: 60px 0;
        }

        .hotel-card {
            background: var(--glass-bg);
            border-radius: 25px;
            padding: 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            margin-bottom: 40px;
            animation: cardSlideIn 0.8s ease-out both;
        }

        .hotel-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .hotel-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .hotel-card:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(60px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .hotel-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(255, 215, 0, 0.2);
            border-color: rgba(255, 215, 0, 0.3);
        }

        .card-image-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
            filter: brightness(0.9);
        }

        .hotel-card:hover .card-image {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.4) 0%, transparent 50%, rgba(255, 215, 0, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .hotel-card:hover .card-overlay {
            opacity: 1;
        }

        .favorite-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #666;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .favorite-btn:hover {
            background: var(--primary-gold);
            color: white;
            transform: scale(1.1);
        }

        .favorite-btn.active {
            background: #ff4757;
            color: white;
        }

        .card-content {
            padding: 30px 25px;
        }

        .destination-name {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-light);
            position: relative;
        }

        .destination-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-gold);
            transition: width 0.4s ease;
        }

        .hotel-card:hover .destination-name::after {
            width: 60px;
        }

        .country-flag {
            width: 30px;
            height: 20px;
            border-radius: 3px;
            margin-left: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .view-btn {
            background: linear-gradient(45deg, var(--primary-gold), #ffed4a);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
        }

        .view-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .view-btn:hover::before {
            left: 100%;
        }

        .view-btn:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);
            color: #000;
            text-decoration: none;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hotel-card {
                margin-bottom: 30px;
            }

            .card-image-container {
                height: 220px;
            }
        }

        /* Loading animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 3px solid rgba(255, 215, 0, 0.3);
            border-top: 3px solid var(--primary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Animated background -->
    <div class="bg-animation" id="bgAnimation"></div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Découvrir notre Hotels</h1>
            <p class="hero-subtitle">
                Discount Découvrir notre Discount Découvrir Discount Découvrir notre notre Découvrir Discount Découvrir
                notre Hotels Ire notre Hotels ire Hotels ire notre Hotels !
            </p>
        </div>
    </section>

    <!-- Hotels Grid -->
    <section class="hotels-grid">
        <div class="container">
            <div class="row">
                <!-- Casa Blanca Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card" data-aos="fade-up">
                        <div class="card-image-container">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Casa Blanca Hotel" class="card-image">
                            <div class="card-overlay"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <h3 class="destination-name">
                                Casa Blanca
                                <img src="https://flagcdn.com/w40/ma.png" alt="Morocco Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn" onclick="viewDestination('Casa Blanca')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Paris Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card" data-aos="fade-up">
                        <div class="card-image-container">
                            <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Paris Hotel" class="card-image">
                            <div class="card-overlay"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <h3 class="destination-name">
                                Paris
                                <img src="https://flagcdn.com/w40/fr.png" alt="France Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn" onclick="viewDestination('Paris')">
                                Tout voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bali Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="hotel-card" data-aos="fade-up">
                        <div class="card-image-container">
                            <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Bali Hotel" class="card-image">
                            <div class="card-overlay"></div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <h3 class="destination-name">
                                Bali
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia Flag" class="country-flag">
                            </h3>
                            <a href="#" class="view-btn" onclick="viewDestination('Bali')">
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
    <script>
        // Loading animation
        window.addEventListener('load', function () {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 1500);
        });

        // Create animated background particles
        function createParticles() {
            const bgAnimation = document.getElementById('bgAnimation');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';

                bgAnimation.appendChild(particle);
            }
        }

        // Toggle favorite functionality
        function toggleFavorite(btn) {
            const icon = btn.querySelector('i');
            btn.classList.toggle('active');

            if (btn.classList.contains('active')) {
                icon.className = 'fas fa-heart';
                btn.style.animation = 'heartBeat 0.6s ease';
            } else {
                icon.className = 'far fa-heart';
            }

            setTimeout(() => {
                btn.style.animation = '';
            }, 600);
        }

        // View destination functionality
        function viewDestination(destination) {
            // Create a smooth fade effect
            document.body.style.transition = 'opacity 0.3s ease';
            document.body.style.opacity = '0.8';

            setTimeout(() => {
                alert(`Découvrez les merveilleux hôtels de ${destination}! 🏨✨`);
                document.body.style.opacity = '1';
            }, 300);
        }

        // Smooth scroll reveal animation
        function revealOnScroll() {
            const cards = document.querySelectorAll('.hotel-card');
            const windowHeight = window.innerHeight;

            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                const revealPoint = 100;

                if (cardTop < windowHeight - revealPoint) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                }
            });
        }

        // Mouse parallax effect
        function initParallax() {
            document.addEventListener('mousemove', (e) => {
                const cards = document.querySelectorAll('.hotel-card');
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;

                cards.forEach((card, index) => {
                    const speed = (index + 1) * 0.5;
                    const xMove = (x - 0.5) * speed;
                    const yMove = (y - 0.5) * speed;

                    card.style.transform += ` translate(${xMove}px, ${yMove}px)`;
                });
            });
        }

        // Add heartbeat animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes heartBeat {
                0% { transform: scale(1); }
                25% { transform: scale(1.2); }
                50% { transform: scale(1); }
                75% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);

        // Initialize all animations
        document.addEventListener('DOMContentLoaded', function () {
            createParticles();
            window.addEventListener('scroll', revealOnScroll);
            initParallax();

            // Add stagger animation to cards
            const cards = document.querySelectorAll('.hotel-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
            });
        });

        // Add some interactive sound effects (optional)
        function playHoverSound() {
            // This would play a subtle hover sound if audio files were available
            // For now, we'll use visual feedback only
        }

        // Enhanced hover effects
        document.querySelectorAll('.hotel-card').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.filter = 'brightness(1.1)';
                playHoverSound();
            });

            card.addEventListener('mouseleave', function () {
                this.style.filter = 'brightness(1)';
            });
        });
    </script>
</body>

</html>