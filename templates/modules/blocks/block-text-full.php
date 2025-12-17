<?php if ($args['background']):?>
	<div class="objectfit module-text__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-text__row">
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-text__row">
				<div class="col-lg-6 margin--basemobile">
					<div class="left-animation inner inner-spacing flex--spacebetween">
						<?php if ($args['headline']): ?><div class="keyline-wrapper"><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2></div><?php endif; ?>
						<?php if($args['link']): ?>
							<a class="btn btn--white" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="left-animation inner inner-spacing">
						<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
						<?php if($args['link']): ?>
							<a class="btn btn--white btn--mobile" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>