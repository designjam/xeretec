<?php

/**
 * Success Stories Carousel Component
 * Uses Slick Carousel with arrows and dots
 * Note: This is a global component, fields are stored in ACF options page
 */

$content = get_field('ss_content', 'option');
$success_stories = get_field('success_stories', 'option');
$primary_cta = get_field('ss_primary_cta', 'option');

if ($success_stories): ?>

  <section class="flex flex-col gap-6 py-20 m-0 bg-gradient-to-t from-white via-purple-100 to-white lg:gap-16" id="success-stories" data-carousel>


    <?php if ($content): ?>
      <div class="mx-auto max-w-none text-center">
        <?php echo wp_kses_post($content); ?>
      </div>
    <?php endif; ?>

    <?php if ($success_stories): ?>
      <div class="z-20 success-stories-carousel-slick">
        <?php foreach ($success_stories as $story):
          $details = $story['details'] ?? array();
          $client_name = $details['client_name'] ?? '';
          $solution = $details['solution'] ?? '';
          $description = $details['description'] ?? '';
          $link = $details['link'] ?? array();
          $image = $story['image'] ?? array();
          $has_link = !empty($link) && !empty($link['url']);
        ?>
          <div class="p-4">
            <div class="success-story-slide">
              <?php if ($has_link): ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="block group">
                <?php else: ?>
                  <div class="block group">
                  <?php endif; ?>

                  <div class="flex overflow-hidden flex-col h-full bg-white transition-all duration-300 rounded-10 shadow-custom">

                    <?php if ($image): ?>
                      <div class="overflow-hidden relative">
                        <img src="<?php echo esc_url($image['url']); ?>"
                          alt="<?php echo esc_attr($image['alt'] ?: $client_name); ?>"
                          class="object-cover w-full h-96 transition-transform duration-300 xl:h-[300px] group-hover:scale-105">
                      </div>
                    <?php endif; ?>

                    <div class="flex flex-col flex-grow p-6 xl:p-12">
                      <?php if ($solution): ?>
                        <span class="inline-block self-start px-3 py-1 mb-4 text-[14px] font-semibold text-white bg-brand-dark rounded-full">
                          <?php echo esc_html($solution); ?>
                        </span>
                      <?php endif; ?>

                      <?php if ($client_name): ?>
                        <h3 class="mb-3 text-[23px] font-bold transition-colors text-brand ">
                          <?php echo esc_html($client_name); ?>
                        </h3>
                      <?php endif; ?>

                      <?php if ($description): ?>
                        <p class="flex-grow mt-0 mb-4 text-gray-600">
                          <?php echo esc_html($description); ?>
                        </p>
                      <?php endif; ?>

                      <?php if ($has_link): ?>
                        <span class="button-tertiary">
                          Discover more
                        </span>
                      <?php endif; ?>
                    </div>

                  </div>

                  <?php if ($has_link): ?>
                </a>
              <?php else: ?>
            </div>
          <?php endif; ?>
          </div>
      </div>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($primary_cta): ?>
    <div class="hidden justify-center lg:flex">
      <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
        <a href="<?php echo esc_url($primary_cta['url']); ?>" class="button-primary">
          <?php echo esc_html($primary_cta['title'] ?: 'More on our partners'); ?>
        </a>
      </div>
    </div>
  <?php endif; ?>


  </section>

<?php endif; ?>