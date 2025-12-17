<?php if ($args['background']):?>
	<div class="objectfit module-content-cards__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-content-cards__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-content-cards__row">

				<div class="col-md-6 col-xl-5 col-xxl-5 margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline1']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline1']); ?></h2><?php endif; ?>
						<?php if ($args['excerpt1']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt1'] . "</h3>"; endif; ?>
						<?php if ($args['text1']) : echo "<div>" . $args['text1'] . "</div>"; endif; ?>
					</div>
				</div>

				<div class="col-md-6 offset-xl-1 col-xl-6 offset-xxl-2 col-xxl-5 module-content-cards__col">
					<div class="card card--illustration card--illustration-content">
						<?php if ($args['headline2']) : echo "<h4 class=\"epsilon epsilon--bold color--secondary\">" . $args['headline2'] . "</h4>"; endif; ?>
						<?php if ($args['text2']): echo "<div>" . $args['text2'] . "</div>"; endif; ?>
						<?php //$count = 0; foreach ($args['links'] as $key => $link): $count++; ?>
						<?php foreach ($args['links'] as $key => $link): ?>
							<?php if($link['link']): ?>
								<a class="btn<?php if ($link['type'] == "default"): echo " btn--default"; elseif($link['type'] == "play"): echo " btn--default-play"; else: echo " btn--default"; endif; ?>" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>" aria-label="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
							<?php endif; ?>
						<?php endforeach; ?>

						<div class="card__illustration">
							<?php if ($args['image2']): ?>
								<div class="card__illustration-image">
									<?php responsive_image($args['image2']['id'],'100vw','120px', 'card__image fade-in'); ?>
								</div>
							<?php endif; ?>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>