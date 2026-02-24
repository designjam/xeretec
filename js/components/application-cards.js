/**
 * Application Cards Component
 * Handles hover interactions to swap center image
 * Image remains changed until another card is hovered
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
            
            // Track currently active card
            let activeCard = null;
            
            // Add hover event listeners to each card
            cards.forEach(function(card) {
                const cardImageSrc = card.getAttribute('data-card-image');
                
                // Only add hover if card has an image
                if (cardImageSrc) {
                    // Mouse enter - change center image
                    card.addEventListener('mouseenter', function() {
                        // If this card is already active, do nothing
                        if (activeCard === card) {
                            return;
                        }
                        
                        // Set this card as active
                        activeCard = card;
                        
                        // Fade out current image
                        centerImage.classList.remove('opacity-100');
                        centerImage.classList.add('opacity-0');
                        
                        // Wait for fade out, then change image and fade in
                        setTimeout(function() {
                            // Update image source
                            centerImage.setAttribute('src', cardImageSrc);
                            
                            // Fade in new image
                            centerImage.classList.remove('opacity-0');
                            centerImage.classList.add('opacity-100');
                        }, 250); // Half of transition duration (500ms)
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


