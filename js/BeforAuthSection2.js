window.addEventListener("load", function () {
  setTimeout(() => {
    document.getElementById("loadingOverlay").classList.add("hidden");
  }, 1500);
});

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

