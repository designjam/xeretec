<?php

/**
 * Testimonials Component
 * Displays company logos in a grid with a featured testimonial that changes on hover
 */

$testimonials = get_sub_field('testimonials');
$content = get_sub_field('testimonials_content');
$primary_cta = get_sub_field('testimonials_primary_cta');

if ($testimonials):
  $component_id = 'testimonials-' . get_row_index();
  $first_testimonial = reset($testimonials);
?>

  <section class="bg-light-fade-up component-wrapper testimonials-component" id="<?php echo esc_attr($component_id); ?>" data-testimonials>
    <div class="container flex flex-col gap-16 mx-auto">

      <?php if ($content): ?>
        <div class="mx-auto max-w-none text-center">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>

      <?php if ($testimonials): ?>
        <div class="testimonials-grid-wrapper">
          <!-- Combined Grid with Logos and Featured Testimonial -->
          <div class="mb-8 testimonials-grid">
            <?php 
            $testimonial_inserted = false;
            $insert_position = 1; // Insert featured testimonial after first logo (position 1)
            $logo_number = 0; // Track logo number for grid positioning
            
            foreach ($testimonials as $index => $testimonial): 
              $logo = $testimonial['logo'] ?? $testimonial['image']; // Fallback to image if no logo
              $is_active = ($index === 0) ? 'active' : '';
              
              // Insert featured testimonial card after the first logo
              if ($index === $insert_position && !$testimonial_inserted):
                $testimonial_inserted = true;
            ?>
              <!-- Featured Testimonial Card - Spans multiple columns based on breakpoint -->
              <div class="testimonial-featured featured-testimonial-wrapper">
              <div class="flex overflow-hidden relative flex-col justify-center items-center p-8 h-full md:p-12 xl:py-6 xl:px-16 rounded-10 shadow-custom featured-testimonial-card bg-dark">
                  <!-- Large Quote Icon -->
                  <div class="absolute top-8 right-8 text-white">
                    <svg class="w-14 h-14 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.984zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h3.983v10h-9.983z"/>
                    </svg>
                  </div>

                  <!-- Testimonial Content -->
                  <div class="relative z-10 pr-16 testimonial-content">
                    <?php if ($first_testimonial['quote']): ?>
                      <p class="leading-tight text-white testimonial-quote text-[16px] xl:text-[18px]">
                        <?php echo esc_html($first_testimonial['quote']); ?>
                      </p>
                    <?php endif; ?>

                    <!-- Profile Section - Always render structure, JavaScript will show/hide based on data -->
                    <?php 
                    $profile_image = $first_testimonial['profile'] ?? null;
                    $profile_name = $first_testimonial['profile_name'] ?? $first_testimonial['name'] ?? '';
                    $profile_role = $first_testimonial['profile_role'] ?? '';
                    $has_profile_class = $profile_image ? 'has-profile' : '';
                    ?>
                    <div class="flex gap-4 items-center pt-3 2xl:flex xl:pt-5 testimonial-profile <?php echo esc_attr($has_profile_class); ?>">
                      <div class="flex-shrink-0 testimonial-image-wrapper">
                        <?php if ($profile_image): ?>
                          <img src="<?php echo esc_url($profile_image['url']); ?>" 
                               alt="<?php echo esc_attr($profile_image['alt'] ?: ($profile_name ?: 'Profile')); ?>" 
                               class="object-cover w-32 h-32 rounded-full testimonial-image">
                        <?php else: ?>
                          <img src="" 
                               alt="Profile" 
                               class="object-cover w-32 h-32 rounded-full testimonial-image">
                        <?php endif; ?>
                      </div>
                      
                      <div class="flex flex-col testimonial-profile-info">
                        <?php if ($profile_name): ?>
                          <h4 class="font-bold text-[16px] xl:text-[18px] mb-0 !m-0 text-white testimonial-name">
                            <?php echo esc_html($profile_name); ?>
                          </h4>
                        <?php else: ?>
                          <h4 class="font-bold text-[16px] xl:text-[18px] mb-0 !m-0 text-white testimonial-name"></h4>
                        <?php endif; ?>
                        
                        <?php if ($profile_role): ?>
                          <p class="text-[14px] xl:text-[16px] text-white/80 p-0 !m-0 testimonial-role">
                            <?php echo esc_html($profile_role); ?>
                          </p>
                        <?php else: ?>
                          <p class="text-[14px] xl:text-[16px] text-white/80 p-0 !m-0 testimonial-role"></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            
              <!-- Logo Card -->
              <?php 
              $logo_number++;
              $logo_class = 'testimonial-logo-' . $logo_number;
              ?>
              <div class="testimonial-logo-card <?php echo esc_attr($logo_class); ?> bg-white group cursor-pointer transition-all duration-300 <?php echo esc_attr($is_active); ?>" 
                   data-testimonial-index="<?php echo esc_attr($index); ?>"
                   data-testimonial-data='<?php echo esc_attr(json_encode([
                     'quote' => $testimonial['quote'] ?? '',
                     'name' => $testimonial['name'] ?? '',
                     'company' => $testimonial['company'] ?? $testimonial['name'] ?? '',
                     'job_title' => $testimonial['job_title'] ?? '',
                     'image' => $testimonial['image']['url'] ?? '',
                     'image_alt' => $testimonial['image']['alt'] ?? '',
                     'profile' => $testimonial['profile']['url'] ?? '',
                     'profile_alt' => $testimonial['profile']['alt'] ?? '',
                     'profile_name' => $testimonial['profile_name'] ?? $testimonial['name'] ?? '',
                     'profile_role' => $testimonial['profile_role'] ?? ''
                   ])); ?>'>
                <?php if ($logo): ?>
                  <div class="flex justify-center items-center p-6 h-full transition-all duration-300 aspect-video md:aspect-square rounded-10 shadow-custom logo-card-inner hover:shadow-xl">
                    <img src="<?php echo esc_url($logo['url']); ?>" 
                         alt="<?php echo esc_attr($logo['alt'] ?: ($testimonial['name'] ?? 'Company logo')); ?>" 
                         class="object-contain max-w-full max-h-[120px]">
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <?php if ($primary_cta): ?>
          <div class="flex justify-center">
            <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
              <a href="<?php echo esc_url($primary_cta['url']); ?>" class="button-primary">
                <?php echo esc_html($primary_cta['title'] ?: 'View all case studies'); ?>
              </a>
            </div>
          </div>
        <?php endif; ?>

      <?php endif; ?>

    </div>
  </section>

<?php endif; ?>