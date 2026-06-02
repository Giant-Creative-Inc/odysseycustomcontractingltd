<?php
defined( 'ABSPATH' ) || exit;

// Route to the legacy footer on designated pages; otherwise fall through to
// the Salient parent theme's footer.
if ( function_exists( 'ody_is_legacy_page' ) && ody_is_legacy_page() ) {
	include LEGACY_THEME_DIR . '/footer.php';
} else {
	include get_template_directory() . '/footer.php';
}
