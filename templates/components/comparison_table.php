<?php

/**
 * Comparison Table Component
 */

$content = get_sub_field('content');
$products = get_sub_field('products');
$features = get_sub_field('features');

if ($products && $features):
  $component_id = 'comparison-table-' . get_row_index();
?>

  <section class="comparison-table text-white component-wrapper bg-[#20284B] lg:bg-dark bg-dark" id="<?php echo esc_attr($component_id); ?>">
    <div class="container flex flex-col gap-20 mx-auto">

      <?php if ($content): ?>
        <div class="text-center">
          <div class="max-w-[850px] mx-auto">
            <?php echo wp_kses_post($content); ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($products && $features): 
        $product_count = count($products);
        $feature_col_width = 150;
        $product_col_min_width = 170;
        // Mobile: fixed widths for scrolling
        $mobile_grid_template = 'grid-template-columns: ' . $feature_col_width . 'px repeat(' . $product_count . ', ' . $product_col_min_width . 'px);';
        // Desktop: flexible widths
        $desktop_grid_template = 'grid-template-columns: 350px repeat(' . $product_count . ', minmax(150px, 1fr));';
        $min_width = $feature_col_width + ($product_count * $product_col_min_width);
        $table_id = 'comparison-table-' . $component_id;
      ?>
        <style>
          #<?php echo esc_attr($table_id); ?> .comparison-grid-row {
            <?php echo esc_attr($mobile_grid_template); ?>
          }
          @media (min-width: 768px) {
            #<?php echo esc_attr($table_id); ?> .comparison-grid-row {
              <?php echo esc_attr($desktop_grid_template); ?>
            }
            #<?php echo esc_attr($table_id); ?> .comparison-content-wrapper {
              width: auto !important;
              min-width: auto !important;
            }
          }
        </style>
        <div class="overflow-hidden relative w-full bg-transparent rounded-lg border-2 border-transparent" id="<?php echo esc_attr($table_id); ?>">
          <!-- Scrollable container with fixed feature column -->
          <div class="overflow-x-auto pb-10 lg:pb-0 lg:overflow-x-visible" style="-webkit-overflow-scrolling: touch;">
            <div class="comparison-content-wrapper md:w-auto" style="width: <?php echo esc_attr($min_width); ?>px; min-width: <?php echo esc_attr($min_width); ?>px;">
              <!-- Header Row -->
              <div class="grid comparison-grid-row">
              <div class="sticky left-0 z-10 px-6 py-4 font-bold text-left text-white border-b border-white bg-[#20284B] lg:bg-transparent"></div>
              <?php foreach ($products as $index => $product): ?>
                <div class="px-6 py-4 font-bold text-center text-white bg-transparent border border-white <?php echo $index === $product_count - 1 ? 'border-r-0' : ''; ?>">
                  <?php echo esc_html($product['product_name']); ?>
                </div>
              <?php endforeach; ?>
            </div>
            
            <!-- Feature Rows -->
            <?php foreach ($features as $feature_index => $feature): ?>
              <?php 
              // Create availability map for this feature
              $availability_map = array();
              if (!empty($feature['product_availability'])) {
                foreach ($feature['product_availability'] as $availability) {
                  $product_index = intval($availability['product_index']) - 1;
                  if ($product_index >= 0) {
                    $availability_map[$product_index] = !empty($availability['available']);
                  }
                }
              }
              ?>
              <div class="grid comparison-grid-row border-b border-gray-200 <?php echo $feature_index === count($features) - 1 ? 'border-b-0' : ''; ?>">
                <div class="sticky left-0 z-10 px-6 py-4 text-[14px] lg:text-[18px] font-semibold text-gray-800 bg-gray-300 border-left-0">
                  <?php echo esc_html($feature['feature_name']); ?>
                </div>
                <?php foreach ($products as $index => $product): 
                  $is_available = isset($availability_map[$index]) && $availability_map[$index];
                ?>
                  
                    <?php if ($is_available): ?>
                      <div class="px-6 py-4 text-center bg-white border-r border-gray-300 flex items-center justify-center <?php echo $index === $product_count - 1 ? 'border-r-0' : ''; ?>">
                        <span class="text-4xl font-bold text-red-600">✓</span>
                      </div>
                    <?php else: ?>
                      <div class="px-6 py-4 text-center bg-gray-200 border-r border-gray-300 flex items-center justify-center <?php echo $index === $product_count - 1 ? 'border-r-0' : ''; ?>">
                        <span class="text-4xl text-gray-800">-</span>
                      </div>
                    <?php endif; ?>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
            
            <!-- Footer Row -->
            <div class="grid border-t border-white comparison-grid-row">
              <div class="sticky left-0 z-10 px-6 py-4 bg-[#20284B] lg:bg-transparent"></div>
              <?php foreach ($products as $index => $product): ?>
                <div class="px-6 py-4 text-center border border-white bg-transparent  <?php echo $index === $product_count - 1 ? 'border-r-0' : ''; ?>">
                  <?php if (!empty($product['view_product_link'])): 
                    $link = $product['view_product_link'];
                  ?>
                    <a href="<?php echo esc_url($link['url']); ?>" 
                       class="inline-flex gap-2 items-center font-medium text-white transition-colors button-tertiary-light hover:text-gray-200"
                       <?php if (!empty($link['target'])): ?>target="<?php echo esc_attr($link['target']); ?>"<?php endif; ?>>

                        <?php echo esc_html($link['title'] ?: 'View Product'); ?>

                    </a>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
            </div>
          </div>
          <div class="block lg:hidden">Swipe to view more >></div>
          <div class="block absolute top-0 right-0 w-10 opacity-80 h-full bg-gradient-to-r from-transparent lg:hidden to-[#20284B]"></div>
        </div>
        
      <?php endif; ?>

      <div class="flex justify-center">
        <?php get_template_part('templates/components/snippets/links'); ?>
      </div>
    </div>
  </section>

<?php endif; ?>