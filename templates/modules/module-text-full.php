<?php 
	$args = array(
        'headline' => get_field('fld_text_headline'),
        'excerpt' => get_field('fld_text_excerpt'),
        'text' => get_field('fld_text_text'),
        'link' => get_field('fld_text_link'),
        'background' => get_field('img_text_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-text module-text--full padding--lg before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'text-full', $args);
        echo "</section>";
    endif; 
?>