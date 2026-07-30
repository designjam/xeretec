<?php
/**
 * Single Post - Flexible Components Template
 * Used when "Flexible Components" is selected in Post Template meta box
 * Mirrors template-components.php structure; uses post's flexible_components field
 */
get_template_part('templates/regions/region', 'head'); 
get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

<?php if (have_rows('flexible_components')) : ?>
  <?php while (have_rows('flexible_components')) : the_row(); ?>
    <?php $layout = get_row_layout(); ?>

    <?php 
    $template_path = 'templates/components/' . $layout . '.php';
    if (locate_template($template_path)) :
      get_template_part('templates/components/' . $layout);
    else :
      get_template_part('templates/components/placeholder');
    endif;
    ?>
  <?php endwhile; ?>
<?php endif; ?>

</main>

<?php
get_template_part('templates/regions/region', 'footer');
?>
