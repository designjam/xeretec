/**
 * Product Detail Component
 * Handles thumbnail click functionality on desktop and carousel on mobile
 * Requires jQuery and Slick (from global-scripts.min.js)
 */
(function($) {
    'use strict';
    
    function initProductDetail() {
        $('[data-product-detail]').each(function() {
            var $component = $(this);
            var $mainImage = $component.find('[data-product-main-image]');
            var $thumbnails = $component.find('[data-product-thumbnail]');
            var $thumbnailWrappers = $component.find('[data-product-thumbnail-wrapper]');
            var $carousel = $component.find('[data-product-carousel]');
            var $navWrapper = $component.find('.carousel-nav-wrapper');
            
            // Desktop: Thumbnail click functionality
            if ($thumbnails.length > 0 && $mainImage.length > 0) {
                $thumbnails.on('click', function() {
                    var $clickedThumb = $(this);
                    var $clickedWrapper = $clickedThumb.closest('[data-product-thumbnail-wrapper]');
                    var imageUrl = $clickedThumb.data('image-url');
                    var imageAlt = $clickedThumb.data('image-alt');
                    
                    // Update main image with fade effect
                    $mainImage.fadeOut(200, function() {
                        $(this).attr('src', imageUrl).attr('alt', imageAlt).fadeIn(200);
                    });
                    
                    // Update active thumbnail state
                    $thumbnails.removeClass('opacity-100').addClass('opacity-75');
                    $thumbnailWrappers.find('[data-product-thumbnail-overlay]').removeClass('bg-opacity-30').addClass('bg-opacity-0');
                    
                    $clickedThumb.removeClass('opacity-75').addClass('opacity-100');
                    $clickedWrapper.find('[data-product-thumbnail-overlay]').removeClass('bg-opacity-0').addClass('bg-opacity-30');
                });
            }
            
            // Mobile: Initialize carousel if Slick is available
            if ($carousel.length > 0 && typeof $.fn.slick !== 'undefined') {
                // Check if already initialized
                if (!$carousel.hasClass('slick-initialized')) {
                    var slickSettings = {
                        dots: false,
                        arrows: true,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                        centerPadding: '20px',
                        focusOnSelect: true,
                        swipe: true,
                        touchMove: true,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: "unslick" // Disable carousel on desktop
                            }
                        ]
                    };
                    
                    // Append arrows to navigation wrapper if it exists
                    if ($navWrapper.length > 0) {
                        slickSettings.appendArrows = $navWrapper;
                    }
                    
                    $carousel.slick(slickSettings);
                }
            }
        });
    }
    
    // Initialize when DOM is ready
    if (typeof jQuery !== 'undefined') {
        $(document).ready(function() {
            // Initialize thumbnail functionality immediately (doesn't need Slick)
            $('[data-product-detail]').each(function() {
                var $component = $(this);
                var $mainImage = $component.find('[data-product-main-image]');
                var $thumbnails = $component.find('[data-product-thumbnail]');
                var $thumbnailWrappers = $component.find('[data-product-thumbnail-wrapper]');
                
                if ($thumbnails.length > 0 && $mainImage.length > 0) {
                    $thumbnails.on('click', function() {
                        var $clickedThumb = $(this);
                        var $clickedWrapper = $clickedThumb.closest('[data-product-thumbnail-wrapper]');
                        var imageUrl = $clickedThumb.data('image-url');
                        var imageAlt = $clickedThumb.data('image-alt');
                        
                        $mainImage.fadeOut(200, function() {
                            $(this).attr('src', imageUrl).attr('alt', imageAlt).fadeIn(200);
                        });
                        
                        $thumbnails.removeClass('opacity-100').addClass('opacity-75');
                        $thumbnailWrappers.find('[data-product-thumbnail-overlay]').removeClass('bg-opacity-30').addClass('bg-opacity-0');
                        
                        $clickedThumb.removeClass('opacity-75').addClass('opacity-100');
                        $clickedWrapper.find('[data-product-thumbnail-overlay]').removeClass('bg-opacity-0').addClass('bg-opacity-30');
                    });
                }
            });
            
            // Wait for Slick to be available (for mobile carousel)
            if (typeof $.fn.slick !== 'undefined') {
                initProductDetail();
            } else {
                // Try to initialize carousel after a delay (Slick might load later)
                setTimeout(function() {
                    if (typeof $.fn.slick !== 'undefined') {
                        initProductDetail();
                    }
                }, 100);
            }
        });
        
        // Handle window resize for carousel
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                $('[data-product-carousel]').each(function() {
                    var $carousel = $(this);
                    var $component = $carousel.closest('[data-product-detail]');
                    var $navWrapper = $component.find('.carousel-nav-wrapper');
                    var windowWidth = $(window).width();
                    
                    if (windowWidth >= 1024) {
                        // Desktop: destroy carousel if initialized
                        if ($carousel.hasClass('slick-initialized')) {
                            $carousel.slick('unslick');
                        }
                    } else {
                        // Mobile: initialize carousel if not already initialized
                        if (!$carousel.hasClass('slick-initialized') && typeof $.fn.slick !== 'undefined') {
                            var slickSettings = {
                                dots: false,
                                arrows: true,
                                infinite: true,
                                speed: 300,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerMode: true,
                                centerPadding: '20px',
                                focusOnSelect: true,
                                swipe: true,
                                touchMove: true
                            };
                            
                            if ($navWrapper.length > 0) {
                                slickSettings.appendArrows = $navWrapper;
                            }
                            
                            $carousel.slick(slickSettings);
                        }
                    }
                });
            }, 250);
        });
    }
})(jQuery);
















