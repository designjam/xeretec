<?php if ($args['background']): ?>
	<div class="objectfit module-video__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>

<div class="container">
	<div class="row module-video__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-video__row flex--vcenter"> 
				<div class="col-md-6 col-lg-5 col-xl-4 margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
					</div>
				</div>

				<div class="col-md-6 offset-lg-1 col-lg-6 offset-xl-2 col-xl-6 offset-xxl-3 col-xxl-5">
					<div class="video">
						<div class="video__video">
							<div class="video__embed <?php if($args['thumbnail']): echo "video__poster"; endif; ?>" data-video-embed='<?php echo $args['video']; ?>'>
					    		<div class="video__trigger">
					    			<span class="video__play">
					    				<span class="visually-hidden"><?php _e('Play the video', 'Rouge'); ?></span>
					    			</span>
					    		</div>
				    			<div class="video__image" style="background-image: url('<?php echo $args['thumbnail']['url']; ?>');"> </div>
				    		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>