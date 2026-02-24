<?php

/**
 * Hero Component
 * Supports 3 sub-types: hero_standard, hero_form, hero_stats
 */

$hero_type = get_sub_field('hero_type') ?: 'hero_standard';
$content = get_sub_field('content');
$background_image = get_sub_field('background_image');
$hubspot_code = get_sub_field('hubspot_code');
$stats = get_sub_field('stats');
$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');

if ($content):
  $component_id = 'hero-' . get_row_index();

  // Set hero height based on type
  $hero_classes = 'relative flex items-center bg-dark -mt-32';

  if ($hero_type === 'hero_form' || $hero_type === 'hero_stats') {
    $hero_classes = 'relative  flex items-center bg-dark -mt-32';
  }
?>

  <section class="component-wrapper !-mt-[100px] !pt-[200px] <?php echo esc_attr($hero_classes); ?>" id="<?php echo esc_attr($component_id); ?>" role="banner">

    <?php if ($background_image): ?>
      <!-- Image Background -->
      <div class="absolute inset-0 z-0">
        <?php if ($background_image['id']): ?>
          <?php responsive_image_nolazy($background_image['id'], '100vw', '1920px', 'w-full h-full object-cover'); ?>
        <?php else: ?>
          <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt'] ?? ''); ?>" class="object-cover w-full h-full">
        <?php endif; ?>
        <!-- <div class="absolute inset-0 bg-gradient-to-r via-purple-900 opacity-80 from-slate-900 to-slate-900"></div> -->
      </div>
    <?php else: ?>
      <!-- Default gradient background if no image -->
      <div class="absolute inset-0 z-0 bg-gradient-to-r from-brand-dark via-brand-dark to-brand/50"></div>
    <?php endif; ?>

    <div class="container relative z-10 mx-auto">

      <?php if ($hero_type === 'hero_standard'): ?>
        <!-- Standard Hero: Centered Content -->
        <div class="mx-auto text-center text-white">
          <?php if ($content): ?>
            <div class="mb-10 max-w-none text-white">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>

          <div class="flex justify-center">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>

      <?php elseif ($hero_type === 'hero_form'): ?>
        <!-- Form Hero: Split Layout with Form on Right -->
        <div class="grid grid-cols-1 gap-8 items-center xl:grid-cols-2 lg:gap-32">
          <!-- Left Content -->
          <div class="text-white !text-center xl:!text-left ">
            <?php if ($content): ?>
              <div class="mb-8 text-white">
                <?php echo wp_kses_post($content); ?>
              </div>
            <?php endif; ?>

            <div class="flex justify-center xl:justify-start">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>
          </div>

          <!-- Right Form -->
          <?php if ($hubspot_code): ?>
            <div class="p-10 bg-opacity-10 border border-white shadow-2xl bg-white/10 rounded-20 lg:p-32">
              <?php echo ($hubspot_code); ?>
            </div>
          <?php endif; ?>
        </div>

      <?php elseif ($hero_type === 'hero_stats'): ?>
        <!-- Stats Hero: Split Layout with Stats on Right -->
        <div class="flex flex-col gap-20 text-white !text-center lg:!text-left">
          <!-- Left Content -->

            <?php if ($content): ?>
              <div class="max-w-none">
                <?php echo wp_kses_post($content); ?>
              </div>
            <?php endif; ?>



            <!-- Right Stats -->
            <?php if ($stats && count($stats) >= 2): ?>
              <div class="hidden flex-col gap-8 lg:flex md:flex-row lg:gap-12">
                <?php foreach ($stats as $index => $stat): ?>
                  <div class="flex flex-col items-center lg:items-start max-w-[200px]">
                    <?php if ($stat['value']): ?>
                      <div class="text-[80px] font-extrabold text-red-600 mb-2 leading-none">
                        <?php echo esc_html($stat['value']); ?>
                      </div>
                    <?php endif; ?>
                    <?php if ($stat['descripion']): ?>
                      <div class="text-white text-[23px] font-semibold ">
                        <?php echo esc_html($stat['descripion']); ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <?php if ($index < count($stats) - 1): ?>
                    <div class="hidden w-px bg-white md:block"></div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <div class="flex justify-center lg:justify-start">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
  </section>

<?php endif; ?>