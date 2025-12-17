<?php 
	$outcomesRpt = array();
    $outcomes = get_field('rpt_outcome_cards');

    foreach (($outcomes ? $outcomes : $outcomesRpt) as $key => $outcome) {
        $outcomesRpt[$key]['image'] = $outcome['img_cards_image'];
        $outcomesRpt[$key]['title'] = $outcome['fld_cards_title'];
        $outcomesRpt[$key]['highlight'] = $outcome['fld_cards_highlight'];
        $outcomesRpt[$key]['text'] = $outcome['fld_cards_text'];
    }

    $args = array(
        'headline' => get_field('fld_outcome_headline'),
        'text' => get_field('fld_outcome_text'),
        'outcomes' => $outcomesRpt,
    );

    if($outcomes):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-outcomes padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'outcomes', $args);
        echo "</section>";
    endif;
?>