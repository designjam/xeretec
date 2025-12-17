<section class="module-blog padding--md" role="complementary" id="blog" aria-label="Articles">
	<div class="container">
		<div class="row module-blog__row">
			<div class="col-xl-9">
				<div class="row module-blog__row">
					<?php 
				        if( $args['related'] ):
				        	global $post;
				            foreach( $args['related'] as $post ):
				            	setup_postdata( $post );
				            	echo "<div class=\"col-md-6 col-xl-4 module-blog__col\">";
					            echo get_template_part('templates/posts/posts', 'module');
					            echo "</div>";
				            endforeach;
							wp_reset_postdata();
				        // else:
				        //     $post = array(
				        //         'post_type'         => 'post',
				        //         'posts_per_page'    => 3,
				        //         'order'             => 'DESC',
				        //         'orderby'           => 'publish_date',
				        //     );
				        //     $query = new WP_Query($post);
				        //     while ( $query->have_posts() ) : $query->the_post();
				        //     	echo "<div class=\"col-md-6 col-xl-4 cards\">";
				        //         echo get_template_part('templates/posts/posts', 'blog');
				        //         echo "</div>";
				        //     endwhile; wp_reset_postdata(); wp_reset_query();
				        endif;
					?>
				</div>
			</div>

			<div class="col-xl-3">
				<div class="inner inner-spacing">
					<?php if ($args['headline']): ?><h2 class="epsilon epsilon--bold epsilon--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
					<?php if($args['link']): ?>
						<a class="btn btn--default" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		
		</div>
	</div>
</section>