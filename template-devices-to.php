<?php 
/*
Template name: Devices (TO)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

	<!-- CONTENT -->
    <?php echo get_template_part('templates/page', 'devices'); ?>

	<!-- PRODUCTS FULL 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>


</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>