<div class="container">
	<div class="row module-features__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-features__row">

				<div class="col-md-12 col-lg-3 margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="epsilon epsilon--bold epsilon--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="row module-features__row">
						<?php foreach ($args['features'] as $key => $card): ?>
							<div class="col-md-4 module-features__col">
								<div class="card card--feature card--illustration card--illustration-top-right-lg">
									<div class="card__illustration">
										<?php if ($card['image']): ?>
											<div class="card__illustration-image">
												<?php responsive_image($card['image']['id'],'100vw','120px', 'card__image fade-in'); ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="card__inner">
										<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--semibold\">" . $card['title'] . "</h3>"; endif; ?>
										<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>