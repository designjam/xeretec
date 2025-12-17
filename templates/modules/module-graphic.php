<?php 
	$args = array(
        'image' => get_field('img_graphic_image'),
    );

    if($args['image']):
        echo get_template_part('templates/modules/blocks/block', 'graphic', $args);
    endif;
?>