<?php 
	$teamsRpt = array();
    $team_members = get_field('rpt_team_cards');

    foreach (($team_members ? $team_members : $teamsRpt) as $key => $team_member) {
        $teamsRpt[$key]['title'] = $team_member['fld_cards_title'];
        $teamsRpt[$key]['text'] = $team_member['fld_cards_text'];
        $teamsRpt[$key]['image'] = $team_member['img_cards_image'];
    }

    $args = array(
        'headline' => get_field('fld_team_headline'),
        'teams' => $teamsRpt,
    );

    if($team_members):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-team padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'team', $args);
        echo "</section>";
    endif; 
?>