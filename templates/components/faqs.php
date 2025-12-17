<?php
/**
 * FAQs Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$faq_items = get_sub_field('faq_items');

if ($content && $faq_items):
    $component_id = 'faqs-' . get_row_index();
    
    // Set background and text classes based on colour selection
    $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-gradient-to-b from-purple-50 to-white';
    $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
    ?>
    
    <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>" data-accordion-group>
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                
                <!-- Left Content -->
                <div>
                    <?php if ($content): ?>
                        <div class="max-w-none mb-8 !text-center lg:!text-left <?php echo esc_attr($text_class); ?>">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php get_template_part('templates/components/snippets/links'); ?>
                </div>
                
                <!-- Right FAQ Accordion -->
                <div class="space-y-4">
                    <?php foreach ($faq_items as $index => $faq): 
                        $faq_id = 'faq-' . get_row_index() . '-' . $index;
                    ?>
                        <div class="overflow-hidden">
                            <button 
                                class="flex justify-between items-center px-6 py-2 w-full text-left border-0"
                                data-accordion-toggle="<?php echo esc_attr($faq_id); ?>"
                                aria-expanded="false"
                            >
                                <span class="text-[18px] lg:text-[21px] font-semibold"><?php echo esc_html($faq['question']); ?></span>
                                <span class="text-[34px] text-gradient accordion-icon">+</span>
                            </button>
                            
                            <div 
                                class="py-4 pr-12 pl-6"
                                data-accordion-content="<?php echo esc_attr($faq_id); ?>"
                            >
                                <p class="opacity-80"><?php echo esc_html($faq['answer']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
    </section>
    
<?php endif; ?>

