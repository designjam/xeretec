<?php 
	$args = array(
        'headline' => get_field('fld_lrg_partners_headline'),
        'link' => get_field('fld_lrg_partners_link'),
        'partners' => [],
    );

    $trusted_partners = get_field('rel_lrg_partners_cards');

    if ($trusted_partners):  foreach( $trusted_partners as $trusted_partner ):
        $row = array(
            'image' => get_field('img_partner_logo', $trusted_partner->ID),
        );

        $args['partners'][] = $row;
    endforeach; endif;

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-partners padding--lg\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'large-partners', $args);
        echo "</section>";
    endif; 
?>