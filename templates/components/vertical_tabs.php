<?php
/**
 * Vertical Tabs Component
 */

$content = get_sub_field('content');
$vertical_tabs = get_sub_field('vertical_tabs');

if ($vertical_tabs):
    $component_id = 'vertical-tabs-' . get_row_index();
    ?>
    
    <section class="component-wrapper bg-light-fade-down" id="<?php echo esc_attr($component_id); ?>" data-vertical-tabs>
        <div class="container flex flex-col gap-20 mx-auto">
            
            <?php if ($content): ?>
                <div class="text-center">
                    <div class="max-w-[850px] mx-auto">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($vertical_tabs): ?>
                <div class="overflow-hidden bg-white rounded-10 shadow-custom">
                    <div class="flex flex-col lg:flex-row justify-stretch">
                        
                        <!-- Left Column: Vertical Tabs Navigation (Desktop) / Accordion (Mobile) -->
                        <div class="flex-shrink-0 w-full lg:w-1/3">
                            <nav class="flex flex-col gap-0 divide-y divide-gray-300" role="tablist">
                                <?php foreach ($vertical_tabs as $index => $tab): 
                                    $is_active = $index === 0;
                                    $tab_id = 'tab-' . $component_id . '-' . $index;
                                    $panel_id = 'panel-' . $component_id . '-' . $index;
                                    $icon = $tab['icon'] ?? null;
                                    $title = $tab['title'] ?? '';
                                ?>
                                    <div>
                                        <button
                                            type="button"
                                            role="tab"
                                            id="<?php echo esc_attr($tab_id); ?>"
                                            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                                            aria-controls="<?php echo esc_attr($panel_id); ?>"
                                            aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>"
                                            data-tab-toggle="<?php echo esc_attr($panel_id); ?>"
                                            data-tab-index="<?php echo $index; ?>"
                                            class="vertical-tab-button border-none bg-[#575757] flex items-center justify-between w-full px-6 !py-4 lg:!py-10 text-left rounded-none transition-all duration-300 <?php echo $is_active ? 'bg-[#575757] text-white' : 'bg-white text-[#4B5563] hover:bg-[#575757'; ?>"
                                        >
                                            <span class="font-semibold"><?php echo esc_html($title); ?></span>
                                            <!-- Accordion icon for mobile -->
                                            <span class="text-[34px] accordion-icon lg:hidden <?php echo $is_active ? 'text-white' : 'text-gradient text-brand'; ?>"><?php echo $is_active ? '−' : '+'; ?></span>
                                        </button>
                                        
                                        <!-- Mobile Accordion Content -->
                                        <div
                                            role="tabpanel"
                                            id="<?php echo esc_attr($panel_id); ?>-mobile"
                                            aria-labelledby="<?php echo esc_attr($tab_id); ?>"
                                            data-tab-panel-mobile
                                            data-accordion-content="<?php echo esc_attr($panel_id); ?>-mobile"
                                            class="lg:hidden overflow-hidden transition-all duration-300 <?php echo $is_active ? 'accordion-open max-h-[2000px]' : 'max-h-0'; ?>"
                                        >
                                            <div class="flex flex-col items-start px-10 pt-2 pb-6">
                                                <?php 
                                                $description = $tab['description'] ?? '';
                                                $link = $tab['link'] ?? null;
                                                ?>
                                                <?php if ($description): ?>
                                                    <div class="text-[#4B5563] leading-relaxed mb-4">
                                                        <?php echo wp_kses_post($description); ?>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if ($link && isset($link['url'])): ?>
                                                    <a 
                                                        href="<?php echo esc_url($link['url']); ?>"
                                                        <?php if (isset($link['target'])): ?>
                                                            target="<?php echo esc_attr($link['target']); ?>"
                                                        <?php endif; ?>
                                                        class="inline-flex button-primary"
                                                    >
                                                        <?php echo esc_html($link['title'] ?? 'Learn more'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                        
                        <!-- Right Column: Tab Content Panels (Desktop Only) -->
                        <div class="hidden flex-shrink-0 w-full shadow-2xl bg-light-fade-up lg:block lg:w-2/3">
                            <?php foreach ($vertical_tabs as $index => $tab): 
                                $is_active = $index === 0;
                                $panel_id = 'panel-' . $component_id . '-' . $index;
                                $tab_id = 'tab-' . $component_id . '-' . $index;
                                
                                $icon = $tab['icon'] ?? null;
                                $title = $tab['title'] ?? '';
                                $description = $tab['description'] ?? '';
                                $image = $tab['image'] ?? null;
                                $link = $tab['link'] ?? null;
                            ?>
                                <div
                                    role="tabpanel"
                                    id="<?php echo esc_attr($panel_id); ?>"
                                    aria-labelledby="<?php echo esc_attr($tab_id); ?>"
                                    data-tab-panel
                                    class="vertical-tab-panel transition-all duration-300 <?php echo $is_active ? 'opacity-100 block' : 'opacity-0 hidden'; ?>"
                                >
                                    <div class="flex flex-col gap-8 items-start p-8 md:p-10 lg:p-12 lg:flex-row justify-stretch">
                                        
                                        <!-- Left side: Content -->
                                        <div class="flex flex-col flex-1 gap-6">
                                            <?php if ($icon && isset($icon['url'])): ?>
                                                <img 
                                                    src="<?php echo esc_url($icon['url']); ?>" 
                                                    alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>"
                                                    class="object-contain w-16 h-16"
                                                >
                                            <?php endif; ?>
                                            
                                            <?php if ($description): ?>
                                                <div class="text-[#4B5563] leading-relaxed">
                                                    <?php echo wp_kses_post($description); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if ($link && isset($link['url'])): ?>
                                                <a 
                                                    href="<?php echo esc_url($link['url']); ?>"
                                                    <?php if (isset($link['target'])): ?>
                                                        target="<?php echo esc_attr($link['target']); ?>"
                                                    <?php endif; ?>
                                                    class="inline-flex self-start mt-4 button-primary"
                                                >
                                                    <?php echo esc_html($link['title'] ?? 'Learn more'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Right side: Image -->
                                        <?php if ($image && isset($image['url'])): ?>
                                            <div class="w-full h-full lg:w-auto lg:max-w-md">
                                                <img 
                                                    src="<?php echo esc_url($image['url']); ?>" 
                                                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                                                    class="object-contain w-full h-auto rounded-lg"
                                                >
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
<?php endif; ?>

