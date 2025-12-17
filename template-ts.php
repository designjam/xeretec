<?php 
/*
Template name: Template (TS)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 5 20 38 29 30 9 36 13 35 24 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- MULTIPLE HERO CARDS 5 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-hero-rows'); ?>

    <!-- MULTIPLE CARDS 20 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-rows'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- SMALL BANNER LEFT 29 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-left'); ?>

    <!-- SMALL BANNER RIGHT 30 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-right'); ?>
    
    <!-- TEAM 9 -->
    <?php echo get_template_part('templates/modules/module', 'team'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

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