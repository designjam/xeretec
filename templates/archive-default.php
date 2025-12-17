<?php
	if(get_post_type() == 'case_studies'):

		global $paged;

		$args = array(
			'post_type' => 'case_studies',
		);

		$args['search_filter_id'] = 866;


	elseif(get_post_type() == 'partners'):

		global $paged;

		$args = array(
			'post_type' => 'partners',
		);

		$args['search_filter_id'] = 879;

	else:

		$args = array(
			'post_type' => 'post',
		);

		$args['search_filter_id'] = 876;

	endif;

	$query = new WP_Query($args);
?>

	<section class="page-listing" id="listing" role="region" aria-label="Articles listing page">
		<div class="container">
			<div class="row listing__row" id="posts-results">
				<div class="offset-xl-1 col-xl-10">
					<div class="form form--filter">
						<?php
							global $searchandfilter;
							$sf_current_query = $searchandfilter->get($args['search_filter_id'])->current_query();
							$array = $sf_current_query->get_array();

							if (isset($array["_sft_pillar"]["active_terms"][0]["name"])){
								$selected = $array["_sft_pillar"]["active_terms"][0]["name"];
								echo "<h3 class=\"zeta zeta--semibold zeta--uppercase\">" . $selected . "</h3>";
							} else {
								echo "<h3 class=\"zeta zeta--semibold zeta--uppercase\"></h3>";
							}
			
						?>
						<?php echo do_shortcode("[searchandfilter id='" . $args['search_filter_id'] . "']"); ?>
					</div>
				</div>
				<div class="offset-xl-1 col-xl-10">
					<div class="row listing__row">
						<?php
							if ($query->have_posts()):
								while ($query->have_posts()): $query->the_post();
									echo "<div class=\"col-md-6 col-xl-4\">";
									echo get_template_part('templates/posts/posts', 'listing');
									echo "</div>";
								endwhile;
							else:
								echo "<div class=\"col-md-12\">";
								echo "No posts found";
								echo "</div>";
							endif; 
						?>

						<?php
							$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
							if ($query->max_num_pages > 1):
								echo "<div class=\"col-xl-12\">";
								the_posts_pagination( array(
									'screen_reader_text' => ' ', 
									'prev_text'          => __( '<span>Previous</span> <', 'Rouge' ),
									'next_text'          => __( '<span>Next</span> >', 'Rouge' )
								));
								echo "</div>";
							endif;
						?>

						<?php wp_reset_postdata(); wp_reset_query(); ?>

					</div>
				</div>
			</div>
		</div>
	</section>