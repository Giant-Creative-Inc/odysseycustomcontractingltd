<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

include LEGACY_THEME_DIR . '/global-templates/hero.php';

?>

<div class="vert1-p-tb pb-xl-0" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main col-12 col-lg-10 col-xlg-8  mx-auto" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php include LEGACY_THEME_DIR . '/loop-templates/content-page.php'; ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer();
