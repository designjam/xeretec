/**
 * Testimonials Component
 * Handles hover (desktop) and click (mobile) interactions to change featured testimonial
 */
(function($) {
    'use strict';
    
    function updateTestimonialContent($card, testimonialData, refs) {
        var $component = refs.$component;
        var $logoCards = refs.$logoCards;
        var $quote = refs.$quote;
        var $name = refs.$name;
        var $company = refs.$company;
        var $image = refs.$image;
        var $profileInfo = refs.$profileInfo;
        var $profileSection = refs.$profileSection;
        
        if (!testimonialData) return;
        
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
            $profileSection.addClass('has-profile');
            
            var profileName = testimonialData.profile_name || testimonialData.name || '';
            var profileRole = testimonialData.profile_role || '';
            
            if ($name.length) {
                $name.fadeOut(200, function() {
                    $name.text(profileName).fadeIn(200);
                });
            }
            
            var $roleElement = $component.find('.testimonial-role');
            if ($roleElement.length) {
                $roleElement.fadeOut(200, function() {
                    $roleElement.text(profileRole).fadeIn(200);
                });
            } else if (profileRole && $profileInfo.length) {
                var $newRole = $('<p class="text-[14px] xl:text-[16px] text-white/80 p-0 !m-0 testimonial-role"></p>');
                $newRole.text(profileRole);
                $profileInfo.append($newRole);
            }
            
            if ($image.length) {
                $image.fadeOut(200, function() {
                    $image.attr('src', profileImageSrc);
                    $image.attr('alt', testimonialData.profile_alt || profileName || 'Profile');
                    $image.fadeIn(200);
                });
            }
        } else {
            if ($profileSection.length) {
                $profileSection.removeClass('has-profile');
            }
        }
        
        var companyText = testimonialData.company || '';
        var jobTitle = testimonialData.job_title || '';
        var companyJobText = companyText + (jobTitle ? ' and ' + jobTitle : '');
        
        if ($company.length) {
            $company.fadeOut(200, function() {
                $company.text(companyJobText).fadeIn(200);
            });
        }
    }
    
    function initTestimonials() {
        $('[data-testimonials]').each(function() {
            var $component = $(this);
            var $logoCards = $component.find('.testimonial-logo-card');
            var $quote = $component.find('.testimonial-quote');
            var $name = $component.find('.testimonial-name');
            var $company = $component.find('.testimonial-company');
            var $image = $component.find('.testimonial-image');
            var $profileInfo = $component.find('.testimonial-profile-info');
            var $profileSection = $component.find('.testimonial-profile');
            
            var refs = {
                $component: $component,
                $logoCards: $logoCards,
                $quote: $quote,
                $name: $name,
                $company: $company,
                $image: $image,
                $profileInfo: $profileInfo,
                $profileSection: $profileSection
            };
            
            // Handle hover on logo cards (desktop)
            $logoCards.on('mouseenter', function() {
                var $card = $(this);
                var testimonialData = $card.data('testimonial-data');
                updateTestimonialContent($card, testimonialData, refs);
            });
            
            // Handle click on logo cards (mobile) - also scrolls testimonial into view
            $logoCards.on('click', function() {
                var $card = $(this);
                var testimonialData = $card.data('testimonial-data');
                updateTestimonialContent($card, testimonialData, refs);
                
                // On mobile, scroll the featured testimonial into view (offset for fixed nav)
                if (window.matchMedia('(max-width: 767px)').matches) {
                    var $featuredCard = $component.find('.featured-testimonial-wrapper');
                    if ($featuredCard.length) {
                        var element = $featuredCard[0];
                        var elementTop = element.getBoundingClientRect().top + window.pageYOffset;
                        var offsetPosition = elementTop - 100;
                        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                    }
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















