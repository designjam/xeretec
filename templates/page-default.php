<?php
    $args = array(
    	'text' => get_field('fld_default_text'),
    );

    if ($args['text']):
?>
	<section class="page-default" id="content" role="region" aria-label="Page content">
		<div class="container">
       		<div class="row">
				<div class="offset-xl-1 col-xl-10">
					<div class="inner inner-spacing">
						<?php echo $args['text']; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>