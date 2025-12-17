<?php

/**
 * About Company Component
 */

$content = get_sub_field('content');
$image = get_sub_field('image');
$logo = get_sub_field('logo');
$company_details = get_sub_field('company_details');

if ($content):
  $component_id = 'about-company-' . get_row_index();
?>

  <section class="bg-white component-wrapper" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto 6">
      <div class="flex gap-8 items-stretch lg:gap-32">


        <div class="flex flex-col lg:w-3/5">

          <!-- Content -->
          <?php if ($content): ?>
            <div class="max-w-none !text-center lg:!text-left">
              <?php echo wp_kses_post($content); ?>
            </div>
          <?php endif; ?>

          <div class="flex flex-col gap-4 p-8 mt-10 lg:gap-8 lg:divide-x lg:flex-row rounded-10 shadow-custom" >
            <!-- Logo -->
            <?php if ($logo): ?>
              <div class="flex items-start">
                <img
                  src="<?php echo esc_url($logo['url']); ?>"
                  alt="<?php echo esc_attr($logo['alt'] ?: 'Company Logo'); ?>"
                  class="w-full h-auto mx-auto max-w-[200px] object-contain">
              </div>
            <?php endif; ?>
            <!-- Company Details -->
            <?php if ($company_details): ?>
              <div class="grid grid-cols-1 gap-3 md:gap-6 lg:pl-8 md:grid-cols-2 !text-center lg:!text-left">

                <?php if (!empty($company_details['sector'])): ?>
                  <div>
                    <dt class="font-bold text-brand">Sector</dt>
                    <dd class=""><?php echo esc_html($company_details['sector']); ?></dd>
                  </div>
                <?php endif; ?>

                <?php if (!empty($company_details['employees'])): ?>
                  <div>
                    <dt class="font-bold text-brand">Employees</dt>
                    <dd class=""><?php echo esc_html($company_details['employees']); ?></dd>
                  </div>
                <?php endif; ?>

                <?php if (!empty($company_details['headquarters'])): ?>
                  <div>
                    <dt class="font-bold text-brand">Headquarters</dt>
                    <dd class=""><?php echo esc_html($company_details['headquarters']); ?></dd>
                  </div>
                <?php endif; ?>

                <?php if (!empty($company_details['key_solution_delivered'])): ?>
                  <div>
                    <dt class="font-bold text-brand">Key Solution Delivered</dt>
                    <dd class=""><?php echo esc_html($company_details['key_solution_delivered']); ?></dd>
                  </div>
                <?php endif; ?>

              </div>
            <?php endif; ?>
          </div>

        </div>



          <!-- Image -->
          <?php if ($image): ?>
            <div class="hidden relative w-2/5 lg:flex">
              <img
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt'] ?: 'Company Image'); ?>"
                class="object-cover absolute w-full h-full rounded-10 shadow-custom">
            </div>
          <?php endif; ?>

      </div>
    </div>
  </section>

<?php endif; ?>