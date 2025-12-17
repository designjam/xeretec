<div class="container">
	<div class="row module-outcomes__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-outcomes__row">
				<div class="col-lg-5">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="module-outcomes__flex">
						<?php foreach ($args['outcomes'] as $key => $card): ?>
							<div class="card card--illustration card--illustration-top-right-sm">
								<div class="card__illustration">
									<?php if ($card['image']): ?>
										<div class="card__illustration-image">
											<?php responsive_image($card['image']['id'],'100vw','120px', 'card__image fade-in'); ?>
										</div>
									<?php endif; ?>
								</div>
								<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
								<?php if ($card['highlight']) : echo "<h4 class=\"delta delta--bold color--secondary fade-in\">" . $card['highlight'] . "</h4>"; endif; ?>
								<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>