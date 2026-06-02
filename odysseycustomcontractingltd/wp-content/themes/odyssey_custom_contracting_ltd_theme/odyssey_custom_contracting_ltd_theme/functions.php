<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Method 1: Filter.
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyAvjoJXZFM9b77ychpikLmybgjR-ZnVN5k';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/wp-admin.php',                        // /wp-admin/ related functions
	'/deprecated.php',                      // Load deprecated functions.
	'/custom-login.php',                    // custom login styling
	'/eh-utility-functions.php',            // various useful utility functions
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

// ADD ACF OPTIONS PAGE (COMMENT TO DE-ACTIVATE)
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
					'page_title' => 'Universal Content',
					'menu_title' => 'Universal Content',
					'menu_slug' => 'universal-content',
					'capability' => 'edit_posts',
					'redirect' => false
	));
}


// custom field excerpt length limiting
function custom_field_excerpt($field_name)
{
	global $post;
	$text = get_field($field_name);
	if ('' != $text) {
		$text = strip_shortcodes($text);
		$text = apply_filters('the_content', $text);
		$excerpt_length = 20;
		$excerpt_more = apply_filters('excerpt_more', '');
		$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
	}
	return apply_filters('the_excerpt', $text);
}
