<?php 
	$args = array(
        'headline' => get_field('fld_headline_headline'),
        'link' => get_field('fld_headline_link'),
        'background' => get_field('img_headline_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-headline padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'headline', $args);
        echo "</section>";
    endif;
?>