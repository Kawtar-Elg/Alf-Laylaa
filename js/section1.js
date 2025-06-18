// Set default dates and update displays
document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const tomorrow = new Date(today);
  tomorrow.setDate(tomorrow.getDate() + 1);

  const checkinInput = document.getElementById("checkin");
  const checkoutInput = document.getElementById("checkout");
  const checkinDisplay = document.getElementById("checkinDisplay");
  const checkoutDisplay = document.getElementById("checkoutDisplay");

  checkinInput.value = today.toISOString().split("T")[0];
  checkoutInput.value = tomorrow.toISOString().split("T")[0];

  // Update date displays
  function updateDateDisplays() {
    const checkin = new Date(checkinInput.value);
    const checkout = new Date(checkoutInput.value);

    if (checkinInput.value && checkoutInput.value) {
      const timeDiff = checkout.getTime() - checkin.getTime();
      const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
      checkinDisplay.textContent =
        daysDiff > 0 ? `${daysDiff} nuit${daysDiff > 1 ? "s" : ""}` : "0 nuit";
    } else {
      checkinDisplay.textContent = "0 nuit";
    }

    if (checkoutInput.value) {
      const options = { weekday: "short", day: "numeric", month: "short" };
      checkoutDisplay.textContent = checkout.toLocaleDateString(
        "fr-FR",
        options
      );
    } else {
      checkoutDisplay.textContent = "Sélection de la...";
    }
  }

  checkinInput.addEventListener("change", updateDateDisplays);
  checkoutInput.addEventListener("change", updateDateDisplays);

  // Initial update
  updateDateDisplays();

  // Star rating functionality
  document.querySelectorAll(".star").forEach((star) => {
    star.addEventListener("click", function () {
      const rating = this.dataset.rating;
      document.querySelectorAll(".star").forEach((s) => {
        s.style.opacity = s.dataset.rating <= rating ? "1" : "0.3";
      });
    });
  });

  // Form submission
  document
    .getElementById("bookingForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = {
        destination: document.getElementById("destination").value,
        checkin: document.getElementById("checkin").value,
        checkout: document.getElementById("checkout").value,
        guests: document.getElementById("guests").value,
        businessTravel: document.getElementById("businessTravel").checked,
      };

      // Simulate booking process
      const btn = document.querySelector(".btn-search");
      const originalText = btn.innerHTML;
      btn.innerHTML =
        '<i class="fas fa-spinner fa-spin me-2"></i>Recherche en cours...';
      btn.disabled = true;

      setTimeout(() => {
        alert(
          "Recherche terminée! Nous avons trouvé plusieurs options pour votre séjour."
        );
        btn.innerHTML = originalText;
        btn.disabled = false;
      }, 2000);
    });

  // Login form
  document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Login functionality would be handled by PHP backend");
  });

  // Smooth scrolling
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // Navbar scroll effect
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Make sure video plays on mobile
  document
    .querySelector(".video-background")
    .play()
    .catch((e) => {
      console.log("Autoplay prevented, showing fallback");
      // You could show a fallback image here if needed
    });
});
// Counter functionality
function updateCounter(type, change) {
  const countElement = document.getElementById(type + "-count");
  const inputElement = document.getElementById(type + "-input");
  let currentValue = parseInt(countElement.textContent);
  let newValue = currentValue + change;

  // Set minimum values
  if (type === "adults" && newValue < 1) newValue = 1;
  if (type === "children" && newValue < 0) newValue = 0;
  if (newValue > 10) newValue = 10; // Maximum limit

  countElement.textContent = newValue;
  inputElement.value = newValue;

  // Add animation
  countElement.style.transform = "scale(1.2)";
  setTimeout(() => {
    countElement.style.transform = "scale(1)";
  }, 150);
}

// Set minimum dates
document.addEventListener("DOMContentLoaded", function () {
  const today = new Date().toISOString().split("T")[0];
  const checkinInput = document.querySelector('input[name="checkin"]');
  const checkoutInput = document.querySelector('input[name="checkout"]');

  checkinInput.min = today;
  checkinInput.value = today;

  // Set checkout minimum to tomorrow
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  checkoutInput.min = tomorrow.toISOString().split("T")[0];
  checkoutInput.value = tomorrow.toISOString().split("T")[0];

  // Update checkout minimum when checkin changes
  checkinInput.addEventListener("change", function () {
    const checkinDate = new Date(this.value);
    checkinDate.setDate(checkinDate.getDate() + 1);
    checkoutInput.min = checkinDate.toISOString().split("T")[0];

    if (checkoutInput.value <= this.value) {
      checkoutInput.value = checkinDate.toISOString().split("T")[0];
    }
  });
});

// Form submission
document
  .getElementById("reservationForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this;
    const submitBtn = form.querySelector(".search-btn");
    const successMsg = document.getElementById("successMessage");
    const errorMsg = document.getElementById("errorMessage");

    // Hide previous messages
    successMsg.style.display = "none";
    errorMsg.style.display = "none";

    // Validate required fields
    const requiredFields = form.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false;
        field.style.borderColor = "#dc3545";
      } else {
        field.style.borderColor = "var(--glass-border)";
      }
    });

    if (!isValid) {
      errorMsg.style.display = "block";
      errorMsg.scrollIntoView({ behavior: "smooth" });
      return;
    }

    // Simulate loading
    form.classList.add("loading");
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';

    // Simulate API call
    setTimeout(() => {
      // Here you would normally send the data to your PHP backend
      const formData = new FormData(form);

      // Log form data (in real scenario, send to server)
      console.log("Form data:", Object.fromEntries(formData));

      // Show success message
      successMsg.style.display = "block";
      successMsg.scrollIntoView({ behavior: "smooth" });

      // Reset loading state
      form.classList.remove("loading");
      submitBtn.innerHTML = '<i class="fas fa-search"></i> Search Hotels';

      // Optional: Reset form after successful submission
      // form.reset();
    }, 2000);
  });

// Add floating animation to form elements
const formGroups = document.querySelectorAll(".form-group");
formGroups.forEach((group, index) => {
  group.style.animationDelay = `${index * 0.1}s`;
  group.classList.add("animate__animated", "animate__fadeInUp");
});

// Add hover effects to inputs
const inputs = document.querySelectorAll(".form-control, .form-select");
inputs.forEach((input) => {
  input.addEventListener("focus", function () {
    this.parentElement.style.transform = "translateY(-2px)";
  });

  input.addEventListener("blur", function () {
    this.parentElement.style.transform = "translateY(0)";
  });
});