<?php
/**
 * Repeatable Cards Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$repeatable_cards = get_sub_field('repeatable_cards');
$columns = get_sub_field('columns') ?: 'three';

if ($repeatable_cards):
    $component_id = 'repeatable-cards-' . get_row_index();
    
    // Set background and text classes based on colour selection
    $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-white';
    $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
    
    // Set grid classes based on columns selection
    $grid_classes = $columns === 'two' 
        ? 'grid grid-cols-1 md:grid-cols-2 gap-8 xl:w-11/12 mx-auto' 
        : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8';
    ?>
    
    <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>">
        <div class="container flex flex-col gap-20 mx-auto">
            
            <?php if ($content): ?>
                <div class="text-center">
                    <div class="max-w-[850px] mx-auto">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($repeatable_cards): ?>
                <div class="<?php echo esc_attr($grid_classes); ?>">
                    <?php if ($columns === 'two'): ?>
                        <?php foreach ($repeatable_cards as $card): ?>
                            <?php if ($card['link']): ?>
                                <a href="<?php echo esc_url($card['link']['url']); ?>" class="block flex gap-10 p-12 shadow-xl transition cursor-pointer rounded-10 hover:shadow-xl text-dark group card-gradient"
                            <?php else: ?>
                                <div class="flex gap-8 p-8 shadow-xl transition lg:p-12 lg:gap-10 rounded-10 hover:shadow-xl text-dark" style="background: linear-gradient(180deg, #FFFFFF 0%, #EDEEF5 100%);">
                            <?php endif; ?>
                                <?php if ($card['icon']): ?>
                                    <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>" class="w-16 h-16 group-hover:invert group-hover:brightness-0">
                                <?php endif; ?>
                                <div class="flex flex-col gap-6">
                                
                                  <?php if ($card['title']): ?>
                                      <h3 class="text-[23px] font-bold group-hover:text-white"><?php echo esc_html($card['title']); ?></h3>
                                  <?php endif; ?>
                                  
                                  <?php if ($card['description']): ?>
                                      <p class="text-[16px] lg:text-[18px] text-gray-600 !m-0 group-hover:text-white"><?php echo wp_kses_post($card['description']); ?></p>
                                  <?php endif; ?>
                                  
                                  <?php if ($card['link']): ?>
                                      <span class="inline-block button-tertiary group-hover:text-white">
                                          <?php echo esc_html($card['link']['title'] ?: 'Explore'); ?>
                                      </span>
                                  <?php endif; ?>
                                </div>
                            <?php if ($card['link']): ?>
                                </a>
                            <?php else: ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php elseif ($columns === 'three'): ?>
                        <?php foreach ($repeatable_cards as $card): ?>
                            <?php if ($card['link']): ?>
                                <a href="<?php echo esc_url($card['link']['url']); ?>" class="block flex flex-col gap-6 p-12 bg-white transition cursor-pointer shadow-custom rounded-20 group hover:shadow-xl text-dark card-gradient">
                            <?php else: ?>
                                <div class="flex flex-col gap-6 p-12 shadow-xl transition rounded-20 hover:shadow-xl text-dark">
                            <?php endif; ?>
                                <?php if ($card['icon']): ?>
                                    <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>" class="w-20 h-20 group-hover:invert group-hover:brightness-0">
                                <?php endif; ?>

                                <?php if ($card['title']): ?>
                                    <h3 class="text-4xl font-bold tracking-tight text-brand group-hover:text-white"><?php echo esc_html($card['title']); ?></h3>
                                <?php endif; ?>
                                
                                <?php if ($card['description']): ?>
                                    <p class="text-gray-600 !m-0 group-hover:text-white"><?php echo wp_kses_post($card['description']); ?></p>
                                <?php endif; ?>
                                
                                <?php if ($card['link']): ?>
                                    <span class="inline-block button-tertiary group-hover:text-white">
                                        <?php echo esc_html($card['link']['title'] ?: 'Explore'); ?>
                                    </span>
                                <?php endif; ?>
                            <?php if ($card['link']): ?>
                                </a>
                            <?php else: ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="flex justify-center">
              <?php get_template_part('templates/components/snippets/links'); ?>
            </div>
        </div>
    </section>
    
<?php endif; ?>

