<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>

  <link href="../css/section1.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
    rel="stylesheet" />

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    rel="stylesheet" />

</head>

<body>
  <div class="loading-overlay-section3" id="loadingOverlay">
    <div class="spinner-section3"></div>
  </div>

  <header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top my-navbar">
      <div
        class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
          <img src="../assets/logo.png" alt="Logo" class="logo-img" />
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
        <a
          class="btn-login text-light"
          href="#"
          data-bs-toggle="modal"
          data-bs-target="#loginModal">Login</a>
      </div>
    </nav>
  </header>


  <section id="home" class="hero-section">
    <!-- Video Background -->
    <video autoplay muted loop class="video-background">
      <source src="../assets/video1.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <!-- Dark overlay -->
    <div class="overlay"></div>
    <!-- Content on top of video -->
    <div class="container">
      <div class="row align-items-center">
        <!-- First Column - Welcome Text -->
        <div class="col-md-6">
          <div
            class="hero-content d-flex flex-column justify-content-center align-items-start">
            <h1 class="hero-title mb-5">
              Welcome Your perfect stay starts here
            </h1>
            <p class="hero-subtitle">
              Commencez votre expérience 5 étoiles avec -20% sur votre <br>
              première réservation !
            </p>
            <button type="submit" class="roomify-btn-search1 button-jumping">
              Réclamer maintenant !
            </button>
          </div>
        </div>
        <!-- Second Column - Booking Form -->
        <div class="col-md-6">
          <div
            class="roomify-form-container animate__animated animate__fadeInUp">
            <h1 class="roomify-form-title">
              <i class="fas fa-hotel"></i>
              Find Your Stay
            </h1>
            <div id="successMessage" class="roomify-success-message">
              <i class="fas fa-check-circle"></i>
              Booking request submitted successfully!
            </div>
            <div id="errorMessage" class="roomify-error-message">
              <i class="fas fa-exclamation-circle"></i>
              Please fill in all required fields.
            </div>
            <form id="reservationForm" method="POST">
              <div class="roomify-form-group">
                <label class="roomify-form-label">
                  <i class="fas fa-map-marker-alt"></i>
                  Destination
                </label>
                <input
                  type="text"
                  class="form-control roomify-form-input"
                  name="destination"
                  placeholder="Where are you going?"
                  required />
              </div>
              <div class="date-row">
                <div class="roomify-form-group">
                  <label class="roomify-form-label">
                    <i class="fas fa-calendar-check"></i>
                    Check In
                  </label>
                  <input
                    type="date"
                    class="form-control roomify-form-input"
                    name="checkin"
                    required />
                </div>
                <div class="roomify-form-group">
                  <label class="roomify-form-label">
                    <i class="fas fa-calendar-times"></i>
                    Check Out
                  </label>
                  <input
                    type="date"
                    class="form-control roomify-form-input"
                    name="checkout"
                    required />
                </div>
              </div>
              <div class="roomify-form-group">
                <label class="roomify-form-label">
                  <i class="fas fa-bed"></i>
                  Room Type
                </label>
                <select
                  class="form-select roomify-form-select"
                  name="room_type"
                  required>
                  <option value="">Select Room Type</option>
                  <option value="standard">Standard Room</option>
                  <option value="deluxe">Deluxe Room</option>
                  <option value="suite">Suite</option>
                  <option value="presidential">Presidential Suite</option>
                </select>
              </div>
              <div class="roomify-form-group">
                <label class="roomify-form-label">
                  <i class="fas fa-users"></i>
                  Guests
                </label>
                <div class="roomify-guest-counter">
                  <span class="roomify-guest-type">Adults</span>
                  <div class="roomify-counter-controls">
                    <button
                      type="button"
                      class="roomify-counter-btn"
                      onclick="updateCounter('adults', -1)">
                      <i class="fas fa-minus"></i>
                    </button>
                    <span class="roomify-counter-value" id="adults-count">2</span>
                    <button
                      type="button"
                      class="roomify-counter-btn"
                      onclick="updateCounter('adults', 1)">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="roomify-guest-counter mt-2">
                  <span class="roomify-guest-type">Children</span>
                  <div class="roomify-counter-controls">
                    <button
                      type="button"
                      class="roomify-counter-btn"
                      onclick="updateCounter('children', -1)">
                      <i class="fas fa-minus"></i>
                    </button>
                    <span class="roomify-counter-value" id="children-count">0</span>
                    <button
                      type="button"
                      class="roomify-counter-btn"
                      onclick="updateCounter('children', 1)">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <input
                type="hidden"
                name="adults"
                id="adults-input"
                value="2" />
              <input
                type="hidden"
                name="children"
                id="children-input"
                value="0" />
              <button type="submit" class="roomify-btn-search">
                <i class="fas fa-search"></i>
                Search
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php include 'section2.php'; ?>

  <?php include 'section3.php'; ?>


</body>

<script src="../js/section1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

</html>