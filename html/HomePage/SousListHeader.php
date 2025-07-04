<?php
// Get current page for navigation highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-sousList navbar-expand-lg navbar-dark" id="sousListHeader">
    <div class="container" >
        <div class="collapse navbar-collapse d-flex align-items-center justify-content-center" id="navbarNav">
            <ul class="navbar-nav navbar-nav-sousList">
                <li class="nav-item nav-item-sousList">
                    <a class="nav-link nav-link-sousList <?php echo $current_page === 'HomePage.php' ? 'active' : ''; ?>" href="HomePage.php">
                        <i class="fas fa-home me-1"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item nav-item-sousList">
                    <a class="nav-link nav-link-sousList <?php echo in_array($current_page, ['rooms.php', 'room-detail.php']) ? 'active' : ''; ?>" href="rooms.php">
                        <i class="fas fa-bed me-1"></i>
                        Rooms & Suites
                    </a>
                </li>
                <li class="nav-item nav-item-sousList">
                    <a class="nav-link nav-link-sousList" href="#services">
                        <i class="fas fa-concierge-bell me-1"></i>
                        Services
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>