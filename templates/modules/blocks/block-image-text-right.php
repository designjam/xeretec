<?php if ($args['background']):?>
	<div class="objectfit module-image-text__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-image-text__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-image-text__row flex--vcenter">
				<div class="col-md-5 module-image-text__col">
					<div class="row"> 
						<?php foreach ($args['images'] as $key => $image): ?>
							<div class="col-md-6">
								<div class="card card--feature fade-in">
									<?php if ($image['image']):?>
										<?php if($image['link']): echo "<a href=\"" . $image['link']['url'] . "\" target=\"" . $image['link']['target'] . "\" aria-label=\"" . $image['link']['title'] . "\">"; endif; ?>
											<?php responsive_image($image['image']['id'],'100vw','620px', 'img-fluid'); ?>
										<?php if($image['link']): echo "</a>"; endif; ?>
									<?php endif; ?>
									<?php if ($image['text'] || $image['link']) :?>
										<div class="card__inner">
											<?php if ($image['text']) : echo "<div>" . $image['text'] . "</div>"; endif; ?>
											<?php if($image['link']): ?>
												<a class="btn btn--white" href="<?php echo $image['link']['url']; ?>" target="<?php echo $image['link']['target']; ?>" aria-label="<?php echo $image['link']['title']; ?>"><?php echo $image['link']['title']; ?></a>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-md-7 offset-lg-1 col-lg-6 offset-xl-2 col-xl-5 offset-xxl-3 col-xxl-4 module-image-text__col margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
						<?php if($args['link']): ?>
							<a class="btn btn--white" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>