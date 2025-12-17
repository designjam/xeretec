<?php
	while( have_rows('17_group') ): the_row(); 

	$links1Rpt = array();
    $links1 = get_sub_field('rpt_right_content_cards_left_links');

    foreach (($links1 ? $links1 : $links1Rpt) as $key => $link1) {
        $links1Rpt[$key]['link'] = $link1['fld_right_content_cards_link'];
        $links1Rpt[$key]['type'] = $link1['fld_right_content_cards_type'];
    }

    $links2Rpt = array();
    $links2 = get_sub_field('rpt_right_content_cards_right_links');

    foreach (($links2 ? $links2 : $links2Rpt) as $key => $link2) {
        $links2Rpt[$key]['link'] = $link2['fld_right_content_cards_link'];
        $links2Rpt[$key]['type'] = $link2['fld_right_content_cards_type'];
    }

    $args = array(
        'headline1' => get_sub_field('fld_right_content_cards_left_headline'),
        'text1' => get_sub_field('fld_right_content_cards_left_text'),
        'image1' => get_sub_field('img_right_content_cards_left_image'),
        'links1' => $links1Rpt,
        'headline2' => get_sub_field('fld_right_content_cards_right_headline'),
        'text2' => get_sub_field('fld_right_content_cards_right_text'),
        'image2' => get_sub_field('img_right_content_cards_right_image'),
        'links2' => $links2Rpt,
        'headline' => get_sub_field('fld_right_content_cards_headline'),
        'background' => get_sub_field('img_right_content_cards_background'),
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-content-cards module-content-cards--right padding--topmd padding--basesm before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'content-cards-duo', $args);
        echo "</section>";
    endif;

    endwhile;
?>