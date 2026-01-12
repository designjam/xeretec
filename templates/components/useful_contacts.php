<?php
/**
 * Repeatable Cards Component
 */

$colour = get_sub_field('colour') ?: 'light';
$content = get_sub_field('content');
$repeatable_cards = get_sub_field('repeatable_cards');

if ($repeatable_cards):
    $component_id = 'repeatable-cards-' . get_row_index();
    
    // Set background and text classes based on colour selection
    $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-white';
    $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
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
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

                        <?php foreach ($repeatable_cards as $card): ?>
                            <div class="flex flex-col gap-6 p-12 shadow-xl transition rounded-20 hover:shadow-xl text-dark card-gradient">
                                <div class="flex flex-row gap-6 justify-between items-center">


                                <?php if ($card['title']): ?>
                                    <h3 class="mt-10 text-4xl font-bold tracking-tight text-brand group-hover:text-white"><?php echo esc_html($card['title']); ?></h3>
                                <?php endif; ?>

                                <?php if ($card['icon']): ?>
                                    <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>" class="w-24 h-24 group-hover:invert group-hover:brightness-0">
                                <?php endif; ?>
                                </div>
                                <?php if ($card['description']): ?>
                                    <div class="text-gray-600 !m-0 group-hover:text-white"><?php echo wp_kses_post($card['description']); ?></div>
                                <?php endif; ?>
                                
                                <?php if ($card['links']): ?>
                                    <div class="flex flex-col gap-4">
                                        <?php foreach ($card['links'] as $link_item): ?>
                                            <?php if ($link_item['link']): ?>
                                                <a href="<?php echo esc_url($link_item['link']['url']); ?>" 
                                                   <?php if ($link_item['link']['target']): ?>target="<?php echo esc_attr($link_item['link']['target']); ?>"<?php endif; ?>
                                                   class="inline-block button-tertiary group-hover:text-white">
                                                    <?php echo esc_html($link_item['link']['title'] ?: 'Explore'); ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
    
<?php endif; ?>

