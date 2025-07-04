function createParticles() {
  const bgAnimation = document.getElementById("bgAnimation");
  const particleCount = 30;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div");
    particle.className = "particle";

    particle.style.left = Math.random() * 100 + "%";
    particle.style.top = Math.random() * 100 + "%";
    particle.style.animationDelay = Math.random() * 6 + "s";
    particle.style.animationDuration = Math.random() * 3 + 4 + "s";

    bgAnimation.appendChild(particle);
  }
}

function toggleFavorite(btn) {
  const icon = btn.querySelector("i");
  btn.classList.toggle("active");

  if (btn.classList.contains("active")) {
    icon.className = "fas fa-heart";
    btn.style.animation = "heartBeat 0.6s ease";
  } else {
    icon.className = "far fa-heart";
  }

  setTimeout(() => {
    btn.style.animation = "";
  }, 600);
}

function viewDestination(destination) {
  document.body.style.transition = "opacity 0.3s ease";
  document.body.style.opacity = "0.8";

  setTimeout(() => {
    alert(`Découvrez les merveilleux hôtels de ${destination}! 🏨✨`);
    document.body.style.opacity = "1";
  }, 300);
}

function revealOnScroll() {
  const cards = document.querySelectorAll(".hotel-card");
  const windowHeight = window.innerHeight;

  cards.forEach((card) => {
    const cardTop = card.getBoundingClientRect().top;
    const revealPoint = 100;

    if (cardTop < windowHeight - revealPoint) {
      card.style.opacity = "1";
      card.style.transform = "translateY(0) scale(1)";
    }
  });
}

function initParallax() {
  document.addEventListener("mousemove", (e) => {
    const cards = document.querySelectorAll(".hotel-card");
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;

    cards.forEach((card, index) => {
      const speed = (index + 1) * 0.5;
      const xMove = (x - 0.5) * speed;
      const yMove = (y - 0.5) * speed;

      card.style.transform += ` translate(${xMove}px, ${yMove}px)`;
    });
  });
}

const style = document.createElement("style");
style.textContent = `
    @keyframes heartBeat {
        0% { transform: scale(1); }
        25% { transform: scale(1.2); }
        50% { transform: scale(1); }
        75% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);

document.addEventListener("DOMContentLoaded", function () {
  createParticles();
  window.addEventListener("scroll", revealOnScroll);
  initParallax();

  const cards = document.querySelectorAll(".hotel-card");
  cards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.2}s`;
  });

  const container = document.querySelector(".carousel-container");
  const track = document.querySelector(".carousel-track");

  track.innerHTML += track.innerHTML;

  const speed = 1;

  function animate() {
    container.scrollLeft += speed;
    if (container.scrollLeft >= track.scrollWidth / 2) {
      container.scrollLeft = 0;
    }
    requestAnimationFrame(animate);
  }

  animate();

  container.addEventListener("mouseenter", () => cancelAnimationFrame(animate));
  container.addEventListener("mouseleave", () => animate());
});

function playHoverSound() {}

document.querySelectorAll(".hotel-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.filter = "brightness(1.1)";
    playHoverSound();
  });

  card.addEventListener("mouseleave", function () {
    this.style.filter = "brightness(1)";
  });
});

let currentPage = 0;
const perPage = 3;
let citiesList = [];

function loadCities(page) {
  fetch(`../../config/get_cities.php?page=${page}`)
    .then((res) => res.json())
    .then((data) => {
      const container = document.getElementById("cityCarousel");
      container.innerHTML = "";

      if (!data.success) {
        console.error("Erreur:", data.error);
        return;
      }

      if (data.cities.length === 0 && page > 0) {
        currentPage = 0;
        loadCities(0);
        return;
      }

      if (data.cities.length === 0 && page === 0) {
        container.innerHTML =
          '<p class="text-center text-muted">Aucune ville trouvée.</p>';
        document.getElementById("nextBtn").disabled = true;
        document.getElementById("prevBtn").disabled = true;
        return;
      }

      if (page === 0) {
        citiesList = data.cities;
        if (citiesList.length > 0 && typeof loadHotelsForCity === "function") {
          loadHotelsForCity(citiesList[0].id, citiesList[0].name);
        }
      }

      data.cities.forEach((city) => {
        const col = document.createElement("div");
        col.className = "col-lg-4 col-md-6";

        col.innerHTML = `
              <div class="hotel-card-section2" data-aos="fade-up">
                <div class="card-image-container-section2">
                  <img src="../../assets/${city.name.toLowerCase()}.jpg"
                      alt="${city.name} Hotel"
                      onerror="this.src='../../assets/land.jpg'"
                      class="card-image">
                  <div class="card-overlay-section2"></div>
                  <button class="favorite-btn" onclick="toggleFavorite(this)">
                    <i class="far fa-heart"></i>
                  </button>
                </div>
                <div class="card-content-section2">
                  <h3 class="destination-name-section2">
                    ${city.name}
                    <img src="https://flagcdn.com/w40/ma.png" 
                        alt="Morocco Flag" 
                        class="country-flag">
                  </h3>
                  <a href="#" class="view-btn-section2" onclick="viewDestination('${
                    city.id
                  }', '${city.name}')">
                    Tout voir
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            `;
        container.appendChild(col);
      });

      document.getElementById("prevBtn").disabled = false;
      document.getElementById("nextBtn").disabled = false;
    })
    .catch((err) => {
      console.error("Erreur réseau :", err);
    });
}

function viewDestination(cityId, cityName) {
  sessionStorage.setItem("selectedCityId", cityId);
  sessionStorage.setItem("selectedCityName", cityName);

  const event = new CustomEvent("citySelected", {
    detail: {
      cityId: cityId,
      cityName: cityName,
    },
  });
  window.dispatchEvent(event);

  if (typeof loadHotelsForCity === "function") {
    loadHotelsForCity(cityId, cityName);
  }

  const citiesSection = document.getElementById("citiesSection");
  const hotelsSection = document.getElementById("hotelsSection");

  if (citiesSection) {
    citiesSection.style.display = "none";
  }

  if (hotelsSection) {
    hotelsSection.style.display = "block";
    hotelsSection.scrollIntoView({ behavior: "smooth" });
  }
}

document.getElementById("nextBtn").addEventListener("click", () => {
  currentPage++;
  loadCities(currentPage);
});

document.getElementById("prevBtn").addEventListener("click", () => {
  if (currentPage > 0) {
    currentPage--;
  } else {
    findLastPageAndNavigate();
    return;
  }
  loadCities(currentPage);
});

function findLastPageAndNavigate() {
  let testPage = 10;

  function testPageExists(page) {
    fetch(`../config/get_cities.php?page=${page}`)
      .then((res) => res.json())
      .then((data) => {
        if (data.success && data.cities.length > 0) {
          fetch(`../config/get_cities.php?page=${page + 1}`)
            .then((res) => res.json())
            .then((nextData) => {
              if (!nextData.success || nextData.cities.length === 0) {
                currentPage = page;
                loadCities(currentPage);
              } else {
                testPageExists(page + 5);
              }
            });
        } else {
          if (page > 0) {
            testPageExists(page - 1);
          } else {
            currentPage = 0;
            loadCities(currentPage);
          }
        }
      });
  }

  testPageExists(testPage);
}

document.addEventListener("DOMContentLoaded", function () {
  loadCities(currentPage);
});
