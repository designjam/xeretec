<?php
/**
 * Application Cards Component
 */

$center_image = get_sub_field('center_image');
$content = get_sub_field('content');
$application_cards = get_sub_field('application_cards');

if ($content && $application_cards):
    $component_id = 'application-cards-' . get_row_index();
    ?>
    
    <section class="component-wrapper bg-light-fade-down" id="<?php echo esc_attr($component_id); ?>">
        <div class="container flex flex-col gap-16 px-4 mx-auto">
            
        <?php if ($content): ?>
      <div class="mx-auto text-center lg:w-8/12">
        <?php echo wp_kses_post($content); ?>
      </div>
    <?php endif; ?>
            
            <div class="flex flex-col gap-10 justify-center items-stretch md:gap-20 md:flex-row md:items-stretch">
                
                <!-- Left Cards -->
                <div class="space-y-10 w-full md:space-y-20 md:w-1/2 lg:w-1/4">
                    <?php 
                    $left_cards = array_slice($application_cards, 0, ceil(count($application_cards) / 2));
                    foreach ($left_cards as $card): 
                    ?>
                        <div class="px-6 py-8 text-center bg-white rounded-10 shadow-custom">
                            <?php if ($card['icon']): ?>
                                <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>" class="mx-auto mb-4 w-16 h-16">
                            <?php endif; ?>
                            
                            <?php if ($card['title']): ?>
                                <h3 class=" text-[23px] font-bold"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($card['description']): ?>
                                <p class="text-[16px] lg:text-[18px] !mt-3 text-gray-600"><?php echo esc_html($card['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Center Image -->
                <?php if ($center_image): ?>
                    <div class="hidden lg:flex lg:flex-col max-w-[560px] self-stretch">
                        <img src="<?php echo esc_url($center_image['url']); ?>" alt="<?php echo esc_attr($center_image['alt']); ?>" class="object-cover object-center flex-1 w-full h-full rounded-10 shadow-custom">
                    </div>
                <?php endif; ?>
                
                <!-- Right Cards -->
                <div class="space-y-10 w-full md:space-y-20 md:w-1/2 lg:w-1/4">
                    <?php 
                    $right_cards = array_slice($application_cards, ceil(count($application_cards) / 2));
                    foreach ($right_cards as $card): 
                    ?>
                        <div class="px-6 py-8 text-center bg-white rounded-10 shadow-custom">
                          <?php if ($card['icon']): ?>
                                <img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>" class="mx-auto mb-4 w-16 h-16">
                            <?php endif; ?>
                            
                            <?php if ($card['title']): ?>
                                <h3 class=" text-[23px] font-bold"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($card['description']): ?>
                                <p class="text-[16px] lg:text-[18px] text-gray-60 !mt-3"><?php echo esc_html($card['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
    </section>
    
<?php endif; ?>

