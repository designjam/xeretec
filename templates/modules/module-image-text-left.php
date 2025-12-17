<?php 
	$imagesRpt = array();
    $images = get_field('rpt_image_text_left_rows');

    foreach (($images ? $images : $imagesRpt) as $key => $image) {
        $imagesRpt[$key]['image'] = $image['img_image_text_image'];
        $imagesRpt[$key]['text'] = $image['fld_image_text_text'];
        $imagesRpt[$key]['link'] = $image['fld_image_text_link'];
    }

    $args = array(
        'headline' => get_field('fld_image_text_left_headline'),
        'excerpt' => get_field('fld_image_text_left_excerpt'),
        'text' => get_field('fld_image_text_left_text'),
        'link' => get_field('fld_image_text_left_link'),
        'background' => get_field('img_image_text_left_background'),
        'images' => $imagesRpt,
    );

    if($images):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-image-text padding--lg before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'image-text-left', $args);
        echo "</section>";
    endif; 
?>