// Hotel Reservation Landing Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather Icons
    feather.replace();
    
    // Initialize all interactive features
    initScrollEffects();
    initButtonHandlers();
    initAnimations();
    initAccessibility();
    
});

/**
 * Initialize scroll-based effects
 */
function initScrollEffects() {
    const floatingBtn = document.getElementById('scrollToTop');
    let isScrolling = false;
    
    // Throttled scroll handler for performance
    function handleScroll() {
        if (!isScrolling) {
            window.requestAnimationFrame(() => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Show/hide floating button based on scroll position
                if (scrollTop > 300) {
                    floatingBtn.classList.add('visible');
                } else {
                    floatingBtn.classList.remove('visible');
                }
                
                // Add parallax effect to golden accent box
                const goldenBox = document.querySelector('.golden-accent-box');
                if (goldenBox) {
                    const parallaxSpeed = 0.5;
                    const yPos = -(scrollTop * parallaxSpeed);
                    goldenBox.style.transform = `translateY(${yPos}px)`;
                }
                
                isScrolling = false;
            });
        }
        isScrolling = true;
    }
    
    // Attach optimized scroll listener
    window.addEventListener('scroll', handleScroll, { passive: true });
}

/**
 * Initialize button click handlers
 */
function initButtonHandlers() {
    const learnMoreBtn = document.getElementById('learnMoreBtn');
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    // Learn More button handler
    if (learnMoreBtn) {
        learnMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Simulate navigation or show more content
            showReservationModal();
        });
    }
    
    // Scroll to top button handler
    if (scrollToTopBtn) {
        scrollToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Smooth scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            
            // Add click feedback
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }
}

/**
 * Initialize scroll-based animations
 */
function initAnimations() {
    // Create intersection observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Stagger animations for feature items
                if (entry.target.classList.contains('feature-item')) {
                    const delay = Array.from(entry.target.parentNode.children).indexOf(entry.target) * 100;
                    setTimeout(() => {
                        entry.target.style.animation = `fadeInUp 0.6s ease-out forwards`;
                    }, delay);
                }
            }
        });
    }, observerOptions);
    
    // Add animation classes to elements
    const animatedElements = [
        '.section-tag',
        '.main-heading',
        '.lead-paragraph',
        '.secondary-paragraph',
        '.btn-golden',
        '.feature-item',
        '.experience-badge'
    ];
    
    animatedElements.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            el.classList.add('animate-on-scroll');
            observer.observe(el);
        });
    });
    
    // Add hover effects to hotel image
    const hotelImage = document.querySelector('.main-hotel-image');
    if (hotelImage) {
        hotelImage.addEventListener('mouseenter', function() {
            this.style.filter = 'brightness(1.1) contrast(1.05)';
        });
        
        hotelImage.addEventListener('mouseleave', function() {
            this.style.filter = '';
        });
    }
}

/**
 * Initialize accessibility features
 */
function initAccessibility() {
    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
        // ESC key to close any modals
        if (e.key === 'Escape') {
            closeAllModals();
        }
        
        // Enter key on buttons
        if (e.key === 'Enter' && e.target.classList.contains('btn')) {
            e.target.click();
        }
    });
    
    // Add focus management for better accessibility
    const focusableElements = document.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    
    focusableElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.setAttribute('data-focused', 'true');
        });
        
        element.addEventListener('blur', function() {
            this.removeAttribute('data-focused');
        });
    });
}

/**
 * Show reservation modal (simulated)
 */
function showReservationModal() {
    // Create and show a reservation information modal
    const modalHtml = `
        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="reservationModalLabel">
                            <i data-feather="calendar"></i>
                            Reserve Your Stay at Grand Palace Hotel
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-golden mb-3">Why Choose Grand Palace Hotel?</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i data-feather="check-circle" class="text-golden me-2"></i>Luxury suites with city views</li>
                                    <li class="mb-2"><i data-feather="check-circle" class="text-golden me-2"></i>Award-winning spa and wellness center</li>
                                    <li class="mb-2"><i data-feather="check-circle" class="text-golden me-2"></i>Fine dining restaurants</li>
                                    <li class="mb-2"><i data-feather="check-circle" class="text-golden me-2"></i>Business center and meeting rooms</li>
                                    <li class="mb-2"><i data-feather="check-circle" class="text-golden me-2"></i>Prime location in city center</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-golden mb-3">Exclusive Amenities</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i data-feather="wifi" class="text-golden me-2"></i>Complimentary high-speed WiFi</li>
                                    <li class="mb-2"><i data-feather="truck" class="text-golden me-2"></i>Valet parking service</li>
                                    <li class="mb-2"><i data-feather="phone" class="text-golden me-2"></i>24/7 room service</li>
                                    <li class="mb-2"><i data-feather="shield" class="text-golden me-2"></i>Enhanced safety protocols</li>
                                    <li class="mb-2"><i data-feather="gift" class="text-golden me-2"></i>Welcome amenities</li>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-3 text-muted">Ready to experience luxury hospitality?</p>
                            <button type="button" class="btn btn-golden me-2" onclick="initiateReservation()">
                                <i data-feather="calendar"></i>
                                Book Now
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="contactConcierge()">
                                <i data-feather="phone"></i>
                                Contact Concierge
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if present
    const existingModal = document.getElementById('reservationModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to DOM
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Initialize and show modal
    const modal = new bootstrap.Modal(document.getElementById('reservationModal'));
    modal.show();
    
    // Re-initialize Feather icons for modal content
    feather.replace();
    
    // Add custom styles for modal
    const modalElement = document.getElementById('reservationModal');
    modalElement.addEventListener('shown.bs.modal', function() {
        this.querySelector('.modal-content').style.borderRadius = '15px';
        this.querySelector('.modal-header').style.backgroundColor = '#ffd70020';
    });
}

/**
 * Close all modals
 */
function closeAllModals() {
    const modals = document.querySelectorAll('.modal.show');
    modals.forEach(modal => {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
}

/**
 * Initiate reservation process (placeholder)
 */
function initiateReservation() {
    // In a real application, this would redirect to booking system
    alert('Redirecting to our secure reservation system...\n\nFor immediate bookings, please call:\n+212 0608399120 - ALF-LAYLA');
    closeAllModals();
}

/**
 * Contact concierge (placeholder)
 */
function contactConcierge() {
    // In a real application, this would open chat or phone system
    alert('Connecting you with our concierge team...\n\nDirect line: +212608399120 - ALF-LAYLA\nEmail: kawtar@alflayla.com');
    closeAllModals();
}

/**
 * Utility function to add CSS class with golden theme
 */
function addGoldenTheme() {
    const style = document.createElement('style');
    style.textContent = `
        .text-golden { color: var(--golden-secondary) !important; }
        .bg-golden { background-color: var(--golden-primary) !important; }
        .border-golden { border-color: var(--golden-primary) !important; }
    `;
    document.head.appendChild(style);
}

// Initialize golden theme utilities
addGoldenTheme();

/**
 * Performance optimization: Lazy load background images
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    }
}

// Initialize lazy loading
initLazyLoading();
