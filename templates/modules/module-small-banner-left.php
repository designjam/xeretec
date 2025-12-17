<?php 
    $linksRpt = array();
    $links = get_field('rpt_sml_banner_left_links');

    foreach (($links ? $links : $linksRpt) as $key => $link) {
        $linksRpt[$key]['link'] = $link['fld_sml_banner_link'];
    }

    $args = array(
        'headline' => get_field('fld_sml_banner_left_headline'),
        'excerpt' => get_field('fld_sml_banner_left_excerpt'),
        'text' => get_field('fld_sml_banner_left_text'),
        'image' => get_field('img_sml_banner_left_image'),
        'links' => $linksRpt,
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-small-banner\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'small-banner', $args);
        echo "</section>";
    endif; 
?>