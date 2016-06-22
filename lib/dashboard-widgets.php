<?php

// Dashboard widgets 


// Remove unwanted dashboard widgets. Find the names by using Inspect Element. Find the ID tag of each widget.
function remove_dashboard_widgets() {

 // Remove Welcome to WordPress! widget NB! It uses a different code.
 // https://codex.wordpress.org/Plugin_API/Action_Reference/welcome_panel
 //remove_action( 'welcome_panel', 'wp_welcome_panel');
 
 // Remove meta boxes to the left. 
 // At a Glance widget
 remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
 // Activity widget
 //remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
 
 // Remove meta boxes to the right.
 // Quick Draft widget
 remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
 // WordPress News
// remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
}

add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

/***************************** 
*Add a custom Welcome Dashboard Panel
*****************************/
function my_welcome_panel() {
    ?>	     
    <div class="getting-started">
    <p align=center><?php _e( 'To learn more check out the below videos' ); ?></p>
    <h3 align=center><?php _e('Taking your first steps with WordPress' ); ?></p>
   
    <p align=center><iframe width="560" height="315" src="https://www.youtube.com/embed/VdvOGV2eIjE?list=PLD3AB608F62AC973C" frameborder="0" allowfullscreen></iframe></p>
      	
    
    </div>
<?php
}

//remove_action('welcome_panel','wp_welcome_panel');
add_action( 'welcome_panel', 'my_welcome_panel' );