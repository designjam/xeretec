<?php
    $args = array(
        'type' => get_field('fld_hero_type'),
        'headline' => get_field('fld_hero_headline'),
        'excerpt' => get_field('fld_hero_excerpt'),
        'link' => get_field('fld_hero_link'),
        'anchor' => get_field('fld_hero_anchor'),
        'background' => get_field('img_hero_background'),
    );
    if ($args['headline']):
        if ($args['type'] == 'large'):
            echo "<section class=\"module-hero module-hero--large\" role=\"banner\">";
        elseif ($args['type'] == 'small'):
            echo "<section class=\"module-hero module-hero--small\" role=\"banner\">";
        else:
            echo "<section class=\"module-hero module-hero--small\" role=\"banner\">";
        endif;
            echo get_template_part('templates/modules/blocks/block', 'hero', $args);
            echo "</section>";
    endif;
?>