<?php 
/*
Template name: Careers (TF)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- 12 10 26 -->

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- CAREERS 10 & 11 -->
    <?php echo get_template_part('templates/modules/module', 'careers'); ?>

    <!-- FORM 26 & 41 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>