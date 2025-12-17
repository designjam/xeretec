<?php

    if(get_post_type() == 'case_studies'):
        $args = array(
            'type' => get_field('fld_hero_type'), // NOT IN USE ON ARCHIVE PAGES
            'headline' => get_field('fld_hero_casestudies_headline', 'options'),
            'excerpt' => get_field('fld_hero_casestudies_excerpt', 'options'),
            'link' => get_field('fld_hero_casestudies_link', 'options'),
            'anchor' => get_field('fld_hero_casestudies_anchor', 'options'),
            'background' => get_field('img_hero_casestudies_background', 'options'),
        );
    elseif(get_post_type() == 'partners'):
        $args = array(
            'type' => get_field('fld_hero_type'), // NOT IN USE ON ARCHIVE PAGES
            'headline' => get_field('fld_hero_partners_headline', 'options'),
            'excerpt' => get_field('fld_hero_partners_excerpt', 'options'),
            'link' => get_field('fld_hero_partners_link', 'options'),
            'anchor' => get_field('fld_hero_partners_anchor', 'options'),
            'background' => get_field('img_hero_partners_background', 'options'),
        );
    else:
        $args = array(
            'type' => get_field('fld_hero_type'), // NOT IN USE ON ARCHIVE PAGES
            'headline' => get_field('fld_hero_insights_headline', 'options'),
            'excerpt' => get_field('fld_hero_insights_excerpt', 'options'),
            'link' => get_field('fld_hero_insights_link', 'options'),
            'anchor' => get_field('fld_hero_insights_anchor', 'options'),
            'background' => get_field('img_hero_insights_background', 'options'),
        );
    endif;
   
    if ($args['headline']):
        echo "<section class=\"module-hero module-hero--small\" role=\"banner\">"; // DEFAULT IS SMALL ON ARCHIVE PAGES
        echo get_template_part('templates/modules/blocks/block', 'hero', $args);
        echo "</section>";
    endif;
?>