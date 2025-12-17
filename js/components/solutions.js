/**
 * Solutions Component JavaScript
 * Handles hover interactions between small cards and featured card
 */

(function() {
    'use strict';

    function initSolutions() {
        const solutionsComponents = document.querySelectorAll('[data-solutions-component]');
        
        solutionsComponents.forEach(component => {
            const featuredCard = component.querySelector('[data-solutions-featured]');
            const solutionCards = component.querySelectorAll('.solution-card');
            
            // Only initialize if we're on desktop (featured card exists)
            if (!featuredCard || solutionCards.length === 0) return;
            
            // Get featured card elements
            const featuredImage = featuredCard.querySelector('[data-solutions-featured-image]');
            const featuredTitle = featuredCard.querySelector('[data-solutions-featured-title]');
            const featuredDescription = featuredCard.querySelector('[data-solutions-featured-description]');
            const featuredLink = featuredCard.querySelector('[data-solutions-featured-link]');
            const featuredContent = featuredCard.querySelector('[data-solutions-featured-content]');
            
            // Add hover listeners to each solution card
            solutionCards.forEach(card => {
                const solutionData = JSON.parse(card.getAttribute('data-solution-data'));
                
                card.addEventListener('mouseenter', function() {
                    updateFeaturedCard(solutionData, {
                        image: featuredImage,
                        title: featuredTitle,
                        description: featuredDescription,
                        link: featuredLink,
                        content: featuredContent
                    });
                });
            });
        });
    }
    
    function updateFeaturedCard(data, elements) {
        // Fade out content
        if (elements.content) {
            elements.content.classList.remove('opacity-100', 'translate-y-0');
            elements.content.classList.add('opacity-0', 'translate-y-2');
        }
        
        setTimeout(() => {
            // Update image
            if (elements.image && data.image) {
                elements.image.src = data.image.url;
                elements.image.alt = data.image.alt;
            }
            
            // Update title
            if (elements.title && data.title) {
                elements.title.textContent = data.title;
            }
            
            // Update description/content
            if (elements.description && data.content) {
                elements.description.innerHTML = data.content;
            }
            
            // Update link
            if (elements.link && data.link) {
                elements.link.href = data.link.url;
                const linkText = elements.link.querySelector('span') ? 
                    elements.link.childNodes[0].textContent.trim() : 
                    elements.link.textContent.trim();
                elements.link.innerHTML = (data.link.title || 'Discover more');
                if (data.link.target) {
                    elements.link.target = data.link.target;
                } else {
                    elements.link.removeAttribute('target');
                }
            }
            
            // Fade in content
            if (elements.content) {
                elements.content.classList.remove('opacity-0', 'translate-y-2');
                elements.content.classList.add('opacity-100', 'translate-y-0');
            }
        }, 150);
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSolutions);
    } else {
        initSolutions();
    }
    
})();

