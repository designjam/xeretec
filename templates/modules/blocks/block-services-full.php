<div class="container">
	<div class="row module-services__row">

		<div class="col-lg-12">
			<div class="inner">
				<h2 class="epsilon epsilon--bold epsilon--uppercase epsilon--center margin--basesm"><?php if (is_404() || is_search()): echo "Looking for a Service?"; elseif ($args['headline']) : echo $args['headline']; endif; ?></h2>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="row module-services__row">
				<?php foreach ($args['services'] as $key => $card): ?>
					<div class="col-md-4 col-xl-2 module-services__col">
						<div class="card card--hover card--illustration card--illustration-stacked">
							<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>

							<div class="card__illustration">
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