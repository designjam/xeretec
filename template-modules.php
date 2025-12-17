<?php 
/*
Template name: All modules
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

    <!-- SERVICES 1 & 3 -->
    <?php echo get_template_part('templates/modules/module', 'services'); ?>

    <!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full'); ?>

    <!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- MULTIPLE HERO CARDS 5 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-hero-rows'); ?>

    <!-- MULTIPLE CARDS 6 & 20 -->
    <?php echo get_template_part('templates/modules/module', 'multiple-rows'); ?>
    
    <!-- MULTIPLE CARDS 7 -->
    <?php echo get_template_part('templates/modules/module', 'hero-cards-two'); ?>

    <!-- MULTIPLE CARDS 8 -->
    <?php echo get_template_part('templates/modules/module', 'hero-cards-three'); ?>

    <!-- TEAM 9 -->
    <?php echo get_template_part('templates/modules/module', 'team'); ?>

    <!-- CAREERS 10 & 11 -->
    <?php echo get_template_part('templates/modules/module', 'careers'); ?>

    <!-- TEXT 50/50 12 -->
    <?php echo get_template_part('templates/modules/module', 'text-full'); ?>

    <!-- TEXT 50/50 13 -->
    <?php echo get_template_part('templates/modules/module', 'text-right'); ?>

    <!-- TEXT 50/50 14 -->
    <?php echo get_template_part('templates/modules/module', 'text-left'); ?>

    <!-- CONTENT CARDS 15 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards'); ?>

    <!-- CONTENT CARDS 16 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-left'); ?>

    <!-- CONTENT CARDS 17 -->
    <?php echo get_template_part('templates/modules/module', 'content-cards-right'); ?>

    <!-- MULTIPLE CARDS 18 -->
    <?php echo get_template_part('templates/modules/module', 'cards-two'); ?>

    <!-- MULTIPLE CARDS 19 -->
    <?php echo get_template_part('templates/modules/module', 'cards-three'); ?>

    <!-- MULTIPLE CARDS 21 -->
    <?php echo get_template_part('templates/modules/module', 'cards-four'); ?>

    <!-- QUICK LINKS 22 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links'); ?>

    <!-- FEATURES 23 -->
    <?php echo get_template_part('templates/modules/module', 'features'); ?>

    <!-- QUICK LINKS 24 -->
    <?php echo get_template_part('templates/modules/module', 'quick-links-full'); ?>

    <!-- IMAGE/TEXT 25 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-right'); ?>

    <!-- FORM 26 & 41 -->
    <?php echo get_template_part('templates/modules/module', 'form'); ?>

    <!-- LARGE BANNER LEFT 27 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-left'); ?>

    <!-- LARGE BANNER RIGHT 28 -->
    <?php echo get_template_part('templates/modules/module', 'large-banner-right'); ?>

    <!-- SMALL BANNER LEFT 29 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-left'); ?>

    <!-- SMALL BANNER RIGHT 30 -->
    <?php echo get_template_part('templates/modules/module', 'small-banner-right'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

    <!-- PRODUCTS RIGHT 32 -->
    <?php echo get_template_part('templates/modules/module', 'products-right'); ?>

    <!-- PRODUCTS RIGHT 33 -->
    <?php echo get_template_part('templates/modules/module', 'products-left'); ?>

    <!-- PRODUCTS FULL 34 -->
    <?php echo get_template_part('templates/modules/module', 'products-full'); ?>

    <!-- HEADLINE 35 -->
    <?php echo get_template_part('templates/modules/module', 'headline'); ?>

    <!-- SMALL TRUSTED PARTNERS 36 -->
    <?php echo get_template_part('templates/modules/module', 'small-partners'); ?>

    <!-- LARGE TRUSTED PARTNERS 37 -->
    <?php echo get_template_part('templates/modules/module', 'large-partners'); ?>

    <!-- CASE STUDIES CAROUSEL 38 -->
    <?php echo get_template_part('templates/modules/module', 'case-studies-slider'); ?>

    <!-- IMAGE/TEXT 39 -->
    <?php echo get_template_part('templates/modules/module', 'image-text-left'); ?>

    <!-- VIDEO 40 -->
    <?php echo get_template_part('templates/modules/module', 'video'); ?>

    <!-- GRAPHIC 41 -->
    <?php echo get_template_part('templates/modules/module', 'graphic'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>