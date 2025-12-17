<?php if ($args['background']):?>
	<div class="objectfit module-content-cards__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-content-cards__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-content-cards__row">

				<div class="col-xl-3 col-xl-12">
					<div class="inner">
						<?php if ($args['headline']) : echo "<h2 class=\"epsilon epsilon--bold epsilon--uppercase margin--basesm\">" . $args['headline'] . "</h2>"; endif; ?>
					</div>
				</div>

				<div class="col-xl-9 col-xl-12">
					<div class="row module-content-cards__row">
						<div class="col-md-6 col-xxl-5 module-content-cards__col">
							<div class="card card--illustration card--illustration-content">
								<?php if ($args['headline1']) : echo "<h3 class=\"epsilon epsilon--bold color--secondary\">" . $args['headline1'] . "</h3>"; endif; ?>
								<?php if ($args['text1']) : echo "<div>" . $args['text1'] . "</div>"; endif; ?>

								<?php if ($args['links1']) : ?>
									<?php //$count = 0; foreach ($args['links1'] as $key => $link): $count++; ?>
									<?php foreach ($args['links1'] as $key => $link): ?>
										<?php if($link['link']): ?>
											<a class="btn<?php if ($link['type'] == "default"): echo " btn--default"; elseif($link['type'] == "play"): echo " btn--default-play"; else: echo " btn--default"; endif; ?>" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>" aria-label="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>

								<div class="card__illustration">
									<?php if ($args['image1']): ?>
										<div class="card__illustration-image">
											<?php responsive_image($args['image1']['id'],'100vw','120px', 'card__image fade-in'); ?>
										</div>
									<?php endif; ?>
								</div>

							</div>
						</div>

						<div class="col-md-6 col-md-6 offset-xxl-2 col-xxl-5 module-content-cards__col">
							<div class="card card--illustration card--illustration-content">
								<?php if ($args['headline2']) : echo "<h3 class=\"epsilon epsilon--bold color--secondary\">" . $args['headline2'] . "</h3>"; endif; ?>
								<?php if ($args['text2']) : echo "<div>" . $args['text2'] . "</div>"; endif; ?>

								<?php if ($args['links2']) : ?>
									<?php //$count = 0; foreach ($args['links2'] as $key => $link): $count++; ?>
									<?php foreach ($args['links2'] as $key => $link): ?>
										<?php if($link['link']): ?>
											<a class="btn<?php if ($link['type'] == "default"): echo " btn--default"; elseif($link['type'] == "play"): echo " btn--default-play"; else: echo " btn--default"; endif; ?>" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>" aria-label="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>

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
	</div>
</div>