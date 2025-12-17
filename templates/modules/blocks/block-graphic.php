<section class="module-graphic" role="presentation" id="graphic">
	<div class="container">
		<div class="row no-gutters module-graphic__row"> 
			<div class="col">
				<?php if ($args['image']):?>
					<?php responsive_image($args['image']['id'],'100vw','1920px', 'img-fluid'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>