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


/**
 * Case Study Template Meta Box
 * Allows switching between Default and Flexible Components templates (like Page Attributes)
 */
function case_studies_template_meta_box() {
   add_meta_box(
      'case_study_template',
      __( 'Case Study Template' ),
      'case_studies_template_meta_box_callback',
      'case_studies',
      'side',
      'high'
   );
}
add_action('add_meta_boxes', 'case_studies_template_meta_box');

function case_studies_template_meta_box_callback( $post ) {
   wp_nonce_field('case_study_template_nonce', 'case_study_template_nonce');
   $template = get_post_meta($post->ID, 'case_study_template', true) ?: 'default';
   ?>
   <p>
      <label for="case_study_template"><?php _e('Template'); ?></label>
      <select name="case_study_template" id="case_study_template" style="width:100%;">
         <option value="default" <?php selected($template, 'default'); ?>><?php _e('Default'); ?></option>
         <option value="template-components.php" <?php selected($template, 'template-components.php'); ?>><?php _e('Flexible Components'); ?></option>
      </select>
   </p>
   <p class="description"><?php _e('Choose which template to use for this case study.'); ?></p>
   <?php
}

function case_studies_template_save_meta( $post_id ) {
   if ( !isset($_POST['case_study_template_nonce']) || !wp_verify_nonce($_POST['case_study_template_nonce'], 'case_study_template_nonce') ) {
      return;
   }
   if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
      return;
   }
   if ( !current_user_can('edit_post', $post_id) ) {
      return;
   }
   if ( isset($_POST['case_study_template']) && in_array($_POST['case_study_template'], array('default', 'template-components.php')) ) {
      update_post_meta($post_id, 'case_study_template', sanitize_text_field($_POST['case_study_template']));
   }
}
add_action('save_post_case_studies', 'case_studies_template_save_meta');

/**
 * Load the appropriate single template based on case study template selection
 */
function case_studies_load_template( $template ) {
   if ( !is_singular('case_studies') ) {
      return $template;
   }
   $post_id = get_queried_object_id();
   $selected = get_post_meta($post_id, 'case_study_template', true);
   if ( $selected === 'template-components.php' ) {
      $components_template = get_template_directory() . '/single-case_studies-components.php';
      if ( file_exists($components_template) ) {
         return $components_template;
      }
   }
   return $template;
}
add_filter('single_template', 'case_studies_load_template');


// CASE STUDIES TAXONOMY - SERVICE PAGES - See post-taxonomies.php


// VENDOR OR PARTNER - RELATIONSHIP??? - LOGO