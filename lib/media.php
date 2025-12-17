<?php
/**
 * Add a set of custom class names on the uploaded media
 */

// Add custom size for the thumbnails
add_theme_support( 'post-thumbnails' );

// Add a custom size for the background images
add_theme_support( 'post-thumbnails' );
add_image_size ( 'thumbnail-image', 375, 9999, true );
add_image_size ( 'background-image', 1900, 9999, true );

/**
 * In WordPress 4.4 max srcset size is set to 1600px wide by default
 * If you have images larger than that size that you’d like included in the srcset you can use this filter:
 */
function responsive_image_max_srcset() {
	return 1900;
}
add_filter( 'max_srcset_image_width', 'responsive_image_max_srcset', 10 , 2 );

// Sanitize the filename of the uploaded files to remove accents and special characters
add_filter('sanitize_file_name', 'sanitize_accent_chars', 10);
    function sanitize_accent_chars ($filename) {
    return remove_accents( $filename );
}


/**
 * Allow upload of SVG in the media menu of WordPress - REMOVED AND REPLACED WITH A PLUGIN
 */
// function cc_mime_types($mimes) {
//     $mimes['svg'] = 'image/svg+xml';
//     return $mimes;
// }
// add_filter( 'upload_mimes', 'cc_mime_types' );


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */
function responsive_image($image_id,$image_size,$max_width,$img_class = null){
	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_src( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// get attachment alt
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

		// generate the markup for the responsive image
		echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="'. $image_src[0] .'" data-srcset="'. $image_srcset .'" data-sizes="(max-width: '. $max_width .') 100vw, '. $max_width .'" width="'. $image_src[1] .'" height="'. $image_src[2] .'" data-original-src="'. $image_src [0].'" alt="' . $image_alt . '" class="lazy '. $img_class .'" />';
	}
}

function responsive_image_nolazy($image_id,$image_size,$max_width,$img_class = null){
	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// get attachment alt
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

		// generate the markup for the responsive image
		echo '<img src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'" data-original-src="'.$image_src.'" alt="' . $image_alt . '" class="'. $img_class .'" />';
	}
}

/**
 * Get the featured image and output src and alt
 */
function featured_image($featured_image_size, $featured_max_width, $featured_class = null) {
    $featured_img_id = get_post_thumbnail_id();

    // set the default src image size
	$featured_img_src = wp_get_attachment_image_url( $featured_img_id, $featured_image_size );

	// set the srcset with various image sizes
	$featured_img_srcset = wp_get_attachment_image_srcset( $featured_img_id, $featured_image_size );

    $featured_img_alt = get_post_meta($featured_img_id, '_wp_attachment_image_alt', TRUE);

    if ( has_post_thumbnail() ) {
    	echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="'.$featured_img_src.'" data-srcset="'.$featured_img_srcset.'" data-sizes="(max-width: '.$featured_max_width.') 100vw, '.$featured_max_width.'" data-original-src="'.$featured_img_src.'" alt="' . $featured_img_alt . '" class="lazy '. $featured_class .'" />';
    } else {
        return '';
    }
}

/**
 * Get the featured image and output src and alt
 */
function featured_image_nolazy($featured_image_size, $featured_max_width, $featured_class = null) {
    $featured_img_id = get_post_thumbnail_id();

    // set the default src image size
	$featured_img_src = wp_get_attachment_image_url( $featured_img_id, $featured_image_size );

	// set the srcset with various image sizes
	$featured_img_srcset = wp_get_attachment_image_srcset( $featured_img_id, $featured_image_size );

    $featured_img_alt = get_post_meta($featured_img_id, '_wp_attachment_image_alt', TRUE);

    if ( has_post_thumbnail() ) {
    	echo '<img src="'.$featured_img_src.'" srcset="'.$featured_img_srcset.'" sizes="(max-width: '.$featured_max_width.') 100vw, '.$featured_max_width.'" data-original-src="'.$featured_img_src.'" alt="' . $featured_img_alt . '" class="lazy '. $featured_class .'" />';
    } else {
        return '';
    }
}