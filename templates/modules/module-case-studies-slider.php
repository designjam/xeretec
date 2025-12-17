<?php 
	$featured_casestudies = get_field('rel_related_casestudies');
	if( $featured_casestudies ):

	    echo "<div class=\"module-casestudies-slider\" role=\"complementary\" id=\"case-studies\" aria-label=\"Case Studies\">";
	    foreach( $featured_casestudies as $featured_casestudy ):
	        $args = array(
	        	'text' => get_field('fld_casestudy_text', $featured_casestudy->ID),
	            'logo' => get_field('img_casestudy_logo', $featured_casestudy->ID),
	            'quotation' => get_field('fld_casestudy_quote', $featured_casestudy->ID),
	            'author' => get_field('fld_casestudy_author', $featured_casestudy->ID),
	            'position' => get_field('fld_casestudy_position', $featured_casestudy->ID),
	            'background' => get_field('img_casestudy_background', $featured_casestudy->ID),
	            'permalink' => get_permalink($featured_casestudy->ID),
				'cta' => get_field('cta', $featured_casestudy->ID),
	        );
	        echo get_template_part('templates/modules/blocks/block', 'case-studies-slider', $args);
	    endforeach;
	    echo "</div>";
	endif;
?>