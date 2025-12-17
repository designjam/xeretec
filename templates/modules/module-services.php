<?php 
	$servicesRpt = array();
    $services = get_field('rpt_services_cards', 'options');

    foreach (($services ? $services : $servicesRpt) as $key => $service) {
        $servicesRpt[$key]['title'] = $service['fld_services_title'];
        $servicesRpt[$key]['text'] = $service['fld_services_text'];
        $servicesRpt[$key]['link'] = $service['fld_services_link'];
        $servicesRpt[$key]['image'] = $service['img_services_image'];
    }

    $args = array(
        'headline' => get_field('fld_services_headline'),
        'excerpt' => get_field('fld_services_excerpt'),
        'background_color' => get_field('fld_services_background_color'),
        'services' => $servicesRpt,
    );

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        if ($args['background_color'] == 'true' && $args['headline']):
            echo "<section class=\"module-services module-services--dark padding--lg\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'services', $args);
            echo "</section>";
        elseif ($args['headline']):
            echo "<section class=\"module-services padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
            echo get_template_part('templates/modules/blocks/block', 'services', $args);
            echo "</section>";
        endif;
    endif; 
?>