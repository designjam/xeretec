<?php 
/*
Template name: Template (TJ)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 19 4 21 38 35 16 22 39 36 41 31 2 -->

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

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- MULTIPLE CARDS 21 -->
    <?php echo get_template_part('templates/modules/module', 'cards-four'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- CONTENT CARDS 16 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-left'); ?>

    <!-- QUICK LINKS 22 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

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