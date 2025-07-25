<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>

  <link href="../../css/section1.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/section1.css">
  <link rel="stylesheet" href="../../css/section2.css">
  <link rel="stylesheet" href="../../css/section3.css">
  <link rel="stylesheet" href="../../css/section4.css">


</head>

<body class="lebody">
  <div class="loading-overlay-section3" id="loadingOverlay">
    <div class="spinner-section3"></div>
  </div>

  <?php include 'BeforAuthHeader.php'; ?>

  <section id="home" class="hero-section">
    <!-- Video Background -->
    <video autoplay muted loop class="video-background">
      <source src="../../assets/video1.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="hero-content d-flex flex-column justify-content-center align-items-start">
            <h1 class="hero-title mb-5">
              Welcome Your perfect stay starts here
            </h1>
            <p class="hero-subtitle">
              Commencez votre expérience 5 étoiles avec -20% sur votre <br>
              première réservation !
            </p>
            <button type="button" class="roomify-btn-search1 button-jumping" data-bs-toggle="modal"
              data-bs-target="#loginModal">
              Réclamer maintenant !
            </button>
          </div>
        </div>
        <!-- Second Column - Booking Form -->
        <div class="col-md-6">
          <div class="roomify-form-container animate__animated animate__fadeInUp">
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
                <input type="text" class="form-control roomify-form-input" name="destination"
                  placeholder="Where are you going?" required />
              </div>
              <div class="date-row">
                <div class="roomify-form-group">
                  <label class="roomify-form-label">
                    <i class="fas fa-calendar-check"></i>
                    Check In
                  </label>
                  <input type="date" class="form-control roomify-form-input" name="checkin" required />
                </div>
                <div class="roomify-form-group">
                  <label class="roomify-form-label">
                    <i class="fas fa-calendar-times"></i>
                    Check Out
                  </label>
                  <input type="date" class="form-control roomify-form-input" name="checkout" required />
                </div>
              </div>
              <div class="roomify-form-group">
                <label class="roomify-form-label">
                  <i class="fas fa-bed"></i>
                  Room Type
                </label>
                <select class="form-select roomify-form-select" name="room_type" required>
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
                    <button type="button" class="roomify-counter-btn" data-bs-toggle="modal"
                      data-bs-target="#loginModal" onclick="event.preventDefault();">
                      <i class="fas fa-minus"></i>
                    </button>
                    <span class="roomify-counter-value" id="adults-count">2</span>
                    <button type="button" class="roomify-counter-btn" data-bs-toggle="modal"
                      data-bs-target="#loginModal" onclick="event.preventDefault();">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="roomify-guest-counter mt-2">
                  <span class="roomify-guest-type">Children</span>
                  <div class="roomify-counter-controls">
                    <button type="button" class="roomify-counter-btn" data-bs-toggle="modal"
                      data-bs-target="#loginModal" onclick="event.preventDefault();">
                      <i class="fas fa-minus"></i>
                    </button>
                    <span class="roomify-counter-value" id="children-count">0</span>
                    <button type="button" class="roomify-counter-btn" data-bs-toggle="modal"
                      data-bs-target="#loginModal" onclick="event.preventDefault();">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <input type="hidden" name="adults" id="adults-input" value="2" />
              <input type="hidden" name="children" id="children-input" value="0" />
              <button type="button" class="roomify-btn-search" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fas fa-search"></i>
                Search
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'section4.php'; ?>

  <?php include 'BeforAuthSection2.php'; ?>

  <?php include 'BeforAuthSection3.php'; ?>

  <?php include 'BeforAuthFooter.php'; ?>
  
  <script>
    // Prevent all form submissions and <a> clicks for guests
    window.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('button#loginModal, a#loginModal').forEach(function (el) {
        el.addEventListener('click', function (e) {
          var modal = document.getElementById('loginModal');
          if (modal) {
            e.preventDefault();
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
          }
        });
      });
    });
  </script>

</body>

<script src="../../js/section1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

</html>