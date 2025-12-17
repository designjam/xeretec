<?php 
/*
Template name: Template (TU)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 15 23 8 38 4 35 13 31 24 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- CONTENT CARDS 15 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards'); ?>

    <!-- FEATURES 23 -->
    <?php echo get_template_part('templates/modules/module', 'features'); ?>

    <!-- CONTENT CARDS 17 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-right'); ?>

    <!-- MULTIPLE CARDS 8 -->
    <?php echo get_template_part('templates/modules/module', 'hero-cards-three'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>