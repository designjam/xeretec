<?php 
/*
Template name: Contact us (TG)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- 26 20 23 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

    <!-- FORM 26 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

    <!-- MULTIPLE CARDS 20 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-rows'); ?>

    <!-- FEATURES 23 -->
    <?php echo get_template_part('templates/modules/module', 'features'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>