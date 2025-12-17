<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content">

	<!-- HERO -->
    <?php echo get_template_part('templates/modules/module', 'hero'); ?>

    <!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 
    
	<!-- POST -->
	<?php 
		$args = array(
	        'excerpt' => get_field('fld_casestudy_excerpt'),
	        'link' => get_field('fld_casestudy_link'),
	        'text' => get_field('fld_casestudy_text'),
	        'video' => get_field('fld_casestudy_embed'),
	        'thumbnail' => get_field('fld_casestudy_thumbnail'),
	    );
        echo get_template_part('templates/single', 'default', $args);
	?>

	<!-- OUTCOMES 4 -->
    <?php echo get_template_part('templates/modules/module', 'outcomes'); ?>

    <!-- BLOG 31 -->
    <?php echo get_template_part('templates/modules/module', 'posts'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>