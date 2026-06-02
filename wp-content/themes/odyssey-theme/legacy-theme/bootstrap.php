<?php
defined( 'ABSPATH' ) || exit;

if ( ! defined( 'LEGACY_THEME_DIR' ) ) {
	define( 'LEGACY_THEME_DIR', get_stylesheet_directory() . '/legacy-theme' );
}
if ( ! defined( 'LEGACY_THEME_URI' ) ) {
	define( 'LEGACY_THEME_URI', get_stylesheet_directory_uri() . '/legacy-theme' );
}

// Register the nav menu location the legacy header relies on.
// setup.php is intentionally not loaded (would conflict with Salient), so we
// register only what the legacy templates actually need here instead.
add_action( 'after_setup_theme', function () {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'understrap' ),
	) );
}, 20 );

// Register custom image sizes the legacy templates rely on.
// These were originally in the legacy setup.php; we register them here
// so eh-utility-functions.php can look them up in $_wp_additional_image_sizes.
add_action( 'after_setup_theme', function () {
	$sizes = [
		'fp-small'  => [ 640, 0 ],
		'fp-medium' => [ 1024, 0 ],
		'fp-large'  => [ 1200, 0 ],
		'fp-xlarge' => [ 1920, 0 ],
		'xlarge'    => [ 1440, 1440 ],
		'1080p'     => [ 1920, 1080 ],
		'retina'    => [ 3200, 3200 ],
	];
	foreach ( $sizes as $name => [ $w, $h ] ) {
		add_image_size( $name, $w, $h );
	}
}, 20 );

// Load only what the legacy templates actually need.
// We do NOT load setup.php, enqueue.php, customizer.php, or editor.php
// to avoid clashing with Salient's theme setup.
$legacy_inc = [
	'/inc/eh-utility-functions.php',
	'/inc/class-wp-bootstrap-navwalker.php',
	'/inc/template-tags.php',
	'/inc/hooks.php',
	'/inc/extras.php',
	'/inc/pagination.php',
];

foreach ( $legacy_inc as $file ) {
	$path = LEGACY_THEME_DIR . $file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}
