<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>

<?php if (!is_page_template('page-templates/under-construction.php')) : ?>
	<?php
	if (!is_page_template('page-templates/contact.php') && !is_front_page()) :
		get_template_part('global-templates/section-footer-contact');
	endif;
	$contactInfo = get_field('primary_contact_info', 'option');
	// INSTAGRAM FEED
	$social_grp = 'social_media_';
	$social_ig_grp = $social_grp . 'instagram_';
	// $ig_url = get_field($social_ig_grp . 'url', 'option');

	if (is_plugin_active('instagram-feed/instagram-feed.php')) :
	?>
		<section id="home_instagram_feed" class="">

			<div class="container-fluid px-0">
				<div class="row px-0 mx-0">
					<div class="col-12 px-0">
						<?php
						echo do_shortcode('[instagram-feed feed=1]');
						?>
					</div>
				</div>
			</div>
		</section>
	<?php
	endif;

	//address
	$c_address = $contactInfo['address'];
	?>
	<footer class="wrapper bg-black" id="wrapper-footer">

		<div class="container">
			<div class="row vert1-p-tb">
				<div class="site-branding col col-lg-8 d-flex">

					<div class="footer-logo ">
						<a rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
							<?php
							$logo2 = get_field('secondary_logo', 'option');

							if ($logo2) :
								show_acf_img('secondary_logo', false, false, 'img-fluid w-100', 'option', ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true);
							else :
								the_custom_logo();
							endif;
							?>
						</a>
					</div>
					<div class="address-n-social">
						<h5 class=" title"><?php echo bloginfo('name'); ?></h5>
						<ul class="list-unstyled">
							<?php if ($c_address) : ?>
								<li class="address">
									<?php echo $c_address; ?>
								</li>
							<?php endif;?>
							<li class="d-flex mb-4"><a id="bbb-logo" href="https://www.bbb.org/ca/on/london/profile/general-contractor/odyssey-custom-contracting-0187-1088259/#sealclick" target="_blank" rel="nofollow"><img src="https://seal-london.bbb.org/seals/blue-seal-293-61-bbb-1088259.png" style="border: 0;" alt="Odyssey Custom Contracting BBB Business Review" /></a>
							</li>
							<?php
							if (have_rows('social_media', 'option')) : ?>
								<li class="socials d-flex">
									<!-- Start of the icons and links -->
									<?php while (have_rows('social_media', 'option')) : the_row();
										$icon = get_sub_field('icon');  // Fetch the Font Awesome icon class
										$link = get_sub_field('url');   // Fetch the link field details (it's an array with URL, title, target, etc.)

										if ($icon && $link) : ?>
											<a href="<?php echo esc_url($link['url']); ?>" class="icon" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>">
												<?php echo $icon; ?>
											</a>
										<?php endif; ?>
									<?php endwhile; ?>
									<!-- End of the icons and links -->

								</li>
							<?php endif; ?>
						</ul>
					</div>

				</div><!--col end -->

				<?php

				// email, phone
				$c_phone = $contactInfo['phone'];
				$c_email = $contactInfo['email'];

				if ($contactInfo && ($c_phone || $c_email)) :
				?>
					<div class="col col-lg-4 contact-info">
						<h4 class="title">Contact Us</h4>
						<ul class="list-unstyled">
							<?php if ($c_phone) : ?>
								<li class="mb-1">
									<a href="tel:<?php echo $c_phone; ?>" class=" text-white" title="Call <?php echo bloginfo('name'); ?> London Ontario">
										<?php echo $c_phone; ?>
									</a>
								</li>
							<?php endif; ?>
							<?php if ($c_email) : ?>
								<li class="">
									<a href="mailto:<?php echo $c_email; ?>" class=" text-white" title="Email <?php echo bloginfo('name'); ?> London Ontario">
										<span class="d-block d-sm-none">Email Us</span><span class="d-none d-sm-block"><?php echo $c_email; ?></span>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				<?php endif; ?>



			</div><!-- row end -->
			<div class="row">
				<div class="sub-footer text-center pb-3 col" id="colophon">
					<div class="site-info w-100 d-flex">
						<small>
							<em>
								<span class="mr-3">© Copyright <?php echo date('Y'); ?> <?php echo bloginfo('name'); ?> - All Rights Reserved</span>
								<span>Designed & Developed by Studio Higbee</span>
							</em>
						</small>
						<a class="back-to-top text-reset" href="#0">Back to top <i class="fa fa-arrow-up"></i></a>

						<?php
						//							understrap_site_info();
						?>

					</div><!-- .site-info -->

				</div><!-- #colophon -->
			</div>

		</div><!-- container end -->

	</footer><!-- wrapper end -->

<?php endif; ?>

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>