<div class="container">
	<div class="row module-small-banner__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row no-gutters module-small-banner__row"> 
				<div class="col-md-5 col-lg-7 module-small-banner__col">
					<?php if ($args['image']):?>
						<div class="objectfit module-small-banner__background">
							<?php responsive_image($args['image']['id'],'100vw','820px','img-fluid'); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="col-md-7 col-lg-5 module-small-banner__col">
					<div class="left-animation inner inner-spacing">
						<?php if ($args['headline']) : echo "<h2 class=\"epsilon epsilon--bold color--secondary\">" . $args['headline'] . "</h2>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
						<div>
							<?php $count = 0; foreach ($args['links'] as $key => $link): $count++; ?>
								<?php if($link['link']): ?>
									<a class="btn<?php if ($count == 2): echo " btn--white-play"; else: echo " btn--white"; endif; ?>" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>" aria-label="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>