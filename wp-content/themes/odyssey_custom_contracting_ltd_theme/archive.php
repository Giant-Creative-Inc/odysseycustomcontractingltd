<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

get_template_part('global-templates/hero');
?>

	<div class="vert2-p-tb pb-xl-0 single-wrapper" id="archive-wrapper">

		<div class="container" id="content" tabindex="-1">

			<div class="row justify-content-center">
				<div class="col col-lg-10">

					<main class="site-main" id="main">
						<div class="row">
							<?php if (have_posts()) : ?>

								<?php /* Start the Loop */ ?>
								<?php while (have_posts()) : the_post(); ?>
									<div class="col-12 mb-4">
										<?php

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part('loop-templates/_post-card', get_post_format());
										?>
									</div>
								<?php endwhile; ?>

							<?php else : ?>
								<div class="col-12">
									<?php get_template_part('loop-templates/content', 'none'); ?>
								</div>
							<?php endif; ?>
						</div>
					</main><!-- #main -->
				</div>
				<!-- The pagination component -->
				<?php understrap_pagination(); ?>

			</div> <!-- .row -->

		</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer();
