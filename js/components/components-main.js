/**
 * Components Main JavaScript
 * Initializes all component-specific functionality
 */

(function() {
    'use strict';

    // Initialize components when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initCarousels();
        initVideoPlayers();
        initFormValidation();
    });

    /**
     * Carousel functionality
     */
    function initCarousels() {
        const carousels = document.querySelectorAll('[data-carousel]');
        
        carousels.forEach(carousel => {
            const prevButton = carousel.querySelector('[data-carousel-prev]');
            const nextButton = carousel.querySelector('[data-carousel-next]');
            const slides = carousel.querySelectorAll('[data-carousel-slide]');
            let currentIndex = 0;
            
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('hidden', i !== index);
                });
            }
            
            if (prevButton) {
                prevButton.addEventListener('click', function() {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                    showSlide(currentIndex);
                });
            }
            
            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    currentIndex = (currentIndex + 1) % slides.length;
                    showSlide(currentIndex);
                });
            }
            
            // Initialize first slide
            if (slides.length > 0) {
                showSlide(0);
            }
        });
    }

    /**
     * Video player functionality
     */
    function initVideoPlayers() {
        const videoContainers = document.querySelectorAll('[data-video-player]');
        
        videoContainers.forEach(container => {
            const playButton = container.querySelector('[data-video-play]');
            const video = container.querySelector('video, iframe');
            
            if (playButton && video) {
                playButton.addEventListener('click', function() {
                    if (video.tagName === 'VIDEO') {
                        video.play();
                        playButton.classList.add('hidden');
                    } else if (video.tagName === 'IFRAME') {
                        // Handle iframe video (YouTube, Vimeo, etc.)
                        const src = video.getAttribute('src');
                        if (src && !src.includes('autoplay=1')) {
                            const separator = src.includes('?') ? '&' : '?';
                            video.setAttribute('src', src + separator + 'autoplay=1');
                        }
                        playButton.classList.add('hidden');
                    }
                });
            }
        });
    }

    /**
     * Form validation
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('[data-component-form]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                // Email validation
                const emailFields = form.querySelectorAll('input[type="email"]');
                emailFields.forEach(field => {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (field.value && !emailRegex.test(field.value)) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    }

})();

