<?php 
/*
Template name: Template (TT)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 42 29 30 28 17 19 38 35 13 -->

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

    <!-- SMALL BANNER LEFT 29 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-left'); ?>

    <!-- SMALL BANNER RIGHT 30 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-right'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- CONTENT CARDS 17 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-right'); ?>

    <!-- MULTIPLE CARDS 19 -->
    <?php echo get_template_part('templates/modules/module', 'cards-three'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>
    
    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>