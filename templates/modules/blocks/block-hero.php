<?php if(is_404() || is_search() || is_page_template('template-default-tv.php') || is_page_template('template-career.php')): ?>

	<div class="container">
		<div class="row module-hero__row"> 
			<div class="offset-lg-1 col-lg-11">
				<div class="row module-hero__row"> 
					<div class="col-lg-6">
						<div class="left-animation inner inner-spacing">
							<?php if ($args['headline']): ?><div class="keyline-wrapper"><h1 class="beta beta--extrabold beta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h1></div><?php endif; ?>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<?php if ($args['background']): ?>
		<div class="objectfit module-hero__background">
			<?php if ($args['type'] == 'large'): ?>
				<?php responsive_image_nolazy($args['background']['id'],'100vw','1920px', 'parallax'); ?>
			<?php else: ?>
				<?php responsive_image_nolazy($args['background']['id'],'100vw','1920px', ''); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row module-hero__row"> 
			<div class="offset-lg-1 col-lg-11">
				<div class="row module-hero__row"> 

					<div class="col-lg-6">
						<div class="left-animation inner inner-spacing">
							<?php if ($args['headline']): ?><div class="keyline-wrapper"><h1 class="beta beta--extrabold beta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h1></div><?php endif; ?>
							<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
							<?php if ($args['link']): ?> <!-- HIDDEN BUTTON - OUTPUT $args['link'] ON MOBILE-->
								<a class="btn btn--white btn--mobile" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>"><?php echo $args['link']['title']; ?></a>
							<?php endif; ?>
							
						</div>
					</div>

					<?php if(get_post_type() == 'case_studies' || get_post_type() == 'partners' || get_post_type() == 'post'): ?>
						<div class="col module-hero__links">
					<?php else: ?>
						<div class="<?php if ($args['type'] == 'large'): echo "col-lg-12"; else: echo "col"; endif;?> module-hero__links">
					<?php endif; ?>
						<?php if ($args['link'] || $args['anchor']): ?>
							<?php if ($args['link']): ?>
								<div class="module-hero__link">
									<a class="btn btn--hero" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>"><?php echo $args['link']['title']; ?><span class="module-hero__cta"></span></a>
								</div>
							<?php endif; ?>
							<?php if ($args['anchor']): ?>
								<div class="module-hero__link">
									<a class="btn btn--hero" href="<?php echo $args['anchor']['url']; ?>" target="<?php echo $args['anchor']['target']; ?>"><?php echo $args['anchor']['title']; ?><span class="module-hero__anchor"></span></a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<div class="module-hero__link"><!-- ALWAYS AVAILABLE-->
							<a class="btn btn--hero" href="/contact-us/"><?php _e('Contact Us', 'Rouge'); ?><span class="module-hero__contact"></span></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<?php endif; ?>