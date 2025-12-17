<?php 
	$cardsRpt = array();
    $cards = get_field('rpt_hero_2card_rows');

    foreach (($cards ? $cards : $cardsRpt) as $key => $card) {
        $cardsRpt[$key]['title'] = $card['fld_cards_title'];
        $cardsRpt[$key]['text'] = $card['fld_cards_text'];
        $cardsRpt[$key]['link'] = $card['fld_cards_link'];
        $cardsRpt[$key]['image'] = $card['img_cards_image'];
    }

    $args = array(
        'headline' => get_field('fld_hero_2card_headline'),
        'excerpt' => get_field('fld_hero_2card_excerpt'),
        'text' => get_field('fld_hero_2card_text'),
        'cards' => $cardsRpt,
    );

    if($cards):	
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-multiple-hero-rows padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'hero-cards-two', $args);
        echo "</section>";
    endif; 
?>