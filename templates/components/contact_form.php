<?php
/**
 * Contact Form Component
 */

$content = get_sub_field('content');
$hubspot_code = get_sub_field('hubspot_code');

if ($content):
    $component_id = 'contact-form-' . get_row_index();
    ?>
    
    <section class="component-wrapper bg-dark" id="<?php echo esc_attr($component_id); ?>">
        <div class="container px-4 mx-auto">
          <div class="grid grid-cols-1 gap-8 items-center lg:grid-cols-2 lg:gap-24">
            <!-- Left Content -->
            <div class="text-white !text-center lg:!text-left ">
              <?php if ($content): ?>
                <div class="mb-8 max-w-none text-white">
                  <?php echo wp_kses_post($content); ?>
                </div>
              <?php endif; ?>

              <div class="flex justify-center lg:justify-start">
                <?php get_template_part('templates/components/snippets/links'); ?>
              </div>
            </div>

            <!-- Right Form -->
            <?php if ($hubspot_code): ?>
              <div class="p-10 bg-opacity-10 border border-white shadow-2xl hubspot-form bg-white/10 rounded-20 lg:p-32">
                <?php echo ($hubspot_code); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
    </section>
    
<?php endif; ?>

