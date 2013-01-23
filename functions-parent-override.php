<?php

/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */

add_action( 'init', 'init_hook', 100 );
function init_hook() {
	remove_filter( 'gb_add_to_cart_form_fields', array( 'Group_Buying_Attributes', 'filter_add_to_cart_add_category_selection' ) );
}
