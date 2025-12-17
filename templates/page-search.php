<section class="module-hero module-hero--default" role="banner">
	<div class="container">
		<div class="row module-hero__row"> 
			<div class="offset-lg-1 col-lg-11">
				<div class="inner inner-spacing">
					<h1 class="beta beta--extrabold beta--uppercase"><span><?php _e('Search ','theme-text-translations');?></span> <?php _e('results ','theme-text-translations');?></h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page-search" role="region" aria-label="Search results">
	<div class="container">
		<div class="row">
			<?php if (have_posts()): ?>

				<div class="offset-lg-1 col-lg-11">
					<?php while (have_posts()) : the_post(); ?>
						<div class="inner inner-spacing">
							<h3 class="zeta zeta--bold"><?php the_title(); ?></h3>
							<?php if (has_excerpt()): echo the_excerpt(); endif; ?>
							<a class="btn btn--default" href="<?php the_permalink(); ?>"><?php _e('Read more', 'Rouge'); ?></a>
							<div class="divider"></div>
						</div>
					<?php endwhile; ?>
				</div>

				<?php
					echo "<div class=\"offset-lg-1 col-lg-10 pagination\">";
					the_posts_pagination( array(
						'screen_reader_text' => ' ', 
						'prev_text'          => __( '<span>Previous</span> <', 'Rouge' ),
						'next_text'          => __( '<span>Next</span> >', 'Rouge' )
					));
					echo "</div>";
				?>

			<?php else: ?>

				<div class="offset-lg-1 col-lg-10">
					<?php _e('No results found. Please try a different search.','theme-text-translations'); ?></div>
				</div>

			<?php endif; ?>

		</div>
	</div>
</section>