/**
 * Carousel Component
 * Uses Slick Carousel for partner/customer carousels
 * Requires jQuery and Slick (from global-scripts.min.js)
 */
(function($) {
    'use strict';
    
    function initSlickCarousels() {
        // Initialize carousels with data-carousel attribute
        $('[data-carousel]').each(function() {
            var $carousel = $(this);
            var $slider = $carousel.find('.partner-carousel-slick, .customer-carousel-slick, .success-stories-carousel-slick, .latest-resources-carousel-slick, .product-feature-carousel-slick, .comparison-cards-carousel-slick, .comparison-table-carousel-slick, .vertical-carousel-slick');
            
            // Skip if no slider found
            if ($slider.length === 0) {
                return;
            }
            
            // Check if it's latest resources carousel (mobile-only)
            var isLatestResources = $slider.hasClass('latest-resources-carousel-slick');
            
            // Skip if already initialized (for all carousels)
            if ($slider.hasClass('slick-initialized')) {
                return;
            }
            
            // Check if Slick is available
            if (typeof $.fn.slick === 'undefined') {
                console.warn('Slick Carousel is not loaded');
                return;
            }
            
            // Determine carousel type and settings
            var isCustomerCarousel = $slider.hasClass('customer-carousel-slick');
            var isPartnerCarousel = $slider.hasClass('partner-carousel-slick');
            var isSuccessStories = $slider.hasClass('success-stories-carousel-slick');
            var isProductFeature = $slider.hasClass('product-feature-carousel-slick');
            var isComparisonCards = $slider.hasClass('comparison-cards-carousel-slick');
            var isComparisonTable = $slider.hasClass('comparison-table-carousel-slick');
            var isVerticalCarousel = $slider.hasClass('vertical-carousel-slick');
            // isLatestResources already determined above
            
            // Determine if arrows should be enabled
            var hasArrows = isSuccessStories || isLatestResources || isProductFeature || isComparisonCards || isComparisonTable; // Vertical carousel uses dots only, no arrows
            
            // Create navigation wrapper for arrows if enabled
            var $navWrapper = null;
            if (hasArrows) {
                $navWrapper = $carousel.find('.carousel-nav-wrapper');
                if ($navWrapper.length === 0) {
                    $navWrapper = $('<div class="carousel-nav-wrapper"></div>');
                    $slider.after($navWrapper);
                }
            }
            
            // Handle vertical carousel dots navigation
            var $verticalDots = null;
            if (isVerticalCarousel) {
                $verticalDots = $carousel.find('.vertical-carousel-dots');
                if ($verticalDots.length === 0) {
                    $verticalDots = $('<div class="vertical-carousel-dots"></div>');
                    $slider.after($verticalDots);
                }
            }
            
            // Determine if this is a continuous scrolling carousel (partner or customer)
            var isContinuousScrolling = isPartnerCarousel || isCustomerCarousel;
            
            var slickSettings = {
                dots: isSuccessStories || isVerticalCarousel, // Show dots for success stories and vertical carousel
                arrows: hasArrows, // Show arrows for carousels that need them
                infinite: !isVerticalCarousel, // Disable infinite scrolling for vertical carousel (has start and end)
                speed: isContinuousScrolling ? 5000 : 600, // Continuous scrolling speed for partner/customer carousels
                autoplay: !isSuccessStories && !isLatestResources && !isProductFeature && !isComparisonCards && !isComparisonTable && !isVerticalCarousel, // No autoplay for success stories, latest resources, product feature, comparison cards, comparison table, and vertical carousel
                autoplaySpeed: isContinuousScrolling ? 0 : 3000, // Continuous scrolling: 0 for seamless transition
                cssEase: isContinuousScrolling ? 'linear' : 'ease', // Linear easing for continuous scrolling
                pauseOnHover: true,
                slidesToShow: isCustomerCarousel ? 6 : (isSuccessStories ? 3 : (isLatestResources ? 1 : (isProductFeature ? 1 : (isComparisonCards ? 1 : (isComparisonTable ? 1 : (isVerticalCarousel ? 1 : 6)))))), // Vertical carousel shows 1 slide at a time
                slidesToScroll: 1,
                swipeToSlide: isContinuousScrolling, // Enable swipe to slide for continuous scrolling carousels
                centerMode: isSuccessStories || isLatestResources || isProductFeature || isComparisonTable || isVerticalCarousel || isContinuousScrolling, // Enable center mode for success stories, latest resources, product feature, comparison table, vertical carousel, and continuous scrolling carousels
                centerPadding: isVerticalCarousel ? '100px' : (isSuccessStories ? '200px' : ((isLatestResources || isProductFeature || isComparisonTable) ? '20px' : '0px')), // Padding for center mode - vertical carousel uses 100px, success stories uses 200px
                focusOnSelect: isSuccessStories || isLatestResources || isProductFeature || isComparisonCards || isComparisonTable || isVerticalCarousel || isContinuousScrolling, // Focus on selected slide
                vertical: isVerticalCarousel, // Enable vertical mode for vertical carousel
                verticalSwiping: isVerticalCarousel, // Enable vertical swiping for vertical carousel
                responsive: []
            };
            
            // Append arrows to wrapper if it exists
            if ($navWrapper && $navWrapper.length > 0) {
                slickSettings.appendArrows = $navWrapper;
            }
            
            // Append dots to vertical carousel dots wrapper
            if ($verticalDots && $verticalDots.length > 0) {
                slickSettings.appendDots = $verticalDots;
            }
            
            // Partner/Customer/Success Stories/Latest Resources/Product Feature carousel responsive settings
            if (isVerticalCarousel) {
                // Vertical carousel: 1 slide at a time, vertical orientation
                // Responsive settings can disable vertical mode on mobile if needed
                slickSettings.responsive = [
                    {
                        breakpoint: 1024,
                        settings: {
                          vertical: false, // Switch to horizontal on mobile for better UX
                            verticalSwiping: false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: false,
                            centerPadding: '0px'
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            vertical: false, // Switch to horizontal on mobile for better UX
                            verticalSwiping: false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: false,
                            centerPadding: '0px'
                        }
                    }
                ];
            } else if (isProductFeature) {
                // Product Feature carousel: 1.5 slides on desktop (showing part of next slide), 1 on mobile
                // Using centerMode with CSS-controlled slide width to show 1.5 slides
                slickSettings.responsive = [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '0px'
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: false,
                            centerPadding: '0px'
                        }
                    }
                ];
            } else if (isComparisonCards) {
                // Comparison Cards carousel: Mobile-only carousel, unslick on desktop (grid shows instead)
                // Using mobileFirst: true so breakpoint applies when width > 1024px
                // Base settings apply to mobile: 1 slide, no center mode, no padding
                slickSettings.mobileFirst = true;
                slickSettings.centerMode = true; // Disable center mode for comparison cards - show one full card at a time
                slickSettings.centerPadding = '50px'; // No padding for comparison cards
                slickSettings.responsive = [
                    {
                        breakpoint: 1024,
                        settings: "unslick" // Disable carousel on desktop (width > 1024px), grid layout shows instead
                    }
                ];
            } else if (isComparisonTable) {
                // Comparison Table carousel: Mobile-only carousel, unslick on desktop (grid shows instead)
                // Using mobileFirst: true so breakpoint applies when width > 768px
                slickSettings.mobileFirst = true;
                slickSettings.responsive = [
                    {
                        breakpoint: 768,
                        settings: "unslick" // Disable carousel on desktop (width > 768px), grid layout shows instead
                    }
                ];
            } else if (isLatestResources) {
                // Latest Resources carousel: Mobile-only carousel, unslick on desktop (grid shows instead)
                // Using mobileFirst: true so breakpoint applies when width > 1024px
                slickSettings.mobileFirst = true;
                slickSettings.responsive = [
                    {
                        breakpoint: 1024,
                        settings: "unslick" // Disable carousel on desktop (width > 1024px), grid layout shows instead
                    }
                ];
            } else if (isSuccessStories) {
                    // Success Stories carousel: 3 on screens > 1400px, then responsive
                    // Using centerMode with whole numbers for slidesToShow
                    slickSettings.responsive = [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                centerMode: true,
                                centerPadding: '60px'
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                dots: false,
                                centerMode: true,
                                centerPadding: '40px'
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: false,
                                centerMode: false, // Disable center mode on mobile for full card display
                                centerPadding: '0px'
                            }
                        }
                    ];
                } else if (isCustomerCarousel) {
                    // Customer carousel: 8 on desktop, responsive breakpoints
                    slickSettings.responsive = [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 6,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        }
                    ];
                } else {
                    // Partner carousel: 6 on desktop, responsive breakpoints
                    slickSettings.responsive = [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ];
                }
            
            // Initialize Slick
            // For latest resources and comparison cards, Slick will automatically "unslick" on desktop via responsive settings
            $slider.slick(slickSettings);
            
            // Handle opacity transitions for vertical carousel slides
            if (isVerticalCarousel) {
                // Function to update opacity
                var updateOpacity = function() {
                    $slider.find('.slick-slide').each(function() {
                        var $slide = $(this);
                        if ($slide.hasClass('slick-current')) {
                            $slide.css('opacity', '1');
                        } else {
                            $slide.css('opacity', '0.5');
                        }
                    });
                };
                
                // Set initial opacity after a short delay to ensure Slick is initialized
                setTimeout(function() {
                    updateOpacity();
                }, 100);
                
                // Update opacity on slide change
                $slider.on('afterChange', function(event, slick, currentSlide) {
                    updateOpacity();
                });
                
                // Also update on init
                $slider.on('init', function() {
                    setTimeout(function() {
                        updateOpacity();
                    }, 100);
                });
            }
            
            // Store settings for latest resources, comparison cards, and comparison table carousels so we can reinitialize on resize
            if (isLatestResources) {
                $slider.data('latest-resources-settings', slickSettings);
            }
            if (isComparisonCards) {
                $slider.data('comparison-cards-settings', slickSettings);
            }
            if (isComparisonTable) {
                $slider.data('comparison-table-settings', slickSettings);
            }
        });
    }
    
    // Initialize product detail carousels (mobile-only)
    function initProductDetailCarousels() {
        $('[data-product-detail]').each(function() {
            var $component = $(this);
            var $slider = $component.find('.product-detail-carousel-slick');
            
            // Skip if no slider found or already initialized
            if ($slider.length === 0 || $slider.hasClass('slick-initialized')) {
                return;
            }
            
            // Check if Slick is available
            if (typeof $.fn.slick === 'undefined') {
                console.warn('Slick Carousel is not loaded');
                return;
            }
            
            // Get navigation wrapper
            var $navWrapper = $component.find('.carousel-nav-wrapper');
            
            // Product detail carousel settings (mobile-only)
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
                mobileFirst: true,
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
            
            // Initialize Slick
            $slider.slick(slickSettings);
        });
    }
    
    // Handle resize for latest resources and comparison cards carousels (mobile-only)
    function handleMobileOnlyCarouselsResize() {
        if (typeof $.fn.slick === 'undefined') {
            return;
        }
        
        var windowWidth = $(window).width();
        $('[data-carousel]').each(function() {
            var $carousel = $(this);
            var $latestResourcesSlider = $carousel.find('.latest-resources-carousel-slick');
            var $comparisonCardsSlider = $carousel.find('.comparison-cards-carousel-slick');
            var $comparisonTableSlider = $carousel.find('.comparison-table-carousel-slick');
            
            // Handle latest resources carousel
            if ($latestResourcesSlider.length > 0) {
                var latestResourcesSettings = $latestResourcesSlider.data('latest-resources-settings');
                if (latestResourcesSettings) {
                    if (windowWidth < 1024) {
                        // Mobile: ensure carousel is initialized
                        if (!$latestResourcesSlider.hasClass('slick-initialized')) {
                            $latestResourcesSlider.slick(latestResourcesSettings);
                        }
                    } else {
                        // Desktop: destroy carousel if initialized
                        if ($latestResourcesSlider.hasClass('slick-initialized')) {
                            $latestResourcesSlider.slick('unslick');
                        }
                    }
                }
            }
            
            // Handle comparison cards carousel
            if ($comparisonCardsSlider.length > 0) {
                var comparisonCardsSettings = $comparisonCardsSlider.data('comparison-cards-settings');
                if (comparisonCardsSettings) {
                    if (windowWidth < 1024) {
                        // Mobile: ensure carousel is initialized
                        if (!$comparisonCardsSlider.hasClass('slick-initialized')) {
                            $comparisonCardsSlider.slick(comparisonCardsSettings);
                        }
                    } else {
                        // Desktop: destroy carousel if initialized
                        if ($comparisonCardsSlider.hasClass('slick-initialized')) {
                            $comparisonCardsSlider.slick('unslick');
                        }
                    }
                }
            }
            
            // Handle comparison table carousel
            if ($comparisonTableSlider.length > 0) {
                var comparisonTableSettings = $comparisonTableSlider.data('comparison-table-settings');
                if (comparisonTableSettings) {
                    if (windowWidth < 768) {
                        // Mobile: ensure carousel is initialized
                        if (!$comparisonTableSlider.hasClass('slick-initialized')) {
                            $comparisonTableSlider.slick(comparisonTableSettings);
                        }
                    } else {
                        // Desktop: destroy carousel if initialized
                        if ($comparisonTableSlider.hasClass('slick-initialized')) {
                            $comparisonTableSlider.slick('unslick');
                        }
                    }
                }
            }
        });
        
        // Handle product detail carousel resize
        $('[data-product-detail]').each(function() {
            var $component = $(this);
            var $slider = $component.find('.product-detail-carousel-slick');
            
            if ($slider.length > 0) {
                if (windowWidth < 1024) {
                    // Mobile: ensure carousel is initialized
                    if (!$slider.hasClass('slick-initialized')) {
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
                            mobileFirst: true,
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: "unslick"
                                }
                            ]
                        };
                        
                        var $navWrapper = $component.find('.carousel-nav-wrapper');
                        if ($navWrapper.length > 0) {
                            slickSettings.appendArrows = $navWrapper;
                        }
                        
                        $slider.slick(slickSettings);
                    }
                } else {
                    // Desktop: destroy carousel if initialized
                    if ($slider.hasClass('slick-initialized')) {
                        $slider.slick('unslick');
                    }
                }
            }
        });
    }
    
    // Initialize when DOM is ready and jQuery/Slick are available
    if (typeof jQuery !== 'undefined') {
        $(document).ready(function() {
            // Wait for Slick to be available
            if (typeof $.fn.slick !== 'undefined') {
                initSlickCarousels();
                initProductDetailCarousels();
            } else {
                // Try again after a short delay (Slick might load after this script)
                setTimeout(function() {
                    if (typeof $.fn.slick !== 'undefined') {
                        initSlickCarousels();
                        initProductDetailCarousels();
                    } else {
                        console.warn('Slick Carousel failed to load');
                    }
                }, 100);
            }
        });
        
        // Handle window resize for latest resources and comparison cards carousels
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                handleMobileOnlyCarouselsResize();
            }, 250); // Debounce resize events
        });
    }
})(jQuery);
