<?php
/**
 * Template Name: Under Construction
 *
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
	<div class="container">
		<img class="uc-logo section-p-tb"
		     src="<?php echo esc_url(get_template_directory_uri('/')); ?>/img/Logo/full-wordmark.svg"
		     alt=""/>
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
<?php
get_footer();
