let currentZoomLevel = "week"; // 'week', 'month', 'year'

// Dashboard-specific JavaScript functionality
document.addEventListener("DOMContentLoaded", function () {
  // Initialize dashboard components
  initializeDashboardNavigation();
  fetchChartData(currentZoomLevel);
  initializeDashboardInteractions();
  initializeProfileForm();

  // Dashboard navigation (sidebar tabs)
  function initializeDashboardNavigation() {
    const navItems = document.querySelectorAll(".dashboard-nav .nav-item");
    const tabContents = document.querySelectorAll(".tab-content");

    navItems.forEach(function (navItem) {
      navItem.addEventListener("click", function (e) {
        e.preventDefault();

        const targetTab = this.getAttribute("data-tab");
        if (!targetTab) return;

        // Remove active class from all nav items
        navItems.forEach((item) => item.classList.remove("active"));

        // Add active class to clicked nav item
        this.classList.add("active");

        // Hide all tab contents
        tabContents.forEach((content) => {
          content.classList.remove("active");
          content.style.opacity = "0";
          content.style.transform = "translateY(20px)";
        });

        // Show target tab content with animation
        const targetContent = document.getElementById(targetTab);
        if (targetContent) {
          setTimeout(() => {
            targetContent.classList.add("active");
            setTimeout(() => {
              targetContent.style.opacity = "1";
              targetContent.style.transform = "translateY(0)";
            }, 10);
          }, 150);
        }

        // Initialize chart if switching to overview
        if (targetTab === "overview") {
          setTimeout(initializeBookingChart, 200);
        }
      });
    });

    // Handle URL hash navigation
    function handleHashNavigation() {
      const hash = window.location.hash.substring(1);
      if (hash) {
        const targetNav = document.querySelector(`[data-tab="${hash}"]`);
        if (targetNav) {
          targetNav.click();
        }
      }
    }

    // Listen for hash changes
    window.addEventListener("hashchange", handleHashNavigation);
    handleHashNavigation();
  }

  document.getElementById("bookingChart").classList.add("loading");

  function fetchChartData(range) {
    const loader = document.getElementById("chartLoader");
    loader.classList.remove("d-none");

    fetch(`../../config/bookings_data.php?range=${range}`)
      .then((res) => res.text())
      .then((text) => {
        console.log("Raw Response:", text);
        const data = JSON.parse(text);
        loader.classList.add("d-none");
        const normalized = normalizeLabels(range, data);
        const labels = normalized.map((d) => d.label);
        const values = normalized.map((d) => parseInt(d.total));

        console.log("Labels:", labels); // 👈 check if correct
        console.log("Values:", values);
        updateChart(labels, values);
      })
      .catch((err) => {
        loader.classList.add("d-none");
        console.error("Failed to fetch chart data:", err);
      });
  }

  function updateChart(labels, values) {
    const ctx = document.getElementById("bookingChart").getContext("2d");

    if (window.bookingChartInstance) {
      window.bookingChartInstance.destroy();
    }

    window.bookingChartInstance = new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Bookings",
            data: values,
            backgroundColor: "rgba(212, 175, 55, 0.2)",
            borderColor: "rgba(212, 175, 55, 1)",
            borderWidth: 2,
            fill: true,
            tension: 0.3,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: "nearest",
          intersect: false,
        },
        plugins: {
          legend: { display: false },
          tooltip: {
            enabled: true,
            callbacks: {
              label: function (context) {
                const value = context.parsed.y;
                return `Bookings: ${value}`;
              },
              title: function (context) {
                return `Day: ${context[0].label}`;
              },
            },
          },
        },
        scales: {
          x: { ticks: { color: "#ccc" } },
          y: {
            beginAtZero: true,
            ticks: {
              color: "#ccc",
              stepSize: 1,
              callback: function (value) {
                return Number.isInteger(value) ? value : "";
              },
            },
          },
        },
      },
    });
  }

  // Zoom buttons logic
  document.getElementById("zoomInBtn").addEventListener("click", () => {
    if (currentZoomLevel === "year") currentZoomLevel = "month";
    else if (currentZoomLevel === "month") currentZoomLevel = "week";
    fetchChartData(currentZoomLevel);
  });

  document.getElementById("zoomOutBtn").addEventListener("click", () => {
    if (currentZoomLevel === "week") currentZoomLevel = "month";
    else if (currentZoomLevel === "month") currentZoomLevel = "year";
    fetchChartData(currentZoomLevel);
  });

  // Dashboard interactions
  function initializeDashboardInteractions() {
    // Animate stats cards on load
    const statCards = document.querySelectorAll(".stat-card");
    statCards.forEach(function (card, index) {
      card.style.opacity = "0";
      card.style.transform = "translateY(20px)";

      setTimeout(() => {
        card.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 100);
    });

    // Booking card interactions
    const bookingCards = document.querySelectorAll(".booking-card");
    bookingCards.forEach(function (card) {
      card.addEventListener("mouseenter", function () {
        this.style.transform = "translateX(5px)";
        this.style.boxShadow = "0 8px 25px rgba(0, 0, 0, 0.3)";
      });

      card.addEventListener("mouseleave", function () {
        this.style.transform = "translateX(0)";
        this.style.boxShadow = "";
      });
    });

    // Add click handlers for tab navigation buttons
    document.querySelectorAll("[data-tab]").forEach(function (button) {
      if (!button.classList.contains("nav-item")) {
        button.addEventListener("click", function (e) {
          e.preventDefault();
          const targetTab = this.getAttribute("data-tab");
          const navItem = document.querySelector(
            `.nav-item[data-tab="${targetTab}"]`
          );
          if (navItem) {
            navItem.click();
          }
        });
      }
    });
  }

  // Profile form handling with AJAX database updates
  function initializeProfileForm() {
    const profileForm = document.getElementById("profile-form");
    if (!profileForm) return;

    profileForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Validate form before submission
      if (!validateForm(this)) {
        showNotification("Please fix the errors before submitting", "error");
        return;
      }

      updateUserProfile(this);
    });

    // Real-time validation
    const inputs = profileForm.querySelectorAll("input, textarea");
    inputs.forEach(function (input) {
      input.addEventListener("blur", function () {
        validateField(this);
        
        // Real-time availability checking for email and username
        if (this.name === 'email' && this.value.trim() && validateField(this)) {
          checkEmailAvailability(this);
        } else if (this.name === 'username' && this.value.trim() && validateField(this)) {
          checkUsernameAvailability(this);
        }
      });

      input.addEventListener("input", function () {
        if (this.classList.contains("is-invalid")) {
          validateField(this);
        }
        
        // Clear availability messages when user types
        if (this.name === 'email' || this.name === 'username') {
          const availabilityMsg = this.parentNode.querySelector('.availability-feedback');
          if (availabilityMsg) {
            availabilityMsg.remove();
          }
        }
      });
    });

    // Profile image upload handling
    const imageUpload = document.getElementById("imageUpload");
    if (imageUpload) {
      imageUpload.addEventListener("change", function(e) {
        if (e.target.files && e.target.files[0]) {
          uploadProfileImage(e.target.files[0]);
        }
      });
    }

    function validateForm(form) {
      const inputs = form.querySelectorAll("input[required], textarea[required]");
      let isValid = true;

      inputs.forEach(function(input) {
        if (!validateField(input)) {
          isValid = false;
        }
      });

      return isValid;
    }

    function validateField(field) {
      const value = field.value.trim();
      let isValid = true;
      let errorMessage = "";

      // Required field validation
      if (field.hasAttribute("required") && !value) {
        isValid = false;
        errorMessage = "This field is required";
      }

      // Email validation
      if (field.type === "email" && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
          isValid = false;
          errorMessage = "Please enter a valid email address";
        }
      }

      // Phone validation
      if (field.type === "tel" && value) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
          isValid = false;
          errorMessage = "Please enter a valid phone number";
        }
      }

      // Username validation
      if (field.name === "username" && value) {
        if (value.length < 3) {
          isValid = false;
          errorMessage = "Username must be at least 3 characters long";
        } else if (!/^[a-zA-Z0-9_]+$/.test(value)) {
          isValid = false;
          errorMessage = "Username can only contain letters, numbers, and underscores";
        }
      }

      // Full name validation
      if (field.name === "full_name" && value) {
        if (value.length < 2) {
          isValid = false;
          errorMessage = "Full name must be at least 2 characters long";
        }
      }

      // Update field state
      if (isValid) {
        field.classList.remove("is-invalid");
        field.classList.add("is-valid");
        removeErrorMessage(field);
      } else {
        field.classList.remove("is-valid");
        field.classList.add("is-invalid");
        showErrorMessage(field, errorMessage);
      }

      return isValid;
    }

    function showErrorMessage(field, message) {
      removeErrorMessage(field);

      const errorDiv = document.createElement("div");
      errorDiv.className = "invalid-feedback";
      errorDiv.textContent = message;

      field.parentNode.appendChild(errorDiv);
    }

    function removeErrorMessage(field) {
      const existingError = field.parentNode.querySelector(".invalid-feedback");
      if (existingError) {
        existingError.remove();
      }
    }

    // AJAX function to update user profile in database
    function updateUserProfile(form) {
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      const formData = new FormData(form);

      // Show loading state
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';

      // Remove any existing alerts
      removeExistingAlerts();

      fetch("update_profile.php", {
        method: "POST",
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;

        if (data.success) {
          showNotification(data.message, "success");
          
          // Update the displayed user information if we're on dashboard
          updateDisplayedUserInfo(formData);
          
          // Refresh the page after a short delay to show updated data
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        } else {
          showNotification(data.message, "error");
        }
      })
      .catch(error => {
        console.error("Error updating profile:", error);
        
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        
        showNotification("An error occurred while updating your profile. Please try again.", "error");
      });
    }

    // Function to upload profile image
    function uploadProfileImage(file) {
      const formData = new FormData();
      formData.append('profile_image', file);
      formData.append('action', 'upload_image');

      // Show loading indicator on avatar
      const avatar = document.querySelector('.profile-avatar');
      if (avatar) {
        avatar.style.opacity = '0.5';
        avatar.innerHTML += '<div class="upload-spinner"><i class="fas fa-spinner fa-spin"></i></div>';
      }

      fetch("update_profile.php", {
        method: "POST",
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        // Remove loading indicator
        const spinner = document.querySelector('.upload-spinner');
        if (spinner) spinner.remove();
        if (avatar) avatar.style.opacity = '1';

        if (data.success) {
          showNotification("Profile image updated successfully!", "success");
          
          // Update the avatar image
          if (data.image_url) {
            updateAvatarImage(data.image_url);
          }
        } else {
          showNotification(data.message, "error");
        }
      })
      .catch(error => {
        console.error("Error uploading image:", error);
        
        // Remove loading indicator
        const spinner = document.querySelector('.upload-spinner');
        if (spinner) spinner.remove();
        if (avatar) avatar.style.opacity = '1';
        
        showNotification("Failed to upload image. Please try again.", "error");
      });
    }

    // Function to update displayed user information
    function updateDisplayedUserInfo(formData) {
      const fullName = formData.get('full_name');
      const phone = formData.get('phone');
      const address = formData.get('address');

      // Update user name displays
      const userNameElements = document.querySelectorAll('.user-name, h5');
      userNameElements.forEach(element => {
        if (element.textContent.includes('@') === false) { // Avoid updating email
          element.textContent = fullName;
        }
      });

      // Update info displays in the profile section
      const phoneDisplay = document.querySelector('.info-item:has(i.fa-phone) .ms-2');
      if (phoneDisplay) {
        phoneDisplay.textContent = phone || 'Not set';
      }

      const addressDisplay = document.querySelector('.info-item:has(i.fa-map-marker-alt) .ms-2');
      if (addressDisplay) {
        addressDisplay.textContent = address || 'Not set';
      }
    }

    // Function to update avatar image
    function updateAvatarImage(imageUrl) {
      const avatars = document.querySelectorAll('.profile-avatar, .profile-avatar-large');
      avatars.forEach(avatar => {
        avatar.innerHTML = `<img src="../../${imageUrl}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
      });
    }

    // Function to show notifications
    function showNotification(message, type) {
      // Remove existing notifications
      removeExistingAlerts();

      const alertClass = type === "success" ? "alert-success" : "alert-danger";
      const iconClass = type === "success" ? "fa-check-circle" : "fa-exclamation-triangle";
      
      const alertHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
          <i class="fas ${iconClass} me-2"></i>
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;

      // Insert the alert at the top of the profile section
      const profileSection = document.getElementById('profile');
      if (profileSection) {
        const dashboardHeader = profileSection.querySelector('.dashboard-header');
        if (dashboardHeader) {
          dashboardHeader.insertAdjacentHTML('afterend', alertHTML);
        }
      }

      // Auto-hide after 5 seconds
      setTimeout(() => {
        removeExistingAlerts();
      }, 5000);
    }

    // Function to remove existing alerts
    function removeExistingAlerts() {
      const existingAlerts = document.querySelectorAll('#profile .alert');
      existingAlerts.forEach(alert => {
        alert.remove();
      });
    }

    // Real-time email availability checking
    function checkEmailAvailability(emailField) {
      const email = emailField.value.trim();
      if (!email || !validateField(emailField)) return;
      
      // Show checking indicator
      showAvailabilityMessage(emailField, 'Checking availability...', 'checking');
      
      ProfileManager.checkEmailAvailability(email)
        .then(data => {
          if (data.available) {
            showAvailabilityMessage(emailField, 'Email is available', 'available');
          } else {
            showAvailabilityMessage(emailField, data.message, 'unavailable');
            emailField.classList.add('is-invalid');
            emailField.classList.remove('is-valid');
          }
        })
        .catch(error => {
          console.error('Error checking email availability:', error);
          showAvailabilityMessage(emailField, 'Could not check availability', 'error');
        });
    }

    // Real-time username availability checking
    function checkUsernameAvailability(usernameField) {
      const username = usernameField.value.trim();
      if (!username || !validateField(usernameField)) return;
      
      // Show checking indicator
      showAvailabilityMessage(usernameField, 'Checking availability...', 'checking');
      
      ProfileManager.checkUsernameAvailability(username)
        .then(data => {
          if (data.available) {
            showAvailabilityMessage(usernameField, 'Username is available', 'available');
          } else {
            showAvailabilityMessage(usernameField, data.message, 'unavailable');
            usernameField.classList.add('is-invalid');
            usernameField.classList.remove('is-valid');
          }
        })
        .catch(error => {
          console.error('Error checking username availability:', error);
          showAvailabilityMessage(usernameField, 'Could not check availability', 'error');
        });
    }

    // Show availability message
    function showAvailabilityMessage(field, message, type) {
      // Remove existing availability message
      const existingMsg = field.parentNode.querySelector('.availability-feedback');
      if (existingMsg) {
        existingMsg.remove();
      }
      
      const msgDiv = document.createElement('div');
      msgDiv.className = 'availability-feedback';
      msgDiv.style.fontSize = '0.875rem';
      msgDiv.style.marginTop = '0.25rem';
      
      switch (type) {
        case 'checking':
          msgDiv.style.color = '#6c757d';
          msgDiv.innerHTML = `<i class="fas fa-spinner fa-spin me-1"></i>${message}`;
          break;
        case 'available':
          msgDiv.style.color = '#28a745';
          msgDiv.innerHTML = `<i class="fas fa-check me-1"></i>${message}`;
          break;
        case 'unavailable':
          msgDiv.style.color = '#dc3545';
          msgDiv.innerHTML = `<i class="fas fa-times me-1"></i>${message}`;
          break;
        case 'error':
          msgDiv.style.color = '#ffc107';
          msgDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-1"></i>${message}`;
          break;
      }
      
      field.parentNode.appendChild(msgDiv);
    }
  }

  // Additional profile management functions
  window.ProfileManager = {
    // Load user data from server
    loadUserData: function() {
      return fetch("../../config/get_user_data.php", {
        method: "GET",
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          return data.user;
        } else {
          throw new Error(data.message);
        }
      });
    },

    // Update specific user field
    updateField: function(fieldName, value) {
      const formData = new FormData();
      formData.append(fieldName, value);
      formData.append('action', 'update_field');

      return fetch("update_profile.php", {
        method: "POST",
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json());
    },

    // Validate email availability
    checkEmailAvailability: function(email) {
      return fetch("../../config/check_email.php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ email: email })
      })
      .then(response => response.json());
    },

    // Validate username availability
    checkUsernameAvailability: function(username) {
      return fetch("../../config/check_username.php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ username: username })
      })
      .then(response => response.json());
    }
  };

  // Dashboard utilities
  window.Dashboard = {
    // Switch to specific tab
    switchTab: function (tabName) {
      const navItem = document.querySelector(`[data-tab="${tabName}"]`);
      if (navItem) {
        navItem.click();
      }
    },

    // Update stats
    updateStats: function (stats) {
      Object.keys(stats).forEach(function (key) {
        const statElement = document.querySelector(`[data-stat="${key}"]`);
        if (statElement) {
          animateNumber(statElement, stats[key]);
        }
      });
    },

    // Add booking to list
    addBooking: function (booking) {
      const bookingsList = document.querySelector(".bookings-list");
      if (bookingsList) {
        const bookingHTML = createBookingHTML(booking);
        bookingsList.insertAdjacentHTML("afterbegin", bookingHTML);
      }
    },

    // Update booking status
    updateBookingStatus: function (bookingId, status) {
      const booking = document.querySelector(
        `[data-booking-id="${bookingId}"]`
      );
      if (booking) {
        const statusBadge = booking.querySelector(".badge");
        if (statusBadge) {
          statusBadge.className = `badge badge-${status}`;
          statusBadge.textContent =
            status.charAt(0).toUpperCase() + status.slice(1);
        }
      }
    },
  };

  // Helper functions
  function animateNumber(element, targetNumber) {
    const startNumber = parseInt(element.textContent) || 0;
    const increment = (targetNumber - startNumber) / 20;
    let currentNumber = startNumber;

    const timer = setInterval(() => {
      currentNumber += increment;
      element.textContent = Math.round(currentNumber);

      if (currentNumber >= targetNumber) {
        element.textContent = targetNumber;
        clearInterval(timer);
      }
    }, 50);
  }

  function createBookingHTML(booking) {
    return `
            <div class="booking-card" data-booking-id="${booking.id}">
                <div class="booking-image">
                    <img src="${booking.room_image}" alt="${booking.room_name}">
                </div>
                <div class="booking-details">
                    <h5>${booking.room_name}</h5>
                    <p class="booking-dates">
                        <i class="fas fa-calendar"></i>
                        ${LuxeHaven.formatDate(
                          booking.checkin
                        )} - ${LuxeHaven.formatDate(booking.checkout)}
                    </p>
                    <p class="booking-guests">
                        <i class="fas fa-users"></i>
                        ${
                          booking.adults
                        } Adults${booking.children > 0 ? `, ${booking.children} Children` : ""}
                    </p>
                    <p class="booking-id">Booking ID: #${booking.id}</p>
                </div>
                <div class="booking-status">
                    <span class="badge badge-${booking.status}">
                        ${
                          booking.status.charAt(0).toUpperCase() +
                          booking.status.slice(1)
                        }
                    </span>
                    <div class="booking-price">
                        ${LuxeHaven.formatCurrency(booking.total_price)}
                    </div>
                    <div class="booking-actions">
                        <a href="room-detail.php?id=${
                          booking.room_id
                        }" class="btn btn-sm btn-outline-luxury">View Room</a>
                        ${
                          booking.status === "confirmed"
                            ? `<button class="btn btn-sm btn-danger" onclick="cancelBooking(${booking.id})">Cancel</button>`
                            : ""
                        }
                    </div>
                </div>
            </div>
        `;
  }

  // Initialize dashboard animations
  function initializeDashboardAnimations() {
    // Fade in dashboard cards
    const dashboardCards = document.querySelectorAll(".dashboard-card");
    dashboardCards.forEach(function (card, index) {
      card.style.opacity = "0";
      card.style.transform = "translateY(30px)";

      setTimeout(() => {
        card.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 100 + 200);
    });
  }

  // Initialize animations
  initializeDashboardAnimations();

  // Keyboard navigation for dashboard
  document.addEventListener("keydown", function (e) {
    // Alt + number keys for tab navigation
    if (e.altKey && e.key >= "1" && e.key <= "4") {
      e.preventDefault();
      const tabIndex = parseInt(e.key) - 1;
      const navItems = document.querySelectorAll(".dashboard-nav .nav-item");
      if (navItems[tabIndex]) {
        navItems[tabIndex].click();
      }
    }
  });

  // Auto-refresh dashboard data (placeholder)
  setInterval(function () {
    // In a real application, this would fetch updated data from the server
    console.log("Dashboard data refresh interval");
  }, 300000); // 5 minutes
});

