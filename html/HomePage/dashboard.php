<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/database.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();
$bookings = getBookingsByUserId($user['id']);
$user_stats = getUserBookingStats($user['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Alf-Layla</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/section1.css" rel="stylesheet" />
    <link href="../../css/section2.css" rel="stylesheet" />
    <link href="../../css/section3.css" rel="stylesheet" />
    <link href="../../css/section4.css" rel="stylesheet" />

    <style>
         /* Dashboard Hero Section */
        .dashboard-hero {
            position: relative;
            height: 40vh;
            min-height: 300px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-hero .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
        }

        .dashboard-hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .dashboard-hero .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
        }

        .dashboard-hero .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .dashboard-hero .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        /* Dashboard Navigation */
        .dashboard-nav {
            border-right: 1px solid #e0e0e0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-nav .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 8px;
            color: #f1f1f1;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .dashboard-nav .nav-item i {
            margin-right: 12px;
            width: 24px;
            text-align: center;
            color: #777;
            transition: color 0.3s ease;
        }

        /* Hover effect */
        .dashboard-nav .nav-item:hover {
            background-color: #ffd700;
            color: #000;
        }

        .dashboard-nav .nav-item:hover i {
            color: #333;
        }

        /* Active state */
        .dashboard-nav .nav-item.active,
        .dashboard-nav .nav-item.active i {
            background-color: #ffd700;
            color: #000;
            font-weight: bold;
            border-radius: 8px;
        }

        .text-gold {
            color: #D4AF37 !important;
        }

        .spinner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            background: rgba(255, 255, 255, 0.6);
            /* semi-transparent backdrop */
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        /* Responsive tweak */
        @media (max-width: 768px) {
            .dashboard-nav {
                flex-direction: row;
                overflow-x: auto;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }

            .dashboard-nav .nav-item {
                white-space: nowrap;
                padding: 10px 14px;
                font-size: 14px;
            }
        }

        
    </style>
</head>

<body style="background:#1a1a1a;">
    <?php include 'header.php'; ?>

    <section class="hero-section dashboard-hero">
        <video autoplay muted loop class="video-background">
            <source src="../../assets/video1.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 ">
                    <div class="hero-content d-flex flex-column justify-content-center align-items-center text-center ">
                        <h1 class="hero-title mb-2">
                            Welcome to Your Dashboard
                        </h1>
                        <p class="hero-subtitle">
                            Manage your bookings and explore luxury accommodations
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section py-5 ">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="user-profile mb-4">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5 class="user-name"><?php echo $user['name']; ?></h5>
                            <p class="user-email"><?php echo $user['email']; ?></p>
                        </div>
                        <nav class="dashboard-nav">
                            <a href="#overview" class="nav-item active" data-tab="overview">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Overview
                            </a>
                            <a href="#bookings" class="nav-item" data-tab="bookings">
                                <i class="fas fa-calendar-check me-2"></i>
                                My Bookings
                            </a>
                            <a href="#favorites" class="nav-item " data-tab="favorites">
                                <i class="fas fa-heart me-2"></i>
                                Favorites
                            </a>
                            <a href="#profile" class="nav-item" data-tab="profile">
                                <i class="fas fa-user-cog me-2"></i>
                                Profile Settings
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9 ">
                    <!-- Overview Tab -->
                    <div class="tab-content active p-3" id="overview">
                        <div class="dashboard-header mb-4">
                            <h2>Dashboard Overview</h2>
                            <p>Welcome back, <?php echo $user['name']; ?>!</p>
                        </div>

                        <!-- Stats Cards -->
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $user_stats['total_bookings']; ?></h3>
                                        <p>Total Bookings</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $user_stats['pending_bookings']; ?></h3>
                                        <p>Pending</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo number_format($user_stats['total_spent']); ?>Dh</h3>
                                        <p>Total Spent</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3><?php echo $user_stats['favorite_rooms']; ?></h3>
                                        <p>Favorites</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Bookings -->
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5>Recent Bookings</h5>
                                <a href="#bookings" class="btn-sm btn-outline-luxury ms-2" data-tab="bookings">View
                                    All</a>
                            </div>
                            <div class="card-body">
                                <?php if (empty($bookings)): ?>
                                            <div class="text-center py-4">
                                                <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                                                <p>No bookings found</p>
                                                <a href="rooms.php" class="btn btn-luxury">Book Your First Room</a>
                                            </div>
                                <?php else: ?>
                                            <?php foreach (array_slice($bookings, 0, 3) as $booking): ?>
                                                        <div class="booking-item">
                                                            <div class="booking-info">
                                                                <h6><?php echo $booking['room_name']; ?></h6>
                                                                <p class="mb-1">
                                                                    <i class="fas fa-calendar"></i>
                                                                    <?php echo date('M j, Y', strtotime($booking['checkin'])); ?> -
                                                                    <?php echo date('M j, Y', strtotime($booking['checkout'])); ?>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <span class="badge badge-<?php echo $booking['status']; ?>">
                                                                        <?php echo ucfirst($booking['status']); ?>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <div class="booking-price">
                                                                <?php echo number_format($booking['total_price']); ?>Dh
                                                            </div>
                                                        </div>
                                            <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Booking Chart -->
                        <div class="dashboard-card mt-4">
                            <div class="card-header">
                                <h5>Booking Statistics</h5>
                            </div>
                            <div
                                class="card-body d-flex align-items-center flex-column chart-wrapper position-relative">
                                <div class="d-flex align-items-end justify-content-end mb-2 me-5 w-100">
                                    <button id="zoomOutBtn" class="btn btn-sm btn-luxury me-2">
                                        <i class="fas fa-search-minus"></i>
                                    </button>
                                    <button id="zoomInBtn" class="btn btn-sm btn-luxury">
                                        <i class="fas fa-search-plus"></i>
                                    </button>
                                </div>
                                <div class="spinner-overlay d-none" id="chartLoader">
                                    <div class="spinner-border text-gold" role="status"></div>
                                </div>
                                <canvas id="bookingChart" width="850" height="240"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Tab -->
                    <div class="tab-content p-4" id="bookings">
                        <div class="dashboard-header mb-4">
                            <h2>My Bookings</h2>
                            <p>Manage your current and past reservations</p>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-body">
                                <?php if (empty($bookings)): ?>
                                            <div class="text-center py-5">
                                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                                <h4>No bookings yet</h4>
                                                <p>Start planning your luxury getaway</p>
                                                <a href="rooms.php" class="btn btn-luxury">Browse Rooms</a>
                                            </div>
                                <?php else: ?>
                                            <?php foreach ($bookings as $booking): ?>
                                                        <div class="booking-card">
                                                            <div class="booking-image">
                                                                <img src="<?php echo $booking['room_image']; ?>"
                                                                    alt="<?php echo $booking['room_name']; ?>">
                                                            </div>
                                                            <div class="booking-details">
                                                                <h5><?php echo $booking['room_name']; ?></h5>
                                                                <p class="booking-dates">
                                                                    <i class="fas fa-calendar"></i>
                                                                    <?php echo date('M j, Y', strtotime($booking['checkin'])); ?> -
                                                                    <?php echo date('M j, Y', strtotime($booking['checkout'])); ?>
                                                                </p>
                                                                <p class="booking-guests">
                                                                    <i class="fas fa-users"></i>
                                                                    <?php echo $booking['adults']; ?> Adults
                                                                    <?php if ($booking['children'] > 0): ?>
                                                                                , <?php echo $booking['children']; ?> Children
                                                                    <?php endif; ?>
                                                                </p>
                                                                <p class="booking-id">Booking ID: #<?php echo $booking['id']; ?></p>
                                                            </div>
                                                            <div class="booking-status">
                                                                <span class="badge badge-<?php echo $booking['status']; ?>">
                                                                    <?php echo ucfirst($booking['status']); ?>
                                                                </span>
                                                                <div class="booking-price">
                                                                    $<?php echo number_format($booking['total_price']); ?>
                                                                </div>
                                                                <div class="booking-actions d-flex flex-column align-items-center">
                                                                    <a href="room-detail.php?id=<?php echo $booking['room_id']; ?>"
                                                                        class="mx-2 btn-sm btn-outline-luxury">View Room</a>
                                                                    <?php if ($booking['status'] === 'confirmed'): ?>
                                                                                <button class="btn-sm btn-outline-luxury btn-danger w-75"
                                                                                    onclick="cancelBookings(<?php echo $booking['id']; ?>)">
                                                                                    Cancel
                                                                                </button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Favorites Tab -->
                    <div class="tab-content" id="favorites">
                        <div class="dashboard-header mb-4">
                            <h2>Favorite Rooms</h2>
                            <p>Your saved rooms for quick access</p>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-body">
                                <div class="text-center py-5">
                                    <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                    <h4>No favorites yet</h4>
                                    <p>Save your favorite rooms for easy booking</p>
                                    <a href="rooms.php" class="btn btn-luxury">Browse Rooms</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="tab-content p-3" id="profile">
                        <div class="dashboard-header mb-4">
                            <h2>Profile Settings</h2>
                            <p>Manage your account information</p>
                        </div>

                        <div class="dashboard-card ">
                            <div class="card-body">
                                <form id="profile-form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" value="<?php echo $user['name']; ?>"
                                                name="name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control"
                                                value="<?php echo $user['email']; ?>" name="email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control"
                                                value="<?php echo $user['phone'] ?? ''; ?>" name="phone">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control"
                                                value="<?php echo $user['dob'] ?? ''; ?>" name="dob">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" rows="3"
                                                name="address"><?php echo $user['address'] ?? ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-luxury">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

<script src="../../js/main.js"></script>
<script src="../../js/dashboard.js"></script>

</html>