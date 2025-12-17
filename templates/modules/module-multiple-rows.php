<?php 
	$args = array(
        'headline' => get_field('fld_multiple_headline'),
        'excerpt' => get_field('fld_multiple_excerpt'),
        'text' => get_field('fld_multiple_text'),
        'link' => get_field('fld_multiple_link'),
        'background' => get_field('img_multiple_background'),
        'cardsrow' => [],
    );

    $multipleRows = get_field('rpt_multiple_rows');
    while(have_rows('rpt_multiple_rows')): the_row();
        $row = [
            'title' => get_sub_field('fld_multiple_title'),
            'cards' => [],
        ];

        $multipleCards = get_sub_field('rpt_multiple_cards');
        while(have_rows('rpt_multiple_cards')): the_row();
            $card = [
                'title' => get_sub_field('fld_cards_title'),
                'highlight' => get_sub_field('fld_cards_highlight'),
                'text' => get_sub_field('fld_cards_text'),
                'link' => get_sub_field('fld_cards_link'),
            ];

            $row['cards'][] = $card;
        endwhile;

        $args['cardsrow'][] = $row;

    endwhile;

    $module_ID = sanitize_title($args['headline']);
    if ($args['background'] && $args['headline']):
        echo "<section class=\"module-multiple-rows module-multiple-rows--dark padding--lg\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'multiple-rows', $args);
        echo "</section>";
    elseif ($args['headline']):
        echo "<section class=\"module-multiple-rows padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'multiple-rows', $args);
        echo "</section>";
    endif;
?>