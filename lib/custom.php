<?php


/*----- Shorter custom code snippets --*/



/**************** 
*
*  By default show Kitchen Sink in WYSIWYG Editor
*  https://core.trac.wordpress.org/ticket/12207
*
*****************/

function unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );



/**************** 
*
*  Adds Lorem Ipsum text to blank pages - Lasts for an hour.
*  https://www.wp-code.com/wordpress-snippets/automatically-add-lorem-ipsum-text-to-blank-wordpress-pages/ 
*  @param string $content - the page's current contents
*  @return string
*
*****************/
 
 function emw_custom_filter_the_content ($content) {
     if ($content == '') {
         if ($c = get_transient ('lipsum'))
             return $c;
         $content = wp_remote_get ('http://www.lipsum.com/feed/json');
         if (!is_wp_error($content)) {
             $content = json_decode (str_replace ("\n", '</p><p>', $content['body']));
             $content = '<p>'.$content->feed->lipsum.'</p>';
             set_transient ('lipsum', $content, 3600); // Cache the text for one hour
             return $content;
         }
     } else
         return $content;
 }

add_filter ('the_content', 'emw_custom_filter_the_content');



/*----NOT SURE IF THIS IS WORKING..---*/

/****************************************************************
* Add a new custom Gravatar to the bottom of the Settings -> Discussion section
* http://blogtimenow.com/wordpress/create-add-custom-default-avatar-wordpress-gravatar/
* http://crunchify.com/how-to-change-default-avatar-in-wordpress/
* 
*********************************************************************/
add_filter( 'avatar_defaults', 'new_custom_default_gravatar' );
function new_custom_default_gravatar ($avatar_defaults) {
$myavatar = plugins_url('../images/gravatar-silhouette.png', __FILE__ );
$avatar_defaults[$myavatar] = "Custom Default Gravatar";
return $avatar_defaults;
}



/************ NOT SURE IF THIS WORKS------?
*
* Automatic update of themes, plugins and major WP versions.
*
* http://www.wpwhitesecurity.com/wordpress-tutorial/guide-configuring-wordpress-automatic-updates/
*
*************************/

/* Allow major updates to be automatic updated */
add_filter('allow_major_auto_core_updates', '__return_true' );

/* Allow themes to be automatic updated */
add_filter( 'auto_update_theme', '__return_true');

/* Allow plugins to be automatic updated */
add_filter( 'auto_update_plugin', '__return_true' );


/********************************************************************
*
* Replace WordPress Howdy
* http://www.trickspanda.com/2014/01/change-howdy-text-wordpress-admin-bar/
*
********************************************************************/
function change_howdy($translated, $text, $domain) {

    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', 'Welcome to the Backend of WordPress', $translated);
    return $translated;
}
add_filter('gettext', 'change_howdy', 10, 3);


/*****************************
*
* Bottom of backend Admin screen -  Custom admin footer credits https://github.com/gregreindel/greg_html5_starter 
*
*******************************/

add_filter( 'admin_footer_text', create_function( '$a', 'return \'<span id="footer-thankyou">Site managed by <a href="http://www.easywebdesigntutorials.com" target="_blank">Paal Joachim Romdahl </a><span> | Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>\';' ) );




/*******************
*
* change the color of the posts in the post list
* http://lorib.me/code/change-admin-postpage-list-color-by-status/  
*
********************/

add_action('admin_footer','posts_status_color');
function posts_status_color(){
?>
<style>
.status-draft { background: #fee7d6 !important;}
.status-future { background: #cf9 !important; }
.status-publish { /* no background - keep alternating rows */ }
.status-pending { background: #87c5d6 !important; }
.status-private { background:#fc9; }
.category-themes { background: #f7f2f2; }
.category-plugins { background: #f3f2f2; }
</style>
<?php
}

/**
 * Embed Gists with a URL
 *
 * Usage:
 * Paste a gist link into a blog post or page and it will be embedded eg:
 * https://gist.github.com/2926827
 *
 * If a gist has multiple files you can select one using a url in the following format:
 * https://gist.github.com/2926827?file=embed-gist.php
 *
 * Updated this code on June 14, 2014 to work with new(er) Gist URLs
 */
 
	wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)(\?file=.*)?/i', 'bhww_embed_handler_gist' );
 
	function bhww_embed_handler_gist( $matches, $attr, $url, $rawattr ) {
 
		$embed = sprintf(
				'<script src="https://gist.github.com/%1$s.js%2$s"></script>',
				esc_attr($matches[1]),
				esc_attr($matches[2])
				);
 
		return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
		
	}


/* http://clarknikdelpowell.com/blog/3-ways-to-use-icon-fonts-in-your-wordpress-theme-admin/
http://wpsites.net/web-design/change-breadcrumbs-in-genesis/

http://wpsites.net/web-design/adding-dashicons-in-wordpress/
http://melchoyce.github.io/dashicons/
*/
