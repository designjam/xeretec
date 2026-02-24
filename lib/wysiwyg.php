<?php

function insert_pull_out_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "bg" => 'bg-primary',
        "url" => '#',
        "link_title" => 'Link text',
    ), $atts));

    return '
        <div class="pull-out' . $bg . '">
            <h4>' . $content . '</h4>
            <a class="link" href="' . $url . '">' . $link_title . '</a>
        </div>
    ';
}
add_shortcode("pullout", "insert_pull_out_shortcode");

function insert_current_year_shortcode($atts, $content = null) {
    $thisYear = date('Y');
    return $thisYear;
}
add_shortcode("year", "insert_current_year_shortcode");

function insert_cookies_table_shortcode($atts, $content = null) {
    $cookies = get_field('rpt_cookies_table', 'options');
    ob_start();?>
        <table class="cookies-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cookies as $cookie) { ?>
                <tr>
                    <td data-label="Name"><span><?php echo $cookie['cookie_name'];?></span></td>
                    <td data-label="Purpose"><span><?php echo $cookie['cookie_purpose'];?></span></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php 
    $output = ob_get_clean();
    return $output;
}
add_shortcode("cookies_table", "insert_cookies_table_shortcode");


//ALL BELOW HERE IS TO ENABLE CUSTOM TINY MCE BUTTON FOR THE ABOVE CODE

function addcontactbutton_admin_enqueue_scripts() {
    wp_enqueue_script( 'addcontactbutton-tinymce-scipt', get_template_directory_uri() . '/js/custom-tinymce.js' );
}
add_action( 'admin_enqueue_scripts', 'addcontactbutton_admin_enqueue_scripts' );

function load_custom_wp_admin_style() {
   wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/custom-admin-css.css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function addcontactbutton_add_mce_button() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }
    add_filter( 'mce_external_plugins', 'addcontactbutton_add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'addgeneralbutton_register_mce_button' );
}
add_action( 'admin_head', 'addcontactbutton_add_mce_button' );

function addcontactbutton_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['addcontactbutton_tinymce_button'] = get_template_directory_uri() . '/js/custom-tinymce.js';
    return $plugin_array;
}

function addgeneralbutton_register_mce_button( $buttons ) {
    array_push( $buttons, 'addpulloutbutton_tinymce_button' );
    return $buttons;
}


// Optional config for tinymce

// function remove_default_format_select( $buttons ) {
//     //Remove the format dropdown select and text color selector
//     $remove = array( 'formatselect' );

//     return array_diff( $buttons, $remove );
//  }
// add_filter( 'mce_buttons', 'remove_default_format_select' );

/**
 * MCE Style select addition
 */
function wpb_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'wpb_mce_buttons_2');

/**
 * Callback function to filter the MCE settings
 */
function mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
    /*
    * Each array child is a format with it's own settings
    * Notice that each array has title, block, classes, and wrapper arguments
    * Title is the label which will be visible in Formats menu
    * Block defines whether it is a span, div, selector, or inline style
    * Classes allows you to define CSS classes
    * Wrapper whether or not to add a new block-level element around any selected elements
    */

        array(
          'title' => 'Section heading',
          'selector' => 'p,h1,h2,h3,h4,h5,h6',
          'classes' => 'section-heading',
        ),

        array(
          'title' => 'Caption',
          'selector' => 'p,h1,h2,h3,h4,h5,h6',
          'classes' => 'label-heading',
        ),

        array(
          'title' => 'Small Text',
          'selector' => 'p,strong',
          'classes' => 'small',
        ),

        array(
          'title' => 'Primary colour',
          'inline' => 'span',
          'classes' => 'text-accent',
          'wrapper' => false
        ),

        array(
          'title' => 'Secondary colour',
          'inline' => 'span',
          'classes' => 'text-brand',
          'wrapper' => false
        ),

        array(
          'title' => 'Bullet points with icons',
          'selector' => 'ul',
          'classes' => 'bullets',
        ),
    );

    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'mce_before_init_insert_formats' );