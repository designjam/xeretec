<div class="container">	<!-- REBUILD TO BE RELATED CONTENT - SEE CASE STUDY EXAMPLE -->
	<div class="row module-products__row">
		<div class="col-xl-3">
			<div class="inner inner-spacing">
				<?php if ($args['headline']): ?><h2 class="epsilon epsilon--bold epsilon--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
				<?php if($args['link']): ?>
					<a class="btn btn--default" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-xl-9">
			<div class="row module-products__row module-products__slider"> <!-- SLIDER ON MOBILE ONLY -->
				<?php foreach ($args['products'] as $key => $card): ?>
					<div class="col-md-4 module-products__slide"> <!-- SLIDER ON MOBILE ONLY --> 
						<div class="card card--product">

							<?php if($card['image']): ?>
								<?php responsive_image($card['image']['id'],'100vw','480px', 'card__image'); ?>
							<?php endif; ?>

							<div class="card__inner">
								<div class="card__content">
									<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--semibold\">" . $card['title'] . "</h3>"; endif; ?>
									<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
								</div>

								<div class="card__links">
									<?php if($card['link']): ?>
										<a class="btn btn--white" href="<?php echo $card['link']['url']; ?>" target="<?php echo $card['link']['target']; ?>"><?php echo $card['link']['title']; ?></a>
									<?php endif; ?>
									<?php if($card['video']): ?>
										<a class="btn btn--play" href="<?php echo $card['video']['url']; ?>" target="<?php echo $card['video']['target']; ?>"><span class="visually-hidden"><?php _e('Play the video', 'Rouge'); ?></span></a>
									<?php endif; ?>
								</div>

							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>