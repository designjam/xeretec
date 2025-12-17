<?php

/**
 * Product Detail Component
 */

$product_name = get_sub_field('product_name');
$content = get_sub_field('content');
$tagline = get_sub_field('tagline');
$main_image = get_sub_field('main_image');
$gallery = get_sub_field('gallery');
$features = get_sub_field('features');
$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');

if ($product_name):
  $component_id = 'product-detail-' . get_row_index();

  // Combine main_image and gallery into a single array (main image first)
  $all_images = array();
  if ($main_image) {
    $all_images[] = $main_image;
  }
  if ($gallery) {
    $all_images = array_merge($all_images, $gallery);
  }
?>

  <section class="component-wrapper bg-light-fade-up" id="<?php echo esc_attr($component_id); ?>" data-product-detail>
    <div class="container grid grid-cols-1 gap-16 p-8 px-4 mx-auto lg:grid-cols-2">

          <!-- Left Images -->
          <div>
            <?php if (!empty($all_images)): ?>
              <!-- Desktop: Main image with thumbnails -->
              <div class="hidden lg:block">
                <?php if ($main_image): ?>
                  <div class="mb-4">
                    <img
                      id="<?php echo esc_attr($component_id); ?>-main-image"
                      src="<?php echo esc_url($main_image['url']); ?>"
                      alt="<?php echo esc_attr($main_image['alt']); ?>"
                      class="w-full h-auto transition-opacity duration-300 rounded-10"
                      data-product-main-image>
                  </div>
                <?php endif; ?>

                <?php if (count($all_images) > 1): ?>
                  <div class="flex gap-8">
                    <?php foreach ($all_images as $index => $image): ?>
                      <div class="relative flex-1 max-w-[180px] cursor-pointer group bg-white rounded-10 flex items-center justify-center" data-product-thumbnail-wrapper>
                        <img
                          src="<?php echo esc_url($image['url']); ?>"
                          alt="<?php echo esc_attr($image['alt']); ?>"
                          class="w-full h-46 object-contain transition-opacity rounded-10 duration-300 <?php echo ($index === 0) ? 'opacity-100' : 'opacity-75'; ?>"
                          data-product-thumbnail
                          data-image-url="<?php echo esc_url($image['url']); ?>"
                          data-image-alt="<?php echo esc_attr($image['alt']); ?>"
                          data-image-index="<?php echo esc_attr($index); ?>">
                        <?php if ($index === 0): ?>
                          <div class="absolute inset-0 bg-opacity-30 pointer-events-none rounded-10 group-hover:shadow-custom" data-product-thumbnail-overlay></div>
                        <?php else: ?>
                          <div class="absolute inset-0 bg-opacity-0 transition-opacity duration-300 pointer-events-none rounded-10 group-hover:shadow-custom" data-product-thumbnail-overlay></div>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Mobile: Carousel with arrows -->
              <div class="lg:hidden">
                <div class="product-detail-carousel-slick" data-product-carousel>
                  <?php foreach ($all_images as $image): ?>
                    <div class="px-2">
                      <img
                        src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>"
                        class="w-full h-auto rounded-10">
                    </div>
                  <?php endforeach; ?>
                </div>
                <!-- Navigation arrows wrapper for mobile -->
                <div class="flex gap-2 justify-center mt-4 carousel-nav-wrapper lg:hidden"></div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Right Content -->
          <div class="flex flex-col gap-10 !text-center lg:!text-left">
            <?php if ($product_name): ?>
              <h2 class="pb-0 mb-0 heading"><?php echo esc_html($product_name); ?></h2>
            <?php endif; ?>

            <?php if ($tagline): ?>
              <p class="mt-0 small-heading text-brand"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>

            <?php if ($content): ?>
              <div>
                <?php echo wp_kses_post($content); ?>
              </div>
            <?php endif; ?>

            <div class="hidden relative z-10 justify-center lg:flex lg:justify-start">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>

            <?php if ($features): ?>
              <div class="p-10 mb-8 bg-white rounded-10">
                <h3 class="mb-5 small-heading text-brand">Features</h3>
                <ul class="ml-8 list-disc">
                  <?php foreach ($features as $feature): ?>
                    <li class="mb-2 !text-left">
                      <?php echo esc_html($feature['text']); ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <div class="flex relative z-10 justify-center lg:hidden lg:justify-start">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>

          </div>


    </div>
  </section>

<?php endif; ?>