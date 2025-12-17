<?php 
/*
Template name: Template (TQ)
*/
?>
<?php
    get_template_part('templates/regions/region', 'head');
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- 12 40 42 27 29 30 28 39 15 35 36 -->

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

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- SMALL BANNER LEFT 29 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-left'); ?>

    <!-- SMALL BANNER RIGHT 30 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-right'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- CONTENT CARDS 15 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>