<?php if(get_post_type() == 'case_studies'): ?>

	<?php 
		$pillars = get_the_term_list($post->ID, 'pillar', ' ', ' / ', ' ');
		$logo = get_field('img_casestudy_logo', $post->ID); // Featured image
	?>
	<div class="card card--listing 123" role="article">
		<?php if(get_field('fld_casestudy_text')): ?> <!-- TEMP SOLUTION UNTIL PHASE 2 -->
			<div class="card__logo">
				<a class="overlaylink" href="<?php the_permalink(); ?>"></a>
				<?php if ($logo): ?>
					<?php responsive_image($logo['id'],'100vw','320px',''); ?>
				<?php endif; ?>
			</div>
			<div class="card__inner">
				<div class="card__content">
					<p><strong><?php the_time('d.m.y'); ?> | <?php if ($pillars): echo wp_strip_all_tags($pillars); endif;?></strong></p> 
					<h3 class="zeta zeta--semibold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if(has_excerpt()): echo the_excerpt(); endif; ?>
				</div>
				<div class="card__cta">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn--default"><?php _e('Read the case study', 'Rouge'); ?></a>
				</div>
			</div>
		<?php else: ?>
			<div class="card__logo">
				<?php if ($logo): ?>
					<?php responsive_image($logo['id'],'100vw','320px',''); ?>
				<?php endif; ?>
			</div>
			<div class="card__inner">
				<div class="card__content">
					<p><strong><?php the_time('d.m.y'); ?> | <?php if ($pillars): echo wp_strip_all_tags($pillars); endif;?></strong></p> 
					<h3 class="zeta zeta--semibold"><?php the_title(); ?></h3>
					<?php if(has_excerpt()): echo the_excerpt(); endif; ?>
				</div>
				<div class="card__cta">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn--default"><?php _e('Read the case study', 'Rouge'); ?></a>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php elseif(get_post_type() == 'partners'): ?>

	<?php 
		$logo = get_field('img_partner_logo', $post->ID);
		$url = get_field('fld_partner_link', $post->ID);
	?>

	<div class="card card--listing 456" role="article">
		<div class="card__logo">
			<?php if ($url): echo "<a href=\"" . $url['url'] . "\" target=\"" . $url['target'] . "\" class=\"overlaylink\"></a>"; endif; ?>
			<?php if ($logo): ?>
				<?php responsive_image($logo['id'],'100vw','320px',''); ?>
			<?php endif; ?>
		</div>
		<div class="card__inner">
			<div class="card__content">
				<h3 class="zeta zeta--semibold"><?php if ($url): echo "<a href=\"" . $url['url'] . "\" target=\"" . $url['target'] . "\">" . get_the_title() . "</a>"; else: echo the_title(); endif; ?></h3>
				<?php if(has_excerpt()): echo the_excerpt(); endif; ?>
			</div>
			<div class="card__cta">
				<?php if ($url): echo "<a href=\"" . $url['url'] . "\" target=\"" . $url['target'] . "\" class=\"btn btn--default\">" . $url['title'] . "</a>"; endif; ?>
			</div>
		</div>
	</div>

<?php else: ?>

	<?php 
		$types = get_the_terms($post->ID, 'type');
	?>
	<div class="card card--listing 789" role="article">
		<div class="card__image">
			<?php if (has_post_thumbnail()): ?>
				<a class="overlaylink" href="<?php the_permalink(); ?>"></a>
				<div class="objectfit">
					<?php featured_image('100vw', '480px','') ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="card__inner">
			<div class="card__content">
				<p><strong><?php the_time('d.m.y'); ?> | <?php if (!empty($types) && !is_wp_error($types)): foreach ($types as $type): echo $type->name; endforeach; endif; ?></strong></p>
				<h3 class="zeta zeta--semibold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php if(has_excerpt()): echo the_excerpt(); endif; ?>
			</div>
			<div class="card__cta">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn--default"><?php _e('Read the article', 'Rouge'); ?></a>
			</div>
		</div>
	</div>

<?php endif; ?>