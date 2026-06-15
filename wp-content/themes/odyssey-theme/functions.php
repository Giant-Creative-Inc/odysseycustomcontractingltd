<?php

// Child theme version — bump this when deploying CSS/JS changes to bust the cache.
// Kept separate from nectar_get_theme_version() so Salient updates don't
// invalidate our own cached assets.
define( 'ODY_VERSION', '1.1.2' );

require_once get_stylesheet_directory() . '/includes/legacy-theme.php';
require_once get_stylesheet_directory() . '/includes/enqueue.php';
require_once get_stylesheet_directory() . '/includes/acf-hooks.php';
require_once get_stylesheet_directory() . '/includes/critical-css.php';
require_once get_stylesheet_directory() . '/includes/acf-page-schema.php';

// Remove WordPress default Site Icon output.
add_filter('site_icon_meta_tags', '__return_empty_array');

// Add light/dark mode favicons.
function giant_theme_color_mode_favicons() {
    $theme_uri = get_stylesheet_directory_uri();

    $favicon_light = $theme_uri . '/assets/img/favicon-lightmode.png';
    $favicon_dark  = $theme_uri . '/assets/img/favicon-darkmode.png';

    ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_light); ?>">
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_light); ?>" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_dark); ?>" media="(prefers-color-scheme: light)">
    <?php
}
add_action('wp_head', 'giant_theme_color_mode_favicons', 99);
add_action('admin_head', 'giant_theme_color_mode_favicons', 99);
add_action('login_head', 'giant_theme_color_mode_favicons', 99);