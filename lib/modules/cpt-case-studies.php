<?php

// CASE STUDIES CPT
function register_casestudies_posttype() {
   $labels = array(
      'name'              => _x( 'Case Studies', 'post type general name' ),
      'menu_name'         => __( 'Case Studies' ),
      'all_items'         => __( 'All Case Studies' )
   );

   $taxonomies = array();

   $post_type_args = array(
      'labels'            => $labels,
      'singular_label'    => __( 'Case Studies' ),
      'public'            => true,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'publicly_queryable'=> true,
      'query_var'         => true,
      'capability_type'   => 'post',
      'hierarchical'      => true,
      'rewrite'           => array('slug' => 'case-studies', 'with_front' => false),
      'has_archive'       => true,
      'exclude_from_search'=> false,
      // 'menu_icon'         => 'dashicons-portfolio',
      // 'menu_position'     => 33,
      'taxonomies'        => $taxonomies,
      'supports'          => array('title', 'revisions', 'excerpt', 'thumbnail')
   );
   
   register_post_type('case_studies', $post_type_args);
}
add_action('init', 'register_casestudies_posttype');


// CASE STUDIES TAXONOMY - SERVICE PAGES - See post-taxonomies.php


// VENDOR OR PARTNER - RELATIONSHIP??? - LOGO