<?php
/**
 * Add Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param object $user
 */
function be_custom_avatar_field( $user ) { ?>
	<h3>Custom Avatar</h3>
	 
	<table>
	<tr>
	<th><label for="be_custom_avatar">Custom Avatar URL:</label></th>
	<td>
	<input type="text" name="be_custom_avatar" id="be_custom_avatar" value="<?php echo esc_attr( get_the_author_meta( 'be_custom_avatar', $user->ID ) ); ?>" /><br />
	<span>Type in the URL of the image you'd like to use as your avatar. This will override your default Gravatar, or show up if you don't have a Gravatar. <br /><strong>Image should be 70x70 pixels.</strong></span>
	</td>
	</tr>
	</table>
	<?php 
}
add_action( 'show_user_profile', 'be_custom_avatar_field' );
add_action( 'edit_user_profile', 'be_custom_avatar_field' );
/**
 * Save Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param int $user_id
 */
function be_save_custom_avatar_field( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
		update_usermeta( $user_id, 'be_custom_avatar', $_POST['be_custom_avatar'] );
}
add_action( 'personal_options_update', 'be_save_custom_avatar_field' );
add_action( 'edit_user_profile_update', 'be_save_custom_avatar_field' );