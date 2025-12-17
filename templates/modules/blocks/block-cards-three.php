<?php if ($args['background']): ?>
	<div class="objectfit module-multiple-rows__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-multiple-rows__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-multiple-rows__row flex--vcenter">

				<div class="col-lg-4 margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
					</div>
				</div>

				<div class="col-lg-8 offset-xl-1 col-xl-7">
					<div class="row module-multiple-rows__row">
						<?php foreach ($args['cards'] as $key => $card): ?>
							<div class="col-md-4 module-multiple-rows__col">
								<div class="card">
									<?php if ($card['title']) : echo "<h4 class=\"zeta zeta--bold\">" . $card['title'] . "</h4>"; endif; ?>
									<?php if ($card['highlight']) : echo "<h5 class=\"delta delta--bold color--secondary fade-in\">" . $card['highlight'] . "</h5>"; endif; ?>
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