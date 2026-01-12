<?php

/**
 * Image Text Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$image = get_sub_field('image');
$layout = get_sub_field('layout') ?: 'left';
$remove_image_styling = get_sub_field('remove_image_styling');
$image_styling = $remove_image_styling ? '' : 'rounded-10 shadow-lg';

if ($image):
  $component_id = 'image-text-' . get_row_index();
  $image_first = $layout === 'left';

  // Set background and text classes based on colour selection
  $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-white';
  $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
?>

  <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto">
      <div class="flex flex-col gap-16 items-center lg:flex-row-reverse xl:gap-32">

        <div class="hidden lg:block w-2/5  max-w-[650px]">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-auto <?php echo esc_attr($image_styling); ?>">
        </div>

        <!-- Content -->
        <div class="w-full flex-1  flex flex-col gap-8 !text-center lg:!text-left xl:pr-32">
          <?php if ($content): ?>
            <div class="max-w-none <?php echo esc_attr($text_class); ?>">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>

          <div class="flex justify-center lg:justify-start">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>

      </div>
    </div>
  </section>

<?php endif; ?>