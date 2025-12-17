<?php 
/*
Template name: Template (TN)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 16 17 15 38 22 27 28 8 7 39 25 32 36 35 26 24 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- VIDEO 40 -->
    <?php echo get_template_part('templates/modules/module', 'video'); ?>

    <!-- CONTENT CARDS 16 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-left'); ?>

    <!-- CONTENT CARDS 17 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-right'); ?>

    <!-- CONTENT CARDS 15 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- QUICK LINKS 22 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links'); ?>

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- MULTIPLE CARDS 8 -->
    <?php echo get_template_part('templates/modules/module', 'hero-cards-three'); ?>

    <!-- MULTIPLE CARDS 7 -->
    <?php echo get_template_part('templates/modules/module', 'hero-cards-two'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- IMAGE/TEXT 25 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-right'); ?>

    <!-- PRODUCTS RIGHT 32 -->
    <?php echo get_template_part('templates/modules/module', 'products-right'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- FORM 26 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>