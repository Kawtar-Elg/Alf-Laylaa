<?php
session_start();
require_once 'config/auth.php';
require_once 'config/database.php';

$room_id = $_GET['id'] ?? null;
if (!$room_id) {
    header('Location: rooms.php');
    exit;
}

$room = getRoomById($room_id);
if (!$room) {
    header('Location: rooms.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Rooms & Suites - Luxe Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <section class="room-detail-section mt-5 py-5">
        <div class="container mt-5">
            <div class="row mt-5">
                <!-- Room Images -->
                <div class="col-lg-8">
                    <div class="room-gallery">
                        <div class="main-image mb-3">
                            <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['name']; ?>" class="img-fluid rounded">
                            <div class="image-overlay">
                                <div class="room-badge"><?php echo $room['category']; ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($room['gallery'] as $image): ?>
                                <div class="col-4 mb-2">
                                    <img src="<?php echo $image; ?>" alt="<?php echo $room['name']; ?>" class="img-fluid rounded gallery-thumb">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Room Info & Booking -->
                <div class="col-lg-4">
                    <div class="room-details-card">
                        <div class="room-header mb-4">
                            <h1 class="room-title"><?php echo $room['name']; ?></h1>
                            <div class="room-rating mb-2">
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star text-gold"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="rating-text">4.9 (245+ Reviews)</span>
                            </div>
                            <p class="room-location">
                                <i class="fas fa-map-marker-alt text-gold"></i>
                                2040 Royal Ln, Mesa, New Jersey 45463
                            </p>
                        </div>

                        <div class="room-price-section mb-4">
                            <div class="price-display">
                                <span class="price">$<?php echo $room['price']; ?></span>
                                <span class="period">/night</span>
                            </div>
                        </div>

                        <div class="room-specs mb-4">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div class="spec-item">
                                        <i class="fas fa-users"></i>
                                        <span><?php echo $room['capacity']; ?> Guests</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="spec-item">
                                        <i class="fas fa-bath"></i>
                                        <span>Private Bath</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="spec-item">
                                        <i class="fas fa-expand-arrows-alt"></i>
                                        <span><?php echo isset($room['size']) ? $room['size'] : 'N/A'; ?> sqft</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Form -->
                        <div class="booking-form">
                            <h5 class="mb-3">Book Room</h5>
                            <form id="booking-form" action="booking.php" method="POST">
                                <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">

                                <div class="mb-3">
                                    <label class="form-label">Your Name *</label>
                                    <input type="text" class="form-control" name="guest_name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" name="phone" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label">Check-in Date *</label>
                                        <input type="date" class="form-control" name="checkin" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Check-out Date *</label>
                                        <input type="date" class="form-control" name="checkout" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label">Adults *</label>
                                        <select class="form-select" name="adults" required>
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Children</label>
                                        <select class="form-select" name="children">
                                            <option value="0">0</option>
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-luxury btn-lg w-100">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Details -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="room-details-tabs">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" type="button" role="tab">Overview</button>
                                <button class="nav-link" id="nav-amenities-tab" data-bs-toggle="tab" data-bs-target="#nav-amenities" type="button" role="tab">Room Amenities</button>
                                <button class="nav-link" id="nav-rules-tab" data-bs-toggle="tab" data-bs-target="#nav-rules" type="button" role="tab">Booking Rules</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-overview" role="tabpanel">
                                <div class="p-4">
                                    <h5>Overview</h5>
                                    <p><?php echo $room['description']; ?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-amenities" role="tabpanel">
                                <div class="p-4">
                                    <h5>Room Amenities</h5>
                                    <div class="row">
                                        <?php foreach ($room['amenities'] as $amenity): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="amenity-item">
                                                    <i class="fas fa-check-circle text-gold me-2"></i>
                                                    <?php echo $amenity; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-rules" role="tabpanel">
                                <div class="p-4">
                                    <h5>Booking Rules & Policies</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-clock text-gold me-2"></i>Check-In Information</h6>
                                            <ul class="rules-list">
                                                <li>Standard check-in: 3:00 PM</li>
                                                <li>Early check-in available from 12:00 PM (subject to availability)</li>
                                                <li>Valid government-issued photo ID required</li>
                                                <li>Credit card authorization for incidentals</li>
                                                <li>VIP guests: Private check-in available</li>
                                                <li>Advance booking confirmation required</li>
                                                <li>Special requests processed upon arrival</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-door-open text-gold me-2"></i>Check-Out Information</h6>
                                            <ul class="rules-list">
                                                <li>Standard check-out: 11:00 AM</li>
                                                <li>Late check-out until 3:00 PM (additional charges apply)</li>
                                                <li>Express check-out via mobile app or TV</li>
                                                <li>Luggage storage available after check-out</li>
                                                <li>Final bill review and payment processing</li>
                                                <li>Suite guests: Extended check-out until 1:00 PM</li>
                                                <li>Departure transportation can be arranged</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-credit-card text-gold me-2"></i>Payment & Pricing</h6>
                                            <ul class="rules-list">
                                                <li>All major credit cards accepted</li>
                                                <li>Room rates exclude taxes and service charges</li>
                                                <li>Prices subject to seasonal variations</li>
                                                <li>Advance payment required for extended stays</li>
                                                <li>Currency: USD (other currencies upon request)</li>
                                                <li>Corporate rates available with valid agreements</li>
                                                <li>Group bookings receive special pricing</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-times-circle text-gold me-2"></i>Cancellation Policy</h6>
                                            <ul class="rules-list">
                                                <li>Standard rooms: 24-hour cancellation policy</li>
                                                <li>Suites: 48-hour cancellation policy</li>
                                                <li>Peak season: 72-hour cancellation policy</li>
                                                <li>No-show charges equal to one night's stay</li>
                                                <li>Flexible rates available with different terms</li>
                                                <li>Force majeure exceptions considered</li>
                                                <li>Modification requests subject to availability</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-users text-gold me-2"></i>Guest Policies</h6>
                                            <ul class="rules-list">
                                                <li>Maximum occupancy strictly enforced</li>
                                                <li>Additional guests subject to extra charges</li>
                                                <li>Children under 12 stay free with parents</li>
                                                <li>Pet-friendly rooms available upon request</li>
                                                <li>Quiet hours: 10:00 PM - 7:00 AM</li>
                                                <li>Smoking prohibited in all indoor areas</li>
                                                <li>Visitor access requires registration</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><i class="fas fa-concierge-bell text-gold me-2"></i>Services & Amenities</h6>
                                            <ul class="rules-list">
                                                <li>24/7 room service and concierge available</li>
                                                <li>Housekeeping service twice daily</li>
                                                <li>Complimentary Wi-Fi throughout property</li>
                                                <li>Valet parking and luggage services</li>
                                                <li>Business center access 24/7</li>
                                                <li>Spa and fitness center with extended hours</li>
                                                <li>Restaurant reservations recommended</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>