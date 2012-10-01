<?php

/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */

/** Australia */
function custom_states() {
	return array(
		'AUS' => array(
			'QLD;' => 'Queensland',
			'NSW' => 'New South Wales',
			'VIC' => 'Victoria',
			'SA' => 'South Australia',
			'WA' => 'Western Australia', 
			'NT' => 'Northern Territory',
			'TAS' => 'Tasmania'
		)
	); 
}
add_filter('gb_state_options', 'custom_states');
/** Australia */
function custom_country() {
	return array(
		'AUS' => 'Australia'
	);
}
add_filter('gb_country_options', 'custom_country');
