<?php 
/*
Template name: Career
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

    <!-- FORM 26 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>