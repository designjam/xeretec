<?php
/**
 * Recommended Products Component
 */

$recommended_products = get_sub_field('recommended_products');
$content = get_sub_field('content');

if ($content && $recommended_products):
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
                <?php if ($recommended_products): ?>
                    <div class="w-full lg:w-1/2 lg:flex-shrink-0">
                        <div class="overflow-hidden product-feature-carousel-slick">
                            <?php foreach ($recommended_products as $item): 
                                // Handle ACF gallery field - can be direct image array or nested under 'image' key
                                $image = isset($item['image']) ? $item['image'] : $item;
                                $image_url = $image['url'] ?? '';
                                $image_alt = $image['alt'] ?? ($item['alt_text'] ?? '');
                                
                                $title = $item['title'] ?? '';
                                $description = $item['description'] ?? '';
                                $link = $item['link'] ?? '';
                                if ($image_url):
                            ?>
                                <div class="px-2 md:px-4">
                                    <div class="bg-white aspect-video shadow-custom rounded-10">
                                        <img src="<?php echo esc_url($image_url); ?>" 
                                             alt="<?php echo esc_attr($image_alt); ?>" 
                                             class="object-contain object-center flex-1 w-full h-full rounded-10">
                                             <div class="p-10 bg-dark rounded-b-10">
                                             <?php if ($title): ?>
                                                <h4 class="font-bold text-white"><?php echo esc_html($title); ?></h4>
                                             <?php endif; ?>
                                             <?php if ($description): ?>
                                                <p class="text-white"><?php echo esc_html($description); ?></p>
                                             <?php endif; ?>
                                             <?php if ($link): ?>
                                                <a href="<?php echo esc_url($link['url']); ?>" class="button-tertiary-light"><?php echo esc_html($link['title']); ?></a>
                                             <?php endif; ?>
                                             </div>
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

