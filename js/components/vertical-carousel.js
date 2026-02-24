/**
 * Vertical Carousel Component
 * Uses CSS sticky positioning and Intersection Observer
 * Cards scroll naturally in document flow
 */

(function() {
    'use strict';
    
    function initVerticalCarouselScroll() {
        // Only run on desktop (min-width: 1024px)
        if (window.innerWidth < 1024) {
            return;
        }

        const sections = document.querySelectorAll('.vc-scroll-section');
        
        sections.forEach((section) => {
            const cards = section.querySelectorAll('.vc-scroll-card');
            const bullets = section.querySelectorAll('.vc-scroll-nav-bullet');

            if (cards.length === 0 || bullets.length === 0) return;

            // Function to update active bullet
            function updateActiveBullet(index) {
                bullets.forEach((bullet, i) => {
                    if (i === index) {
                        bullet.classList.add('active');
                    } else {
                        bullet.classList.remove('active');
                    }
                });
            }

            // Function to get distance from viewport center
            function getDistanceFromCenter(card) {
                const rect = card.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const cardCenter = rect.top + rect.height / 2;
                const viewportCenter = viewportHeight / 2;
                
                return Math.abs(cardCenter - viewportCenter);
            }

            // Function to find the most centered card
            function findMostCenteredCard() {
                let mostCenteredIndex = 0;
                let smallestDistance = Infinity;
                
                cards.forEach((card, index) => {
                    const rect = card.getBoundingClientRect();
                    // Only consider cards that are visible in viewport
                    if (rect.bottom > 0 && rect.top < window.innerHeight) {
                        const distance = getDistanceFromCenter(card);
                        if (distance < smallestDistance) {
                            smallestDistance = distance;
                            mostCenteredIndex = index;
                        }
                    }
                });
                
                return mostCenteredIndex;
            }

            // Intersection Observer to detect visible cards
            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -20% 0px', // Trigger when card is in center 60% of viewport
                threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1]
            };

            const observer = new IntersectionObserver((entries) => {
                // Find the most centered card among all intersecting entries
                const visibleCards = entries
                    .filter(entry => entry.isIntersecting)
                    .map(entry => ({
                        index: parseInt(entry.target.dataset.cardIndex, 10),
                        distance: getDistanceFromCenter(entry.target),
                        ratio: entry.intersectionRatio
                    }));
                
                if (visibleCards.length > 0) {
                    // Sort by distance from center, then by intersection ratio
                    visibleCards.sort((a, b) => {
                        if (Math.abs(a.distance - b.distance) < 50) {
                            // If distances are close, prefer higher intersection ratio
                            return b.ratio - a.ratio;
                        }
                        return a.distance - b.distance;
                    });
                    
                    updateActiveBullet(visibleCards[0].index);
                }
            }, observerOptions);

            // Observe all cards
            cards.forEach(card => {
                observer.observe(card);
            });

            // Scroll event handler - finds most centered card
            let scrollTimeout;
            let lastActiveIndex = 0;
            
            function checkCenteredCards() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    const mostCenteredIndex = findMostCenteredCard();
                    // Only update if it's different to avoid unnecessary DOM updates
                    if (mostCenteredIndex !== lastActiveIndex) {
                        updateActiveBullet(mostCenteredIndex);
                        lastActiveIndex = mostCenteredIndex;
                    }
                }, 50); // Reduced timeout for more responsive updates
            }

            window.addEventListener('scroll', checkCenteredCards, { passive: true });
            
            // Initial check
            lastActiveIndex = findMostCenteredCard();
            updateActiveBullet(lastActiveIndex);

            // Bullet click navigation - smooth scroll to card
            bullets.forEach((bullet) => {
                bullet.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetCardId = bullet.dataset.cardId;
                    const targetCard = document.getElementById(targetCardId);
                    
                    if (targetCard) {
                        // Calculate offset to center the card
                        const cardRect = targetCard.getBoundingClientRect();
                        const scrollOffset = window.pageYOffset + cardRect.top - (window.innerHeight / 2) + (cardRect.height / 2);
                        
                        window.scrollTo({
                            top: scrollOffset,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Initial check - find most centered card on load
            const initialIndex = findMostCenteredCard();
            updateActiveBullet(initialIndex);
            lastActiveIndex = initialIndex;
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initVerticalCarouselScroll, 100);
        });
    } else {
        setTimeout(initVerticalCarouselScroll, 100);
    }
    
    // Re-initialize on resize (to handle mobile/desktop switching)
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            initVerticalCarouselScroll();
        }, 250);
    });
})();
