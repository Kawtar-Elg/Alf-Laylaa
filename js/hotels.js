// --- Hotel AJAX Search ---
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const roomsGrid = document.getElementById("rooms-grid");

  if (!searchInput || !roomsGrid) return;

  let lastQuery = "";
  let debounceTimeout;

  // Create a wrapper for the search input to ensure proper positioning
  const searchWrapper = document.createElement("div");
  searchWrapper.style.position = "relative";
  searchWrapper.style.zIndex = "999999"; // Very high z-index for the wrapper

  // Insert wrapper before search input and move input inside
  searchInput.parentNode.insertBefore(searchWrapper, searchInput);
  searchWrapper.appendChild(searchInput);

  // Suggestion dropdown with improved styling
  let suggestionBox = document.createElement("div");
  suggestionBox.className = "autocomplete-suggestions";
  suggestionBox.style.position = "absolute";
  suggestionBox.style.top = "100%"; // Position below the input
  suggestionBox.style.left = "0";
  suggestionBox.style.right = "0";
  suggestionBox.style.zIndex = "999999"; // Very high z-index to appear above everything
  suggestionBox.style.background = "rgba(26, 26, 26, 0.95)"; // Semi-transparent dark background
  suggestionBox.style.backdropFilter = "blur(10px)"; // Blur effect
  suggestionBox.style.webkitBackdropFilter = "blur(10px)"; // Safari support
  suggestionBox.style.color = "#ffffff"; // Light text
  suggestionBox.style.border = "1px solid rgba(255, 255, 255, 0.2)"; // Subtle light border
  suggestionBox.style.borderRadius = "12px"; // Rounded corners
  suggestionBox.style.boxShadow = "0 8px 32px rgba(0, 0, 0, 0.3)"; // Soft shadow
  suggestionBox.style.display = "none";
  suggestionBox.style.maxHeight = "300px"; // Limit height
  suggestionBox.style.overflowY = "auto"; // Scroll if needed
  suggestionBox.style.marginTop = "5px"; // Small gap from input
  searchWrapper.appendChild(suggestionBox);

  searchInput.addEventListener("input", function () {
    const query = searchInput.value.trim();
    if (query === lastQuery) return;
    lastQuery = query;

    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
      fetchHotels(query);
      fetchSuggestions(query);
    }, 300);
  });

  searchInput.addEventListener("blur", function () {
    setTimeout(() => (suggestionBox.style.display = "none"), 200);
  });

  searchInput.addEventListener("focus", function () {
    if (searchInput.value.trim().length > 0) {
      fetchSuggestions(searchInput.value.trim());
    }
  });

  function fetchSuggestions(query) {
    if (!query) {
      suggestionBox.style.display = "none";
      return;
    }
    fetch(`../../config/search-suggestions.php?q=${encodeURIComponent(query)}`)
      .then((response) => response.json())
      .then((suggestions) => {
        renderSuggestions(suggestions);
      })
      .catch(() => {
        suggestionBox.style.display = "none";
      });
  }

  function renderSuggestions(suggestions) {
    if (!suggestions || suggestions.length === 0) {
      suggestionBox.style.display = "none";
      return;
    }
    suggestionBox.innerHTML = suggestions
      .map(
        (s) =>
          `<div class="autocomplete-suggestion" style="
            padding: 12px 16px;
            cursor: pointer;
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease;
          " 
          onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.1)'; this.style.transform='translateX(4px)';"
          onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateX(0)';">${escapeHtml(
            s.trim()
          )}</div>`
      )
      .join("");

    // Remove border from last suggestion
    const lastSuggestion = suggestionBox.lastElementChild;
    if (lastSuggestion) {
      lastSuggestion.style.borderBottom = "none";
    }

    suggestionBox.style.display = "block";

    Array.from(suggestionBox.children).forEach((child) => {
      child.addEventListener("mousedown", function (e) {
        const selectedText = this.textContent.trim().replace(/\s+/g, " ");
        searchInput.value = selectedText;
        suggestionBox.style.display = "none";
        fetchHotels(selectedText);
      });
    });
  }

  function fetchHotels(query) {
    fetch(`../../config/search-hotels.php?search=${encodeURIComponent(query)}`)
      .then((response) => response.json())
      .then((hotels) => {
        renderHotels(hotels);
      })
      .catch((err) => {
        console.error("Error fetching hotels:", err);
        roomsGrid.innerHTML =
          '<div class="col-12 text-center"><p class="text-light">Error loading hotels.</p></div>';
      });
  }

  function renderHotels(hotels) {
    if (!hotels || hotels.length === 0) {
      roomsGrid.innerHTML =
        '<div class="col-12 text-center"><p class="text-light">No hotels found.</p></div>';
      return;
    }
    roomsGrid.innerHTML = hotels
      .map(
        (hotel) => `
            <div class="col-lg-4 col-md-6 mb-4 room-item">
                <div class="room-card shadow-sm">
                    <div class="room-image">
                        <img src="../../assets/hotels/${
                          hotel.id
                        }.png" alt="${escapeHtml(
          hotel.name
        )}" class="img-fluid img" />
                    </div>
                    <div class="room-info mt-3 px-3">
                        <h5 class="room-name">${escapeHtml(hotel.name)}</h5>
                        <p class="room-desc">${escapeHtml(
                          hotel.description || ""
                        )}</p>
                        <a href="rooms.php?hotel_id=${
                          hotel.id
                        }" class="btn btn-sm btn-luxury mt-2">View Rooms</a>
                    </div>
                </div>
            </div>
        `
      )
      .join("");
  }

  function escapeHtml(text) {
    const map = {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#039;",
    };
    return String(text).replace(/[&<>"']/g, (m) => map[m]);
  }
});
