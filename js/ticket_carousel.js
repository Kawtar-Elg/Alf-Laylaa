class WeekendPackageCarousel_WP2024 {
  constructor() {
    this.track = document.getElementById("wpCarouselTrack");
    this.cards = document.querySelectorAll(".wppackage-card-b5q8");
    this.prevBtn = document.getElementById("wpPrevBtn");
    this.nextBtn = document.getElementById("wpNextBtn");
    this.indicatorsContainer = document.getElementById("wpIndicators");

    this.currentIndex = 0;
    this.cardsPerView = this.getCardsPerView();
    this.totalCards = this.cards.length;
    this.maxIndex = Math.max(0, this.totalCards - this.cardsPerView);

    this.init();
  }

  init() {
    this.createIndicators();
    this.updateCarousel();
    this.bindEvents();

    // Auto-resize handling
    window.addEventListener("resize", () => {
      this.cardsPerView = this.getCardsPerView();
      this.maxIndex = Math.max(0, this.totalCards - this.cardsPerView);
      this.currentIndex = Math.min(this.currentIndex, this.maxIndex);
      this.updateCarousel();
    });
  }

  getCardsPerView() {
    const containerWidth = this.track.parentElement.offsetWidth;
    if (containerWidth < 576) return 1;
    if (containerWidth < 768) return 2;
    return 3;
  }

  createIndicators() {
    const numIndicators = this.maxIndex + 1;
    this.indicatorsContainer.innerHTML = "";

    for (let i = 0; i < numIndicators; i++) {
      const indicator = document.createElement("div");
      indicator.className = `wpindicator-dot-f7c4 ${
        i === 0 ? "wpactive-state-r3t7" : ""
      }`;
      indicator.addEventListener("click", () => this.goToSlide(i));
      this.indicatorsContainer.appendChild(indicator);
    }
  }

  bindEvents() {
    this.prevBtn.addEventListener("click", () => this.prev());
    this.nextBtn.addEventListener("click", () => this.next());

    // Touch/swipe support
    let startX = 0;
    let isDragging = false;

    this.track.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
      isDragging = true;
    });

    this.track.addEventListener("touchmove", (e) => {
      if (!isDragging) return;
      e.preventDefault();
    });

    this.track.addEventListener("touchend", (e) => {
      if (!isDragging) return;

      const endX = e.changedTouches[0].clientX;
      const diffX = startX - endX;

      if (Math.abs(diffX) > 50) {
        if (diffX > 0) {
          this.next();
        } else {
          this.prev();
        }
      }

      isDragging = false;
    });

    // Keyboard navigation
    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") this.prev();
      if (e.key === "ArrowRight") this.next();
    });

    // Card click events
    this.cards.forEach((card, index) => {
      card.addEventListener("click", () => {
        console.log(
          `Package selected: ${
            card.querySelector(".wpcard-date-l6w1").textContent
          }`
        );
        // Add your booking logic here
      });
    });
  }

  prev() {
    if (this.currentIndex > 0) {
      this.currentIndex--;
      this.updateCarousel();
    }
  }

  next() {
    if (this.currentIndex < this.maxIndex) {
      this.currentIndex++;
      this.updateCarousel();
    }
  }

  goToSlide(index) {
    this.currentIndex = Math.max(0, Math.min(index, this.maxIndex));
    this.updateCarousel();
  }

  updateCarousel() {
    const cardWidth = this.cards[0].offsetWidth + 20; // including gap
    const translateX = -this.currentIndex * cardWidth;

    this.track.style.transform = `translateX(${translateX}px)`;

    // Update active states
    this.cards.forEach((card, index) => {
      card.classList.remove("wpactive-state-r3t7");
      if (
        index >= this.currentIndex &&
        index < this.currentIndex + this.cardsPerView
      ) {
        if (index === this.currentIndex + Math.floor(this.cardsPerView / 2)) {
          card.classList.add("wpactive-state-r3t7");
        }
      }
    });

    // Update indicators
    const indicators = this.indicatorsContainer.querySelectorAll(
      ".wpindicator-dot-f7c4"
    );
    indicators.forEach((indicator, index) => {
      indicator.classList.toggle(
        "wpactive-state-r3t7",
        index === this.currentIndex
      );
    });

    // Update navigation buttons
    this.prevBtn.style.opacity = this.currentIndex === 0 ? "0.5" : "1";
    this.nextBtn.style.opacity =
      this.currentIndex === this.maxIndex ? "0.5" : "1";
  }
}

// Initialize carousel when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  window.wpCarouselInstance = new WeekendPackageCarousel_WP2024();
});

// Auto-play functionality (optional)
let wpAutoPlayInterval;

function startWPAutoPlay() {
  wpAutoPlayInterval = setInterval(() => {
    const carousel = window.wpCarouselInstance;
    if (carousel && carousel.currentIndex < carousel.maxIndex) {
      carousel.next();
    } else if (carousel) {
      carousel.goToSlide(0);
    }
  }, 4000);
}

function stopWPAutoPlay() {
  clearInterval(wpAutoPlayInterval);
}

// Uncomment to enable auto-play
// startAutoPlay();
