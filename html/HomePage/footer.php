<style>
    /* Footer */
    .footer {
        background: var(--dark-bg);
        padding: 3rem 0 1rem;
        border-top: 1px solid var(--dark-border);
        margin-top: auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-section h5 {
        color: var(--primary-gold);
        margin-bottom: 1rem;
    }

    .footer-section p,
    .footer-section a {
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        transition: var(--transition);
    }

    .footer-section a:hover {
        color: var(--primary-gold);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid var(--dark-border);
        color: var(--text-muted);
    }

    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .footer-links a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
        padding: 0.25rem 0;
    }

    .footer-links a:hover {
        color: var(--primary-gold);
        transform: translateX(5px);
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: var(--dark-card);
        color: var(--text-secondary);
        border-radius: 50%;
        transition: var(--transition);
        border: 1px solid var(--dark-border);
    }

    .social-links a:hover {
        background: var(--primary-gold);
        color: var(--dark-bg);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }

    .contact-info p {
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .contact-info a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .contact-info a:hover {
        color: var(--primary-gold);
    }

    .footer-links-inline {
        display: flex;
        gap: 0;
    }

    .footer-links-inline a {
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        font-size: 0.9rem;
    }

    .footer-links-inline a:hover {
        color: var(--primary-gold);
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-bottom .row {
            text-align: center !important;
        }

        .footer-links-inline {
            justify-content: center;
            margin-top: 1rem;
        }

        .social-links {
            justify-content: center;
        }
    }
</style>
<footer class="footer mt-auto">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h5><i class="fas fa-crown me-2"></i>Alf Layla</h5>
                <p>Experience luxury like never before. Our exclusive collection of rooms and suites offers the perfect blend of comfort, elegance, and world-class service.</p>
                <div class="social-links mt-3">
                    <a href="#" class="me-3" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="me-3" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="me-3" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="me-3" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <?php include '../LoginSysteme/SignIn.html'; ?>
            <?php include '../LoginSysteme/SignUp.html'; ?>

            <div class="footer-section">
                <h5>Quick Links</h5>
                <div class="footer-links">
                    <a href="BeforAuth.php">Home</a>
                    <a href="rooms.php">Rooms & Suites</a>
                    <a href="#services">Services</a>
                    <a href="#about">About Us</a>
                    <a href="#contact">Contact</a>
                    <a href="dashboard.php">Dashboard</a>
                </div>
            </div>

            <div class="footer-section">
                <h5>Services</h5>
                <div class="footer-links">
                    <a href="#">24/7 Concierge</a>
                    <a href="#">Luxury Spa</a>
                    <a href="#">Fine Dining</a>
                    <a href="#">Room Service</a>
                    <a href="#">Valet Parking</a>
                    <a href="#">Airport Transfer</a>
                    <a href="#">Business Center</a>
                    <a href="#">Event Planning</a>
                </div>
            </div>

            <div class="footer-section">
                <h5>Contact Info</h5>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt me-2 text-gold"></i>
                        2040 Royal Lane<br>
                        Mesa, New Jersey 45463
                    </p>
                    <p><i class="fas fa-phone me-2 text-gold"></i>
                        <a href="tel:+1-555-LUXURY">+212608399120</a>
                    </p>
                    <p><i class="fas fa-envelope me-2 text-gold"></i>
                        <a href="mailto:reservations@luxehaven.com">reservations@alflayla.com</a>
                    </p>
                    <p><i class="fas fa-clock me-2 text-gold"></i>
                        24/7 Guest Services
                    </p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>&copy; <?php echo date('Y'); ?>Alf Layla Hotel. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-links-inline">
                        <a href="#" class="me-3">Privacy Policy</a>
                        <a href="#" class="me-3">Terms of Service</a>
                        <a href="#">Accessibility</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php
// Create logout.php if it doesn't exist
$logout_file = '../../config/logout.php';
if (!file_exists($logout_file)) {
    $logout_content = '<?php
session_start();
session_destroy();
header("Location: HomePage");
exit;
?>';

    // Ensure config directory exists
    if (!is_dir('config')) {
        mkdir('config', 0755, true);
    }

    file_put_contents($logout_file, $logout_content);
}
?>