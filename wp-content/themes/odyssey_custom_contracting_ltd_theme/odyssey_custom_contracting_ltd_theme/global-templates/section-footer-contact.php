<?php
$cta_footer_slug = 'footer_contact_section';
$cta_footer_groupname = $cta_footer_slug . '_';

$cta_footer = get_field($cta_footer_slug, 'option');
$cta_title = $cta_footer['title'];
$cta_btn = $cta_footer['button'];

$contactInfo = get_field('primary_contact_info', 'option');
// email, phone
$c_phone = $contactInfo['phone'];
$c_email = $contactInfo['email'];

if (!empty($cta_footer) && ($c_phone || $c_email || $cta_btn)):
	?>
	<section class=" pb-lg-8 pt-lg-6 container footer-cta-section">
		<div class="row col-12 col-lg-10 mx-auto position-relative px-0">
			<div class="col-12 col-sm-6 col-xl-5 form-col bg-black px-5 px-lg-5 text-white text-center vert1-p-tb">
				<?php if ($cta_title): ?>
					<h2 class="mb-4"><?php echo $cta_title; ?></h2>
				<?php endif; ?>
				<?php if ($c_phone || $c_email): ?>
					<ul class="vert3-p-tb list-unstyled contact-links mb-0">
						<?php if ($c_phone): ?>
							<li class="mb-3">
								<a href="tel:<?php echo $c_phone; ?>" class="nav-phone h5 text-white-50"
									 title="Call <?php echo bloginfo('name'); ?> London Ontario">
									<span><i class="far fa-phone mr-1"></i> </span><span><?php echo $c_phone; ?></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ($c_email): ?>
							<li>
								<a href="mailto:<?php echo $c_email; ?>" class="nav-phone h5 text-white-50"
									 title="Email <?php echo bloginfo('name'); ?> London Ontario">
									<span><i class="far fa-envelope mr-1"></i> </span><span><?php echo $c_email; ?></span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
				<?php
				show_acf_link($cta_footer_groupname . 'button', false, ' btn btn-outline-primary mt-4 ', 'option');
				?>
			</div>
			<div class="col-12 col-sm-6 col-xl-7 bg-black image-col">
				<?php
				show_acf_img('footer_contact_section_image', false, false, $css_class = 'use-as-bg w-100 fit-cover ', 'option', ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], true);
				?>
			</div>
		</div>
	</section>
<?php
endif;
?>
