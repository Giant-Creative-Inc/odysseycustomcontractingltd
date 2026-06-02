<?php
/**
 * Template Name: Contact
 *
 * Template for displaying the contact page.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
	<div class="bg-black container-fluid px-0 position-relative pt-md-9 bg-img-cont overflow-hidden" id="contact_page">
		<?php show_ft_img_srcset('use-as-bg'); ?>
		<div class="row mxw-xxl mx-auto no-gutters">
			<div class="col-12 col-md-6 col-lg-5 offset-md-6 offset-lg-7 p-4 pt-6 p-sm-6 p-xl-8 mt-md-9 text-white bg-black text-center extend-bg-right">
				<?php
				$c_form = get_field('contact_form_id');
				$c_title = get_field('contact_form_title');
				if ($c_form && !empty($c_form)):
					if ($c_title):
						$f_title = $c_title;
					else:
						$f_title = 'Let\'s get started';
					endif;
					?>
					<h3><?php echo $f_title; ?></h3>
					<?php
					echo do_shortcode('[gravityform id='
									. $c_form
									. ' title=false description=false ajax=true]');
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer();
