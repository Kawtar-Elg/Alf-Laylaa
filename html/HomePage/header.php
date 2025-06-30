<header>
    <!-- Navigation -->
    <nav class="navbar navbar-home navbar-expand-lg fixed-top my-navbar">
        <div
            class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logo.png" alt="Logo" class="logo-img" />
            </a>
            <div
                class="collapse navbar-collapse justify-content-center"
                id="navbarNav">
                <ul class="navbar-nav d-flex gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hotels">Our Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo $_SESSION['user_name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item <?php echo $current_page === 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="dashboard.php#profile">
                                    <i class="fas fa-user-cog me-2"></i>
                                    Profile Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="dashboard.php#bookings">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    My Bookings
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="logout()">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    // Create logout endpoint
    if (typeof logout === 'undefined') {
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // Create a form to POST to logout
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../../config/logout.php';
                document.body.appendChild(form);
                form.submit();
            }
        }
    }
</script>