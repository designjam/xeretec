/**
 * Application Cards Component
 * Handles hover interactions to swap center image
 */

(function() {
    'use strict';

    /**
     * Initialize application cards hover functionality
     */
    function initApplicationCards() {
        // Find all application cards sections on the page
        const sections = document.querySelectorAll('[id^="application-cards-"]');
        
        sections.forEach(function(section) {
            const componentId = section.getAttribute('id');
            const centerImage = section.querySelector('#' + componentId + '-center-image');
            const cards = section.querySelectorAll('.application-card');
            
            // Only proceed if we have a center image and cards
            if (!centerImage || cards.length === 0) {
                return;
            }
            
            // Store the default image source
            const defaultImageSrc = centerImage.getAttribute('src');
            
            // Add hover event listeners to each card
            cards.forEach(function(card) {
                const cardImageSrc = card.getAttribute('data-card-image');
                
                // Only add hover if card has an image
                if (cardImageSrc) {
                    // Mouse enter - change center image
                    card.addEventListener('mouseenter', function() {
                        centerImage.style.opacity = '0';
                        
                        // Wait for fade out, then change image and fade in
                        setTimeout(function() {
                            centerImage.setAttribute('src', cardImageSrc);
                            centerImage.style.opacity = '1';
                        }, 150); // Half of transition duration
                    });
                    
                    // Mouse leave - restore default image
                    card.addEventListener('mouseleave', function() {
                        centerImage.style.opacity = '0';
                        
                        // Wait for fade out, then restore default image and fade in
                        setTimeout(function() {
                            centerImage.setAttribute('src', defaultImageSrc);
                            centerImage.style.opacity = '1';
                        }, 150); // Half of transition duration
                    });
                }
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initApplicationCards);
    } else {
        initApplicationCards();
    }

})();


