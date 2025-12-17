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
        'headline' => get_field('fld_services_full_headline'),
        'services' => $servicesRpt,
    );

    if($args['headline'] || is_404() || is_search()):
        echo "<section class=\"module-services module-services--full padding--md\" role=\"complementary\" id=\"services\">";
        echo get_template_part('templates/modules/blocks/block', 'services-full', $args);
        echo "</section>";
    endif; 
?>