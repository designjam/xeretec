<?php 
	$args = array(
        'headline' => get_field('fld_video_headline'),
        'excerpt' => get_field('fld_video_excerpt'),
        'text' => get_field('fld_video_text'),
        'video' => get_field('fld_video_embed'),
        'thumbnail' => get_field('fld_video_thumbnail'),
        'background' => get_field('img_video_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-video padding--lg after\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'video', $args);
        echo "</section>";
    endif; 
?>