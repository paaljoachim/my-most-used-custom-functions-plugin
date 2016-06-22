/* Testing Uses featured image, if no featured image uses first image in the post, and if no post image uses a default selected image. */

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) { // Defines a default image.
    $first_img = "/path/to/default.png";
  }
  return $first_img;
}


/* http://wordpress.stackexchange.com/questions/60245/get-first-image-in-a-post */

