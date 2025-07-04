<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/database.php';

$error = '';
$success = false;
$booking_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $room_id = $_POST['room_id'] ?? '';
    $guest_name = trim($_POST['guest_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $checkin = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';
    $adults = intval($_POST['adults'] ?? 1);
    $children = intval($_POST['children'] ?? 0);

    // Validate required fields
    if (empty($room_id) || empty($guest_name) || empty($phone) || empty($checkin) || empty($checkout)) {
        $error = 'Please fill in all required fields.';
    } else {
        try {
            // Get room details
            $room = getRoomById($room_id);
            if (!$room) {
                $error = 'Room not found.';
            } else {
                // Calculate number of nights
                $checkin_date = new DateTime($checkin);
                $checkout_date = new DateTime($checkout);
                $nights = $checkin_date->diff($checkout_date)->days;

                if ($nights <= 0) {
                    $error = 'Invalid check-in or check-out date.';
                } else {
                    // Parse images
                    if (is_array($room['images'])) {
                        $images = $room['images'];
                    } else {
                        $images = json_decode($room['images'], true);

                        // Fallback: si le JSON est invalide, on fait une conversion manuelle
                        if (!is_array($images)) {
                            $images = explode(',', str_replace(['[', ']', '"'], '', $room['images']));
                        }
                    }

                    // Calculate total price
                    $total_price = $room['price'] * $nights;

                    // Generate booking ID
                    $booking_id = 'LH' . date('Ymd') . rand(1000, 9999);

                    // Call createBooking function
                    if (createBooking(isLoggedIn() ? getCurrentUser()['id'] : null, $room_id, $checkin, $checkout, $adults + $children, $total_price)) {
                        $success = true;
                    } else {
                        $error = 'Failed to save booking to the database.';
                    }
                }
            }
        } catch (Exception $e) {
            $error = 'An unexpected error occurred: ' . $e->getMessage();
        }
    }
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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/section1.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="booking-confirmation py-5 mt-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php if ($success): ?>
                        <div class="confirmation-card text-center">
                            <div class="confirmation-icon mb-4">
                                <i class="fas fa-check-circle text-success fa-3x"></i>
                            </div>
                            <h2 class="mb-3">Booking Confirmed!</h2>
                            <p class="mb-4">Your reservation has been successfully confirmed.</p>
                            <div class="booking-details text-start">
                                <h5>Booking Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Booking ID:</strong> #<?php echo htmlspecialchars($booking_id); ?></p>
                                        <p><strong>Room:</strong> <?php echo htmlspecialchars($room['name']); ?></p>
                                        <p><strong>Guest:</strong> <?php echo htmlspecialchars($guest_name); ?></p>
                                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Check-in:</strong> <?php echo date('M j, Y', strtotime($checkin)); ?></p>
                                        <p><strong>Check-out:</strong> <?php echo date('M j, Y', strtotime($checkout)); ?></p>
                                        <p><strong>Guests:</strong> <?php echo $adults; ?> Adults<?php if ($children > 0): echo ", $children Children";
                                                                                                    endif; ?></p>
                                        <p><strong>Total Price:</strong> $<?php echo number_format($total_price, 2); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="confirmation-actions mt-4">
                                <a href="rooms.php" class="btn btn-outline-luxury me-2"><i class="fas fa-arrow-left me-2"></i>Browse More Rooms</a>
                                <?php if (isLoggedIn()): ?>
                                    <a href="dashboard.php" class="btn btn-luxury">Go to Dashboard</a>
                                <?php else: ?>
                                    <a href="index.php" class="btn btn-luxury">Return Home</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="error-card text-center">
                            <div class="error-icon mb-4">
                                <i class="fas fa-exclamation-triangle text-danger fa-3x"></i>
                            </div>
                            <h2 class="mb-3">Booking Failed</h2>
                            <p class="mb-4"><?php echo $error ?: 'An unknown error occurred.'; ?></p>
                            <a href="javascript:history.back()" class="ms-2 btn-luxury">Try Again</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>