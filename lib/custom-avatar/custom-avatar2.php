<?php
/**
 * Use Custom Avatar if Provided
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 */
function be_gravatar_filter($avatar, $id_or_email, $size, $default, $alt) {
	
	// If provided an email and it doesn't exist as WP user, return avatar since there can't be a custom avatar
	$email = is_object( $id_or_email ) ? $id_or_email->comment_author_email : $id_or_email;
	if( is_email( $email ) && ! email_exists( $email ) )
		return $avatar;
	
	$custom_avatar = get_the_author_meta('be_custom_avatar');
	if ($custom_avatar) 
		$return = '<img src="'.$custom_avatar.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	elseif ($avatar) 
		$return = $avatar;
	else 
		$return = '<img src="'.$default.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	return $return;
}
add_filter('get_avatar', 'be_gravatar_filter', 10, 5);