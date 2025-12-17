<div class="container">
	<div class="row module-multiple-hero-rows__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-multiple-hero-rows__row">
				<div class="col-lg-4">
					<div class="inner">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase margin--basesm"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row module-multiple-hero-rows__row">
						<?php foreach ($args['cards'] as $key => $card): ?>
							<div class="col-md-6 col-lg-4 module-multiple-hero-rows__col">
								<div class="card<?php if($card['link']): echo " card--hover"; endif; ?> card--illustration">
									<?php if ($card['title']) : echo "<h3 class=\"epsilon epsilon--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
									<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>

									<div class="<?php if(!$card['link']): echo "card__illustration-nolink"; else: echo "card__illustration"; endif; ?>">
										<?php if ($card['image']): ?>
											<div class="card__illustration-image">
												<?php responsive_image($card['image']['id'],'100vw','120px', 'card__image fade-in'); ?>
											</div>
										<?php endif; ?>

										<?php if($card['link']): ?>
											<span class="btn btn--service card__btn"><?php echo $card['link']['title']; ?></span>
										<?php endif; ?>
									</div>

									<?php if($card['link']): ?>
										<a class="overlaylink" href="<?php echo $card['link']['url']; ?>" target="<?php echo $card['link']['target']; ?>" aria-label="Find out more about <?php echo $card['title']; ?>"><span class="visually-hidden"><?php echo $card['link']['title']; ?></span></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>