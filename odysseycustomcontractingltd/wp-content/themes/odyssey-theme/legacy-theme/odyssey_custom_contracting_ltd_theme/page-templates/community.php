<?php
/**
 * Template Name: Community
 *
 * Template for displaying the contact page.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

//get_template_part('inc/full-width-map');
get_template_part('global-templates/hero');

?>

	<div class=" vert1-p-t pb-xxlg-0 vert3-m-b" id="real_estate__community">

		<div class="container pl-lg-0" id="content" tabindex="-1">

			<main class="site-main " id="main">
				<?php if (have_rows('locations')): ?>

					<article <?php post_class('col-12 col-lg-11 col-xlg-10  mx-auto px-0'); ?>
									id="post-<?php the_ID(); ?>">
						<?php while (have_rows('locations')):
							the_row();
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							$img = get_sub_field('image');
							?>
							<div class="location-row row mb-6 mb-md-8">
								<div class="col-12 col-md-7 col-lg-6 text-center text-md-left pr-md-5 pr-lg-6">
									<?php if ($title): ?>
										<h2 class="mb-4"><?php echo $title; ?></h2>
									<?php endif; ?>
									<?php if ($content): ?>
										<div class="entry-content">
											<?php echo $content; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-12 col-md-5 col-lg-6 position-relative bg-img-cont">
									<?php
									show_acf_img('image', true, false, 'use-as-bg', null, ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true);
									?>
								</div>
							</div>
						<?php endwhile; ?>
					</article>
				<?php endif; ?>

			</main><!-- #main -->

		</div><!-- #content -->

	</div><!-- #page-wrapper -->

<?php get_footer();
