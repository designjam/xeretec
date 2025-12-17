<?php 
    $linksRpt = array();
    $links = get_field('rpt_banner_left_links');

    foreach (($links ? $links : $linksRpt) as $key => $link) {
        $linksRpt[$key]['link'] = $link['fld_banner_link'];
    }

    $args = array(
        'headline' => get_field('fld_banner_left_headline'),
        'excerpt' => get_field('fld_banner_left_excerpt'),
        'text' => get_field('fld_banner_left_text'),
        'image' => get_field('img_banner_left_image'),
        'links' => $linksRpt,
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-large-banner\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'large-banner', $args);
        echo "</section>";
    endif;
?>