<?php 
	$featuresRpt = array();
    $features = get_field('rpt_features_cards');

    foreach (($features ? $features : $featuresRpt) as $key => $feature) {
        $featuresRpt[$key]['image'] = $feature['img_cards_image'];
        $featuresRpt[$key]['title'] = $feature['fld_cards_title'];
        $featuresRpt[$key]['text'] = $feature['fld_cards_text'];
    }

    $args = array(
        'headline' => get_field('fld_features_headline'),
        'features' => $featuresRpt,
    );

    if($features):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-features padding--topsm padding--basemd before\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'features', $args);
        echo "</section>";
    endif; 
?>