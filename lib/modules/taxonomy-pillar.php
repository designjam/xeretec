<?php

// CHANGE THE ICON OF THE CORE POST TYPE
function change_post_icon_css() {
    ?>
    <style>
        .menu-icon-post .dashicons-before:before {
            content: "\f330";
        }
    </style>
    <?php
}
add_action( 'admin_head', 'change_post_icon_css' );

// TAXONOMY - SERVICE PAGES - AVAILABLE ON CASE STUDIES, INSIGHTS AND PARTNERS
function register_pillar_taxonomies() {
   $labels = array(
      'name'                  => _x( 'Pillar', 'taxonomy general name' ),
      'menu_name'             => __( 'Pillar' )
   );

   $args = array(
      'labels'                => $labels,
      'show_in_nav_menus'     => true,
      'hierarchical'          => true,
      'public'                => true,
      'publicly_queryable'    => false,
      'show_in_menu'          => true,
      'show_admin_column'     => true,
      'show_in_quick_edit'    => true,
      'rewrite'               => array('slug' => get_option('pillar_slug', 'pillars'))
   );

   register_taxonomy('pillar', array('partners', 'case_studies', 'post'), $args);
}
add_action('init', 'register_pillar_taxonomies', 10);