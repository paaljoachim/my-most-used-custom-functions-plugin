<?php
/*
Plugin Name: My most used Custom Functions
Plugin URI: http://easywebdesigntutorials.com
Description: My most used Custom functions. 
Version: 1.0
Author: Paal Joachim Romdahl 
Author URI: http://easywebdesigntutorials.com
License: GPL2
*/

/**
 * Include all necessary files
 */
//admin customizations
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/dashboard-widgets.php' ) ) {
	require_once( 'lib/dashboard-widgets.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom.php' ) ) {
	require_once( 'lib/custom.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-login.php' ) ) {
	require_once( 'lib/custom-login.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/top-admin-tool-bar.php' ) ) {
	require_once( 'lib/top-admin-tool-bar.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/duplicate-post.php' ) ) {
	require_once( 'lib/duplicate-post.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/tinymce-excerpt.php' ) ) {
	require_once( 'lib/tinymce-excerpt.php' );
}

// Fontawesome is also loaded.
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-authorbox.php' ) ) {
	require_once( 'lib/custom-authorbox.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/back-to-top.php' ) ) {
	require_once( 'lib/back-to-top.php' );
}

if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/test.php' ) ) {
	require_once( 'lib/test.php' );
}


/* Custom avatar in discussion setting. Used for comments. 
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-avatar/kl_addnewdefaultavatar.php' ) ) {
	require_once( 'lib/custom-avatar/kl_addnewdefaultavatar.php' );
}

/* Bill Ericksons old add avatar code 
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-avatar/custom-avatar.php' ) ) {
	require_once( 'lib/custom-avatar/custom-avatar.php' );
}
if ( file_exists( plugin_dir_path( __FILE__ ) . 'lib/custom-avatar/custom-avatar2.php' ) ) {
	require_once( 'lib/custom-avatar/custom-avatar2.php' );
}
*/





// Add js files
add_action( 'wp_enqueue_scripts', 'my_enqueued_assets' );
function my_enqueued_assets() {
	// wp_enqueue_script( 'my-script', plugin_dir_url( __FILE__ ) . '/js/my-script.js', array( 'jquery' ), '1.0', true );
}


// Add css files
add_action( 'wp_enqueue_scripts', 'load_custom_style_sheet' );
function load_custom_style_sheet() {
	// Editor style not working properly
	// wp_enqueue_style( 'editor-style-twentysixteen-css', plugin_dir_url( __FILE__ ) . '/css/editor-style.css', array( ) );
	wp_enqueue_style( 'top-admin-bar-icons-css', plugin_dir_url( __FILE__ ) . '/css/top-admin-bar-icons.css', array( ) );
	wp_enqueue_style( 'dashboard-widget-styles', plugin_dir_url( __FILE__ ) . '/css/dashboard-widgets.css', array( ) );
	wp_enqueue_style( 'dashboard-widget-styles', plugin_dir_url( __FILE__ ) . '/css/custom-avatar.css', array( ) );
	
		
	wp_enqueue_style( 'custom-css', plugin_dir_url( __FILE__ ) . '/css/custom-authorbox.css', array( ) );
}

// Custom login - CSS file
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url( __FILE__ ) . '/css/custom-login.css" />';
}
add_action('login_head', 'my_custom_login');



