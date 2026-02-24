/**
 * Mobile Menu Functionality
 * Standalone script - no dependencies on existing menu code
 */

(function() {
    'use strict';

    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenuClose = document.querySelector('.mobile-menu__close');
    const searchToggle = document.querySelector('.mobile-menu__search-toggle');
    const searchContainer = document.querySelector('.mobile-menu__search');
    const body = document.body;

    if (!mobileMenu || !mobileMenuToggle) {
        return;
    }

    // Toggle menu open/close
    function toggleMenu() {
        const isOpen = mobileMenu.classList.contains('active');
        
        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    }

    function openMenu() {
        mobileMenu.classList.add('active');
        mobileMenuToggle.classList.add('active');
        body.classList.add('mobile-menu-open');
        // Prevent scroll on body
        const scrollY = window.scrollY;
        body.style.top = `-${scrollY}px`;
    }

    function closeMenu() {
        mobileMenu.classList.remove('active');
        mobileMenuToggle.classList.remove('active');
        body.classList.remove('mobile-menu-open');
        // Restore scroll position
        const scrollY = body.style.top;
        body.style.top = '';
        if (scrollY) {
            window.scrollTo(0, parseInt(scrollY || '0') * -1);
        }
        // Close search if open
        if (searchContainer) {
            searchContainer.classList.add('mobile-menu__search--closed');
        }
    }

    // Toggle search
    function toggleSearch() {
        if (searchContainer) {
            searchContainer.classList.toggle('mobile-menu__search--closed');
        }
    }

    // Handle menu item toggles (collapsible items)
    function handleMenuItemToggle(e) {
        // Find the toggle link - could be clicked directly or on a child element
        const link = e.target.closest('.mobile-menu__link--toggle');
        if (!link) return;
        
        const item = link.closest('.mobile-menu__item--has-children');
        if (!item) return;
        
        e.preventDefault();
        e.stopPropagation();
        
        const isExpanded = item.classList.contains('mobile-menu__item--expanded');
        
        if (isExpanded) {
            item.classList.remove('mobile-menu__item--expanded');
            link.setAttribute('aria-expanded', 'false');
        } else {
            // Close other expanded items at the same level
            const parent = item.parentElement;
            if (parent) {
                const siblings = Array.from(parent.children);
                siblings.forEach(sibling => {
                    if (sibling !== item && sibling.classList.contains('mobile-menu__item--expanded')) {
                        sibling.classList.remove('mobile-menu__item--expanded');
                        const siblingLink = sibling.querySelector('.mobile-menu__link--toggle');
                        if (siblingLink) {
                            siblingLink.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            }
            
            item.classList.add('mobile-menu__item--expanded');
            link.setAttribute('aria-expanded', 'true');
        }
    }

    // Event Listeners
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleMenu);
    }

    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMenu);
    }

    if (searchToggle) {
        searchToggle.addEventListener('click', toggleSearch);
    }

    // Handle menu item toggles - use event delegation on the menu container
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            // Check if click is on a toggle link or its children
            if (e.target.closest('.mobile-menu__link--toggle')) {
                handleMenuItemToggle(e);
            }
        });
    }

    // Handle header bar search toggle - ensure DOM is ready
    function initHeaderSearch() {
        const headerSearchToggle = document.querySelector('.mobile-header-bar__search-toggle');
        const headerSearch = document.querySelector('.mobile-header-search');
        
        if (headerSearchToggle && headerSearch) {
            headerSearchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                headerSearch.classList.toggle('mobile-header-search--closed');
            });

            // Close header search when clicking outside
            document.addEventListener('click', function(e) {
                if (!headerSearch.contains(e.target) && !headerSearchToggle.contains(e.target)) {
                    headerSearch.classList.add('mobile-header-search--closed');
                }
            });
        }
    }

    // Initialize header search when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeaderSearch);
    } else {
        initHeaderSearch();
    }

    // Close menu when clicking outside (on backdrop)
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            closeMenu();
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMenu();
        }
    });

    // Handle window resize - close menu if resizing above breakpoint
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 1101 && mobileMenu.classList.contains('active')) {
                closeMenu();
            }
        }, 250);
    });
})();
