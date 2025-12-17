<?php 
/*
Template name: Template (TR)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 42 5 16 17 27 32 34 29 28 19 38 39 13 35 2 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- VIDEO 40 -->
    <?php echo get_template_part('templates/modules/module', 'video'); ?>

    <!-- GRAPHIC 42 -->
    <?php echo get_template_part('templates/modules/module', 'graphic'); ?>

    <!-- MULTIPLE HERO CARDS 5 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-hero-rows'); ?>

    <!-- CONTENT CARDS 16 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-left'); ?>

    <!-- CONTENT CARDS 17 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-right'); ?>

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- PRODUCTS RIGHT 32 -->
    <?php echo get_template_part('templates/modules/module', 'products-right'); ?>

    <!-- PRODUCTS FULL 34 -->
    <?php echo get_template_part('templates/modules/module', 'products-full'); ?>

    <!-- SMALL BANNER LEFT 29 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-left'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- MULTIPLE CARDS 19 -->
    <?php echo get_template_part('templates/modules/module', 'cards-three'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>