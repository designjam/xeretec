<?php

/**
 * Partner Carousel Component
 * Uses Slick Carousel
 * Note: This is a global component, fields are stored in ACF options page
 */

$partners = get_field('partners', 'option');
$content = get_field('partners_content', 'option');
$primary_cta = get_field('partners_primary_cta', 'option');

if ($partners):
  $component_id = 'partner-carousel-' . get_row_index();
?>

  <section class="px-0 bg-white component-wrapper" id="<?php echo esc_attr($component_id); ?>" data-carousel>
    <div class="flex flex-col gap-16 mx-auto">

      <?php if ($content): ?>
        <div class="px-10 mx-auto max-w-none text-center">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>

      <?php if ($partners): ?>
        <div class="partner-carousel-slick">
          <?php foreach ($partners as $partner): ?>
            <div class="px-4">
              <div class="flex justify-center items-center p-0 h-32 transition">
                <?php if ($partner['logo']): ?>
                  <?php if ($partner['link']): ?>
                    <a href="<?php echo esc_url($partner['link']['url']); ?>" class="block">
                      <img src="<?php echo esc_url($partner['logo']['url']); ?>" alt="<?php echo esc_attr($partner['logo']['alt'] ?: $partner['name']); ?>" class="object-contain mx-auto max-h-32">
                    </a>
                  <?php else: ?>
                    <img src="<?php echo esc_url($partner['logo']['url']); ?>" alt="<?php echo esc_attr($partner['logo']['alt'] ?: $partner['name']); ?>" class="object-contain mx-auto max-h-32">
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($primary_cta): ?>
        <div class="flex justify-center">
          <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
            <a href="<?php echo esc_url($primary_cta['url']); ?>" class="button-primary">
              <?php echo esc_html($primary_cta['title'] ?: 'More on our partners'); ?>
            </a>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

<?php endif; ?>