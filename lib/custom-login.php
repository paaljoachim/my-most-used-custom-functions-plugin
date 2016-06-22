<?php

/* Custom login code - Modified from: https://premium.wpmudev.org/blog/customize-login-page/ */

// URL link of logo.
function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// Name of site alt text.
function my_login_logo_url_title() {
return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Remove error message
function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');


// Remember Me is checked
function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}