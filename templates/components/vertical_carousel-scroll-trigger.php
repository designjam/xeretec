<?php

/**
 * Vertical Carousel Component
 * Uses Slick Carousel with vertical orientation
 */

$content = get_sub_field('content');
$repeatable_cards = get_sub_field('repeatable_cards');

if ($content && $repeatable_cards):
  $component_id = 'vertical-carousel-' . get_row_index(); 
?>

  <section class="min-h-screen text-white lg:pt-0 lg:pb-0 component-wrapper bg-dark" id="<?php echo esc_attr($component_id); ?>" data-carousel>
    <div class="container mx-auto">

      <div class="flex flex-col lg:flex-row lg:gap-48">

        <!-- Left Content -->
        <div class="pinned-content w-full lg:w-1/2 !text-center lg:!text-left mt-32">
          <?php if ($content): ?>
            <div class="mb-8 max-w-none">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>

          <div class="hidden justify-center lg:flex lg:justify-start">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>

        <!-- Right Vertical  -->
        <?php if ($repeatable_cards): ?>
          <div class="relative flex-1">
              <?php foreach ($repeatable_cards as $card): ?>
                <div class="mb-10 card-container">
                  <?php if ($card['link']): ?>
                    <a href="<?php echo esc_url($card['link']['url']); ?>" class="block flex flex-col gap-6 bg-white shadow-xl transition cursor-pointer rounded-10 hover:shadow-xl text-dark group">
                  <?php else: ?>
                    <div class="flex flex-col gap-8 shadow-xl transition lg:gap-10 rounded-10 hover:shadow-xl text-dark" style="background: linear-gradient(180deg, #FFFFFF 0%, #EDEEF5 100%);">
                  <?php endif; ?>
                    <?php if ($card['image']): ?>
                      <div class="h-[300px] rounded-t-10 overflow-hidden">
                        <img src="<?php echo esc_url($card['image']['url']); ?>" alt="<?php echo esc_attr($card['image']['alt']); ?>" class="object-cover flex-shrink-0 w-full h-full">
                      </div>
                    <?php endif; ?>
                    <div class="flex flex-col gap-6 p-10 pt-4">

                      <?php if ($card['title']): ?>
                        <h3 class="text-[23px] font-bold text-brand"><?php echo esc_html($card['title']); ?></h3>
                      <?php endif; ?>

                      <?php if ($card['description']): ?>
                        <p class="text-[16px] lg:text-[18px] text-gray-600 !m-0 "><?php echo esc_html($card['description']); ?></p>
                      <?php endif; ?>

                      <?php if ($card['link']): ?>
                        <span class="inline-block button-tertiary">
                          <?php echo esc_html($card['link']['title'] ?: 'Explore'); ?>
                        </span>
                      <?php endif; ?>
                    </div>
                  <?php if ($card['link']): ?>
                    </a>
                  <?php else: ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="flex justify-center lg:hidden lg:justify-start">
          <?php get_template_part('templates/components/snippets/links'); ?>
        </div>

      </div>

    </div>
  </section>

<?php endif; ?>