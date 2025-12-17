<?php if ($args['background']):?>
	<div class="objectfit module-headline__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', ''); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-headline__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-image-text__row"> 
				<div class="offset-md-6 col-md-6 offset-lg-8 col-lg-4">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if($args['link']): ?>
							<a class="btn btn--white" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>