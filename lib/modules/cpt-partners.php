<?php // VENDOR OR PARTNER

// PARTNERS CPT
function register_partners_posttype() {
   $labels = array(
      'name'              => _x( 'Partners', 'post type general name' ),
      'menu_name'         => __( 'Partners' ),
      'all_items'         => __( 'All Partners' )
   );

   $taxonomies = array();

   $post_type_args = array(
      'labels'            => $labels,
      'singular_label'    => __( 'Partners' ),
      'public'            => true,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'publicly_queryable'=> true,
      'query_var'         => true,
      'capability_type'   => 'post',
      'hierarchical'      => true,
      'rewrite'           => array('slug' => 'partners', 'with_front' => false),
      'has_archive'       => true,
      'exclude_from_search'=> true, // HIDE IN THE SITE SEARCH RESULTS
      // 'menu_icon'         => 'dashicons-portfolio',
      // 'menu_position'     => 33,
      'taxonomies'        => $taxonomies,
      'supports'          => array('title', 'revisions', 'excerpt')
   );

   register_post_type('partners', $post_type_args);
}
add_action('init', 'register_partners_posttype');


// PARTNERS TAXONOMY - SERVICE PAGES - See post-taxonomies.php


// HIDE PERMALINK FROM POST
function partners_permalink($return, $post_id, $new_title, $new_slug, $post) {
   if($post->post_type == 'partners') {
      return '';
   }
      return $return;
   }
add_filter('get_sample_permalink_html', 'partners_permalink', 10, 5);