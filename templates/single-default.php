<?php if($args['text']): ?>
	<section class="single" id="post" role="region" aria-label="Article">
		<div class="container">
			<div class="row single__row">
				<div class="offset-xl-1 col-xl-10">

					<div class="row single__row"> 
						<div class="col-lg-2">
							<div class="single__share">
								<h3 class="epsilon epsilon--bold epsilon--uppercase"><span><?php _e('Share', 'Rouge'); ?></span> <?php _e('this', 'Rouge'); ?></h3>
								<?php echo get_template_part('templates/modules/module', 'share'); ?>
								<!-- <?php //if($args['link']): ?>
									<a class="btn btn--default" href="<?php //echo $args['link']['url']; ?>" target="<?php //echo $args['link']['target']; ?>"><?php //echo $args['link']['title']; ?></a>
								<?php //endif; ?> -->
							</div>
						</div>

						<div class="col-lg-10">
							<div class="inner inner-spacing">
								<p><?php _e('Publish date:', 'Rouge'); ?> <strong><?php the_time('d.m.y'); ?></strong></p>
								<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
								<?php if($args['link']): ?>
									<a class="btn btn--default" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>"><?php echo $args['link']['title']; ?></a>
								<?php endif; ?>
								<?php if ($args['text']) : echo $args['text']; endif; ?>
							</div>

							<?php if($args['video']): ?>
								<div class="single__video video">
									<div class="video__video">
										<div class="video__embed <?php if($args['thumbnail']): echo "video__poster"; endif; ?>" data-video-embed='<?php echo $args['video']; ?>'>
								    		<div class="video__trigger">
								    			<span class="video__play">
								    				<span class="visually-hidden"><?php _e('Play the video', 'Rouge'); ?></span>
								    			</span>
								    		</div>
							    			<div class="video__image" style="background-image: url('<?php echo $args['thumbnail']['url']; ?>');"></div>
							    		</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php 
	else: 
		$redirecturl = '/case-studies';
		header('Location: ' .$redirecturl);
	endif;
?>