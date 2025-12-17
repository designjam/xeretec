<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero-archive'); ?> 

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<!-- TEXT 50/50 12 -->
	<?php echo get_template_part('templates/modules/module', 'text-full-archive'); ?>

	<!-- ARCHIVE -->
	<?php echo get_template_part('templates/archive', 'default'); ?>

	<!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full-archive'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>