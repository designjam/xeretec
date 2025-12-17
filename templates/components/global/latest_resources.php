<?php
/**
 * Resources Component
 */

 $content = get_field('resource_content', 'option');
 $primary_cta = get_field('resource_primary_cta', 'option');
 
?>
   <section class="text-white component-wrapper bg-dark" id="latest-resources" >
     <div class="flex flex-col gap-16 mx-auto container-holder">
 
      <?php if ($content): ?>
        <div class="mx-auto max-w-none text-center">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>

      <?php
      // Query latest 3 posts
      $latest_posts = new WP_Query(array(
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
      ));

      if ($latest_posts->have_posts()): ?>
        <div class="latest-resources-wrapper" data-carousel>
          <!-- Desktop Grid Layout -->
          <div class="hidden grid-cols-1 gap-10 lg:grid lg:grid-cols-4 latest-resources-grid">
            <?php 
            $post_index = 0;
            while ($latest_posts->have_posts()): 
              $latest_posts->the_post();
              $post_index++;
              $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
              $categories = get_the_terms(get_the_ID(), 'type');
              $category_name = !empty($categories) && !is_wp_error($categories) ? $categories[0]->name : '';
              $excerpt = get_field('fld_insight_excerpt');
              $is_first = $post_index === 1;
            ?>
              <div class="latest-resource-card <?php echo $is_first ? 'lg:col-span-2' : ''; ?>">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="block h-full group">
                  <div class="flex overflow-hidden flex-col h-full bg-white transition-all duration-300 rounded-10 shadow-custom">
                    <?php if ($featured_image): ?>
                      <div class="overflow-hidden relative">
                        <img src="<?php echo esc_url($featured_image); ?>" 
                             alt="<?php echo esc_attr(get_the_title()); ?>"
                             class="object-cover w-full h-96 transition-transform duration-300 xl:h-[300px] group-hover:scale-105">
                      </div>
                    <?php endif; ?>
                    
                    <div class="flex flex-col flex-grow p-6 xl:p-12">
                      <?php if ($category_name): ?>
                        <span class="inline-block self-start px-3 py-1 mb-4 text-[14px] font-semibold text-white bg-brand-dark rounded-full">
                          <?php echo esc_html($category_name); ?>
                        </span>
                      <?php endif; ?>
                      
                      <h3 class="mb-3 text-[23px] font-bold transition-colors text-brand <?php echo $is_first ? 'lg:text-[36px]' : ''; ?>">
                        <?php echo esc_html(get_the_title()); ?>
                      </h3>
                      
                      <?php if ($excerpt): ?>
                        <p class="flex-grow mt-0 mb-4 text-gray-600">
                          <?php echo esc_html(wp_trim_words($excerpt, 20)); ?>
                        </p>
                      <?php endif; ?>
                      
                      <span class="button-tertiary">
                        Read more
                      </span>
                    </div>
                  </div>
                </a>
              </div>
            <?php 
            endwhile;
            wp_reset_postdata();
            ?>
          </div>

          <!-- Mobile Carousel -->
          <div class="latest-resources-carousel-slick lg:hidden">
            <?php 
            $latest_posts->rewind_posts();
            while ($latest_posts->have_posts()): 
              $latest_posts->the_post();
              $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
              $categories = get_the_terms(get_the_ID(), 'type');
              $category_name = !empty($categories) && !is_wp_error($categories) ? $categories[0]->name : '';
              $excerpt = get_field('fld_insight_excerpt');
            ?>
              <div class="p-4">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="block group">
                  <div class="flex overflow-hidden flex-col h-full bg-white transition-all duration-300 rounded-10 shadow-custom">
                    <?php if ($featured_image): ?>
                      <div class="overflow-hidden relative">
                        <img src="<?php echo esc_url($featured_image); ?>" 
                             alt="<?php echo esc_attr(get_the_title()); ?>"
                             class="object-cover w-full h-96 transition-transform duration-300 xl:h-[300px] group-hover:scale-105">
                      </div>
                    <?php endif; ?>
                    
                    <div class="flex flex-col flex-grow p-6 xl:p-12">
                      <?php if ($category_name): ?>
                        <span class="inline-block self-start px-3 py-1 mb-4 text-[14px] font-semibold text-white bg-brand-dark rounded-full">
                          <?php echo esc_html($category_name); ?>
                        </span>
                      <?php endif; ?>
                      
                      <h3 class="mb-3 text-[23px] font-bold transition-colors text-brand">
                        <?php echo esc_html(get_the_title()); ?>
                      </h3>
                      
                      <?php if ($excerpt): ?>
                        <p class="flex-grow mt-0 mb-4 text-gray-600">
                          <?php echo esc_html(wp_trim_words($excerpt, 20)); ?>
                        </p>
                      <?php endif; ?>
                      
                      <span class="button-tertiary">
                        Read more →
                      </span>
                    </div>
                  </div>
                </a>
              </div>
            <?php 
            endwhile;
            wp_reset_postdata();
            ?>
          </div>

          <!-- Mobile Carousel Navigation -->
          <div class="flex gap-2 justify-center mt-6 carousel-nav-wrapper lg:hidden">
            <!-- Navigation arrows will be inserted here by Slick -->
          </div>
        </div>
      <?php endif; ?>
 
       <?php if ($primary_cta): ?>
         <div class="flex justify-center">
           <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
             <a href="<?php echo esc_url($primary_cta['url']); ?>" class="button-primary">
               <?php echo esc_html($primary_cta['title'] ?: 'More on our partners'); ?>
             </a>
           </div>
         </div>
       <?php endif; ?>
 
     </div>
   </section>
