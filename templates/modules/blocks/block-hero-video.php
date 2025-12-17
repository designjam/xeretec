
<?php if ($args['background']): ?>

	<div class="objectfit module-hero__background <?php echo "gradient-" . $args['theme']; ?>">
		<?php responsive_image_nolazy($args['background']['id'],'100vw','1920px', ''); ?>
	</div>

<?php else: ?>

	<?php if ($args['vimeo']):?>

	    <div class="module-hero__vimeo <?php echo "gradient-" . $args['theme']; ?>">
			<video src=<?php echo $args['vimeo']; ?> autoplay loop playsinline muted></video>
		</div>

	<?php else: ?>

		<div class="module-hero__video <?php echo "gradient-" . $args['theme']; ?>">
	    	<div class="module-hero__video-wrapper">
	    	</div>
	    </div>

	<?php endif; ?>

<?php endif; ?>

<div class="container">
	<div class="row module-hero__row"> 
		<div class="offset-lg-1 col-lg-11">
			<div class="row module-hero__row"> 
				<div class="col-lg-5 module-hero__content">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h1 class="alpha alpha--extrabold alpha--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h1><?php endif; ?>
						<?php if ($args['excerpt']) : echo "<h2 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h2>"; endif; ?>
						<?php if ($args['link']): ?>
							<a class="btn btn--white" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>"><?php echo $args['link']['title']; ?></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-7 module-hero__links">

					<?php if ($args['embed'] && $args['video']): ?>
						<div class="module-hero__link">
							<!-- CLICK TO SHOW MODAL -->
							<a class="btn btn--modal" data-video-id="homepage" id="play-video"><?php echo $args['video']; ?><span class="module-hero__play"></span></a>
							<!-- MODAL - THIS CAN BE FOUND IN REGION HEADER -->
						</div>
					<?php elseif (!$args['embed'] && $args['link2']): ?>
						<div class="module-hero__link">
							<a class="btn btn--hero" href="<?php echo $args['link2']['url']; ?>" target="<?php echo $args['link2']['target']; ?>"><?php echo $args['link2']['title']; ?><span class="module-hero__cta"></span></a>
						</div>
					<?php endif; ?>

					<?php if ($args['anchor']): ?>
						<div class="module-hero__link">
							<a class="btn btn--hero" href="<?php echo $args['anchor']['url']; ?>" target="<?php echo $args['anchor']['target']; ?>"><?php echo $args['anchor']['title']; ?><span class="module-hero__anchor"></span></a>
						</div>
					<?php endif; ?>

					<div class="module-hero__link"><!-- ALWAYS AVAILABLE-->
						<a class="btn btn--hero" href="/contact-us/"><?php _e('Contact Us', 'Rouge'); ?><span class="module-hero__contact"></span></a>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="scrollto">
	<div class="scrollto-link">
		<span></span>
		<span></span>
	</div>
</div>