<?php 
/*
Template name: Our Approach (TC)
*/
?>
<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- 14 12 23 4 39 38 31 26 -->

    <!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

    <!-- TEXT 50/50 14 -->
    <?php echo get_template_part('templates/modules/module', 'text-left'); ?>

    <!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- FEATURES 23 -->
    <?php echo get_template_part('templates/modules/module', 'features'); ?>

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

    <!-- FORM 26 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>