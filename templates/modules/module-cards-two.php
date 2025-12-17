<?php 
	$cardsRpt = array();
    $cards = get_field('rpt_2card_rows');

    foreach (($cards ? $cards : $cardsRpt) as $key => $card) {
        $cardsRpt[$key]['image'] = $card['img_cards_image'];
        $cardsRpt[$key]['title'] = $card['fld_cards_title'];
        $cardsRpt[$key]['highlight'] = $card['fld_cards_highlight'];
        $cardsRpt[$key]['text'] = $card['fld_cards_text'];
    }

    $args = array(
        'headline' => get_field('fld_2card_headline'),
        'excerpt' => get_field('fld_2card_excerpt'),
        'text' => get_field('fld_2card_text'),
        'background' => get_field('img_2card_background'),
        'cards' => $cardsRpt,
    );

    if($cards):
        $module_ID = sanitize_title($args['headline']);
        if ($args['background'] && $args['headline']):
            echo "<section class=\"module-multiple-rows module-multiple-rows--dark padding--lg after\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'cards-two', $args);
            echo "</section>";
        elseif ($args['headline']):
            echo "<section class=\"module-multiple-rows padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'cards-two', $args);
            echo "</section>";
        endif;
    endif; 
?>