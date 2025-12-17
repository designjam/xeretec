<div class="container">
	<div class="row module-large-banner__row"> 

		<div class="col-md-6">
			<?php if ($args['image']):?>
				<div class="objectfit module-large-banner__background">
					<?php responsive_image($args['image']['id'],'100vw','880px','img-fluid'); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="col-md-6">
			<div class="left-animation inner inner-spacing">
				<?php if ($args['headline']): ?><div class="keyline-wrapper"><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2></div><?php endif; ?>
				<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
				<?php if ($args['text']) : echo $args['text']; endif; ?>
				<div>
					<?php foreach ($args['links'] as $key => $link): ?>
						<?php if($link['link']): ?>
							<a class="btn btn--white" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>" aria-label="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>
</div>