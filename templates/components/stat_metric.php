<?php

/**
 * Stat Metric Component
 */

$value = get_sub_field('value');
$content = get_sub_field('content');

if ($value && $content):
  $component_id = 'stat-metric-' . get_row_index();
?>

  <section class="bg-[#EDEEF5] component-wrapper" id="<?php echo esc_attr($component_id); ?>"">
    <div class="container flex flex-col gap-8 justify-center items-center lg:gap-16 lg:flex-row">

      <svg viewBox="0 0 36 36" class="circular-chart">
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
          data-value="<?php echo esc_html($value); ?>"
          stroke-dasharray="0, 100"
          d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831" />
        <text x="18" y="20.35" class="percentage"><?php echo esc_html($value); ?>%</text>
      </svg>


      <p class="max-w-4xl text-[24px] lg:text-[32px] !text-center lg:!text-left font-semibold"><?php echo esc_html($content); ?></p>

      <script>
        document.addEventListener('DOMContentLoaded', () => {
          const chart = document.querySelector('#<?php echo esc_js($component_id); ?> .circular-chart');
          if (chart) {
            const circle = chart.querySelector('.circle');
            if (circle) {
              const finalValue = circle.getAttribute('data-value');
              if (finalValue) {
                circle.style.strokeDasharray = `${finalValue}, 100`;
                requestAnimationFrame(() => {
                  chart.classList.add('is-animating');
                });
              }
            }
          }
        });
      </script>

    </div>
  </section>

<?php endif; ?>