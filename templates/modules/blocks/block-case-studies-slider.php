<div class="module-casestudies-slider__slide">
	<?php if ($args['background']) : ?>
		<div class="objectfit module-casestudies-slider__background">
			<?php responsive_image($args['background']['id'], '100vw', '1920px', ''); ?>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row module-casestudies-slider__row">
			<div class="col-lg-6 offset-lg-6 col-xl-5 offset-xl-7">
				<div class="inner">
					<?php if ($args['quotation']) : echo "<blockquote>" . $args['quotation'] . "</blockquote>";
					endif; ?>
					<?php if ($args['logo']) : ?>
						<?php responsive_image($args['logo']['id'], '100vw', '320px', ''); ?>
					<?php endif; ?>
					<div class="module-casestudies-slider__footer">
						<?php if ($args['author'] || $args['position']) : echo "<div><strong>" . $args['author'] . "</strong>" . $args['position'] . "</div>";
						endif; ?>

						<?php if ($args['text']) : ?> <!-- TEMP SOLUTION UNTIL PHASE 2 -->
							<a class="btn btn--white" href="<?php echo $args['permalink']; ?>"><?php _e('Read more', 'theme-text-translations'); ?></a>
						<?php elseif ($args['cta']) : ?>
							<a class="btn btn--white" href="<?php echo $args['cta']['url']; ?>"><?php echo $args['cta']['title'] ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>