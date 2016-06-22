<?php

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

/*-- 
Testing Uses featured image, if no featured image uses first image in the post, and if no post image uses a default selected image. 
https://developer.wordpress.org/reference/functions/has_post_thumbnail/
https://wordpress.org/support/topic/make-first-image-in-post-featured-if-no-featured-is-set 
http://wordpress.stackexchange.com/questions/60245/get-first-image-in-a-post 
http://www.wpbeginner.com/beginners-guide/how-to-add-featured-image-or-post-thumbnails-in-wordpress/
--*/

function catch_that_image() {
  if ( has_post_thumbnail() ) {
    $first_img = get_the_post_thumbnail(); // Use featured image if the post has one.
  } else {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
    if (empty($first_img)) { //If no post image then use a default image.
      $first_img = '<img src="' . plugins_url( 'images/sunset.jpg', dirname(__FILE__) ) . '" > ';
    }
  }
  return $first_img;
}

