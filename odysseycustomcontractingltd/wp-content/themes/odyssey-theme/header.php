<?php
defined( 'ABSPATH' ) || exit;

// Route to the legacy header on designated pages; otherwise fall through to
// the Salient parent theme's header.
if ( function_exists( 'ody_is_legacy_page' ) && ody_is_legacy_page() ) {
	include LEGACY_THEME_DIR . '/header.php';
} else {
	include get_template_directory() . '/header.php';
}
