<?php
/**
 * Comparison Cards Component
 * Displays comparison cards in a grid on desktop and carousel on mobile
 */

$content = get_sub_field('content');
$comparison_cards = get_sub_field('comparison_cards');

if ($comparison_cards):
    $component_id = 'comparison-cards-' . get_row_index();
    ?>
    
    <section class="bg-gray-50 component-wrapper !px-0" id="<?php echo esc_attr($component_id); ?>" data-carousel>
        <div class="max-w-[1536px] !px-0 mx-auto lg:!px-10">
            
            <?php if ($content): ?>
                <div class="mb-12 text-center">
                    <div class="mx-auto max-w-none">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($comparison_cards): ?>
                <div class="flex gap-8 justify-center items-stretch comparison-cards-carousel-slick">
                    <?php foreach ($comparison_cards as $card): 
                        $heading = $card['heading'] ?? '';
                        $bullet_points = $card['bullet_points'] ?? [];
                        $image = $card['image'] ?? null;
                        $link = $card['link'] ?? null;
                        $has_image = !empty($image);
                        $has_link = !empty($link) && !empty($link['url']);
                    ?>
                        <div class="py-4 w-full transition-all duration-300 lg:py-0 lg:w-1/2 xl:w-1/4 hover:lg:-translate-y-4">
                            <div class="flex overflow-hidden flex-col h-full bg-white transition-all duration-300 comparison-card rounded-20 shadow-custom group hover:shadow-xl">
                                
                                <?php if ($has_image): ?>
                                    <div class="overflow-hidden relative">
                                        <img src="<?php echo esc_url($image['url']); ?>" 
                                             alt="<?php echo esc_attr($image['alt'] ?: $heading); ?>" 
                                             class="object-cover w-full h-80">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex flex-col flex-grow p-10 group-hover:bg-brand-dark group-hover:text-white' : ''; ?>">
                                    
                                    <?php if ($heading): ?>
                                        <h3 class="font-bold mb-4 text-[38px] group-hover:text-white text-purple-900">
                                            <?php echo esc_html($heading); ?>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if ($bullet_points): ?>
                                        <ul class="flex flex-col flex-grow gap-3 mb-6">
                                            <?php foreach ($bullet_points as $bullet): 
                                                $bullet_text = $bullet['bullet_point'] ?? '';
                                                if ($bullet_text):
                                            ?>
                                                <li class="flex gap-2 items-start">
                                                    <span class="flex-shrink-0 mt-1 text-brand group-hover:text-white">
                                                        <svg class="mt-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </span>
                                                    <span class="font-light font-normal text-gray-700 group-hover:text-white">
                                                        <?php echo esc_html($bullet_text); ?>
                                                    </span>
                                                </li>
                                            <?php 
                                                endif;
                                            endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    
                                    <?php if ($has_link): ?>
                                        <a href="<?php echo esc_url($link['url']); ?>" 
                                           target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                           class="inline-flex justify-center items-center mt-auto border-2 border-white button-primary group-hover:border-white group-hover:bg-transparent group-hover:border-2 group-hover:bg-gradient-to-r group-hover:from-transparent group-hover:via-transparent group-hover:to-transparent group-hover:text-white">
                                            <?php echo esc_html($link['title'] ?: 'Contact our team'); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="carousel-nav-wrapper"></div>
            <?php endif; ?>
            
        </div>
    </section>
    
<?php endif; ?>
