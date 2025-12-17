<?php 
/*
Template name: Default (TV)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

    <!-- CONTENT -->
    <?php echo get_template_part('templates/page', 'default'); ?>

    <!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>