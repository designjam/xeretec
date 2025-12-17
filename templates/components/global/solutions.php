<?php

/**
 * Solutions Component
 * Note: This is a global component, fields are stored in ACF options page
 */

$solutions = get_field('solutions', 'option');
$content = get_field('solutions_content', 'option');

if ($solutions && !empty($solutions)):
  $component_id = 'solutions-' . uniqid();
  $first_solution = $solutions[0];
?>

  <section class="component-wrapper bg-white" id="<?php echo esc_attr($component_id); ?>" data-solutions-component>
    <div class="container flex flex-col gap-16 mx-auto">
      
      <?php if ($content): ?>
        <div class="mx-auto max-w-none text-center">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-12 lg:gap-12">
        <!-- Large Featured Card (Desktop) -->
        <div class="hidden md:block rounded-10 md:col-span-6 shadow-custom solutions-featured" data-solutions-featured>
          <?php if ($first_solution['image']): ?>
            <div class="overflow-hidden mb-6 rounded-t-10 h-[310px]">
              <img 
                src="<?php echo esc_url($first_solution['image']['url']); ?>" 
                alt="<?php echo esc_attr($first_solution['image']['alt'] ?: $first_solution['title']); ?>"
                class="object-cover w-full h-full transition-opacity duration-300"
                data-solutions-featured-image
              >
            </div>
          <?php endif; ?>
          
          <div class="flex flex-col gap-4 justify-start items-start p-10 opacity-100 transition-all duration-300 ease-in-out translate-y-0" data-solutions-featured-content>
            <?php if ($first_solution['title']): ?>
              <h3 class="mb-6 text-4xl font-bold lg:text-5xl text-brand" data-solutions-featured-title>
                <?php echo esc_html($first_solution['title']); ?>
              </h3>
            <?php endif; ?>
            
            <?php if ($first_solution['content']): ?>
              <div class="grid grid-cols-1 gap-6 mb-6 text-l" data-solutions-featured-description>
                <?php echo wp_kses_post($first_solution['content']); ?>
              </div>
            <?php endif; ?>
            
            <?php if ($first_solution['link']): ?>
              <a href="<?php echo esc_url($first_solution['link']['url']); ?>" 
                 class="inline-flex button-primary"
                 <?php if ($first_solution['link']['target']): ?>target="<?php echo esc_attr($first_solution['link']['target']); ?>"<?php endif; ?>
                 data-solutions-featured-link>
                <?php echo esc_html($first_solution['link']['title'] ?: 'Discover more'); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Small Cards Grid -->
        <div class="grid grid-cols-1 col-span-1 gap-6 md:col-span-6 md:grid-cols-2">
          <?php foreach ($solutions as $index => $solution): ?>
            <?php if ($solution['link']): ?>
              <a href="<?php echo esc_url($solution['link']['url']); ?>" 
                 class="flex flex-col gap-6 p-12 shadow-xl transition cursor-pointer rounded-10 hover:shadow-xl text-dark group card-gradient solution-card"
                 data-solution-index="<?php echo esc_attr($index); ?>"
                 data-solution-data='<?php 
                   echo esc_attr(json_encode([
                     'image' => $solution['image'] ? [
                       'url' => $solution['image']['url'],
                       'alt' => $solution['image']['alt'] ?: $solution['title']
                     ] : null,
                     'title' => $solution['title'] ?? '',
                     'content' => $solution['content'] ?? '',
                     'link' => $solution['link'] ?? null
                   ]));
                 ?>'
                 <?php if ($solution['link']['target']): ?>target="<?php echo esc_attr($solution['link']['target']); ?>"<?php endif; ?>>
            <?php else: ?>
              <div class="flex flex-col gap-6 p-12 shadow-xl transition rounded-10 hover:shadow-xl text-dark solution-card" 
                   style="background: linear-gradient(180deg, #FFFFFF 0%, #EDEEF5 100%);"
                   data-solution-index="<?php echo esc_attr($index); ?>"
                   data-solution-data='<?php 
                     echo esc_attr(json_encode([
                       'image' => $solution['image'] ? [
                         'url' => $solution['image']['url'],
                         'alt' => $solution['image']['alt'] ?: $solution['title']
                       ] : null,
                       'title' => $solution['title'] ?? '',
                       'content' => $solution['content'] ?? '',
                       'link' => $solution['link'] ?? null
                     ]));
                   ?>'>
            <?php endif; ?>
              <?php if ($solution['icon']): ?>
                <img 
                  src="<?php echo esc_url($solution['icon']['url']); ?>" 
                  alt="<?php echo esc_attr($solution['icon']['alt'] ?: ''); ?>"
                  class="w-20 h-20 group-hover:invert group-hover:brightness-0"
                >
              <?php endif; ?>
              
              <?php if ($solution['title']): ?>
                <h3 class="text-4xl font-bold tracking-tight group-hover:text-white"><?php echo esc_html($solution['title']); ?></h3>
              <?php endif; ?>
              
              <?php if ($solution['overview']): ?>
                <p class="text-gray-600 !m-0 group-hover:text-white text-[15px]"><?php echo esc_html($solution['overview']); ?></p>
              <?php endif; ?>
              
              <?php if ($solution['link']): ?>
                <span class="flex inline-flex relative gap-4 items-center font-semibold text-center transition group text-brand group-hover:text-white">
                  <?php echo esc_html($solution['link']['title'] ?: 'Discover more'); ?>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.56 14" class="fill-brand group-hover:fill-white w-6 h-6 group-hover:translate-x-[5px] transition-all duration-100 ease-in-out"><path d="M15.27,6.29L9.44.29c-.09-.09-.2-.17-.32-.22-.12-.05-.24-.08-.37-.08s-.25.03-.37.08c-.12.05-.23.12-.32.22-.09.09-.16.2-.21.32-.05.12-.07.25-.07.38s.03.26.07.38c.05.12.12.23.21.32l4.17,4.29H.97c-.26,0-.51.11-.69.29-.18.19-.28.44-.28.71s.1.52.28.71c.18.19.43.29.69.29h11.26l-4.17,4.29c-.18.19-.29.44-.29.71s.1.52.29.71c.18.19.43.29.69.29s.51-.11.69-.29l5.83-6c.18-.19.29-.44.29-.71s-.1-.52-.29-.71Z"/></svg>
                </span>
              <?php endif; ?>
            <?php if ($solution['link']): ?>
              </a>
            <?php else: ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </section>

<?php endif; ?>
