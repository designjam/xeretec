<?php 
/*
Template name: Template (TM)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 19 22 23 4 38 36 41 31 24 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- VIDEO 40 -->
    <?php echo get_template_part('templates/modules/module', 'video'); ?>

    <!-- MULTIPLE CARDS 19 -->
    <?php echo get_template_part('templates/modules/module', 'cards-three'); ?>

    <!-- QUICK LINKS 22 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links'); ?>

    <!-- FEATURES 23 -->
    <?php echo get_template_part('templates/modules/module', 'features'); ?>

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

    <!-- FORM 41 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>    

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>