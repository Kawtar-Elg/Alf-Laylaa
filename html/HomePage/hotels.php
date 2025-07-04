<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/database.php';

$search = $_GET['search'] ?? '';
$hotels = getHotelsBySearch($search);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Hotels - Luxe Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/section1.css">

    <style>
        .room-card{

        }
    </style>
</head>

<body style="background:#1a1a1a;">

    <?php include 'header.php'; ?>

    <section class="hotels-section py-5 mt-5">
        <div class="container mt-5">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="page-title">All Our Hotels</h1>
                    <p class="page-subtitle">Browse through our luxurious hotel options</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Search hotels by name or city...">
                </div>
            </div>

            <div class="row" id="rooms-grid">
                <?php foreach ($hotels as $hotel): ?>
                    <div class="col-lg-4 col-md-6 mb-4 room-item">
                        <div class="room-card shadow-sm">
                            <div class="room-image">
                                <img src="../../assets/hotels/<?php echo htmlspecialchars($hotel['id']); ?>.png"
                                    alt="<?php echo htmlspecialchars($hotel['name']); ?>" class="img-fluid img" />
                            </div>
                            <div class="room-info mt-3 px-3">
                                <h5 class="room-name"><?php echo htmlspecialchars($hotel['name']); ?></h5>
                                <p class="room-desc"><?php echo htmlspecialchars($hotel['description']); ?></p>
                                <a href="rooms.php?hotel_id=<?php echo $hotel['id']; ?>" class="btn btn-sm btn-luxury mt-2">
                                    View Rooms
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($hotels)): ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-muted">No hotels found.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/section1.js"></script>
    <script src="../../js/section2.js"></script>
    <script src="../../js/section3.js"></script>
    <script src="../../js/hotels.js"></script>
</body>

</html>