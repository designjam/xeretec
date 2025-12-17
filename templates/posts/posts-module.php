<?php $types = get_the_terms($post->ID, 'type'); ?>
<div class="card card--blog" role="article">
	<div class="card__inner">
		<strong><?php if (!empty($types) && !is_wp_error($types)): foreach ($types as $type): echo "<span class=\"icon icon--" . $type->slug . "\"></span>" . $type->name . "."; endforeach; endif; ?>
		<?php if(get_post_type() == 'case_studies'): echo "<span class=\"icon icon--casestudy\"></span> Case Study."; endif; ?> <?php the_time('d.m.y'); ?></strong>
		<?php if ($types && $types[0]->slug != 'twitter'): ?>
			<h3 class="zeta zeta--semibold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php elseif(get_post_type() == 'case_studies'): ?>
			<h3 class="zeta zeta--semibold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php endif; ?>
		<?php if ($types && $types[0]->slug == 'twitter'): echo the_excerpt(); endif; ?>
		<span class="btn btn--blog"></span>
		<a href="<?php the_permalink(); ?>" class="overlaylink" aria-label="Read the article: <?php the_title(); ?>"><span class="visually-hidden"><?php _e('Read more', 'Rouge'); ?></span></a>
	</div>
	<div class="objectfit card__background">
		<?php featured_image('100vw','480px', 'img-fluid') ?>
	</div>
</div>