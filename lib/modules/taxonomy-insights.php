<?php

// CHANGE THE NAME OF THE CORE POST TYPE
function change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Insights';
}
function change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Insights';
    $labels->menu_name = 'Insights';
    $labels->all_items = 'All Posts';
}
add_action( 'admin_menu', 'change_post_label' );
add_action( 'init', 'change_post_object' );

// CHANGE THE ICON OF THE CORE POST TYPE
// ERRORS

// UNREGISTER FORMAT FROM CORE POST
function unregister_formats_sidebar()
{
   remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'unregister_formats_sidebar', 100);

// UNREGISTER TAGS FROM CORE POST
function unregister_news_taxonomies() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
    unregister_taxonomy_for_object_type( 'post_cat', 'post' );
}
add_action( 'init', 'unregister_news_taxonomies' );

// TAXONOMY - TYPE
function register_type_taxonomies() {
   $labels = array(
      'name'                  => _x( 'Type', 'taxonomy general name' ),
      'menu_name'             => __( 'Type' )
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
      'rewrite'               => array('slug' => get_option('type_slug', 'types'))
   );

   register_taxonomy('type', array('post'), $args);
}
add_action('init', 'register_type_taxonomies', 10);