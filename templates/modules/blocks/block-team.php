<div class="container">
	<div class="row module-team__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-team__row">
				<div class="col-md-12">
					<div class="inner">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase margin--basesm"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row module-team__row">
						<?php foreach ($args['teams'] as $key => $card): ?>
							<div class="col-md-4 module-team__col">
								<div class="card card--team">
									<?php if ($card['image']): ?>
										<?php responsive_image($card['image']['id'],'100vw','480px', 'card__image'); ?>
									<?php endif; ?>
									<div class="card__inner">
										<?php if ($card['title']) : echo "<h3 class=\"epsilon epsilon--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
										<?php if ($card['text']) : echo "<h4 class=\"zeta zeta--semibold\">" . $card['text'] . "</h4>"; endif; ?>
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