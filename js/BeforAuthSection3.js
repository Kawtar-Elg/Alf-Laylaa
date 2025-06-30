function loadHotelsForCity(cityId, cityName) {
  if (!cityId || isNaN(cityId)) {
    console.error("❌ Invalid city ID:", cityId);
    return;
  }

  fetch(`config/get_hotels.php?city_id=${cityId}`)
    .then((res) => {
      if (!res.ok) {
        throw new Error("Erreur réseau");
      }
      return res.json();
    })
    .then((data) => {
      const hotelsGrid = document.getElementById("hotelsGrid");
      const hotelsSection = document.getElementById("hotelsSection");

      if (!data.success) {
        console.error("Erreur serveur :", data.error);
        hotelsGrid.innerHTML = `<p class="text-center text-muted">Aucun hôtel trouvé à ${cityName}</p>`;
        return;
      }

      // Afficher le titre de la section
      const sectionTitle = document.getElementById("hotelsSectionTitle");
      if (sectionTitle) {
        sectionTitle.textContent = `Hôtels à ${cityName}`;
      }

      // Vider le conteneur
      hotelsGrid.innerHTML = "";

      // Afficher chaque hôtel
      data.hotels.forEach((hotel) => {
        const col = document.createElement("div");
        col.className = "col-md-4";

        col.innerHTML = `
                    <div class="hotel-card-section3" data-aos="fade-up">
                        <div class="card-image-container-section3">
                            <img src="${
                              hotel.image_url ||
                              "public/defaultl.jpg"
                            }"
                                 alt="${hotel.name}"
                                 class="card-hotel"
                                 onerror="this.src='public/default.jpg'">
                            <div class="card-overlay-section3"></div>
                            <div class="card-content-section3">
                                <h2 class="card-title">${hotel.name}</h2>
                                <div style="color: gold;">
                                    ⭐ ${hotel.rating || "4.5"}
                                </div>
                            </div>
                            <button class="favorite-btn" onclick="toggleFavorite(this)">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-content-section3">
                            <a href="#" class="view-btn-section3" onclick="viewHotelDetails('${
                              hotel.id
                            }')">
                                Tout voir <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                `;

        hotelsGrid.appendChild(col);
      });

      // Afficher la section hôtels
      hotelsSection.style.display = "block";
      hotelsSection.scrollIntoView({ behavior: "smooth", block: "start" });
    })
    .catch((err) => {
      console.error("Erreur lors du chargement des hôtels :", err);
      document.getElementById(
        "hotelsGrid"
      ).innerHTML = `<p class="text-center text-danger">Erreur lors du chargement des hôtels.</p>`;
    });
}

function viewHotelDetails(hotelId) {
  // You can implement hotel details page here
  console.log("Viewing hotel details for hotel ID:", hotelId);
  // Example: window.location.href = `hotel-details.html?id=${hotelId}`;
}

function backToCities() {
  document.getElementById("hotelsSection").style.display = "none";
  document.getElementById("citiesSection").style.display = "block";
  window.scrollTo({ top: 0, behavior: "smooth" });
}

window.addEventListener("citySelected", function (event) {
  const { cityId, cityName } = event.detail;
  loadHotelsForCity(cityId, cityName);
});

document.addEventListener("DOMContentLoaded", function () {
  const savedCityId = sessionStorage.getItem("selectedCityId");
  const savedCityName = sessionStorage.getItem("selectedCityName");

  if (savedCityId && savedCityName) {
    loadHotelsForCity(savedCityId, savedCityName);
  }

  // Or you can load hotels for first city by making a request to get first city
  // This is optional if you want hotels to show by default
  /*
  fetch(`../backend/get_cities.php?page=0`)
    .then(res => res.json())
    .then(data => {
      if (data.success && data.cities.length > 0) {
        const firstCity = data.cities[0];
        loadHotelsForCity(firstCity.id, firstCity.name);
      }
    })
    .catch(err => console.error('Error loading default city:', err));
  */
});
