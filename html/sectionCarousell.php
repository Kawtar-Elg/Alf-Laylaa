<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Dynamique - Destinations</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="../css/section2.css" rel ="stylesheet">    

</head>
<body>
    <div class="carousel-container">
        <!-- Main Carousel -->
        <div id="destinationCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#destinationCarousel" data-bs-slide-to="0" class="active"></button>
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
                            <div class="destination-card" style="background: url('../assets/fes.jpg') center/cover;">
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
                            <div class="destination-card" style="background: url('../assets/agadir.jpg') center/cover;">
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
                            <div class="destination-card" style="background: url('../assets/rabat.jpg') center/cover;">
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
                            <div class="destination-card" style="background:  url('../assets/chafchaoun.jpg') center/cover;">
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
                            <div class="destination-card" style="background: url('../assets/essauira.jpg') center/cover;">
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
                            <div class="destination-card" style="background:url('../assets/ourzazat.jpg') center/cover;">
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
            
            <button class="carousel-control-prev" type="button" data-bs-target="#destinationCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#destinationCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- Promotional Banner -->
        <div class="promo-banner">
            <div class="special-offer">SPECIAL OFFER</div>
            <div class="promo-content">
                <h3 class="promo-title">Commencez votre expérience 5 étoiles avec -20%</h3>
                <p class="promo-subtitle">sur votre première réservation !</p>
                <button class="btn btn-promo" onclick="claimPromo()">
                    <i class="fas fa-gift me-2"></i>Réclamer maintenant !
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dynamic functionality
        const destinations = [
            {
                name: 'Casablanca',
                price: '1200',
                rating: '4.8',
                attractions: ['Hassan II Mosque', 'Corniche', 'Old Medina']
            },
            {
                name: 'Marrakech',
                price: '980',
                rating: '4.9',
                attractions: ['Jemaa el-Fnaa', 'Bahia Palace', 'Majorelle Garden']
            },
            {
                name: 'Tanger',
                price: '850',
                rating: '4.7',
                attractions: ['Kasbah', 'American Legation', 'Cape Spartel']
            },
            {
                name: 'Fès',
                price: '920',
                rating: '4.8',
                attractions: ['Medina', 'Al Quaraouiyine', 'Bou Inania']
            },
            {
                name: 'Agadir',
                price: '1100',
                rating: '4.6',
                attractions: ['Beach', 'Kasbah', 'Souk El Had']
            },
            {
                name: 'Rabat',
                price: '750',
                rating: '4.5',
                attractions: ['Hassan Tower', 'Kasbah Oudayas', 'Royal Palace']
            },
            {
                name: 'Chefchaouen',
                price: '680',
                rating: '4.9',
                attractions: ['Blue Streets', 'Ras El Maa', 'Spanish Mosque']
            },
            {
                name: 'Essaouira',
                price: '890',
                rating: '4.7',
                attractions: ['Medina', 'Skala', 'Port']
            },
            {
                name: 'Ouarzazate',
                price: '1050',
                rating: '4.6',
                attractions: ['Atlas Studios', 'Kasbah Taourirt', 'Desert Tours']
            }
        ];

        // Reservation function
        function reserveDestination(destinationName) {
            const destination = destinations.find(d => d.name === destinationName);
            
            if (destination) {
                // Create dynamic modal or alert
                const modal = document.createElement('div');
                modal.innerHTML = `
                    <div class="modal fade" id="reservationModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 20px; border: none;">
                                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px 20px 0 0;">
                                    <h5 class="modal-title"><i class="fas fa-plane me-2"></i>Réservation - ${destination.name}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center" style="padding: 30px;">
                                    <div class="mb-3">
                                        <i class="fas fa-map-marker-alt text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                    <h4 class="mb-3">${destination.name}</h4>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <strong>Prix:</strong><br>
                                            <span class="text-success fs-5">${destination.price} MAD</span>
                                        </div>
                                        <div class="col-6">
                                            <strong>Note:</strong><br>
                                            <span class="text-warning fs-5">
                                                <i class="fas fa-star"></i> ${destination.rating}/5
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Attractions principales:</strong><br>
                                        <small class="text-muted">${destination.attractions.join(', ')}</small>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-lg" style="border-radius: 25px;" onclick="confirmReservation('${destination.name}')">
                                            <i class="fas fa-check me-2"></i>Confirmer la réservation
                                        </button>
                                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 25px;">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                const bootstrapModal = new bootstrap.Modal(document.getElementById('reservationModal'));
                bootstrapModal.show();
                
                // Clean up modal after hiding
                document.getElementById('reservationModal').addEventListener('hidden.bs.modal', function() {
                    document.body.removeChild(modal);
                });
            }
        }

        // Confirm reservation
        function confirmReservation(destinationName) {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('reservationModal'));
            modal.hide();
            
            // Show success message
            setTimeout(() => {
                showSuccessMessage(`Réservation confirmée pour ${destinationName}! Vous recevrez un email de confirmation.`);
            }, 500);
        }

        // Promo function
        function claimPromo() {
            showSuccessMessage('Code promo appliqué! Vous bénéficiez de -20% sur votre prochaine réservation.');
        }

        // Success message function
        function showSuccessMessage(message) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
            alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);';
            alert.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }

        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to carousel items
            const carouselItems = document.querySelectorAll('.destination-card');
            carouselItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add dynamic content loading
            const carousel = document.getElementById('destinationCarousel');
            carousel.addEventListener('slide.bs.carousel', function(e) {
                // Add slide animation effects
                const activeItem = e.relatedTarget;
                const cards = activeItem.querySelectorAll('.destination-card');
                
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 200);
                });
            });

            // Add typing effect to promo banner
            const promoTitle = document.querySelector('.promo-title');
            const originalText = promoTitle.textContent;
            let index =