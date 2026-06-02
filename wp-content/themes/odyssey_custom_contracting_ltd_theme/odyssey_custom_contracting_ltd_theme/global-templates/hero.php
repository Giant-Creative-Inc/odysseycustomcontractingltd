<?php

/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$query = get_queried_object();

$title = is_tax() ? $query->name : get_the_title();
$subtext = '';

if (is_archive()) :
	$title = get_the_archive_title();
	$subtext = get_the_archive_description('<span class="taxonomy-description">', '</span>');

elseif (is_404()) :
	$title = 'Oops! That page can&rsquo;t be found.';
	$subtext = 'It looks like nothing was found at this location. Maybe try one of the links below or a search?';
elseif (is_search()) :
	$title = 'Search Results for: ' .
		'<span>' . get_search_query() . '</span>';
endif;
global $post;
global $_wp_additional_image_sizes;
?>
<header class="wrapper" id="wrapper-hero">
	<?php if (is_front_page()) : ?>
		<div id="home_page_hero" class="has-featured-image bg-img-cont position-relative entry-header py-5 d-flex flex-column d-flex flex-column align-content-end justify-content-end">

			<?php
			$hero_grp = 'hero_content_';
			$h_cta_fname = $hero_grp . 'hero_cta';
			$h_phone_fname = $hero_grp . 'phone_link';
			$h_phone_overline = get_field($hero_grp . 'phone_overline');

			$contactInfo = get_field('primary_contact_info', 'option');
			// email, phone
			$c_phone = $contactInfo['phone'];
			$c_email = $contactInfo['email'];

			?>
			<div class="container hero-content-container">
				<div class="row ">
					<div class=" hero-content col-12 d-flex flex-column flex-sm-row w-100 align-content-center">
						<div class="logo-cont">
							<?php
							//show primary site logo					
							if (has_custom_logo()) {
								the_custom_logo();
							} elseif ($logo2) {
								show_acf_img('secondary_logo', false, false, 'img-fluid w-100 navbar-brand', 'option', ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true);
							} else {
							?>
								<h1 class="mb-0 navbar-brand">
									<a rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>
								</h1>
							<?php
							}
							?>
						</div>

						<div class="contact-col d-flex flex-column flex-sm-row justify-content-center align-content-center text-white">
							<div class="mt-3 mt-sm-0 mb-6 mb-sm-0">
								<?php show_acf_link($h_cta_fname, false, 'btn btn-primary'); ?>
							</div>
							<div class="ml-4 call-block d-none d-sm-block">
								<?php echo $h_phone_overline ? '<span class="text-overline">' . $h_phone_overline . '</span>' : ''; ?>
								<?php if (get_field($h_phone_fname)) :
									show_acf_link($h_phone_fname, false, 'text-white h5');
								elseif ($c_phone) :
								?>
									<div class="mb-2 mr-4">
										<a href="tel:<?php echo $c_phone; ?>" class=" text-white h5" title="Call <?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
											<?php echo $c_phone; ?>
										</a>
									</div>
								<?php
								endif;
								?>
							</div>


						</div>

					</div>
				</div>
			</div>
			<svg id="home_hero_diamond" xmlns="http://www.w3.org/2000/svg" width="1440" height="900" viewBox="0 0 1440 900" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M1439.6 143.078L296.462 -1800.98L-846 143.078L296.462 1286.56L1439.6 143.078Z" stroke="black" stroke-width="2" stroke-miterlimit="10" />
			</svg>
			<?php
			show_ft_img_srcset('use-as-bg home-featured-image d-block');
			?>
			<h1 class="seo-title position-absolute"><?php echo esc_attr(get_bloginfo('name', 'display')) . ' ' . $title; ?></h1>
		</div>
	<?php
	elseif (has_post_thumbnail($post->ID) && (is_page() || is_single())) : ?>
		<div id="general_page_hero" class="has-featured-image entry-header text-center position-relative container-fluid py-5 d-flex flex-column justify-content-center align-content-center">
			<h1 class="text-white "><?php echo $title; ?></h1>
			<?php show_ft_img_srcset('use-as-bg'); ?>
		</div>
	<?php else : ?>
		<div id="general_page_hero" class="entry-header bg-black text-center text-white container-fluid py-5 d-flex flex-column justify-content-center align-content-center">
			<h1 class="text-white "><?php echo $title; ?></h1>
			<?php if (!empty($subtext)) : ?>
				<p class="text-white-50 mt-4"><?php echo $subtext; ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</header>