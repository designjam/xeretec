<?php 
/*
Template name: Landing page (TX)
*/
?>
<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- 12 27 28 41 2 -->

    <!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

    <!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- FORM 41 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

    <!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full'); ?>


</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>