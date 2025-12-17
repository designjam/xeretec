<?php
/**
 * Contact Map Component
 * Note: This is a global component, fields are stored in ACF options page
 */

$content = get_field('contact_content', 'option');
$map_image = get_field('map_image', 'option');
$areas = get_field('areas', 'option');

if ($content && $areas):
    $component_id = 'contact-map-' . get_row_index();
    ?>
    
    <section class="component-wrapper bg-light-pink" id="<?php echo esc_attr($component_id); ?>" data-accordion-group>
        <div class="container px-4 mx-auto">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Left Content -->
                <div class="lg:w-2/5">
                    <?php if ($content): ?>
                        <div class="max-w-none mb-8 !text-center lg:!text-left lg:pr-20">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($map_image): ?>
                        <div class="map-image-wrapper">
                            <img 
                                src="<?php echo esc_url($map_image['url']); ?>" 
                                alt="<?php echo esc_attr($map_image['alt'] ?: 'Xeretec Offices Map'); ?>" 
                                class="mx-auto w-full h-auto"
                            >
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Right Areas Accordion -->
                <div class="lg:w-3/5">
                <div class="p-10 space-y-4 bg-white rounded-20 shadow-custom">
                  
                    <?php foreach ($areas as $index => $area): 
                        $area_id = 'area-' . get_row_index() . '-' . $index;
                        $country = $area['country'] ?? '';
                        $locations = $area['locations'] ?? '';
                        $is_first = $index === 0;
                    ?>
                        <?php if ($country): ?>
                            <div class="overflow-hidden">
                                <button 
                                    class="flex justify-between items-center px-6 py-2 w-full text-left border-0<?php echo $is_first ? ' active' : ''; ?>"
                                    data-accordion-toggle="<?php echo esc_attr($area_id); ?>"
                                    aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                >
                                    <span class="text-[20px] lg:text-[26px] font-semibold"><?php echo esc_html($country); ?></span>
                                    <span class="text-[34px] text-gradient accordion-icon"><?php echo $is_first ? '−' : '+'; ?></span>
                                </button>
                                
                                <?php if ($locations): ?>
                                    <div 
                                        class="py-4 pr-12 pl-6<?php echo $is_first ? ' accordion-open' : ''; ?>"
                                        data-accordion-content="<?php echo esc_attr($area_id); ?>"
                                    >
                                        <div class="opacity-80"><?php echo wp_kses_post($locations); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
    </section>
    
<?php endif; ?>
 
 
