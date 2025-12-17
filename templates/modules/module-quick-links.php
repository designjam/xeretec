<?php 
	$quicklinksRpt = array();
    $quicklinks = get_field('rpt_quick_links_cards');

    foreach (($quicklinks ? $quicklinks : $quicklinksRpt) as $key => $quicklink) {
        $quicklinksRpt[$key]['image'] = $quicklink['img_cards_image'];
        $quicklinksRpt[$key]['title'] = $quicklink['fld_cards_title'];
        $quicklinksRpt[$key]['text'] = $quicklink['fld_cards_text'];
        $quicklinksRpt[$key]['link'] = $quicklink['fld_cards_link'];
    }

    $args = array(
        'headline' => get_field('fld_quick_links_headline'),
        'quicklinks' => $quicklinksRpt,
    );

    if($quicklinks):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-quick-links module-quick-links--right padding--md before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'quick-links', $args);
        echo "</section>";
    endif;
?>