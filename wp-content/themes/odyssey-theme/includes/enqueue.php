<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles', 100 );

function salient_child_enqueue_styles() {
  // Legacy pages load their own isolated assets; skip the new theme entirely.
  if ( function_exists( 'ody_is_legacy_page' ) && ody_is_legacy_page() ) {
    return;
  }

  $v = ODY_VERSION;

  wp_enqueue_style( 'theme-custom-style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/style.min.css' ) );
  wp_register_script( 'ody-form-js', get_stylesheet_directory_uri() . '/assets/js/forms.js', array( 'jquery' ), '', true );

  // Pages that need the forms JS enqueued.
  $form_pages = array( 'contact', 'careers' );

  // Auto-load page-specific CSS based on the page slug.
  // Convention: create assets/scss/pages/{slug}.scss and it loads automatically.
  if ( is_singular( 'page' ) ) {
    $slug = get_post_field( 'post_name', get_the_ID() );
    $file = get_stylesheet_directory() . "/assets/css/{$slug}.min.css";

    if ( file_exists( $file ) ) {
      wp_enqueue_style( "ody-{$slug}-style", get_stylesheet_directory_uri() . "/assets/css/{$slug}.min.css", array(), filemtime( get_stylesheet_directory() . "/assets/css/{$slug}.min.css" ) );
    }

    if ( in_array( $slug, $form_pages, true ) ) {
      wp_enqueue_script( 'ody-form-js' );
    }
  }



  if ( is_rtl() ) {
    wp_enqueue_style( 'salient-rtl', get_template_directory_uri() . '/rtl.css', array(), '1', 'screen' );
  }
}
