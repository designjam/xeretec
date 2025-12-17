/**
 * Testimonials Component
 * Handles hover interactions to change featured testimonial when hovering over logos
 */
(function($) {
    'use strict';
    
    function initTestimonials() {
        $('[data-testimonials]').each(function() {
            var $component = $(this);
            var $logoCards = $component.find('.testimonial-logo-card');
            var $quote = $component.find('.testimonial-quote');
            var $name = $component.find('.testimonial-name');
            var $company = $component.find('.testimonial-company');
            var $image = $component.find('.testimonial-image');
            
            // Store original content for fade animation
            var originalQuote = $quote.text();
            var originalName = $name.text();
            var originalCompany = $company.text();
            var originalImageSrc = $image.attr('src');
            
            // Handle hover on logo cards
            $logoCards.on('mouseenter', function() {
                var $card = $(this);
                var testimonialData = $card.data('testimonial-data');
                
                if (!testimonialData) {
                    return;
                }
                
                // Update active state
                $logoCards.removeClass('active');
                $card.addClass('active');
                
                // Fade out current content
                $quote.fadeOut(200, function() {
                    $quote.text(testimonialData.quote || '').fadeIn(200);
                });
                
                $name.fadeOut(200, function() {
                    $name.text(testimonialData.name || '').fadeIn(200);
                });
                
                // Update company/job title
                var companyText = testimonialData.company || '';
                var jobTitle = testimonialData.job_title || '';
                var companyJobText = companyText + (jobTitle ? ' and ' + jobTitle : '');
                
                $company.fadeOut(200, function() {
                    $company.text(companyJobText).fadeIn(200);
                });
                
                // Update image with fade effect
                if (testimonialData.image) {
                    $image.fadeOut(200, function() {
                        $image.attr('src', testimonialData.image);
                        $image.attr('alt', testimonialData.image_alt || testimonialData.name || 'Profile');
                        $image.fadeIn(200);
                    });
                }
            });
            
            // Optional: Handle mouse leave to return to first testimonial
            // Uncomment if you want this behavior
            /*
            $component.on('mouseleave', function() {
                var $firstCard = $logoCards.first();
                if (!$firstCard.hasClass('active')) {
                    $firstCard.trigger('mouseenter');
                }
            });
            */
        });
    }
    
    // Initialize when DOM is ready
    if (typeof jQuery !== 'undefined') {
        $(document).ready(function() {
            initTestimonials();
        });
    }
})(jQuery);












