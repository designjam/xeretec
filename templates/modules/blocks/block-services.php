<div class="container">
	<div class="row module-services__row flex--vcenter">

		<div class="col-lg-12 col-xl-3 margin--basemobile">
			<div class="inner inner-spacing">
				<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
				<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
			</div>
		</div>

		<div class="col-lg-12 col-xl-9">
			<div class="row module-services__row">
				<?php foreach ($args['services'] as $key => $card): ?>
					<div class="col-md-6 col-lg-4 module-services__col">
						<div class="card card--hover card--illustration">
							<?php if ($card['title']) : echo "<h4 class=\"epsilon epsilon--bold color--tertiary\">" . $card['title'] . "</h4>"; endif; ?>
							<!-- HIDDEN UNTIL HOVER -->
							<?php if ($card['text']) : echo "<div class=\"card__hidden\">" . $card['text'] . "</div>"; endif; ?>

							<div class="card__illustration">
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