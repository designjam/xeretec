<?php
    $args = array(
        'headline' => get_field('fld_hero_video_headline'),
        'excerpt' => get_field('fld_hero_video_excerpt'),
        'link' => get_field('fld_hero_video_link'),
        'link2' => get_field('fld_hero_video_link2'),
        'anchor' => get_field('fld_hero_video_anchor'),
        'embed' => get_field('fld_hero_video_embed'),
        'video' => get_field('fld_hero_video_embed_link'),
        'theme' => get_field('img_hero_theme_background'),
        'background' => get_field('img_hero_video_background'),
        'vimeo' => get_field('img_hero_videourl_background'),
    );
    if ($args['headline']):
        echo "<section class=\"module-hero module-hero--large module-hero--homepage\" role=\"complementary\">";
        echo get_template_part('templates/modules/blocks/block', 'hero-video', $args);
        echo "</section>";
    endif;
?>