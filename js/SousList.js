// Main JavaScript file for Luxe Haven Hotel
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all components
    initializeNavigation();
    initializeRoomFilters();
    initializeRoomCards();
    initializeBookingForm();
    initializeAnimations();
    initializeScrollEffects();
    
    // Navigation functionality
    function initializeNavigation() {
        const navbar = document.querySelector('.navbar');
        const navToggler = document.querySelector('.navbar-toggler');
        const navCollapse = document.querySelector('.navbar-collapse');
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(10, 10, 10, 0.98)';
                navbar.style.backdropFilter = 'blur(20px)';
            } else {
                navbar.style.background = 'rgba(10, 10, 10, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            }
        });
        
        // Mobile menu toggle
        if (navToggler && navCollapse) {
            navToggler.addEventListener('click', function() {
                navCollapse.classList.toggle('show');
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navbar.contains(e.target) && navCollapse.classList.contains('show')) {
                    navCollapse.classList.remove('show');
                }
            });
        }
    }
    
    // Room filtering functionality
    function initializeRoomFilters() {
        const priceFilters = document.querySelectorAll('input[name="price_filter"]');
        const categoryFilters = document.querySelectorAll('input[name="category_filter"]');
        const roomItems = document.querySelectorAll('.room-item');
        const noResults = document.getElementById('no-results');
        
        if (priceFilters.length === 0 || categoryFilters.length === 0) return;
        
        // Add change event listeners to all filters
        [...priceFilters, ...categoryFilters].forEach(filter => {
            filter.addEventListener('change', applyFilters);
        });
        
        function applyFilters() {
            const selectedPrice = document.querySelector('input[name="price_filter"]:checked')?.value;
            const selectedCategory = document.querySelector('input[name="category_filter"]:checked')?.value;
            
            let visibleCount = 0;
            
            roomItems.forEach(function(item) {
                const price = parseInt(item.dataset.price);
                const category = item.dataset.category;
                
                let showItem = true;
                
                // Apply price filter
                if (selectedPrice && selectedPrice !== 'all') {
                    switch (selectedPrice) {
                        case '0-200':
                            showItem = showItem && price < 200;
                            break;
                        case '200-400':
                            showItem = showItem && price >= 200 && price < 400;
                            break;
                        case '400-600':
                            showItem = showItem && price >= 400 && price < 600;
                            break;
                        case '600+':
                            showItem = showItem && price >= 600;
                            break;
                    }
                }
                
                // Apply category filter
                if (selectedCategory && selectedCategory !== 'all') {
                    showItem = showItem && category === selectedCategory;
                }
                
                // Show/hide item with animation
                if (showItem) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 10);
                    visibleCount++;
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
            
            // Show/hide no results message
            if (noResults) {
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    setTimeout(() => {
                        noResults.style.opacity = '1';
                    }, 10);
                } else {
                    noResults.style.opacity = '0';
                    setTimeout(() => {
                        noResults.style.display = 'none';
                    }, 300);
                }
            }
        }
    }
    
    // Room card interactions
    function initializeRoomCards() {
        const roomCards = document.querySelectorAll('.room-card');
        
        roomCards.forEach(function(card) {
            // Add hover effects
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.3)';
                
                const image = this.querySelector('.room-image img');
                if (image) {
                    image.style.transform = 'scale(1.1)';
                }
                
                const overlay = this.querySelector('.room-overlay');
                if (overlay) {
                    overlay.style.opacity = '1';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
                
                const image = this.querySelector('.room-image img');
                if (image) {
                    image.style.transform = 'scale(1)';
                }
                
                const overlay = this.querySelector('.room-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                }
            });
            
            // Click handler for room cards
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons
                if (e.target.closest('.btn') || e.target.closest('a')) {
                    return;
                }
                
                const roomId = this.dataset.roomId;
                if (roomId) {
                    window.location.href = `room-detail.php?id=${roomId}`;
                }
            });
        });
    }
    
    // Booking form functionality
    function initializeBookingForm() {
        const bookingForm = document.getElementById('booking-form');
        const checkinInput = document.querySelector('input[name="checkin"]');
        const checkoutInput = document.querySelector('input[name="checkout"]');
        
        if (!bookingForm) return;
        
        // Set minimum dates
        if (checkinInput) {
            const today = new Date().toISOString().split('T')[0];
            checkinInput.min = today;
            
            checkinInput.addEventListener('change', function() {
                if (checkoutInput) {
                    const checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    checkoutInput.min = checkinDate.toISOString().split('T')[0];
                    
                    // Clear checkout if it's before new checkin
                    if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
                        checkoutInput.value = '';
                    }
                }
            });
        }
        
        // Form validation
        bookingForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    
                    // Remove invalid class after user starts typing
                    field.addEventListener('input', function() {
                        this.classList.remove('is-invalid');
                    }, { once: true });
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            // Validate dates
            if (checkinInput && checkoutInput && checkinInput.value && checkoutInput.value) {
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);
                
                if (checkout <= checkin) {
                    isValid = false;
                    checkoutInput.classList.add('is-invalid');
                    alert('Check-out date must be after check-in date');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            }
        });
    }
    
    // Room detail gallery functionality
    function initializeGallery() {
        const galleryThumbs = document.querySelectorAll('.gallery-thumb');
        const mainImage = document.querySelector('.main-image img');
        
        if (!mainImage || galleryThumbs.length === 0) return;
        
        galleryThumbs.forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                const newSrc = this.src;
                
                // Fade out current image
                mainImage.style.opacity = '0';
                
                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.style.opacity = '1';
                }, 150);
                
                // Update active thumb
                galleryThumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    
    // Initialize gallery if on room detail page
    initializeGallery();
    
    // Animation utilities
    function initializeAnimations() {
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe elements with animation classes
        document.querySelectorAll('.room-card, .service-card, .stat-card').forEach(function(el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });
    }
    
    // Scroll effects
    function initializeScrollEffects() {
        let ticking = false;
        
        function updateScrollEffects() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            // Parallax effect for hero section
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                heroSection.style.transform = `translateY(${rate}px)`;
            }
            
            ticking = false;
        }
        
        function requestScrollUpdate() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestScrollUpdate);
    }
    
    // Utility functions
    window.LuxeHaven = {
        // Show loading state
        showLoading: function(element) {
            if (element) {
                element.classList.add('loading');
            }
        },
        
        // Hide loading state
        hideLoading: function(element) {
            if (element) {
                element.classList.remove('loading');
            }
        },
        
        // Show notification
        showNotification: function(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
            `;
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateX(0)';
            }, 10);
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        },
        
        // Format currency
        formatCurrency: function(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        },
        
        // Format date
        formatDate: function(date) {
            return new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }).format(new Date(date));
        }
    };
    
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Handle form errors
    document.querySelectorAll('.form-control, .form-select').forEach(function(input) {
        input.addEventListener('invalid', function() {
            this.classList.add('is-invalid');
        });
        
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
    
    // Price calculation for booking form
    const roomPriceElement = document.querySelector('.price');
    const checkinInputCalc = document.querySelector('input[name="checkin"]');
    const checkoutInputCalc = document.querySelector('input[name="checkout"]');
    if (roomPriceElement && checkinInputCalc && checkoutInputCalc) {
        const basePrice = parseInt(roomPriceElement.textContent.replace('$', ''));
        
        function updateTotalPrice() {
            if (checkinInputCalc.value && checkoutInputCalc.value) {
                const checkin = new Date(checkinInputCalc.value);
                const checkout = new Date(checkoutInputCalc.value);
                const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                
                if (nights > 0) {
                    const totalPrice = basePrice * nights;
                    const existingTotal = document.querySelector('.total-price');
                    
                    if (existingTotal) {
                        existingTotal.textContent = `Total: ${LuxeHaven.formatCurrency(totalPrice)} (${nights} nights)`;
                    } else {
                        const totalElement = document.createElement('div');
                        totalElement.className = 'total-price mt-2 text-center';
                        totalElement.innerHTML = `<strong>Total: ${LuxeHaven.formatCurrency(totalPrice)} (${nights} nights)</strong>`;
                        totalElement.style.color = 'var(--primary-gold)';
                        
                        const priceSection = document.querySelector('.room-price-section');
                        if (priceSection) {
                            priceSection.appendChild(totalElement);
                        }
                    }
                }
            }
        }
        
        checkinInputCalc.addEventListener('change', updateTotalPrice);
        checkoutInputCalc.addEventListener('change', updateTotalPrice);
    }
});

// Handle booking cancellation
function cancelBooking(bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        // In a real application, this would make an AJAX call
        LuxeHaven.showNotification('Booking cancellation functionality would be implemented here', 'info');
    }
}

// Handle favorite toggle
function toggleFavorite(roomId) {
    // In a real application, this would make an AJAX call
    const heartIcon = event.target;
    if (heartIcon.classList.contains('fas')) {
        heartIcon.classList.remove('fas');
        heartIcon.classList.add('far');
        LuxeHaven.showNotification('Removed from favorites', 'success');
    } else {
        heartIcon.classList.remove('far');
        heartIcon.classList.add('fas');
        LuxeHaven.showNotification('Added to favorites', 'success');
    }
}

// Lazy loading for images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}
