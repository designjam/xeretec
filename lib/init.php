<?php

/**
 * Theme setup
 */
function setup() {
  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'theme'),
    'legal_navigation'   => __('Legal Navigation', 'theme'),
    'footer_navigation'   => __('Footer Navigation', 'theme')
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);
}
add_action('after_setup_theme', 'setup');


/**
 * Register sidebars
 */
// function widgets_init() {
//   register_sidebar(array(
//     'name' => 'Sidebar',
//     'id' => 'sidebar',
//     'description' => 'The right hand column on the Blog',
//     'before_widget' => '<section class="widget %1$s %2$s">',
//     'after_widget'  => '</section>',
//     'before_title'  => '<h3>',
//     'after_title'   => '</h3>'
//   ));
//   register_sidebar(array(
//     'name' => 'Sitemap',
//     'id' => 'sitemap',
//     'description' => 'This is for SEO purposes. This runs off the main navigation.',
//     'before_widget' => '<section class="widget %1$s %2$s">',
//     'after_widget'  => '</section>',
//     'before_title'  => '<h3>',
//     'after_title'   => '</h3>'
//   ));
// }
// add_action('widgets_init', 'widgets_init');


/**
 * ACF Google map api key
 */
function theme_acf_google_map_api( $api ){
  $api['key'] = 'API_KEY';

  return $api;
}
add_filter('acf/fields/google_map/api', 'theme_acf_google_map_api');

/**
 * Add <body> classes
 */
// function body_class($classes) {
//     // Add page slug if it doesn't exist
//     if (is_single() || is_page() && !is_front_page()) {
//         if (!in_array(basename(get_permalink()), $classes)) {
//         $classes[] = basename(get_permalink());
//         }
//     }

//     // Add class if sidebar is active
//     if (Config\display_sidebar()) {
//         $classes[] = 'sidebar';
//     }

//     // Remove unnecessary classes
//     $home_id_class = 'page-id-' . get_option('page_on_front');
//     $remove_classes = array(
//         'page-template-default',
//         'page-template',
//         $home_id_class
//     );
//     $classes = array_diff( $classes, $remove_classes );
//     $classes = str_replace( 'template-template', 'template', $classes );

//     return $classes;
// }
// add_filter('body_class', 'body_class');

//Loading colour options in to page builder
// function acf_load_color_field_choices( $field ) {

//     $field['choices'] = array(
//         'bg-white'        => 'White',
//         'bg-light'        => 'Light grey',
//         'bg-primary'        => 'Primary colour',
//         'bg-primary-light'  => 'Primary - Light colour',
//         'bg-accent'         => 'Accent colour',
//         'bg-dark'         => 'Dark colour',
//     );

//     return $field;    
// }
// add_filter('acf/load_field/name=bg_colour', 'acf_load_color_field_choices');


//Loading icon options in to page builder
// function acf_load_icon_field_choices( $field ) {
//     // reset choices
//     $field['choices'] = array();

//     if( have_rows('rpt_button_icons', 'option') ) {
//         while( have_rows('rpt_button_icons', 'option') ) {
            
//             the_row();

//             $value = get_sub_field('icon');
//             $label = get_sub_field('icon_name');
            
//             $field['choices'][ $value ] = $label;
//         }
//     }

//     return $field;  
// }
// add_filter('acf/load_field/name=optional_button_icon', 'acf_load_icon_field_choices');


//Loading FF form names in to page builder
// function acf_load_form_name_field_choices( $field ) {
//     $field['choices'] = array();

//     global $wpdb;
//     $query = $wpdb->get_results("SELECT id, name FROM wp_frm_forms WHERE status = 'published'");

//     foreach ($query as $form) {
//         $value = $form->id;
//         $label = $form->name;

//         $field['choices'][ $value ] = $label;
//     }

//     return $field;  
// }
// add_filter('acf/load_field/name=form_name', 'acf_load_form_name_field_choices');