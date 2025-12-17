<?php
/**
 * Product Feature Carousel Component
 */

$product_images = get_sub_field('product_images');
$content = get_sub_field('content');

if ($content && $product_images):
    $component_id = 'product-feature-carousel-' . get_row_index();
    ?>
    
    <section class="product-feature-carousel bg-light-fade-down" id="<?php echo esc_attr($component_id); ?>" data-carousel>

            <div class="flex flex-col gap-8 justify-center items-center lg:flex-row lg:gap-16">
                
                <!-- Left Column: Content -->
                <div class="flex justify-center w-full lg:pb-40 lg:w-1/2">
                    <?php if ($content): ?>
                        <div class="px-10 max-w-3xl !text-center lg:!text-left">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Right Column: Carousel -->
                <?php if ($product_images): ?>
                    <div class="w-full lg:w-1/2 lg:flex-shrink-0">
                        <div class="overflow-hidden product-feature-carousel-slick">
                            <?php foreach ($product_images as $item): 
                                // Handle ACF gallery field - can be direct image array or nested under 'image' key
                                $image = isset($item['image']) ? $item['image'] : $item;
                                $image_url = $image['url'] ?? '';
                                $image_alt = $image['alt'] ?? ($item['alt_text'] ?? '');
                                
                                if ($image_url):
                            ?>
                                <div class="px-2 md:px-4">
                                    <div class="p-4 bg-white aspect-square shadow-custom rounded-10 md:p-6">
                                        <img src="<?php echo esc_url($image_url); ?>" 
                                             alt="<?php echo esc_attr($image_alt); ?>" 
                                             class="object-contain object-center flex-1 w-full h-full rounded-10">
                                    </div>
                                </div>
                            <?php 
                                endif;
                            endforeach; ?>
                        </div>
                        
                        <!-- Navigation Arrows -->
                        <div class="mt-6 carousel-nav-wrapper"></div>
                    </div>
                <?php endif; ?>
                
            </div>

    </section>
    
<?php endif; ?>

