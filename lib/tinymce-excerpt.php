<?php

/**************************  https://github.com/cosmic/cosmic-tinymce-excerpt
  * Plugin Name: Cosmic TinyMCE Excerpt
  * Description: TinyMCE pour les extraits
  * Author: Agence Cosmic
  * Author URI: http://agencecosmic.com/
  * Version: 1.0
  ****************************/
 
 function cosmic_activate_page_excerpt() {
   add_post_type_support('page', array('excerpt'));
 }
 add_action('init', 'cosmic_activate_page_excerpt');
 
 # Removes default extracts and replaces them with new blocks
 function cosmic_replace_post_excerpt() {
   foreach (array("post", "page") as $type) {
     remove_meta_box('postexcerpt', $type, 'normal');
     add_meta_box('postexcerpt', __('Excerpt'), 'cosmic_create_excerpt_box', $type, 'normal');
   }
 }
 add_action('admin_init', 'cosmic_replace_post_excerpt');
 
 function cosmic_create_excerpt_box() {
   global $post;
   $id = 'excerpt';
   $excerpt = cosmic_get_excerpt($post->ID);
 
   wp_editor($excerpt, $id);
 }
 
 function cosmic_get_excerpt($id) {
   global $wpdb;
   $row = $wpdb->get_row("SELECT post_excerpt FROM $wpdb->posts WHERE id = $id");
   return $row->post_excerpt;
 }
 
 /************** http://wpbeaches.com/force-read-link-excerpts-wordpress/
 Forces the read more link to the bottom of the post preview excerpt. */
 // Read More Button For Excerpt
 function themeprefix_excerpt_read_more_link( $output ) {
 	global $post;
 	return $output . ' <a href="' . get_permalink( $post->ID ) . '" class="more-link" title="Read More">Read More</a>';
 }
 add_filter( 'the_excerpt', 'themeprefix_excerpt_read_more_link' );
 

/***** ADD EXCERPT TO A PAGE ****/
function add_excerpts_to_pages() {
add_post_type_support(‘page’, ‘excerpt’);
}
add_action(‘init’, ‘add_excerpts_to_pages’);