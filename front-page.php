<?php
    get_template_part('templates/regions/region', 'head'); 
    get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

    <!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero-video'); ?>

    <!-- SERVICES 1 -->
    <?php echo get_template_part('templates/modules/module', 'services'); ?>

    <!-- GRAPHIC 41 -->
    <?php echo get_template_part('templates/modules/module', 'graphic'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- IMAGE/TEXT 25 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-right'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- LARGE TRUSTED PARTNERS 37 -->
    <?php echo get_template_part('templates/modules/module', 'large-partners'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>


</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>