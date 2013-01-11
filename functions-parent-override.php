<?php

/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */

// redirect from homepage
add_action( 'pre_gbs_head', 'gb_redirect_to_home' );
/**
 * Redirect to the latest deal
 * @return null redirect
 */
function gb_redirect_to_home() {

	// Redirect away from almost everything if the user is not logged in.
	if ( !is_user_logged_in() && !is_home() ) {
		if (
			gb_on_login_page() ||
			gb_on_reset_password_page() ||
			gb_on_registration_page() 
			) {
				return;
			} else {
				gb_set_message( 'Membership Required.' );
				gb_login_required();
				return;
			}
	}
}
