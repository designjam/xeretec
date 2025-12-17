<?php 
/*
Template name: About (TB)
*/
?>
<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- 15 41 27 3 13 37 -->

    <!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

    <!-- CONTENT CARDS 15 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards'); ?>

	<!-- GRAPHIC 41 -->
    <?php echo get_template_part('templates/modules/module', 'graphic'); ?>

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- SERVICES 3 -->
    <?php echo get_template_part('templates/modules/module', 'services'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

    <!-- LARGE TRUSTED PARTNERS 37 -->
    <?php echo get_template_part('templates/modules/module', 'large-partners'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>