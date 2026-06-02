<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

get_template_part('global-templates/hero');

?>

<div class="py-5 py-md-7 pb-lg-4 pt-xxlg-9 pb-xxlg-0 mb-lg-5" id="error-404-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<div class="col-12 col-lg-11 col-xlg-10  mx-auto px-4 px-lg-0 text-center content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<div class="page-content">
							<div class="mb-5 mw-10col mx-auto">
								<?php get_search_form(); ?>
							</div>
							<?php if ( understrap_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

								<div class="widget widget_categories py-5">

									<h2 class="widget-title mb-4"><?php esc_html_e( 'Most Used Categories', 'understrap' ); ?></h2>

									<ul class="list-unstyled">
										<?php
										wp_list_categories(
											array(
												'orderby'    => 'count',
												'order'      => 'DESC',
												'show_count' => 1,
												'title_li'   => '',
												'number'     => 10,
											)
										);
										?>
									</ul>

								</div><!-- .widget -->

							<?php endif; ?>

							<?php

							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'understrap' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

							the_widget( 'WP_Widget_Tag_Cloud' );
							?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer();
