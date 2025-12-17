<?php 
	$args = array(
        'headline' => get_field('fld_multiple_hero_headline'),
        'excerpt' => get_field('fld_multiple_hero_excerpt'),
        'text' => get_field('fld_multiple_hero_text'),
        'cardsrow' => [],
    );

    $multipleRows = get_field('rpt_multiple_hero_rows');
    while(have_rows('rpt_multiple_hero_rows')): the_row();
        $row = [
            'title' => get_sub_field('fld_multiple_hero_title'),
            'cards' => [],
        ];

        $multipleCards = get_sub_field('rpt_multiple_hero_cards');
        while(have_rows('rpt_multiple_hero_cards')): the_row();
            $card = [
                'title' => get_sub_field('fld_cards_title'),
                'text' => get_sub_field('fld_cards_text'),
                'link' => get_sub_field('fld_cards_link'),
                'image' => get_sub_field('img_cards_image'),
            ];

            $row['cards'][] = $card;
        endwhile;

        $args['cardsrow'][] = $row;

    endwhile;

    $module_ID = sanitize_title($args['headline']);
    if($args['headline']):
        echo "<section class=\"module-multiple-hero-rows padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'multiple-hero-rows', $args);
        echo "</section>";
    endif;

?>