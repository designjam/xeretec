<?php

// TESTIMONIALS CPT
function register_testimonials_posttype() {
   $labels = array(
      'name'              => _x( 'Testimonials', 'post type general name' ),
      'menu_name'         => __( 'Testimonials' ),
      'all_items'         => __( 'All Testimonials' )
   );

   $taxonomies = array();

   $post_type_args = array(
      'labels'            => $labels,
      'singular_label'    => __( 'Testimonials' ),
      'public'            => true,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'publicly_queryable'=> true,
      'query_var'         => true,
      'capability_type'   => 'post',
      'hierarchical'      => false,
      'rewrite'           => array('slug' => 'testimonials', 'with_front' => false),
      'has_archive'       => false,
      'exclude_from_search'=> false,
      // 'menu_icon'         => 'dashicons-portfolio',
      // 'menu_position'     => 33,
      'taxonomies'        => $taxonomies,
      'supports'          => array('title', 'revisions', 'thumbnail')
   );
   
   register_post_type('testimonials', $post_type_args);
}
add_action('init', 'register_testimonials_posttype');


// TESTIMONIALS TAXONOMY - SERVICE PAGES - See post-taxonomies.php


// VENDOR OR PARTNER - RELATIONSHIP??? - LOGO