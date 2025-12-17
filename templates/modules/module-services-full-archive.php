<?php 
	$servicesRpt = array();
    $services = get_field('rpt_services_cards', 'options');

    foreach (($services ? $services : $servicesRpt) as $key => $service) {
        $servicesRpt[$key]['title'] = $service['fld_services_title'];
        $servicesRpt[$key]['text'] = $service['fld_services_text'];
        $servicesRpt[$key]['link'] = $service['fld_services_link'];
        $servicesRpt[$key]['image'] = $service['img_services_image'];
    }

    if(get_post_type() == 'case_studies'):
        $args = array(
            'headline' => get_field('fld_services_full_casestudies_headline', 'options'),
            'services' => $servicesRpt,
        );
    elseif(get_post_type() == 'partners'):
        $args = array(
            'headline' => get_field('fld_services_full_partners_headline', 'options'),
            'services' => $servicesRpt,
        );
    else:
        $args = array(
            'headline' => get_field('fld_services_full_insights_headline', 'options'),
            'services' => $servicesRpt,
        );
    endif;

    if($args['headline']):
        $module_ID = sanitize_title($args['headline']);
        echo "<section class=\"module-services module-services--full padding--md\" role=\"complementary\" id=\"" . $module_ID . "\">";
        echo get_template_part('templates/modules/blocks/block', 'services-full', $args);
        echo "</section>";
    endif; 
?>