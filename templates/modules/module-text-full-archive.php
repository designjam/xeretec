<?php

    if(get_post_type() == 'case_studies'):
        $args = array(
            'headline' => get_field('fld_text_casestudies_headline', 'options'),
            'excerpt' => get_field('fld_text_casestudies_excerpt', 'options'),
            'text' => get_field('fld_text_casestudies_text', 'options'),
            'link' => get_field('fld_text_casestudies_link', 'options'),
            'background' => get_field('img_text_casestudies_background', 'options'),
        );
    elseif(get_post_type() == 'partners'):
        $args = array(
            'headline' => get_field('fld_text_partners_headline', 'options'),
            'excerpt' => get_field('fld_text_partners_excerpt', 'options'),
            'text' => get_field('fld_text_partners_text', 'options'),
            'link' => get_field('fld_text_partners_link', 'options'),
            'background' => get_field('img_text_partners_background', 'options'),
        );
    else:
        $args = array(
            'headline' => get_field('fld_text_insights_headline', 'options'),
            'excerpt' => get_field('fld_text_insights_excerpt', 'options'),
            'text' => get_field('fld_text_insights_text', 'options'),
            'link' => get_field('fld_text_insights_link', 'options'),
            'background' => get_field('img_text_insights_background', 'options'),
        );
    endif;

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-text padding--lg before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'text-full', $args);
        echo "</section>";
    endif; 
?>