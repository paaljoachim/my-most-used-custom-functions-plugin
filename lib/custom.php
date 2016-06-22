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


/**********************
* All Posts listing of posts.
* Adding thumbnail and word count to Post List.
*
* http://theme.fm/2011/07/hacking-the-wordpress-admin-mastering-custom-columns-758/
*
**********************/

add_action( 'after_setup_theme', 'my_thumbnail_setup' );
function my_thumbnail_setup() {
	add_image_size( 'edit-screen-thumbnail', 80, 80, true );
}

add_filter( 'manage_edit-post_columns', 'my_columns_filter', 10, 1 );
function my_columns_filter( $columns ) {
 	$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$column_wordcount = array( 'wordcount' => 'Word count' );
	$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	$columns = array_slice( $columns, 0, 3, true ) + $column_wordcount + array_slice( $columns, 3, NULL, true );
	return $columns;
}

// Display
add_action( 'manage_posts_custom_column', 'my_column_action', 10, 1 );
function my_column_action( $column ) {
	global $post;
	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, 'edit-screen-thumbnail' );
			break;
		case 'wordcount':
			echo str_word_count( $post->post_content );
			break;
	}
}

/*-- https://wordpress.org/support/topic/make-first-image-in-post-featured-if-no-featured-is-set --*/

function get_src() {
  if ( has_post_thumbnail() ) {
	$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb' );
	$fbimage = $src[0];
  } else {
	global $post, $posts;
	$fbimage = '';
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
	$post->post_content, $matches);
	$fbimage = $matches [1] [0];
  }
  if(empty($fbimage)) {
    $fbimage = site_url().'/wp-content/themes/epik/img/logo.png';
  }
  return $fbimage;
}
add_filter('genesis_get_image', 'default_image_fallback', 10, 2);
function default_image_fallback($output, $args) {
    return get_image();
}

function get_image($class="") {
    $src = get_src();
    ob_start()?>
    <a href="<?php echo get_permalink() ?>">
        <img class="featured-image <?php echo $class ?>" src="<?php echo $src ?>" alt="<?php echo get_the_title() ?>" />
    </a>
    <?php return ob_get_clean();
}

