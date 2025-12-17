<?php
$component_type = get_sub_field('components');
?>
<section class="component-wrapper">
  <div class="container bg-gray-100 border border-dashed border-gray-400 rounded-xl min-h-[50vh] flex flex-col items-center justify-center p-6 my-8 !mx-auto text-center">
    <div class="mb-2 text-sm tracking-widest uppercase">
      Placeholder Block
    </div>
    <h2 class="text-xl font-semibold">
      <?php echo ucwords(str_replace('_', ' ', $component_type)); ?>
    </h2>
    <p class="mt-2">
      This is a placeholder for the <strong><?php echo $component_type; ?></strong> component.
    </p>
  </div>
</section>