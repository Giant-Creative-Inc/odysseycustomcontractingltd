<?php

/**
 * Template Name: Home Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

include LEGACY_THEME_DIR . '/global-templates/hero.php';

?>

<div class="" id="home">

	<div id="content">

		<main class="site-main pt-5" id="main" role="main">
			<?php
			// INTRO SECTION
			$intro_content = get_field('intro_content');
			if (!empty($intro_content)) :
			?>
				<section id="home_intro_content" class="container position-relative py-6 py-lg-8 vert1-p-tb">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-lg-6 content-col text-size-large text-white text-center">
							<?php echo $intro_content; ?>
						</div>
					</div>
					<svg id="page_bg_diamond" width="826" height="2567" viewBox="0 0 826 2567" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M825.373 1616.48L-124.5 2566.29L-1074.37 1616.48L-124.5 0.986502L825.373 1616.48Z" stroke="white" />
					</svg>
				</section>
			<?php endif;
			// ABOUT US - SECTION 1

			$about_section_grpname = 'about_us_section_1_';
			$about_section = get_field('about_us_section_1');
			$au_title = $about_section['title'];
			$au_content = $about_section['content'];
			$au_overline = $about_section['overline'];

			if (!empty($au_title) && !empty($au_content)) :
			?>
				<section id="about_us_section_1" class="container vert1-p-tb py-6 py-lg-8">
					<div class="row d-flex align-items-center ">
						<div class="col ">
							<div class="content-col">
								<?php
								//overline
								if (!empty($au_overline)) : ?>
									<span class="text-overline text-white-50 text-size-large"><?php echo $au_overline; ?></span>
								<?php
								endif;
								//title
								if (!empty($au_title)) : ?>
									<h2 class="text-left text-white">
										<?php echo $au_title; ?>
									</h2>
								<?php endif;
								?>
							</div>
						</div>
						<div class="col ">
							<div class="content-col">
								<?php
								// content
								if (!empty($au_content)) : ?>
									<div class=" content-area text-left text-white-50 text-size-large">
										<div>
											<?php echo $au_content; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</section>

			<?php
			endif;

			// VALUE PROP TABS
			$val_prop_fname = "value_prop_tabs";
			// Assuming you are within the WordPress loop

			if (have_rows($val_prop_fname)) : ?>
				<section id="value_prop_section" class="container vert1-p-tb">
					<div class="row align-content-center">
						<div class="col">
							<ul class="nav flex-column nav-trnsp" id="valPropTabs" role="tablist">
								<?php
								// Loop through the repeater field items
								while (have_rows($val_prop_fname)) :
									the_row();

									// Get the subfield values
									$tabTitle = get_sub_field('tab_title');
									$tabContent = get_sub_field('content');

									// Generate tab item HTML
									$index = get_row_index();
									$tabId = 'tab-' . $index;

									// Output the tab link
								?>
									<li class="nav-item" role="presentation">
										<?php
										echo '<a class="nav-link h4 pl-0 '
											. ($index === 1 ? ' active' : '')
											. '" id="' . $tabId . '-tab" data-toggle="tab" href="#'
											. $tabId . '" role="tab" aria-controls="'
											. $tabId . '" aria-selected="'
											. ($index === 1 ? 'true' : 'false')
											. '">' . esc_html($tabTitle) . '</a>';
										?>
									</li>
								<?php
								endwhile; ?>

							</ul>
						</div>
						<div class="col align-content-center">
							<div class="tab-content text-white" id="valPropTabContent">
								<?php
								// Output the tab content

								while (have_rows($val_prop_fname)) :
									the_row();

									// Get the subfield values
									$tabContent = get_sub_field('content');

									// Generate tab item HTML
									$index = get_row_index();
									$tabId = 'tab-' . $index;

									echo '<div class="tab-pane fade text-size-large'
										. ($index === 1 ? ' show active' : '')
										. '" id="' . $tabId . '" role="tabpanel" aria-labelledby="'
										. $tabId . '-tab">' . wp_kses_post($tabContent) . '</div>';
								endwhile; ?>
							</div>
						</div>
					</div>
				</section>
			<?php
			endif;

			// ADJECTIVE ROW
			if (have_rows('adjective_row')) :
			?>
				<section id="adjective_row" class="container-fluid justify-content-center border-top border-bottom border-color-white">

					<div class="row mx-auto justify-content-md-center align-content-center">
						<?php while (have_rows('adjective_row')) :
							the_row();

							$adj = get_sub_field('adjective');
							if (!empty($adj)) :
						?>
								<div class="col text-white h5">
									<div>
										<p class="text-center mb-0"><?php echo $adj; ?></p>
									</div>
								</div>
						<?php
							else :
								continue;
							endif;
						endwhile; ?>
					</div>

				</section>





			<?php
			endif;
			//ABOUT US SECTION 4
			$au4_grpname = 'about_us_section_4_';
			$au4_section = get_field('about_us_section_4');

			$au4_image = get_field($au4_grpname . 'image');
			$au4_title = $au4_section['title'];
			$au4_content = $au4_section['content'];

			if (!empty($au4_image) || !empty($au4_title)) :
			?>
				<section id="home_about_us_section_4" class="container vert1-p-tb">
					<div class="row">
						<div class="col-12 col-md-6 content-col">
							<div class="">
								<?php if (!empty($au4_title)) : ?>
									<h2 class="text-left text-white section-title">
										<?php echo $au4_title; ?>
										</h3>
									<?php endif;
								if (!empty($au4_content)) : ?>
										<div class="content text-white text-size-large">
											<?php echo $au4_content; ?>
										</div>
									<?php
								endif;
								$au_cta_grpname = $au4_grpname . 'call_to_action_card_';
								$au_cta_grp = $au4_section['call_to_action_card'];
								$au_cta_content = $au_cta_grp['content'];

								if (!empty($au_cta_grp)) : ?>
										<div class="cta-block p-5 text-white">
											<div class="h5">
												<?php echo $au_cta_content; ?>
											</div>
											<div class="w-100 d-flex align-content-end">
												<?php
												show_acf_link($au_cta_grpname . 'button', false, ' btn btn-primary mt-4 ml-auto ');
												?>
											</div>
										</div>
									<?php
								endif;



									?>
							</div>
						</div>
						<div class="col image-col">
							<div class="h-100">
								<?php show_acf_img($au4_grpname . 'image', false, false, ' fit-cover h-100 ', null, ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true); ?>
							</div>
						</div>
					</div>
				</section>
			<?php
			endif;
			// SERVICES SECTION

			$services_section = get_field('services_section');
			$services_section_fname = 'services_section_';
			$overline = $services_section['overline'];
			$title = $services_section['title'];
			if ($services_section) : ?>
				<section id="home_our_services" class="services-section container vert1-p-tb">
					<div class="row text-white justify-content-center">
						<?php if ($overline || $title) : ?>
							<div class="col-12 col-lg-10 text-center">
								<?php if ($overline) : ?>
									<span class="text-overline"><?php echo $overline; ?></span>
								<?php endif; ?>
								<?php if ($title) : ?>
									<h2><?php echo $title; ?></h2>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if (have_rows($services_section_fname . 'services')) : ?>
							<ul class="services-list col-12 col-lg-10  text-white text-size-large vert2-p-tb text-center">
								<?php while (have_rows($services_section_fname . 'services')) : the_row();
									$icon = get_sub_field('icon');
									$service_name = get_sub_field('service_name');
								?>
									<li class="service-item text-size-large h4">
										<div class="service-icon"><?php echo $icon; ?></div>
										<div class="service-name"><?php echo $service_name; ?></div>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
						<?php
						$payment_line = $services_section['payment_line'];
						if ($payment_line) : ?>
							<div class="payment-line col-12 d-flex justify-content-center align-content-center">
								<?php if ($content = $payment_line['content']) : ?>
									<p class="mb-0"><?php echo $content; ?></p>
								<?php endif; ?>
								<?php
								show_acf_img($services_section_fname . 'payment_line_image', false, false, "mh-50 ml-3");
								?>
							</div>
						<?php endif; ?>
					</div>

				</section>
			<?php endif;

			//PORTFOLIO
			$portfolio_section = get_field('portfolio');
			$portfolio_section_fname = 'portfolio_';
			$overline = $portfolio_section['overline'];
			$images = get_field($portfolio_section_fname . 'image_gallery');
			if ($portfolio_section && !empty($images)) :
			?>
				<section id="home_our_portfolio" class="masonry-img-grid-section container">
					<?php if ($overline) : ?>
						<div class="text-overline text-white text-center"><?php echo $overline; ?></div>
					<?php endif;
					// https://github.com/andreknieriem/simplelightbox
					?>
					<div class="text-white row sl-gallery">
						<?php
						foreach ($images as $image_id) :
						?>
							<a href="<?php echo wp_get_attachment_image_url($image_id, 'full'); ?>" class="col">
								<?php
								echo wp_get_attachment_image($image_id, $size);
								?>
							</a>
						<?php
						endforeach; ?>

					</div>
				</section>
			<?php
			endif;

			//SIMPLE CTA
			$simp_CTA_section = get_field('simple_cta_section');
			$simp_CTA_section_fname = 'simple_cta_section_';
			$title = $simp_CTA_section['title'];

			if ($simp_CTA_section) :
			?>
				<section id="home_simp_CTA" class="container vert1-p-tb">
					<div class="text-white row justify-content-center ">
						<div class="col-md-10">
							<div class="row">
								<?php if ($title) : ?>
									<div class="text-white col">
										<h3><?php echo $title; ?></h3>
									</div>
								<?php endif; ?>
								<?php if (have_rows($simp_CTA_section_fname . 'button_group')) : ?>

									<!-- Start Button Group -->
									<div class="col col-sm-4 col-md-5 button-group">

										<?php
										$is_first_button = true;
										while (have_rows($simp_CTA_section_fname . 'button_group')) : the_row();
											$button = get_sub_field('button');
											if ($button) : ?>
												<a href="<?php echo esc_url($button['url']); ?>" class="btn <?php echo $is_first_button ? 'btn-primary' : 'btn-outline-primary'; ?>" target="<?php echo esc_attr($button['target'] ? $button['target'] : '_self'); ?>">
													<?php echo esc_html($button['title']); ?>
												</a>
											<?php
												if ($is_first_button) :
													$is_first_button = false;
												endif;
											endif; ?>
										<?php endwhile; ?>

									</div>
									<!-- End Button Group -->

								<?php endif; ?>
							</div>
						</div>
					</div>
					<svg id="simp_CTA_diamond" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 778 434" fill="none">
						<path d="M777.373 134.485L-172.5 1084.29L-1122.37 134.485L-172.5 -1481.01L777.373 134.485Z" stroke="white" />
					</svg>
				</section>
			<?php
			endif;

			?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer();
