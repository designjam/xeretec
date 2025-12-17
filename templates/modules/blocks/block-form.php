<?php if ($args['background']): ?>
	<div class="objectfit module-form__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>

<div class="container">
	<div class="row module-form__row"> 
		<div class="offset-xl-1 col-xl-10">
			<div class="row module-form__row"> 
				<div class="col-md-6 <?php if ($args['type'] == 'gated' || $args['type'] == 'ondemand'): echo "col-xl-5"; else: echo "col-xl-3"; endif;?> margin--basemobile">
					<div class="inner inner-spacing">
						<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
						<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
						<?php if ($args['text']) : echo $args['text']; endif; ?>
					</div>
				</div>

				<div class="col-md-6 <?php if ($args['type'] == 'gated' || $args['type'] == 'ondemand'): echo "offset-xl-1 col-xl-6"; else: echo "offset-xl-1 col-xl-8"; endif;?>">
					<div class="form form--contact">

						<?php if ($args['gated']): ?>
		                	<script>
			                    jQuery(document).ready(function () {
			                        jQuery('input#field_gated').val('<?php echo $args['gated']; ?>');
			                    });
			                </script>
		            	<?php endif; ?>

		            	<?php if ($args['ondemand']): ?>
		                	<script>
			                    jQuery(document).ready(function () {
			                        jQuery('input#field_ondemand').val('<?php echo $args['ondemand']; ?>');
			                    });
			                </script>
		            	<?php endif; ?>

		            	<?php if ($args['type'] == 'gated'): ?>
		            		<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 2, 'title' => false, 'description' => false ) ); ?>
		            	<?php elseif($args['type'] == 'ondemand'): ?>
		            		<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 3, 'title' => false, 'description' => false ) ); ?>
		            	<?php elseif($args['type'] == 'standard'): ?>
		            		<?php echo FrmFormsController::get_form_shortcode( array( 'id' => $args['form'], 'title' => false, 'description' => false ) ); ?>
		            	<?php elseif($args['type'] == 'hubspot'): ?>
		            		<?php echo $args['hubspot']; ?>
		            	<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>