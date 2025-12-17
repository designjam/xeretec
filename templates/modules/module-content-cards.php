<?php 
    while( have_rows('15_group') ): the_row(); 
   
	$linksRpt = array();
    $links = get_sub_field('rpt_content_cards_right_links');

    foreach (($links ? $links : $linksRpt) as $key => $link) {
        $linksRpt[$key]['link'] = $link['fld_content_cards_link'];
        $linksRpt[$key]['type'] = $link['fld_content_cards_type'];
    }

    $args = array(
        'headline1' => get_sub_field('fld_content_cards_left_headline'),
        'excerpt1' => get_sub_field('fld_content_cards_left_excerpt'),
        'text1' => get_sub_field('fld_content_cards_left_text'),
        'headline2' => get_sub_field('fld_content_cards_right_headline'),
        'text2' => get_sub_field('fld_content_cards_right_text'),
        'image2' => get_sub_field('img_content_cards_right_image'),
        'background' => get_sub_field('img_content_cards_background'),
        'links' => $linksRpt,
    );

    if($args['headline1']):
        $module_ID = sanitize_title($args['headline1']);
        echo "<section class=\"module-content-cards padding--toplg padding--basemd after\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'content-cards', $args);
        echo "</section>";
    endif;

    endwhile;
?>