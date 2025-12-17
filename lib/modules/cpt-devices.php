<?php

// DEVICES CPT
function register_devices_posttype() {
   $labels = array(
      'name'              => _x( 'Devices', 'post type general name' ),
      'menu_name'         => __( 'Devices' ),
      'all_items'         => __( 'All Devices' )
   );

   $taxonomies = array();

   $post_type_args = array(
      'labels'            => $labels,
      'singular_label'    => __( 'Devices' ),
      'public'            => true,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'publicly_queryable'=> false,
      'query_var'         => true,
      'capability_type'   => 'post',
      'hierarchical'      => false,
      'rewrite'           => array('slug' => 'devices', 'with_front' => false),
      'has_archive'       => true,
      'exclude_from_search'=> true, // HIDE IN THE SITE SEARCH RESULTS
      // 'menu_icon'         => 'dashicons-portfolio',
      // 'menu_position'     => 33,
      'taxonomies'        => $taxonomies,
      'supports'          => array('title', 'revisions')
   );
   
   register_post_type('devices', $post_type_args);
}
add_action('init', 'register_devices_posttype');


// HIDE PERMALINK FROM POST
function devices_permalink($return, $post_id, $new_title, $new_slug, $post) {
   if($post->post_type == 'devices') {
      return '';
   }
      return $return;
   }
add_filter('get_sample_permalink_html', 'devices_permalink', 10, 5);