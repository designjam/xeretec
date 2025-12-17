<?php
// Theme specific


// HIDE DRAFTS FROM RELATIONSHIP ACF FIELDS
function filter_acf_relationship ($args, $field, $post_id) {
    $args['post_status'] = 'publish';
    return $args;
}

add_filter('acf/fields/relationship/query', 'filter_acf_relationship', 10, 3);


/**
 * Due to the Xeretec staging environment showing the following error:
 * Notice: ob_end_flush(): failed to send buffer of zlib output compression (0) in /home/www2xeretec/public_html/wp-includes/functions.php on line 5275
 * 
 * Proper ob_end_flush() for all levels is required:
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );