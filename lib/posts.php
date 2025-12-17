<?php

/**
 * Return WP Posts
 *
 *
 * @param $_POST['nbPosts'] is the number of posts to return. If not
 * specified will use the WP default setting
 * @param $_POST['page'] is the current page to return
 *
 * @return HTML of the posts usin the views/post-preview.php template
 */
add_action( 'wp_ajax_load_posts', 'load_posts' );
add_action( 'wp_ajax_nopriv_load_posts', 'load_posts' );
function load_posts() {
    $args = array();

    // Number of posts to get
    // Check if a param was passed otherwise get the default option
    $posts_per_page = get_option('posts_per_page');
    if ( isset($_POST['posts_per_page']) ) {
        $posts_per_page = $_POST['posts_per_page'];
    }

    $post_type = 'post';
    if ( isset($_POST['post_type']) ) {
        $post_type = $_POST['post_type'];
    }

    // Default options for the WP Query
    $args = array(
        'posts_per_page'    => $posts_per_page,
        'post_type'         => $post_type,
        'post_status'       => 'publish',
    );

    // The page to get the posts from
    if ( isset($_POST['page']) && $_POST['page'] != '' ) {
        $args['paged'] = $_POST['page'];
    }

    // The category for the posts
    if ( isset($_POST['cat']) && $_POST['cat'] != '' ) {
        $args['cat'] = $_POST['cat'];
    }

    // The date params (month or year)
    if ( isset($_POST['monthnum']) ) {
        $args['monthnum'] = $_POST['monthnum'];
    }
    if ( isset($_POST['year']) ) {
        $args['year'] = $_POST['year'];
    }

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            get_template_part( 'templates/posts/post-preview' );
        }

        wp_reset_postdata();
    }

    wp_die();
}


/**
 * Clean up the_excerpt()
 */
// function excerpt_more() {
//   return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'theme') . '</a>';
// }
// add_filter('excerpt_more', 'excerpt_more');


/**
 * Set a custom excerpt length
 */
function excerpt_length( $excerpt ) {
    global $post;
    if ($post->post_type == 'post' || $post->post_type == 'case_studies')
    return substr( $excerpt, 0, 200 ) . ' [...]';
    else
    return substr( $excerpt, 0, 999 );
}
add_filter( 'get_the_excerpt', 'excerpt_length' );

/**
 * Remove links from category output
 */
function no_links($thelist) {
    return preg_replace('#<a.*?>([^<]*)</a>#i', '$1', $thelist);
}
// add_filter( 'the_category', 'no_links' );

/**
 * Get the featured image's path and echo it as background image
 */
function get_featured_image() {
    $src = '';

    $featured_img_id = get_post_thumbnail_id();
    $featured_img_array = wp_get_attachment_image_src( $featured_img_id, 'background', true );
    $bg_url = $featured_img_array[0];

    if ( has_post_thumbnail() ) {
        return 'style="background-image: url(' . $bg_url . ');"';
    } else {
        return '';
    }
}

/**
 * Remove presets from Archive, Category, Tag and Author
 */
function remove_category_prefix_from_archive_title( $title ) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'remove_category_prefix_from_archive_title' );


/* Echo current taxonomy term as a link */
function current_tax_term_link() {
    global $post;
    // Enter taxonomy name here
    $tax_name = 'tax-name';
    $return = '';
    $terms = get_the_terms( $post->ID, $tax_name );
    if ( !empty( $terms ) ) {
        $out = array();
        foreach ( $terms as $term )
            $out[] = '<a href="' .get_term_link($term->slug, $tax_name) .'">'.$term->name.'</a>';
        $return = join( ' ', $out );
    }
    return $return;
}
/* Echo current taxonomy term as a word */
function current_tax_term_name() {
    global $post;
    // Enter taxonomy name here
    $tax_name = 'tax-name';
    $return = '';
    $terms = get_the_terms( $post->ID, $tax_name );
    if ( !empty( $terms ) ) {
        $out = array();
        foreach ( $terms as $term )
            $out[] = ''.$term->name.'';
        $return = join( ', ', $out );
    }
    return $return;
}