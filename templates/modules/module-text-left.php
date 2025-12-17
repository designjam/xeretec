<?php 
    $args = array(
        'headline' => get_field('fld_text_left_headline'),
        'excerpt' => get_field('fld_text_left_excerpt'),
        'text' => get_field('fld_text_left_text'),
        'link' => get_field('fld_text_left_link'),
        'background' => get_field('img_text_left_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-text padding--lg before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'text', $args);
        echo "</section>";
    endif;
?>