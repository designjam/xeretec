/**
 * FAQs Component
 * Handles FAQ accordion functionality
 */
(function() {
    'use strict';
    
    function initAccordions() {
        const accordionButtons = document.querySelectorAll('[data-accordion-toggle]');
        
        function closeAccordion(button, content, icon) {
            if (!content) return;
            
            // Set max-height to current height for smooth transition
            content.style.maxHeight = content.scrollHeight + 'px';
            
            // Force reflow
            content.offsetHeight;
            
            // Remove open class and set to 0
            content.classList.remove('accordion-open');
            content.style.maxHeight = '0';
            
            button.setAttribute('aria-expanded', 'false');
            button.classList.remove('active');
            
            if (icon) {
                icon.textContent = '+';
            }
        }
        
        function openAccordion(button, content, icon) {
            if (!content) return;
            
            // Set max-height to 0 first
            content.style.maxHeight = '0';
            content.classList.remove('accordion-open');
            
            // Force reflow
            content.offsetHeight;
            
            // Add open class and set to actual height
            content.classList.add('accordion-open');
            content.style.maxHeight = content.scrollHeight + 'px';
            
            button.setAttribute('aria-expanded', 'true');
            button.classList.add('active');
            
            if (icon) {
                icon.textContent = '−';
            }
            
            // After transition completes, set to auto for flexibility
            setTimeout(() => {
                if (content.classList.contains('accordion-open')) {
                    content.style.maxHeight = 'none';
                }
            }, 300);
        }
        
        accordionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-accordion-toggle');
                const content = document.querySelector(`[data-accordion-content="${targetId}"]`);
                const icon = this.querySelector('.accordion-icon');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                // Get the accordion group
                const group = this.closest('[data-accordion-group]');
                
                // If clicking an already open accordion, close it
                if (isExpanded && content) {
                    closeAccordion(this, content, icon);
                    return;
                }
                
                // Otherwise, close all accordions in the same group first
                if (group) {
                    const allButtons = group.querySelectorAll('[data-accordion-toggle]');
                    
                    allButtons.forEach(btn => {
                        const btnTargetId = btn.getAttribute('data-accordion-toggle');
                        const btnContent = document.querySelector(`[data-accordion-content="${btnTargetId}"]`);
                        const btnIcon = btn.querySelector('.accordion-icon');
                        if (btnContent && btn.getAttribute('aria-expanded') === 'true') {
                            closeAccordion(btn, btnContent, btnIcon);
                        }
                    });
                }
                
                // Then open the clicked accordion
                openAccordion(this, content, icon);
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAccordions);
    } else {
        initAccordions();
    }
})();

