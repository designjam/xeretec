<div class="container">
	<div class="row module-partners__row">
		<div class="col-xl-3 margin--basemobile">
			<div class="inner inner-spacing">
				<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
				<?php if($args['link']): ?>
					<a class="btn btn--white" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="offset-xl-1 col-xl-8">
			<div class="module-partners__flex">
				<?php foreach ($args['partners'] as $key => $card): ?>
					<div class="card card--logo">
						<?php if ($card['image']): ?>
							<?php responsive_image($card['image']['id'],'100vw','320px', 'card__logo'); ?> <!-- BLURRED WHEN USING img-fluid -->
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>