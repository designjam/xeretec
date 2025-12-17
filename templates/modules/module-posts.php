<?php 
	$args = array(
        'headline' => get_field('fld_blog_title'),
        'link' => get_field('fld_blog_link'),
        'related' => get_field('rel_related_posts'),
    );
    if($args['headline']):
        echo get_template_part('templates/modules/blocks/block', 'posts', $args);
	endif;
?>