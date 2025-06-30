<?php
require '../../config/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotelId = $_POST['hotel_id'] ?? null;

    if ($hotelId !== null) {
        $_SESSION['selected_hotel_id'] = $hotelId;

        echo json_encode([
            'success' => true,
            'message' => 'Hotel ID saved in session.',
            'stored_id' => $hotelId
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing hotel_id']);
    }
    exit;
}

if (isset($_SESSION['selected_hotel_id'])) {
    $hotel_id = $_SESSION['selected_hotel_id'];
    $rooms = getRoomsByHotelId($hotel_id);
    $featured_rooms = array_slice($rooms, 0, 3);
} else {
    echo "Aucun hôtel sélectionné.";
}

?>

<?php include 'SousListHeader.php'; ?>

<!-- Featured Rooms Section -->

<section class="featured-rooms py-5" id="sousListRooms">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="hero-title-section3">Featured Luxury Rooms & Suites</h2>
                <p class="hero-subtitle-section3">Handpicked accommodations for the ultimate luxury experience</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($featured_rooms as $room): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="room-card" data-room-id="<?php echo $room['id']; ?>">
                        <div class="room-image">
                            <?php
                            $images = $room['images'];

                            if (is_string($images)) {
                                $images = json_decode($images, true);
                            }

                            $firstImage = !empty($images) ? trim($images[0]) : 'https://via.placeholder.com/400x300';
                            ?>

                            <img src="<?php echo $firstImage; ?>" alt="<?php echo $room['name']; ?>" class="img-fluid">
                            <div class="room-overlay">
                                <div class="room-badge"><?php echo $room['type']; ?></div>
                                <div class="room-actions">
                                    <a href="room-detail.php?id=<?php echo $room['id']; ?>" class="btn btn-sm btn-luxury">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="room-info">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="room-name"><?php echo $room['name']; ?></h5>
                                <div class="room-rating">
                                    <i class="fas fa-star text-gold"></i>
                                    <span>4.9</span>
                                </div>
                            </div>
                            <div class="room-price mb-2">
                                <span class="price">$<?php echo number_format($room['price']); ?></span>
                                <span class="period">/night</span>
                            </div>
                            <div class="room-features">
                                <span class="feature">
                                    <i class="fas fa-users"></i> <?php echo $room['capacity']; ?> Guests
                                </span>
                                <span class="feature">
                                    <i class="fas fa-bath"></i> Private Bath
                                </span>
                                <span class="feature">
                                    <i class="fas fa-expand-arrows-alt"></i> <?php echo $room['size']; ?> sqft
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="rooms.php" class="btn btn-outline-luxury btn-lg">View All Rooms</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5" id="sousListServices">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="hero-title-section3">Luxury Services</h2>
                <p class="hero-subtitle-section3">Exceptional amenities for an unforgettable stay</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <h5>24/7 Luxury Concierge</h5>
                    <p>Dedicated personal concierge service with multilingual staff, VIP experience planning, exclusive access arrangements, and personalized assistance for every request</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h5>Award-Winning Spa</h5>
                    <p>World-class spa facilities featuring therapeutic treatments, wellness therapies, premium skincare, massage services, and holistic healing experiences</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h5>Michelin-Star Dining</h5>
                    <p>Exceptional culinary experiences with renowned chefs, fine dining restaurants, private chef services, wine sommelier, and customized gourmet menus</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h5>Premium Transportation</h5>
                    <p>Luxury vehicle fleet including limousines, sports cars, helicopter transfers, yacht charters, and personalized city tours with professional chauffeurs</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h5>Fitness & Wellness</h5>
                    <p>State-of-the-art fitness center, personal trainers, yoga studios, swimming pool, tennis court, and comprehensive wellness programs</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h5>Business Center</h5>
                    <p>Executive business facilities with meeting rooms, conference halls, high-speed internet, secretarial services, and event planning assistance</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h5>Family Services</h5>
                    <p>Comprehensive family amenities including babysitting, children's activities, family entertainment, educational programs, and kid-friendly dining options</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>VIP Security</h5>
                    <p>Discrete security services, private entrances, secure transportation, personal protection, and comprehensive privacy measures for distinguished guests</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>