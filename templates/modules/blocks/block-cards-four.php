<?php if ($args['background']): ?>
	<div class="objectfit module-multiple-rows__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-multiple-rows__row">
		<div class="offset-lg-1 col-lg-10 offset-xl-2 col-xl-8">
			<div class="row module-multiple-rows__row">
				<div class="col-lg-12">
					<div class="inner">
						<?php if ($args['headline']) : echo "<h2 class=\"epsilon epsilon--bold epsilon--uppercase margin--basesm\">" . $args['headline'] . "</h2>"; endif; ?>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row module-multiple-rows__row">
						<?php foreach ($args['cards'] as $key => $card): ?>
							<div class="col-md-6 col-lg-3 module-multiple-rows__col">
								<div class="card">
									<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold\">" . $card['title'] . "</h3>"; endif; ?>
									<?php if ($card['highlight']) : echo "<h4 class=\"delta delta--bold color--secondary fade-in\">" . $card['highlight'] . "</h4>"; endif; ?>
									<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>