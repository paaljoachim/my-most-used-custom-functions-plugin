<?php

/* Back to top button */

/*function my_scripts_method() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '../js/back-to-top-button.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );*/

/* Create a shortcode to display a custom Go to top link
add_shortcode('footer_custombacktotop', 'set_footer_custombacktotop');
function set_footer_custombacktotop($atts) {
   return '
     <a href="#" class="tooltip" title=""><span title="">⇪</span></a>
   ';
}
add_action('wp_footer', 'go_to_top');
function go_to_top() { ?>
     <script type="text/javascript">
        jQuery(function($) {
          $('.tooltip').click(function() {
             $('html, body').animate({scrollTop:0}, 'slow');
             return false;
          });
        });
     </script>
<?php }*/

//* Create a shortcode to display a custom Go to top link
add_shortcode('footer_custombacktotop', 'set_footer_custombacktotop');
function set_footer_custombacktotop($atts) {
   return '
     <a href="#" class="tooltip" title=""><span title="">⇪</span></a>
   ';
}
add_action('wp_footer', 'go_to_top');
function go_to_top() { ?>
     <script type="text/javascript">
        jQuery(function($) {
          $('.tooltip').click(function() {
             $('html, body').animate({scrollTop:0}, 'slow');
             return false;
          });
        });
     </script>
<?php }