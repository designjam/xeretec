/**
 * Vertical Carousel Component
 * Uses GSAP ScrollTrigger for pinned left content and sequential card animations
 * Cards fade/slide up from below, hold briefly, then slide up and off
 */

(function() {
    'use strict';
    
    function initVerticalCarousel() {
        // Check if GSAP and ScrollTrigger are available
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            console.warn('GSAP ScrollTrigger is not loaded');
            return;
        }
        
        // Register ScrollTrigger plugin
        gsap.registerPlugin(ScrollTrigger);
        
        // Use matchMedia for responsive behavior
        const mm = gsap.matchMedia();
        
        // Desktop behavior (min-width: 961px)
        mm.add("(min-width: 961px)", () => {
            const sections = document.querySelectorAll('[data-vertical-carousel]');
            
            sections.forEach((section) => {
                const cardStack = section.querySelector('.card-stack');
                const cards = gsap.utils.toArray(cardStack ? cardStack.querySelectorAll('.card') : []);
                
                if (cards.length === 0) {
                    return;
                }
                
                // Start cards hidden/off-screen (below)
                gsap.set(cards, {
                    opacity: 0,
                    yPercent: 35,         // start below the visible area
                    pointerEvents: "none"
                });
                
                // Animation timing settings
                const hold = 0.5;       // increase for longer "pin" per card
                const inDur = 0.35;     // entrance speed
                const outDur = 0.35;    // exit speed
                const gap = 0.15;       // small gap between cards
                
                // Create timeline for card animations
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: section,
                        start: "top top",
                        end: () => "+=" + (cards.length * 900), // increase to slow down overall
                        scrub: true,
                        pin: true,
                        anticipatePin: 1
                        // markers: true // uncomment for debugging
                    }
                });
                
                // Animate each card: in -> hold -> out
                cards.forEach((card) => {
                    // Card enters
                    tl.to(card, {
                        opacity: 1,
                        yPercent: 0,
                        duration: inDur,
                        ease: "power2.out",
                        pointerEvents: "auto"
                    });
                    
                    // "Pinned" hold moment
                    tl.to({}, { duration: hold });
                    
                    // Card exits
                    tl.to(card, {
                        opacity: 0,
                        yPercent: -35, // exit above
                        duration: outDur,
                        ease: "power2.in",
                        pointerEvents: "none"
                    });
                    
                    // Gap between cards
                    tl.to({}, { duration: gap });
                });
                
                // Pin left content (without extra spacing)
                const leftContent = section.querySelector('.vertical-carousel-left');
                if (leftContent) {
                    ScrollTrigger.create({
                        trigger: section,
                        start: "top top",
                        end: () => "+=" + (cards.length * 1200),
                        pin: leftContent,
                        pinSpacing: false
                    });
                }
            });
        });
        
        // Mobile behavior: cards stack normally (no pinning)
        mm.add("(max-width: 960px)", () => {
            const sections = document.querySelectorAll('[data-vertical-carousel]');
            
            sections.forEach((section) => {
                const cardStack = section.querySelector('.card-stack');
                const cards = cardStack ? cardStack.querySelectorAll('.card') : [];
                
                // Reset cards to normal flow on mobile
                gsap.set(cards, {
                    clearProps: "all"
                });
                
                // Ensure card stack allows normal flow
                if (cardStack) {
                    gsap.set(cardStack, {
                        height: "auto",
                        overflow: "visible"
                    });
                }
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit for GSAP to load if it's loaded via CDN
            setTimeout(initVerticalCarousel, 100);
        });
    } else {
        // DOM already loaded
        setTimeout(initVerticalCarousel, 100);
    }
    
    // Also try to initialize after a delay in case GSAP loads later
    setTimeout(initVerticalCarousel, 500);
})();

