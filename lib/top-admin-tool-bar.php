<?php

/*--------- Adjust top admin toolbar ----*/

//* Remove WP logo
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
} 
// Adds links to the site name bar
 add_action( 'admin_bar_menu', 'add_nodes_to_admin_bar',999 );
  function add_nodes_to_admin_bar($wp_admin_bar) {  
  
  global $wp_admin_bar;
  	if ( is_admin() ) {
  	
  		// Remove Visit site link
  		$wp_admin_bar->remove_node( 'view-site' );
  		
  		//Empty, we don't need the options on the admin side :)  		
  		} else if ( current_user_can( 'read' ) ) { 				
  				// We're on the front end
  					
  					// Posts  					
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'posts',
  						'title'  => __( 'Posts' ) ,
  						'href'   => admin_url('edit.php'),
  						'meta'	=>  array('rel' => 'dashicons-wordpress')
  						
  					) );
  				  				
  					//Media
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'media',
  						'title'  => __( 'Media' ),
  						'href'   => admin_url('upload.php'),
  					) );
  				
  				
  					// Pages
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'pages',
  						'title'  => __( 'Pages' ),
  						'href'   => admin_url('edit.php?post_type=page'),
  					) );
  				
						  					
  					
  					// Comments - places itself right after the Dashboard link
  						$wp_admin_bar->add_menu( array(
  							'parent' => 'site-name',
  							'id'     => 'comments-options',
  							'title'  => __( 'Comments' ),
  							'href'   => admin_url('edit-comments.php'),
  						) );
  					
  					
  					//* Appearance
  					$wp_admin_bar->add_menu( array(
  								'parent' => 'site-name',
  								'id'     => 'appearance1',
  								'title'  => __( 'Appearance' ),
  								'href'   => admin_url('themes.php'),
  							) );
  						
  									
  						
  					// Plugins
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'plugins',
  						'title'  => __( 'Plugins' ),
  						'href'   => admin_url('plugins.php'),
  					) );
  				
  				
  					// Users
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'users',
  						'title'  => __( 'Users' ),
  						'href'   => admin_url('users.php'),
  					) );
  				  				
  					// Tools.
  					$wp_admin_bar->add_node( array(
  							'parent' => 'site-name',
  							'id'     => 'tools', 
  							'title'  => __( 'Tools' ),
  							'href'   => admin_url( 'tools.php' ),	
  					));	 
  					  				
  				
  					// Settings
  					$wp_admin_bar->add_menu( array(
  						'parent' => 'site-name',
  						'id'     => 'options',
  						'title'  => __( 'Settings' ),
  						'href'   => admin_url('options-general.php'),
  					) );			
  } }	