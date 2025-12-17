/**
 * Vertical Tabs Component JavaScript
 * Handles tab switching on desktop and accordion behavior on mobile
 */

(function() {
    'use strict';

    function initVerticalTabs() {
        const tabComponents = document.querySelectorAll('[data-vertical-tabs]');
        
        tabComponents.forEach(component => {
            const tabButtons = component.querySelectorAll('.vertical-tab-button');
            const tabPanels = component.querySelectorAll('[data-tab-panel]'); // Desktop panels
            const mobilePanels = component.querySelectorAll('[data-tab-panel-mobile]'); // Mobile accordion panels
            
            if (tabButtons.length === 0) return;
            
            tabButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    // Check screen size dynamically on each click
                    const isMobile = window.innerWidth < 1024; // lg breakpoint
                    
                    const tabIndex = parseInt(button.getAttribute('data-tab-index'));
                    const targetPanelId = button.getAttribute('data-tab-toggle');
                    const icon = button.querySelector('.accordion-icon');
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    
                    if (isMobile) {
                        // Mobile: Accordion behavior
                        const mobilePanel = component.querySelector(`[data-accordion-content="${targetPanelId}-mobile"]`);
                        
                        if (isExpanded && mobilePanel) {
                            // Close accordion
                            closeMobileAccordion(button, mobilePanel, icon);
                        } else {
                            // Close all other accordions first
                            tabButtons.forEach((btn, idx) => {
                                if (idx !== tabIndex) {
                                    const btnPanelId = btn.getAttribute('data-tab-toggle');
                                    const btnMobilePanel = component.querySelector(`[data-accordion-content="${btnPanelId}-mobile"]`);
                                    const btnIcon = btn.querySelector('.accordion-icon');
                                    if (btn.getAttribute('aria-expanded') === 'true' && btnMobilePanel) {
                                        closeMobileAccordion(btn, btnMobilePanel, btnIcon);
                                    }
                                }
                            });
                            
                            // Open clicked accordion
                            if (mobilePanel) {
                                openMobileAccordion(button, mobilePanel, icon);
                            }
                        }
                    } else {
                        // Desktop: Tab behavior
                        // Remove active state from all buttons and icons
                        tabButtons.forEach(btn => {
                            btn.classList.remove('bg-[#575757]', 'text-white');
                            btn.classList.add('bg-white', 'text-[#4B5563]');
                            btn.setAttribute('aria-selected', 'false');
                            
                            // Update icon color
                            const btnIcon = btn.querySelector('.accordion-icon');
                            if (btnIcon) {
                                btnIcon.classList.remove('text-white');
                                btnIcon.classList.add('text-gradient', 'text-brand');
                            }
                        });
                        
                        // Hide all panels
                        tabPanels.forEach(panel => {
                            panel.classList.remove('opacity-100', 'block');
                            panel.classList.add('opacity-0', 'hidden');
                        });
                        
                        // Add active state to clicked button
                        button.classList.remove('bg-white', 'text-[#4B5563]');
                        button.classList.add('bg-[#575757]', 'text-white');
                        button.setAttribute('aria-selected', 'true');
                        
                        // Update icon color for active button
                        if (icon) {
                            icon.classList.remove('text-gradient', 'text-brand');
                            icon.classList.add('text-white');
                        }
                        
                        // Show corresponding panel
                        if (tabPanels[tabIndex]) {
                            tabPanels[tabIndex].classList.remove('opacity-0', 'hidden');
                            tabPanels[tabIndex].classList.add('opacity-100', 'block');
                        }
                    }
                });
            });
            
            // Handle window resize to switch between mobile/desktop behavior
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    // Reset to first tab/accordion on resize
                    const firstButton = tabButtons[0];
                    const firstPanelId = firstButton.getAttribute('data-tab-toggle');
                    
                    if (window.innerWidth < 1024) {
                        // Mobile: Close all except first
                        tabButtons.forEach((btn, idx) => {
                            const btnPanelId = btn.getAttribute('data-tab-toggle');
                            const btnMobilePanel = component.querySelector(`[data-accordion-content="${btnPanelId}-mobile"]`);
                            const btnIcon = btn.querySelector('.accordion-icon');
                            
                            if (idx === 0) {
                                if (btnMobilePanel && btn.getAttribute('aria-expanded') !== 'true') {
                                    openMobileAccordion(btn, btnMobilePanel, btnIcon);
                                }
                            } else {
                                if (btnMobilePanel && btn.getAttribute('aria-expanded') === 'true') {
                                    closeMobileAccordion(btn, btnMobilePanel, btnIcon);
                                }
                            }
                        });
                    } else {
                        // Desktop: Show first tab
                        tabButtons.forEach((btn, idx) => {
                            const btnIcon = btn.querySelector('.accordion-icon');
                            if (idx === 0) {
                                btn.classList.remove('bg-white', 'text-[#4B5563]');
                                btn.classList.add('bg-[#575757]', 'text-white');
                                btn.setAttribute('aria-selected', 'true');
                                if (btnIcon) {
                                    btnIcon.classList.remove('text-gradient', 'text-brand');
                                    btnIcon.classList.add('text-white');
                                }
                            } else {
                                btn.classList.remove('bg-[#575757]', 'text-white');
                                btn.classList.add('bg-white', 'text-[#4B5563]');
                                btn.setAttribute('aria-selected', 'false');
                                if (btnIcon) {
                                    btnIcon.classList.remove('text-white');
                                    btnIcon.classList.add('text-gradient', 'text-brand');
                                }
                            }
                        });
                        
                        tabPanels.forEach((panel, idx) => {
                            if (idx === 0) {
                                panel.classList.remove('opacity-0', 'hidden');
                                panel.classList.add('opacity-100', 'block');
                            } else {
                                panel.classList.remove('opacity-100', 'block');
                                panel.classList.add('opacity-0', 'hidden');
                            }
                        });
                    }
                }, 250);
            });
        });
    }
    
    function closeMobileAccordion(button, panel, icon) {
        if (!panel) return;
        
        panel.style.maxHeight = panel.scrollHeight + 'px';
        panel.offsetHeight; // Force reflow
        
        panel.classList.remove('accordion-open', 'max-h-[2000px]');
        panel.style.maxHeight = '0';
        
        button.setAttribute('aria-expanded', 'false');
        button.classList.remove('bg-[#575757]', 'text-white');
        button.classList.add('bg-white', 'text-[#4B5563]');
        
        if (icon) {
            icon.textContent = '+';
            icon.classList.remove('text-white');
            icon.classList.add('text-gradient', 'text-brand');
        }
    }
    
    function openMobileAccordion(button, panel, icon) {
        if (!panel) return;
        
        panel.style.maxHeight = '0';
        panel.classList.remove('accordion-open');
        
        panel.offsetHeight; // Force reflow
        
        panel.classList.add('accordion-open', 'max-h-[2000px]');
        panel.style.maxHeight = panel.scrollHeight + 'px';
        
        button.setAttribute('aria-expanded', 'true');
        button.classList.remove('bg-white', 'text-[#4B5563]');
        button.classList.add('bg-[#575757]', 'text-white');
        
        if (icon) {
            icon.textContent = '−';
            icon.classList.remove('text-gradient', 'text-brand');
            icon.classList.add('text-white');
        }
        
        // After transition, set to auto for flexibility
        setTimeout(() => {
            if (panel.classList.contains('accordion-open')) {
                panel.style.maxHeight = 'none';
            }
        }, 300);
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVerticalTabs);
    } else {
        initVerticalTabs();
    }
    
})();

