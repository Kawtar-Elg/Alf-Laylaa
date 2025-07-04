<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/database.php';

if (isset($_SESSION['selectedHotelId'])) {
    $hotel_id = $_SESSION['selectedHotelId'];
    $hotel_name = $_SESSION['selectedHotelName'] ?? '';
    $rooms = getRoomsByHotelId($hotel_id);
    if (!$rooms) {
        $rooms = [];
    }
} else {
    echo "Aucun hôtel sélectionné.";
    $rooms = [];
}

$categories = array_unique(array_column($rooms, 'type'));
$price_ranges = [
    'all' => 'All Prices',
    '0-200' => 'Under $200',
    '200-400' => '$200 - $400',
    '400-600' => '$400 - $600',
    '600+' => '$600+'
];

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

    <section class="rooms-section py-5  mt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h1 class="page-title">Luxury Rooms & Suites</h1>
                    <p class="page-subtitle">Discover our exclusive collection of luxury accommodations</p>
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-3">
                    <!-- Filters -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="filters-container">
                                <div class="row d-flex flex-column">
                                    <div class="col-md-12">
                                        <h5 class="filter-title">Price Range</h5>
                                        <div class="filter-group">
                                            <?php foreach ($price_ranges as $value => $label): ?>
                                                <label class="filter-radio">
                                                    <input type="radio" name="price_filter" value="<?php echo $value; ?>"
                                                        <?php echo $value === 'all' ? 'checked' : ''; ?>>
                                                    <span class="radio-custom"></span>
                                                    <span class="radio-label"><?php echo $label; ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="filter-title">Room Type</h5>
                                        <div class="filter-group">
                                            <label class="filter-radio">
                                                <input type="radio" name="category_filter" value="all" checked>
                                                <span class="radio-custom"></span>
                                                <span class="radio-label">All Categories</span>
                                            </label>
                                            <?php foreach ($categories as $category): ?>
                                                <label class="filter-radio">
                                                    <input type="radio" name="category_filter"
                                                        value="<?php echo $category; ?>">
                                                    <span class="radio-custom"></span>
                                                    <span class="radio-label"><?php echo $category; ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9"><!-- Rooms Grid -->
                    <div class="row" id="rooms-grid">
                        <?php foreach ($rooms as $room): ?>
                            <div class="col-lg-6 col-md-6 mb-4 room-item" data-category="<?php echo $room['type']; ?>"
                                data-price="<?php echo $room['price']; ?>">
                                <div class="room-card" data-room-id="<?php echo $room['id']; ?>">
                                    <div class="room-image">
                                        <?php
                                        $images = $room['images'];

                                        if (is_string($images)) {
                                            $images = json_decode($images, true);
                                        }

                                        $firstImage = !empty($images) ? trim($images[0]) : 'https://via.placeholder.com/400x300';
                                        ?>

                                        <img src="<?php echo $firstImage; ?>" alt="<?php echo $room['name']; ?>"
                                            class="img-fluid">
                                        <div class="room-overlay">
                                            <div class="room-badge"><?php echo $room['type']; ?></div>
                                            <div class="room-actions">
                                                <a href="room-detail.php?id=<?php echo $room['id']; ?>"
                                                    class="btn btn-sm btn-luxury">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="room-info">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h5 class="room-name"><?php echo htmlspecialchars($room['name']); ?> in
                                                    <?php echo htmlspecialchars($hotel_name); ?>
                                                </h5>
                                                <h6 class="room-desc"><?php echo htmlspecialchars($room['description']); ?></h6>
                                            </div>
                                            <div class="room-rating">
                                                <i class="fas fa-star text-gold"></i>
                                                <span>4.9</span>
                                            </div>
                                        </div>
                                        <div class="room-price mb-2">
                                            <span class="price"><?php echo number_format($room['price']); ?>Dh</span>
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
                                                <i class="fas fa-expand-arrows-alt"></i> <?php echo $room['size']; ?> m²
                                            </span>
                                        </div>
                                        <div class="room-price my-2">
                                            <span class="price" style="color : white;font-size: 0.9rem;">localisation : <?php echo htmlspecialchars($room['location']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>





            <!-- No Results Message -->
            <div class="row" id="no-results" style="display: none;">
                <div class="col-12 text-center">
                    <div class="no-results-message">
                        <i class="fas fa-bed mb-3"></i>
                        <h3>No rooms found</h3>
                        <p>Try adjusting your filters to find the perfect room</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/section1.js"></script>
</body>

</html>