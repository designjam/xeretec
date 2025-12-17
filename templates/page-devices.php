<?php
    $args = array(
        'cardsrow' => [],
    );

    $multipleRows = get_field('rpt_products_device');
    while(have_rows('rpt_products_device')): the_row();
        $row = [
            'headline' => get_sub_field('fld_products_headline'),
            'anchor' => sanitize_title(get_sub_field('fld_products_headline')),
            'link' => get_sub_field('fld_products_link'),
            'cards' => [],
        ];

        $multipleCards = get_sub_field('rel_products_cards');
        if($multipleCards): foreach( $multipleCards as $multipleCard ):
            $card = [
                'image' => get_field('img_product_image', $multipleCard->ID),
	            'title' => get_field('fld_product_headline', $multipleCard->ID),
	            'text' => get_field('fld_product_excerpt', $multipleCard->ID),
	            'link' => get_field('fld_product_link', $multipleCard->ID),
	            'video' => get_field('fld_product_video', $multipleCard->ID),
            ];

            $row['cards'][] = $card;
        endforeach; endif;

        $args['cardsrow'][] = $row;

    endwhile;

    if ($args['cardsrow']): $i=0
?>

	<section class="menu-jump" id="products" role="navigation" aria-label="Jump to a section of the page">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-12">
	            	<div class="menu-jump__list">
	            		<button class="menu-jump__toggle"><?php _e('Filter devices', 'Rouge'); ?><span>:</span></button>
		            	<ul class="menu-jump__reveal">
			                <?php foreach ($args['cardsrow'] as $key => $row): ?>
			                    <li class="menu-jump__item"><a class="menu-jump__link" href="#<?php echo $row['anchor']; ?>"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $row['headline']); ?></a></li>
			                <?php endforeach; ?>
			            </ul>
		            </div>
	            </div>
	        </div>
	    </div>
	</section>

	<?php reset_rows(); ?>

	<?php foreach ($args['cardsrow'] as $key => $row): $i++ ?>
		<section class="module-products padding--md <?php if($i % 2 == 0): echo "module-products--right after"; else: echo "module-products--left before"; endif; ?>" id="<?php echo $row['anchor']; ?>" role="region" aria-label="Devices">
			<div class="container">
	       		<div class="row module-products__row">
					<div class="col-xl-3">
						<div class="inner inner-spacing">
							<?php if ($row['headline']): ?><h2 class="epsilon epsilon--bold epsilon--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $row['headline']); ?></h2><?php endif; ?>
							<?php if($row['link']): ?>
								<a class="btn btn--default" href="<?php echo $row['link']['url']; ?>" target="<?php echo $row['link']['target']; ?>"><?php echo $row['link']['title']; ?></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-xl-9">
						<div class="row module-products__row module-products__slider"> <!-- SLIDER ON MOBILE ONLY -->
							<?php foreach ($row['cards'] as $key => $card): ?>
								<div class="col-md-4 module-products__slide"> <!-- SLIDER ON MOBILE ONLY --> 
									<div class="card card--product">

										<?php if($card['image']): ?>
											<?php responsive_image($card['image']['id'],'100vw','480px', 'card__image'); ?>
										<?php endif; ?>

										<div class="card__inner">
											<div class="card__content">
												<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--semibold\">" . $card['title'] . "</h3>"; endif; ?>
												<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
											</div>

											<div class="card__links">
												<?php if($card['link']): ?>
													<a class="btn btn--white" href="<?php echo $card['link']['url']; ?>" target="<?php echo $card['link']['target']; ?>"><?php echo $card['link']['title']; ?></a>
												<?php endif; ?>
												<?php if($card['video']): ?>
													<a class="btn btn--play" href="<?php echo $card['video']['url']; ?>" target="<?php echo $card['video']['target']; ?>"><span class="visually-hidden"><?php _e('Play the video', 'Rouge'); ?></span></a>
												<?php endif; ?>
											</div>

										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

<?php endif; ?>