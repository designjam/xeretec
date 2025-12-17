<?php
/**
 * Customer Carousel Component
 * Uses Slick Carousel
 * Note: This is a global component, fields are stored in ACF options page
 */

$customers = get_field('customers', 'option');
$content = get_field('customer_content', 'option');

if ($customers):
    $component_id = 'customer-carousel-' . get_row_index();
    ?>
    
    <section class="px-0 bg-gray-50 component-wrapper" id="<?php echo esc_attr($component_id); ?>" data-carousel>
        <div class="flex flex-col gap-16 mx-auto">
            
            <?php if ($content): ?>
                <div class="px-10 mx-auto max-w-none text-center">
                  <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($customers): ?>
                <div class="customer-carousel-slick">
                    <?php foreach ($customers as $customer): ?>
                        <div class="px-4">
                            <div class="flex justify-center items-center p-0 h-32 transition">
                                <?php if ($customer['logo']): ?>
                                    <?php if ($customer['link']): ?>
                                        <a href="<?php echo esc_url($customer['link']['url']); ?>" class="block">
                                            <img src="<?php echo esc_url($customer['logo']['url']); ?>" alt="<?php echo esc_attr($customer['logo']['alt'] ?: $customer['name']); ?>" class="object-contain mx-auto max-h-24">
                                        </a>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url($customer['logo']['url']); ?>" alt="<?php echo esc_attr($customer['logo']['alt'] ?: $customer['name']); ?>" class="object-contain mx-auto max-h-24">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </section>
    
<?php endif; ?>

