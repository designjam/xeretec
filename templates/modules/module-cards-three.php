<?php 
	$cardsRpt = array();
    $cards = get_field('rpt_3card_rows');

    foreach (($cards ? $cards : $cardsRpt) as $key => $card) {
        $cardsRpt[$key]['title'] = $card['fld_cards_title'];
        $cardsRpt[$key]['highlight'] = $card['fld_cards_highlight'];
        $cardsRpt[$key]['text'] = $card['fld_cards_text'];
    }

    $args = array(
        'headline' => get_field('fld_3card_headline'),
        'excerpt' => get_field('fld_3card_excerpt'),
        'text' => get_field('fld_3card_text'),
        'background' => get_field('img_3card_background'),
        'cards' => $cardsRpt,
    );

    if($cards):
        $module_ID = sanitize_title($args['headline']);
        if ($args['background'] && $args['headline']):
            echo "<section class=\"module-multiple-rows module-multiple-rows--dark padding--lg after\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'cards-three', $args);
            echo "</section>";
        elseif ($args['headline']):
            echo "<section class=\"module-multiple-rows padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'cards-three', $args);
            echo "</section>";
        endif;
    endif; 
?>