<?php

/* Add Contact Methods in User Profile - https://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods */

function add_user_contact_methods( $user_contact ) {
  $user_contact['facebook'] = __( 'Facebook URL' );
  $user_contact['skype']   = __( 'Skype Username'   );
  $user_contact['twitter'] = __( 'Twitter Handle' );
  $user_contact['youtube'] = __( 'Youtube Channel' );
  $user_contact['linkedin'] = __( 'LinkedIn' );
  $user_contact['googleplus'] = __( 'Google +' );
  $user_contact['pinterest'] = __( 'Pinterest' );
  $user_contact['instagram'] = __( 'Instagram' );
  $user_contact['github'] = __( 'Github profile' ); 
  
  return $user_contact;
  
}
add_filter( 'user_contactmethods', 'add_user_contact_methods' );


/* http://www.wpbeginner.com/wp-tutorials/how-to-add-an-author-info-box-in-wordpress-posts/ */ 

//Load Fontawesome
function themeprefix_fontawesome_styles() {
	wp_register_style( 'fontawesome' , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', '' , '4.4.0', 'all' );
	wp_enqueue_style( 'fontawesome' );
}
add_action( 'wp_enqueue_scripts', 'themeprefix_fontawesome_styles' ); 


function wpb_author_info_box( $content ) {

global $post;

// Detect if it is a single post with a post author
if ( is_single() && isset( $post->post_author ) ) {

// Get author's display name - NB! changed display_name to first_name. Error in code.
$display_name = get_the_author_meta( 'first_name', $post->post_author );

// If display name is not available then use nickname as display name
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );


// Get author's biographical information or description
$user_description = get_the_author_meta( 'user_description', $post->post_author );



// Get author's website URL 
$user_website = get_the_author_meta('url', $post->post_author);

// Get author's email
$user_email = get_the_author_meta('email', $post->post_author);

// Get author's Facebook
$user_facebook = get_the_author_meta('facebook', $post->post_author);

// Get author's Skype
$user_skype = get_the_author_meta('skype', $post->post_author);

// Get author's	Twitter
$user_twitter = get_the_author_meta('twitter', $post->post_author);

// Get author's	LinkedIn	
$user_linkedin = get_the_author_meta('linkedin', $post->post_author);
 
// Get author's Youtube
$user_youtube = get_the_author_meta('youtube', $post->post_author);

// Get author's Google+
$user_googleplus = get_the_author_meta('googleplus', $post->post_author);

// Get author's Pinterest
$user_pinterest = get_the_author_meta('pinterest', $post->post_author);

// Get author's Instagram
$user_instagram = get_the_author_meta('instagram', $post->post_author);

// Get author's Github
$user_github = get_the_author_meta('github', $post->post_author);




// Get link to the author archive page
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
if ( ! empty( $display_name ) )
$author_details = '<p class="author_name">About ' . $display_name . '</p>';

// Author avatar - - the number 90 is the px size of the image.
$author_details .= '<p class="author_image">' . get_avatar( get_the_author_meta('ID') , 90 ) . '</p>';
$author_details .= '<p class="author_bio">' . get_the_author_meta( 'description' ). '</p>';
$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name .   '</a></p>';  

// Display

// Check if author has a website in their profile
if ( ! empty( $user_website ) ) {
// Display author website link
$author_details .= '<a href="' . $user_website .'" target="_blank" rel="nofollow" >Website</a></p>';
} else { 
// if there is no author website link then just close the paragraph
$author_details .= '</p>';
}

$author_details .= '<class="social-links">';

// Fontawesome icons: http://fontawesome.io/icons/

// Display author Email link
$author_details .= ' <a href="mailto:' . $user_email .'" target="_blank" rel="nofollow" title="E-mail" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/email2.png', dirname(__FILE__) ) . '" width="50" class="social-icons"> </a></p>';


// Check if author has Facebook in their profile
if ( ! empty( $user_facebook ) ) {
// Display author Facebook link
$author_details .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" title="Facebook" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/facebook.png', dirname(__FILE__) ) . '" width="50" class="social-icons"> </a></p>';
} else { 
// if there is no author Facebook link then just close the paragraph
$author_details .= '</p>';
}

// Check if author has Skype in their profile
if ( ! empty( $user_skype ) ) {
// Display author Skype link
$author_details .= ' <a href="' . $user_skype .'" target="_blank" rel="nofollow" title="Username paaljoachim Skype" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/skype.png', dirname(__FILE__) ) . '" width="50" class="social-icons"> </a></p>';
} else { 
// if there is no author Skype link then just close the paragraph
$author_details .= '</p>';
}


// Check if author has Twitter in their profile
if ( ! empty( $user_twitter ) ) {
// Display author Twitter link
$author_details .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" title="Twitter" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/twitter.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Twitter link then just close the paragraph
$author_details .= '</p>';
}


// Check if author has LinkedIn in their profile
if ( ! empty( $user_linkedin ) ) {
// Display author LinkedIn link
$author_details .= ' <a href="' . $user_linkedin .'" target="_blank" rel="nofollow" title="LinkedIn" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/linkedin.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author LinkedIn link then just close the paragraph
$author_details .= '</p>';
}


// Check if author has Youtube in their profile
if ( ! empty( $user_youtube ) ) {
// Display author Youtube link
$author_details .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" title="Youtube" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/youtube.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Youtube link then just close the paragraph
$author_details .= '</p>';
}


// Check if author has Google+ in their profile
if ( ! empty( $user_googleplus ) ) {
// Display author Google + link
$author_details .= ' <a href="' . $user_googleplus .'" target="_blank" rel="nofollow" title="Google+" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/google+.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Google+ link then just close the paragraph
$author_details .= '</p>';
}


// Check if author has Pinterest in their profile
if ( ! empty( $user_pinterest ) ) {
// Display author Pinterest link
$author_details .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" title="Pinterest" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/pinterest.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Pinterest link then just close the paragraph
$author_details .= '</p>';
}

// Check if author has Instagram in their profile
if ( ! empty( $user_instagram ) ) {
// Display author Instagram link
$author_details .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" title="Instagram" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/instagram.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Instagram link then just close the paragraph
$author_details .= '</p>';
}

// Check if author has Github in their profile
if ( ! empty( $user_github ) ) {
// Display author Github link
$author_details .= ' <a href="' . $user_github .'" target="_blank" rel="nofollow" title="Github" class="tooltip"><img src="' . plugins_url( 'images/social-media-icons/github.png', dirname(__FILE__) ) . '" width="50" class="social-icons"></a></p>';
} else { 
// if there is no author Github link then just close the paragraph
$author_details .= '</p>';
}

$author_details .= '</div>';


// Pass all this info to post content  
$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
}
return $content;
}

// Add our function to the post content filter 
add_action( 'the_content', 'wpb_author_info_box' );

// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');

