<?php
	get_template_part('templates/regions/region', 'head'); 
	get_template_part('templates/regions/region', 'header');
?>

<main id="content" role="main">

	<section class="module-hero module-hero--small" role="banner">
		<div class="container">
			<div class="row module-hero__row"> 
				<div class="offset-lg-1 col-lg-11">
					<div class="inner inner-spacing">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- BREADCRUMB -->
    <?php echo get_template_part('templates/modules/module', 'breadcrumb'); ?> 

	<section id="content">
		<div class="container">
       		<div class="row">
				<div class="offset-xl-1 col-xl-10">
					<div class="inner inner-spacing">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>