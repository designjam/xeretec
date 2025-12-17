<?php 
	$args = array(
        'headline' => get_field('fld_products_headline'),
        'link' => get_field('fld_products_link'),
        'products' => [],
    );

    $featured_products = get_field('rel_products_cards');

    if($featured_products): foreach( $featured_products as $featured_product ):
        $row = array(
            'image' => get_field('img_product_image', $featured_product->ID),
            'title' => get_field('fld_product_headline', $featured_product->ID),
            'text' => get_field('fld_product_excerpt', $featured_product->ID),
            'link' => get_field('fld_product_link', $featured_product->ID),
            'video' => get_field('fld_product_video', $featured_product->ID),
        );
        $args['products'][] = $row;
    endforeach; endif;

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-products padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'products-full', $args);
        echo "</section>";
    endif;
?>