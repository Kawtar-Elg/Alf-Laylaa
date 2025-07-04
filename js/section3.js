function loadHotelsForCity(cityId, cityName) {
  if (!cityId || isNaN(cityId)) {
    console.error("❌ Invalid city ID:", cityId);
    return;
  }

  fetch(`../../config/get_hotels.php?city_id=${cityId}`)
    .then((res) => {
      if (!res.ok) throw new Error("Erreur réseau");
      return res.json();
    })
    .then((data) => {
      const hotelsGrid = document.getElementById("hotelsGrid");
      const hotelsSection = document.getElementById("hotelsSection");

      if (
        !data.success ||
        !Array.isArray(data.hotels) ||
        data.hotels.length === 0
      ) {
        hotelsGrid.innerHTML = `<p class="text-center text-muted">Aucun hôtel trouvé à ${cityName}</p>`;
        return;
      }

      const sectionTitle = document.getElementById("hotelsSectionTitle");
      if (sectionTitle) {
        sectionTitle.textContent = `Discover the Best Hotels in ${cityName} ! `;
      }

      hotelsGrid.innerHTML = "";

      data.hotels.forEach((hotel, index) => {
        const col = document.createElement("div");
        col.className = "col-md-4";
        sessionStorage.setItem("selectedHotelId", hotel.id);
        sessionStorage.setItem("selectedHotelName", hotel.name);
        col.innerHTML = `
            <div class="hotel-card-section3" data-aos="fade-up">
              <div class="card-image-container-section3">
                <img src="../../assets/hotels/${hotel.id}.png"
                    alt="${hotel.name}"
                    class="card-hotel"
                    onerror="this.onerror=null; this.src='../../assets/land.jpg';">
                
                <div class="card-overlay-section3"></div>
                <div class="card-content-section3">
                  <h2 class="card-title">${hotel.name}</h2>
                  <h3 class="card-desc my-2">${hotel.address}</h3>
                  <div style="color: gold;">
                    ⭐ ${hotel.rating || "4.5"}
                  </div>
                  <h3 class="card-sub-desc my-2">${hotel.description}</h3>
                </div>
                <button class="favorite-btn" onclick="toggleFavorite(this)">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="card-content-section3">
                <a href="#" class="view-btn-section3"
                  onclick="loadRoomsForHotel('${hotel.id}', '${hotel.name}')">
                  Tout voir <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          `;
        hotelsGrid.appendChild(col);

        if (index === 0) {
          loadRoomsForHotel(hotel.id, hotel.name);
        }
      });

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

function loadRoomsForHotel(hotelId, hotelName) {
  sessionStorage.setItem("selectedHotelId", hotelId);
  sessionStorage.setItem("selectedHotelName", hotelName);
  hotelId = Number(hotelId);
  if (!hotelId || isNaN(hotelId)) {
    console.error("❌ Invalid hotel ID:", hotelId);
    return;
  }

  fetch(`../../config/get_rooms.php?hotel_id=${hotelId}`)
    .then((res) => {
      if (!res.ok) throw new Error("Erreur réseau");
      return res.json();
    })
    .then((data) => {
      const roomContainer = document.querySelector("#sousListRooms .row");
      if (!data.success || data.rooms.length === 0) {
        roomContainer.innerHTML =
          "<p class='text-center text-muted'>Aucune chambre trouvée.</p>";
        return;
      }

      roomContainer.innerHTML = "";
      data.rooms.slice(0, 3).forEach((room) => {
        const images = Array.isArray(room.images)
          ? room.images
          : JSON.parse(room.images || "[]");
        const firstImage =
          images.length > 0
            ? images[0].trim()
            : "https://via.placeholder.com/400x300";

        roomContainer.innerHTML += `
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="room-card" data-room-id="${room.id}">
              <div class="room-image">
                <img src="${firstImage}" alt="${room.name}" class="img-fluid">
                <div class="room-overlay">
                  <div class="room-badge">${room.type}</div>
                  <div class="room-actions">
                    <a href="room-detail.php?id=${
                      room.id
                    }" class="btn btn-sm btn-luxury">View Details</a>
                  </div>
                </div>
              </div>
              <div class="room-info">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <h5 class="room-name">${room.name} in ${hotelName}</h5>
                  <div class="room-rating">
                    <i class="fas fa-star text-gold"></i>
                    <span>${room.rating || "4.9"}</span>
                  </div>
                </div>
                <div class="room-price mb-2">
                  <span class="price">$${Number(
                    room.price
                  ).toLocaleString()}</span>
                  <span class="period">/night</span>
                </div>
                <div class="room-features">
                  <span class="feature"><i class="fas fa-users"></i> ${
                    room.capacity
                  } Guests</span>
                  <span class="feature"><i class="fas fa-bath"></i> Private Bath</span>
                  <span class="feature"><i class="fas fa-expand-arrows-alt"></i> ${
                    room.size
                  } m²</span>
                </div>
              </div>
            </div>
          </div>
        `;
      });

      document
        .getElementById("sousListRooms")
        .scrollIntoView({ behavior: "smooth", block: "start" });
    })
    .catch((err) => {
      console.error("Erreur lors du chargement des chambres :", err);
    });
}

function saveHotelAndGoToRooms() {
  const hotelId = sessionStorage.getItem("selectedHotelId");
  const hotelName = sessionStorage.getItem("selectedHotelName");

  if (!hotelId || !hotelName) {
    alert("No hotel selected.");
    return;
  }

  const body = new URLSearchParams();
  body.append("hotel_id", hotelId);
  body.append("hotel_name", hotelName);

  fetch("../../config/save_hotel_session.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: body.toString(),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "rooms.php";
      } else {
        alert("Failed to save hotel session");
      }
    })
    .catch(() => alert("Network error"));
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
