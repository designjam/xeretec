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
            var $profileInfo = $component.find('.testimonial-profile-info');
            var $role = $component.find('.testimonial-role');
            var $profileSection = $component.find('.testimonial-profile');
            
            // Store original content for fade animation
            var originalQuote = $quote.text();
            var originalName = $name.text();
            var originalCompany = $company.text();
            var originalImageSrc = $image.attr('src');
            var originalRole = $role.text();
            
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
                
                // Update profile section - only show if profile image exists
                var profileImageSrc = testimonialData.profile || '';
                
                if (profileImageSrc && $profileSection.length) {
                    // Add has-profile class to show profile section (respects Tailwind breakpoints)
                    $profileSection.addClass('has-profile');
                    
                    // Show profile section and update content
                    var profileName = testimonialData.profile_name || testimonialData.name || '';
                    var profileRole = testimonialData.profile_role || '';
                    
                    // Update profile name
                    if ($name.length) {
                        $name.fadeOut(200, function() {
                            $name.text(profileName).fadeIn(200);
                        });
                    }
                    
                    // Update profile role - find element dynamically in case it was created
                    var $roleElement = $component.find('.testimonial-role');
                    if ($roleElement.length) {
                        $roleElement.fadeOut(200, function() {
                            $roleElement.text(profileRole).fadeIn(200);
                        });
                    } else if (profileRole && $profileInfo.length) {
                        // Create role element if it doesn't exist but we have a role to show
                        var $newRole = $('<p class="text-[14px] xl:text-[16px] text-white/80 p-0 !m-0 testimonial-role"></p>');
                        $newRole.text(profileRole);
                        $profileInfo.append($newRole);
                    }
                    
                    // Update profile image
                    if ($image.length) {
                        $image.fadeOut(200, function() {
                            $image.attr('src', profileImageSrc);
                            $image.attr('alt', testimonialData.profile_alt || profileName || 'Profile');
                            $image.fadeIn(200);
                        });
                    }
                } else {
                    // Remove has-profile class to hide profile section (respects Tailwind breakpoints)
                    if ($profileSection.length) {
                        $profileSection.removeClass('has-profile');
                    }
                }
                
                // Update company/job title
                var companyText = testimonialData.company || '';
                var jobTitle = testimonialData.job_title || '';
                var companyJobText = companyText + (jobTitle ? ' and ' + jobTitle : '');
                
                if ($company.length) {
                    $company.fadeOut(200, function() {
                        $company.text(companyJobText).fadeIn(200);
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















