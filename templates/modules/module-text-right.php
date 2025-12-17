<?php 
	$args = array(
        'headline' => get_field('fld_text_right_headline'),
        'excerpt' => get_field('fld_text_right_excerpt'),
        'text' => get_field('fld_text_right_text'),
        'link' => get_field('fld_text_right_link'),
        'background' => get_field('img_text_right_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-text module-text--right padding--lg after\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'text', $args);
        echo "</section>";
    endif; 
?>