// Export dashboard functions for external use
window.cancelBooking = function (bookingId) {
  if (confirm("Are you sure you want to cancel this booking?")) {
    const bookingCard = document.querySelector(
      `[data-booking-id="${bookingId}"]`
    );
    if (bookingCard) {
      // Animate removal
      bookingCard.style.opacity = "0";
      bookingCard.style.transform = "translateX(-100%)";

      setTimeout(() => {
        bookingCard.remove();
        LuxeHaven.showNotification("Booking cancelled successfully", "success");
      }, 300);
    }
  }
};

function cancelBookings(bookingId) {
  if (confirm("Are you sure you want to cancel this booking?")) {
    const url = "../../config/cancel_booking.php?id=" + bookingId;
    window.location.href = url;
  }
}

function normalizeLabels(range, rawData) {
  if (range === "week") {
    const fullWeek = [
      { long: "Monday", short: "Mon" },
      { long: "Tuesday", short: "Tue" },
      { long: "Wednesday", short: "Wed" },
      { long: "Thursday", short: "Thu" },
      { long: "Friday", short: "Fri" },
      { long: "Saturday", short: "Sat" },
      { long: "Sunday", short: "Sun" },
    ];

    const map = Object.fromEntries(
      rawData.map((item) => [item.label, item.total])
    );

    return fullWeek.map((day) => ({
      label: day.short,
      total: map[day.long] ?? 0,
    }));
  } else if (range === "month") {
    return Array.from({ length: 30 }, (_, i) => {
      const found = rawData.find((item) => parseInt(item.label) === i + 1);
      return { label: (i + 1).toString(), total: found ? found.total : 0 };
    });
  } else {
    const months = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    const map = Object.fromEntries(
      rawData.map((item) => [parseInt(item.label), item.total])
    );
    return months.map((month, i) => ({
      label: month,
      total: map[i + 1] ?? 0,
    }));
  }
}
