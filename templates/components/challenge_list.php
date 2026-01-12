<?php

/**
 * Challenge List Component
 */

$content = get_sub_field('content');
$content_right = get_sub_field('content_right');
$challenges = get_sub_field('challenges');
$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');

if ($content && $challenges):
  $component_id = 'challenge-list-' . get_row_index();
?>

  <section class="bg-white component-wrapper" id="<?php echo esc_attr($component_id); ?>">
    <div class="container px-4 mx-auto">
      <div class="flex flex-col lg:gap-20 lg:flex-row">

        <div class="w-1/2 w-full">
          <?php if ($content): ?>
            <div class="mb-8">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="flex flex-col gap-4 w-1/2 w-full">
          <?php if ($content_right): ?>
            <div class="max-w-none">
              <?php echo wp_kses_post($content_right); ?>
            </div>
          <?php endif; ?>

          <?php if ($challenges): ?>
            <ul class="mb-8 space-y-4 font-normal">
              <?php foreach ($challenges as $challenge): ?>
                <li class="flex gap-4 items-start font-normal text-[18px]">
                  <?php if ($challenge['icon']): ?>
                    <img src="<?php echo esc_url($challenge['icon']['url']); ?>" alt="" class="flex-shrink-0 mt-2 w-7 h-7">
                  <?php else: ?>
                    <span class="flex-shrink-0 mt-2 w-7 h-7 bg-white bg-opacity-20 rounded"></span>
                  <?php endif; ?>
                  <span><?php echo esc_html($challenge['text']); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <div class="flex justify-center lg:justify-start">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>



      </div>
    </div>
  </section>

<?php endif; ?>