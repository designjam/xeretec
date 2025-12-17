<?php

/**
 * Metrics Grid Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$metrics = get_sub_field('metrics');
$type = get_sub_field('type');

if ($content && $metrics):
  $component_id = 'metrics-grid-' . get_row_index();

  // Set background and text classes based on colour selection
  $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-white';
  $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
?>

  <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto">

      <div class="flex flex-col gap-16 lg:flex-row lg:gap-32">

        <!-- Left Content -->
        <div class="w-full lg:w-1/2 !text-center lg:!text-left lg:max-w-[350px] xl:max-w-[450px]">
          <?php if ($content): ?>
            <div class="max-w-none mb-8 <?php echo esc_attr($text_class); ?>">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>

          <div class="hidden justify-center lg:flex lg:justify-start">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>

        <!-- Right Metrics Grid -->
        <?php if ($metrics): ?>
          <div class="grid flex-1 grid-cols-1 gap-10 md:grid-cols-2">
            <?php foreach ($metrics as $metric): ?>
              <div class="flex flex-col p-10 shadow-custom card-gradient rounded-10 items-bottom">
                <div class="min-h-[80px] mb-3">
                  <?php if ($type === 'circular'): ?>

                    <svg viewBox="0 0 36 36" class="circular-chart" style="max-width: 150px;">
                      <defs>
                        <linearGradient id="percentage-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                          <stop offset="0%" style="stop-color:#120E25;stop-opacity:1" />
                          <stop offset="50%" style="stop-color:#32226A;stop-opacity:1" />
                          <stop offset="100%" style="stop-color:#AF1E63;stop-opacity:1" />
                        </linearGradient>
                      </defs>
                      <path class="circle-bg"
                        d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831" />
                      <path class="circle"
                        stroke-dasharray="<?php echo esc_html($metric['value']); ?>, 100"
                        d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831" />
                      <text x="18" y="20.35" class="percentage"><?php echo esc_html($metric['value']); ?>%</text>
                    </svg>
                  <?php else : ?>
                    <?php if ($metric['value']): ?>
                      <div class="text-[50px] tracking-tight xl:text-[80px] leading-[50px] xl:leading-[80px] xl:leading-[100px] font-extrabold text-accent"><?php echo esc_html($metric['value']); ?></div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <?php if ($metric['label']): ?>
                  <div class="text-[22px] font-bold text-brand mb-2"><?php echo esc_html($metric['label']); ?></div>
                <?php endif; ?>

                <?php if ($metric['description']): ?>
                  <p class="text-gray-900"><?php echo esc_html($metric['description']); ?></p>
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