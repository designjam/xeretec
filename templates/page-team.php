<?php
	    $args = array(
	        'cardsrow' => [],
	    );

	    $multipleRows = get_field('rpt_team_department');
	    while(have_rows('rpt_team_department')): the_row();
	        $row = [
	            'headline' => get_sub_field('fld_team_headline'),
	            'anchor' => sanitize_title(get_sub_field('fld_team_headline')),
	            'cards' => [],
	        ];

	        $multipleCards = get_sub_field('rpt_team_cards');
	        while(have_rows('rpt_team_cards')): the_row();
	            $card = [
	                'image' => get_sub_field('img_cards_image'),
	                'title' => get_sub_field('fld_cards_name'),
	                'role' => get_sub_field('fld_cards_role'),
	                'text' => get_sub_field('fld_cards_text'),
	            ];

	            $row['cards'][] = $card;
	        endwhile;

	        $args['cardsrow'][] = $row;

	    endwhile;
	?>

	<?php if ($args['cardsrow']): ?>

		<section class="menu-jump" id="team" role="navigation" aria-label="Jump to a section of the page">
		    <div class="container">
		        <div class="row">
		            <div class="offset-xl-1 col-xl-10">
		            	<ul class="menu-jump__list">
		            		<button class="menu-jump__toggle"><?php _e('Filter team members', 'Rouge'); ?><span>:</span></button>
			            	<ul class="menu-jump__reveal">
				                <?php foreach ($args['cardsrow'] as $key => $row): ?>
				                    <li class="menu-jump__item"><a class="menu-jump__link" href="#<?php echo $row['anchor']; ?>"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $row['headline']); ?></a></li>
				                <?php endforeach; ?>
				            </ul>
			            </ul>
		            </div>
		        </div>
		    </div>
		</section>

		<?php reset_rows(); ?>

		<?php $row_count = 1; ?>
		
		<?php foreach ($args['cardsrow'] as $key => $row): ?>
			<section class="module-team" id="<?php echo $row['anchor']; ?>" role="region" aria-label="Team members">

				<div class="container">
		       		<div class="row module-team__row">
						<div class="offset-xl-1 col-xl-10">
							<div class="inner">
								<?php if ($row['headline']): ?><h2 class="delta delta--bold delta--uppercase margin--basesm"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $row['headline']); ?></h2><?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<!-- TEAM REVEAL START -->
				<div class="container-fluid position-relative">
		       		<div class="row no-gutters">
		       			<div class="offset-xl-1 col-xl-10 position-static">
		       				<div class="row">

	       						<!-- DROPDOWN CONTAINER -->
								<div class="module-team__grid">
			
									<?php $card_count = 1; ?>
									<?php foreach ($row['cards'] as $key => $card): ?>
									<?php $id = 'module-team__card-' . $row_count . '-' . $card_count; ?>

									<!-- DROPDOWN LINK -->
									<div class="module-team__card module-team__card--closed" data-team_id="team-<?php echo $id; ?>">

										<!-- CARD -->
										<div class="card card--profile">
											<?php if ($card['image']): ?>
												<?php responsive_image($card['image']['id'],'100vw','480px', 'card__image'); ?>
											<?php endif; ?>
											<div class="card__inner">
												<?php if ($card['title']) : echo "<h3 class=\"epsilon epsilon--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
												<?php if ($card['role']) : echo "<h4 class=\"zeta zeta--semibold\">" . $card['role'] . "</h4>"; endif; ?>
												<button class="btn btn--profile" type="button">
			                                    	<span class="visually-hidden"><?php _e('Toggle the profile', 'Rouge'); ?></span>
			                                    </button>
											</div>
										</div>

		                            </div>


		                            <!-- DROPDOWN -->
		                            <div class="module-team__dropdown" id="team-<?php echo $id; ?>">
		                            	<!-- CARD CONTENT -->
										<div class="module-team__dropdown-content">
											<div class="module-team__dropdown-inner">
												<?php if ($card['image']):?>
													<div class="objectfit module-team__background">
														<?php responsive_image_nolazy($card['image']['id'],'100vw','800px', ''); ?>
													</div>
												<?php endif; ?>
												<div class="offset-lg-5 col-lg-7 offset-xl-6 col-xl-6 padding--lg">
													<div class="inner">
					                                    <?php if ($card['title']) : echo "<h5 class=\"epsilon epsilon--bold color--secondary\">" . $card['title'] . "</h5>"; endif; ?>
					                                    <?php if ($card['role']) : echo "<h6 class=\"zelta zelta--semibold\">" . $card['role'] . "</h6>"; endif; ?>
					                                    <?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
					                            	</div>
												</div>
											</div>
										</div>
									</div>

		            				<?php $card_count++; endforeach; ?>

		            			</div>

							</div>
						</div>
					</div>
				</div>
				<!-- TEAM REVEAL END -->

			</section>
		<?php $row_count++; endforeach; ?>

	<?php endif; ?>