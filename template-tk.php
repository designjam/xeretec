<?php 
/*
Template name: Template (TK)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 5 6 38 16 19 4 22 32 35 37 41 31 2 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- VIDEO 40 -->
    <?php echo get_template_part('templates/modules/module', 'video'); ?>

    <!-- MULTIPLE HERO CARDS 5 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-hero-rows'); ?>

    <!-- MULTIPLE CARDS 6 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-rows'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- CONTENT CARDS 16 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-left'); ?>

    <!-- MULTIPLE CARDS 19 -->
    <?php echo get_template_part('templates/modules/module', 'cards-three'); ?>

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- QUICK LINKS 22 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links'); ?>

    <!-- PRODUCTS RIGHT 32 -->
    <?php echo get_template_part('templates/modules/module', 'products-right'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- LARGE TRUSTED PARTNERS 37 -->
    <?php echo get_template_part('templates/modules/module', 'large-partners'); ?>

    <!-- FORM 41 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

    <!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>