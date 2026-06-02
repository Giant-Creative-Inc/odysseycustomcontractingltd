<?php
/**
 * Template Name: Blog
 *
 * Template for displaying the contact page.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$term = get_queried_object();

//get_template_part('inc/full-width-map');
get_template_part('global-templates/hero');

$args = array(
				'numberposts' => -1,
				'paged' => true,
				'posts_per_page', 5
);
$blog_posts = get_posts($args);

?>

	<div class=" vert1-p-t pb-xl-0 vert2-p-b" id="real_estate__blog">

		<div class="container" id="content" tabindex="-1">
			<div class="row justify-content-center">
				<div class="col col-lg-10">

					<main class="site-main " id="main">
						<!-- Grid Layout -->
						<?php if ($blog_posts) : ?>
							<div class="row">
								<?php foreach ($blog_posts as $post):
									setup_postdata($post);
									?>
									<div class="col-12 mb-4">
										<?php
										// display post card
										get_template_part('loop-templates/_post-card');
										?>
									</div>
								<?php
								endforeach;
								wp_reset_postdata();
								?>
							</div>
						<?php endif; ?>
						<div class="row justify-content-center">
							<div class="col-12">
								<!-- The pagination component -->
								<?php understrap_pagination(); ?>
							</div>
						</div>

					</main><!-- #main -->
				</div>
			</div>
		</div><!-- #content -->

	</div><!-- #page-wrapper -->

<?php get_footer();
