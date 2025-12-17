<?php

/**
 * CTA Banner Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$image = get_sub_field('image');

if ($content):
  $component_id = 'cta-banner-' . get_row_index();

  // Set background and text classes based on colour selection
  $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-purple-50';
  $text_class = $colour === 'dark' ? 'text-gray-900' : 'text-gray-900';
?>

  <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto">
      <div class="overflow-hidden shadow-xl rounded-20">
        <div class="grid grid-cols-1 gap-0 bg-white lg:grid-cols-2">

          <!-- Left Content -->
          <div class="p-12 lg:p-20 flex flex-col gap-8 !text-center lg:!text-left justify-center bg-white bg-return-white">
            <?php if ($content): ?>
              <div class="lg:max-w-[550px]">
                <?php echo wp_kses_post($content); ?>
              </div>
            <?php endif; ?>

            <div class="flex relative z-10 justify-center lg:justify-start">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>
          </div>

          <!-- Right Image -->
          <?php if ($image): ?>
            <div class="relative h-64 lg:block lg:h-auto">
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="object-cover w-full h-full">
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

<?php endif; ?>