<?php 
	$args = array(
	    'type' => get_field('fld_form_type'),
	    'headline' => get_field('fld_form_headline'),
	    'excerpt' => get_field('fld_form_excerpt'),
	    'text' => get_field('fld_form_text'),
	    'form' => get_field('fld_form_id'),
	    'gated' => get_field('fld_form_gated'),
	    'ondemand' => get_field('fld_form_ondemand'),
	    'hubspot' => get_field('fld_form_hubspot'),
	    'background' => get_field('img_form_background'),
	);

	if($args['headline']):
	    $module_ID = sanitize_title($args['headline']);
	    if ($args['background'] && $args['headline']):
            echo "<section class=\"module-form module-form--dark padding--lg\" role=\"form\" id=\"" . $module_ID . "\" aria-label=\"Get in touch\">";
            echo get_template_part('templates/modules/blocks/block', 'form', $args);
	    	echo "</section>";
       	elseif ($args['headline']):
            echo "<section class=\"module-form padding--md\" role=\"form\" id=\"" . $module_ID . "\" aria-label=\"Get in touch\">";
            echo get_template_part('templates/modules/blocks/block', 'form', $args);
	    	echo "</section>";
        endif;
	endif; 
?>