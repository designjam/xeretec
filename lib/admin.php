<?php

/**
 * Admin Logo Image
 */
function custom_loginlogo() {
  echo '<style type="text/css">
    h1 a {width:100% !important;height:122px !important;background-size:auto !important;background-image: url(/wp-content/themes/rouge-wp-start-theme/admin-logo.png) !important; }
  </style>';
}
add_action('login_head', 'custom_loginlogo');

/**
 * Admin Logo URL
 */
function custom_loginlogo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

/**
 * Allow editors to see Appearance menu
 */
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );
function show_only_menus() {
    remove_submenu_page( 'themes.php', 'themes.php' ); // Hide theme selection page
    remove_submenu_page( 'themes.php', 'widgets.php' ); // Hide widgets page
    remove_submenu_page( 'themes.php', 'customize.php' ); // Hide customize page
    // Hide customize page
    global $submenu;
    unset($submenu['themes.php'][6]);
}
add_action('admin_head', 'show_only_menus');

/**
 * Remove links/menus from the admin bar
 */
function remove_editor_menu(){
    // Get current login user's role
    $roles = wp_get_current_user()->roles;
     
    // Test role
    if( !in_array('editor',$roles)){
        return;
    }

    // Remove from menu
    remove_menu_page( 'edit-comments.php' ); // Comments
    // remove_menu_page( 'themes.php' ); // Appearance
    remove_menu_page( 'plugins.php' ); // Plugins
    remove_menu_page( 'users.php' ); // Users
    remove_menu_page( 'tools.php' ); // Tools
    remove_menu_page( 'options-general.php' ); // Settings
    //remove_menu_page('edit.php?post_type=testimonial'); // Custom post type if required

    // Remove from page/post sidebar
    remove_meta_box('postimagediv', 'page', 'side'); // Page image meta box
    remove_meta_box('formatdiv', 'post', 'side'); // Post format meta box
}
add_action( '_admin_menu', 'remove_editor_menu' , 100 );

/**
 * Remove tags support from posts
 */
function rouge_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'rouge_unregister_tags');

/**
 * Remove the Quick Edit link - This is to hide unused and confussing options, such as Make this post sticky
 */
function remove_post_actions( $actions )
{
    if( get_post_type() === 'post' )
        unset( $actions['inline hide-if-no-js'] );
    return $actions;
}
add_filter( 'post_row_actions', 'remove_post_actions', 10, 1 );

/**
 * Register Theme Options
 */
function theme_options_page() {
    if ( function_exists('acf_add_options_page') ) {
        acf_add_options_page( array(
            'page_title'    => __('Theme Options'),
            'menu_title'    => __('Theme Options'),
            'menu_slug'     => 'theme_options',
            'parent_slug'   => '',
            'capability'    => 'edit_posts',
            'position'      => 79,
            'icon_url'      => 'dashicons-admin-generic',
        ));
        
        //Theme options page for 'Posts' post type
        acf_add_options_sub_page(array(
          'page_title'      => __('Insights Grid'),
          'parent_slug'     => 'edit.php',
          'capability'      => 'edit_posts'
        ));

        //Theme options page for 'Case Studies' post type
        acf_add_options_sub_page(array(
          'page_title'      => __('Case Studies Grid'),
          'parent_slug'     => 'edit.php?post_type=case_studies',
          'capability'      => 'edit_posts'
        ));

        //Theme options page for 'Partners' post type
        acf_add_options_sub_page(array(
          'page_title'      => __('Partners Grid'),
          'parent_slug'     => 'edit.php?post_type=partners',
          'capability'      => 'edit_posts'
        ));
    }
}
add_action('init', 'theme_options_page');

function acf_hide_acf_admin() {
    // get the current site url
    $site_url = get_bloginfo( 'url' );

    // an array of protected site urls  
    $protected_urls = array(
        'https://www.example.com',
        'http://staging.example.com'
    );

    // check if the current site url is in the protected urls array  
    if ( in_array( $site_url, $protected_urls ) ) {
        // hide the acf menu item 
        return false;
    } else {
        // show the acf menu item 
        return true;
    }
}

add_filter('acf/settings/show_admin', 'acf_hide_acf_admin');