<?php
defined( 'ABSPATH' ) || exit;

// Load legacy constants and functions unconditionally so they are available
// whenever a legacy template file (including header/footer) is rendered.
require_once get_stylesheet_directory() . '/legacy-theme/bootstrap.php';

// ---------------------------------------------------------------------------
// Helper: which pages use the legacy theme
// ---------------------------------------------------------------------------

function ody_legacy_page_slugs() {
	return [ 'new-project-request-get-a-free-quote', 'testimonials' ];
}

function ody_is_legacy_page() {
	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_the_ID() );
		return in_array( $slug, ody_legacy_page_slugs(), true );
	}
	return false;
}

// ---------------------------------------------------------------------------
// Template routing: swap in the legacy template for the 3 specified pages
// ---------------------------------------------------------------------------

add_filter( 'template_include', function ( $template ) {
	if ( ! ody_is_legacy_page() ) {
		return $template;
	}

	// Check if the page has a specific template assigned and it exists in legacy-theme.
	$page_template = get_page_template_slug( get_the_ID() );
	if ( $page_template && file_exists( LEGACY_THEME_DIR . '/' . $page_template ) ) {
		return LEGACY_THEME_DIR . '/' . $page_template;
	}

	// Home page default template.
	if ( is_front_page() && file_exists( LEGACY_THEME_DIR . '/page-templates/home.php' ) ) {
		return LEGACY_THEME_DIR . '/page-templates/home.php';
	}

	// Generic page template.
	if ( file_exists( LEGACY_THEME_DIR . '/page.php' ) ) {
		return LEGACY_THEME_DIR . '/page.php';
	}

	return LEGACY_THEME_DIR . '/index.php';
}, 99 );

// ---------------------------------------------------------------------------
// Assets: strip all new/Salient styles and scripts; enqueue only legacy ones
// ---------------------------------------------------------------------------

add_action( 'wp_enqueue_scripts', function () {
	if ( ! ody_is_legacy_page() ) {
		return;
	}

	global $wp_styles, $wp_scripts;

	// Handle prefixes for plugin assets that must survive the dequeue sweep.
	// Add a prefix here if another plugin's styles/scripts break on legacy pages.
	$keep_style_prefixes  = [ 'sbi_', 'gform_', 'popup-maker', 'pum-' ];
	$keep_script_prefixes = [ 'sbi_', 'gform_', 'popup-maker', 'pum-' ];

	// Dequeue every style except the admin bar, dashicons, and allowed plugin assets.
	$keep_styles = [ 'admin-bar', 'dashicons' ];
	foreach ( array_unique( $wp_styles->queue ) as $handle ) {
		if ( in_array( $handle, $keep_styles, true ) ) {
			continue;
		}
		foreach ( $keep_style_prefixes as $prefix ) {
			if ( strpos( $handle, $prefix ) === 0 ) {
				continue 2;
			}
		}
		wp_dequeue_style( $handle );
	}

	// Dequeue every script except jQuery, the admin bar, and allowed plugin assets.
	$keep_scripts = [ 'jquery', 'jquery-core', 'jquery-migrate', 'admin-bar' ];
	foreach ( array_unique( $wp_scripts->queue ) as $handle ) {
		if ( in_array( $handle, $keep_scripts, true ) ) {
			continue;
		}
		foreach ( $keep_script_prefixes as $prefix ) {
			if ( strpos( $handle, $prefix ) === 0 ) {
				continue 2;
			}
		}
		wp_dequeue_script( $handle );
	}

	// Enqueue legacy stylesheet.
	$css = LEGACY_THEME_DIR . '/css/theme.min.css';
	if ( file_exists( $css ) ) {
		wp_enqueue_style( 'legacy-theme-style', LEGACY_THEME_URI . '/css/theme.min.css', [], filemtime( $css ) );
	}

	// Enqueue legacy scripts (Bootstrap 4 + custom JS bundled in theme.min.js).
	$js = LEGACY_THEME_DIR . '/js/theme.min.js';
	if ( file_exists( $js ) ) {
		wp_enqueue_script( 'legacy-theme-scripts', LEGACY_THEME_URI . '/js/theme.min.js', [ 'jquery' ], filemtime( $js ), true );
	}
}, 9999 );
