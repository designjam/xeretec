<?php
/**
 * Testimonial Component
 */

$name = get_sub_field('name');
$quote = get_sub_field('content');
$image = get_sub_field('image');

if ($name || $quote):
    $component_id = 'testimonial-' . get_row_index();
    ?>
    
    <section class="bg-white component-wrapper" id="<?php echo esc_attr($component_id); ?>">
        <div class="container px-4 mx-auto">
            <div class="flex overflow-hidden flex-col bg-white rounded-10 shadow-custom md:flex-row">
                
                <!-- Left Gradient Bar -->
                <div class="hidden flex-shrink-0 w-8 bg-gradient-to-b lg:block rounded-l-10 from-brand to-brand-light"></div>
                
                <!-- Main Content Area -->
                <div class="relative flex-1 p-6 md:p-8">
                    
                    <!-- Quote Icon (Top Right) -->
                    <div class="hidden absolute top-6 right-6 rotate-180 lg:block">
                        <svg class="w-16 h-16 md:w-20 md:h-20" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="quote-gradient-<?php echo esc_attr($component_id); ?>" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:#541388;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#AF1E63;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.984zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" fill="url(#quote-gradient-<?php echo esc_attr($component_id); ?>)"/>
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex relative z-10 flex-col gap-8 lg:flex-row lg:gap-16">
                        
                        <!-- Profile Image -->
                        <?php if ($image): ?>
                            <div class="flex-shrink-0">
                                <img 
                                    src="<?php echo esc_url($image['url']); ?>" 
                                    alt="<?php echo esc_attr($image['alt'] ?: $name); ?>" 
                                    class="object-cover mx-auto w-52 h-52 rounded-full"
                                >
                            </div>
                        <?php endif; ?>
                        
                        <!-- Text Content -->
                        <div class="flex-1 lg:pr-32 !text-center lg:!text-left">
                            <?php if ($name): ?>
                                <h3 class="text-4xl font-bold text-brand">
                                    <?php echo esc_html($name); ?>
                                </h3>
                            <?php endif; ?>
                            
                            <?php if ($quote): ?>
                              <?php echo wp_kses_post($quote); ?>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
    
<?php endif; ?>

