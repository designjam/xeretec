<?php 
	$careersRpt = array();
    $careers = get_field('rpt_careers_cards');

    foreach (($careers ? $careers : $careersRpt) as $key => $career) {
        $careersRpt[$key]['title'] = $career['fld_careers_title'];
        $careersRpt[$key]['location'] = $career['fld_careers_location'];
        $careersRpt[$key]['salary'] = $career['fld_careers_salary'];
        $careersRpt[$key]['text'] = $career['fld_careers_text'];
        $careersRpt[$key]['link'] = $career['fld_careers_link'];
    }

    $args = array(
        'format' => get_field('fld_careers_format'),
        'careers' => $careersRpt,
    );

    if($careers):
        echo get_template_part('templates/modules/blocks/block', 'careers', $args);
    endif;
?>