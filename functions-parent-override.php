<?php

/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */

///////////////////
// Theme Scripts //
///////////////////

function gbs_child_theme_register_scripts() {

	if ( !is_admin() ) {
		wp_register_script( 'placeholder-enhanced', get_stylesheet_directory_uri().'/js/jquery.placeholder-enhanced.min.js', array( 'jquery' ), gb_ptheme_current_version(), false );
	}

}
add_action( 'init', 'gbs_child_theme_register_scripts' );

function gbs_child_theme_enqueue_scripts() {

	if ( !is_admin() ) {

		// GBS Scripts
		wp_enqueue_script( 'placeholder-enhanced' );
	}
}
add_action( 'wp_enqueue_scripts', 'gbs_child_theme_enqueue_scripts' );
