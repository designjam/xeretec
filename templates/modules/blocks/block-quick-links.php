<div class="container">
	<div class="row module-quick-links__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-quick-links__row">
				<div class="col-md-12">
					<div class="inner">
						<?php if ($args['headline']) : echo "<h2 class=\"epsilon epsilon--bold epsilon--uppercase margin--basesm\">" . $args['headline'] . "</h2>"; endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row module-quick-links__row">
						<?php foreach ($args['quicklinks'] as $key => $card): ?>
							<div class="col-md-6 col-lg-3 module-quick-links__col">
								<div class="card<?php if($card['link']): echo " card--hover"; endif; ?> card--illustration card--illustration-right"> 
									<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
									<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>

									<div class="<?php if(!$card['link']): echo "card__illustration-nolink"; else: echo "card__illustration"; endif; ?>">
										<?php if($card['link']): ?>
											<span class="btn btn--arrow card__btn"></span>
										<?php endif; ?>
										<?php if ($card['image']): ?>
											<div class="card__illustration-image">
												<?php responsive_image($card['image']['id'],'100vw','120px', 'card__image fade-in'); ?>
											</div>
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