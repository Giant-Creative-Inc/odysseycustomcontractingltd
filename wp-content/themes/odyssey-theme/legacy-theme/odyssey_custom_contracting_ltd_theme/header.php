<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

//$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php get_template_part('inc/analytics'); ?>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="PpqgjAcpPwdENngS9nDxGPcOAeSLg1r37Qs9jmJkSkk" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/safari-pinned-tab.svg" color="#1C1818">
	<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri('/')); ?>/favicon.ico">
	<meta name="msapplication-config" content="<?php echo esc_url(get_template_directory_uri('/')); ?>/browserconfig.xml">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="theme-color" content="#ffffff">
	<!-- Loads FontAwesome Pro -->
	<script src="https://kit.fontawesome.com/cbb27f0237.js" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>

<?php
$bodyClasses = '';

if (is_page_template('page-templates/home.php')) :
	$bodyClasses = $bodyClasses . ' bg-dark';
endif;

		$contactInfo = get_field('primary_contact_info', 'option');
		// email, phone
		$c_phone = $contactInfo['phone'];


?>

<body <?php body_class($bodyClasses); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<?php

		if (!is_page_template('page-templates/under-construction.php')) : ?>
			<!-- ******************* The Navbar Area ******************* -->
			<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite" class="sticky-top">

				<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>

				<nav class="navbar navbar-expand-md navbar-dark bg-black px-0 py-3">

					<div class="container-fluid px-0 px-lg-7">

						<!-- Your site title as branding in the menu -->
						<div class="px-4 px-lg-0 justify-content-between d-flex mobile-nav-wrapper">
							<div class="brand-cont">
								<div>

									<?php
									$logo2 = get_field('secondary_logo', 'option');
									if ($logo2 || has_custom_logo()) : ?>
										<a class="logo-wrap" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
											<?php
											if ($logo2) :

												show_acf_img('secondary_logo', false, false, 'img-fluid nav-logo', 'option', ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true);

											elseif (has_custom_logo()) :
												the_custom_logo();
											endif;
											?>
										</a>
										<?php

									else :

										if (is_front_page() && is_home()) :
										?>

											<h1 class="navbar-brand mb-0">
												<a rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>
											</h1>

										<?php
										else :
										?>

											<a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

									<?php
										endif;


									endif;

									?>
								</div>
							</div>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
								<span class="navbar-toggler-icon"></span>
							</button>

						</div>
						<!--					<div class="px-4 px-lg-0 w-100 bg-lg-reset">-->
						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container_class' => 'collapse navbar-collapse bg-dark px-4 px-lg-0 bg-md-reset',
								'container_id' => 'navbarNavDropdown',
								'menu_class' => 'navbar-nav',
								'fallback_cb' => '',
								'menu_id' => 'main-menu',
								'depth' => 2,
								'walker' => new Understrap_WP_Bootstrap_Navwalker(),
							)
						); ?>
						<!--					</div>-->
					</div><!-- .container -->

				</nav><!-- .site-navigation -->

			</div><!-- #wrapper-navbar end -->
			<div id="mobile_fixed_cta" class="mobile-fixed-cta d-sm-none">
				<a href="tel:<?php echo $c_phone; ?>" class="nav-phone text-dark d-block h5 mb-0  p-3" title="Call <?php echo bloginfo('name'); ?> London Ontario">
					<span><i class="fa fa-phone mr-1"></i> </span><span><?php echo $c_phone; ?></span>
				</a>
			</div>
		<?php endif; ?>