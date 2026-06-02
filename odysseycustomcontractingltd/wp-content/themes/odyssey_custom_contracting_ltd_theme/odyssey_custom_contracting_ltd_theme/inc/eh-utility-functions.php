<?php
//show an image that's a part of an acf layout
//arguments:
//	$field_name: the name of the acf field or sub-field
//	$is_sub_field: true for a sub_field, false for a normal field
//	$is_div_bg: true if you want the output to be a background style for a div, false if you want the output to be an <img> tag
//	$css_class: any additional css classes you want to add to the image, if output as an <img> tag
//	$parent_page: the page where this field can be found; null for current page
//	$sizes: an ordered list of sizes to use for responsive image loading (set to null to disable responsive image loading)
//	$use_srcset: whether or not to use the "srcset" attribute in place of data-interchange (optional because IE11 doesn't support it)
//return:
//	no return value
//side-effects:
//	outputs a string consisting of the html for displaying the image
// NOTE: if image is within an ACF Group pass in 'group_name'_'field_name' when using this function
function show_acf_img($field_name, $is_sub_field = false, $is_div_bg = false, $css_class = '', $parent_page = null, $sizes = ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'], $use_srcset = false)
{
	global $_wp_additional_image_sizes;

	$img = null;
	if ($parent_page === null) {
		$img = ($is_sub_field ? get_sub_field($field_name) : get_field($field_name));
	} else {
		$img = ($is_sub_field ? get_sub_field($field_name, $parent_page) : get_field($field_name, $parent_page));
	}
	if (!empty($img)) {
		//convert an image id into the appropriate data structure
		if (is_int($img)) {
			$img_id = $img;
			$img = array(
							'url' => wp_get_attachment_url($img_id),
							'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
							'sizes' => array(),
			);
			//with all specified sizes if any are given
			if (($sizes !== null) && (count($sizes) > 0)) {
				foreach ($sizes as $size) {
					$img['sizes'][$size] = [wp_get_attachment_image_src($img_id, $size)];
				}
			}
		}

		//NOTE: in the case that $sizes is null or empty array,
		//$data_interchange and $data_interchange_attr will be nullstring ('')
		//and so their output will be a no-op
		$base_img_url = $img['url'];
		$data_interchange = '';
		if (($sizes !== null) && (count($sizes) > 0)) {
			$first_size = true;
			foreach ($sizes as $size) {
				if (!isset($img['sizes'][$size])) {
					continue;
				}
				$img_url = (gettype($img['sizes'][$size]) === 'array') ? $img['sizes'][$size][0][0] : $img['sizes'][$size];

				if (!$first_size) {
					$data_interchange .= ', ';
				} else {
					//when multiple sizes are available
					//the base url is the smallest, which should be the first in order
					$base_img_url = $img_url;
				}
				$interchange_size = $size;
				if ($size === 'fp-small') {
					$interchange_size = 'small';
				} elseif ($size === 'fp-medium') {
					$interchange_size = 'medium';
				} elseif ($size === 'fp-large') {
					$interchange_size = 'large';
				}
				$data_interchange .= '[' . $img_url . ', ' . $interchange_size . ']';

				$first_size = false;
			}
		}
		$data_interchange_attr = ((strlen($data_interchange) > 0) ? 'data-interchange="' . $data_interchange . '"' : '');

		if ($is_div_bg) {
			//NOTE: while data-interchange does work with div backgrounds
			//it doesn't work when a background image is already set
			//so these are mutually exclusive
			if (strlen($data_interchange_attr) !== 0) {
				echo $data_interchange_attr;
			} else {
				echo ' style="background-image:url(\'' . $base_img_url . '\');"';
			}
			echo ' title="' . $img['alt'] . '" aria-label="' . $img['alt'] . '" ';
		} else {
			$srcset_attr = '';
			//using srcset is optional because IE11 doesn't support it (but edge supposedly does)
			if ($use_srcset) {
				$srcset = '';
				if (($sizes !== null) && (count($sizes) > 0)) {
					$first_size = true;
					foreach ($sizes as $size) {
						if (!isset($img['sizes'][$size])) {
							continue;
						}
						$img_url = (gettype($img['sizes'][$size]) === 'array') ? $img['sizes'][$size][0][0] : $img['sizes'][$size];

						if (!$first_size) {
							$srcset .= ', ';
						}
						$srcset .= $img_url . ' ' . $_wp_additional_image_sizes[$size]['width'] . 'w';

						$first_size = false;
					}
				}
				$srcset_attr = (strlen($srcset) > 0) ? 'srcset="' . $srcset . '"' : '';
				//prefer srcset to data-interchange, when available
				if (strlen($srcset_attr) > 0) {
					$data_interchange_attr = '';
				}
			}
			?>
			<img
							src='<?php echo $base_img_url; ?>'
							alt='<?php echo $img['alt']; ?>'
							class='<?php echo $css_class; ?>'
							<?php echo $data_interchange_attr; ?>
							<?php echo $srcset_attr; ?>
							<?php
							/*
								NOTE: we intentionally omit the sizes attribute here
								becase we don't know how the image will be used once we return from this function
								and it may take up the entire screen width
							*/
							?>
			>
			<?php
		}
	}
}

//show a link that's a part of an acf layout
//arguments:
//	$field_name: the name of the acf field or sub-field (of link type)
//	$is_sub_field: true for a sub_field, false for a normal field
//	$css_class: any additional css classes you want to add to the anchor tag
//	$parent_page: the page where this field can be found; null for current page
//return:
//	no return value
//side-effects:
//	outputs a string consisting of the html for displaying the link
// NOTE: if link is within an ACF Group pass in 'group_name'_'field_name' when using this function
function show_acf_link($field_name, $is_sub_field = false, $css_class = '', $parent_page = null)
{
	$link = null;
	if ($parent_page === null) {
		$link = ($is_sub_field ? get_sub_field($field_name) : get_field($field_name));
	} else {
		$link = ($is_sub_field ? get_sub_field($field_name, $parent_page) : get_field($field_name, $parent_page));
	}
	if (!empty($link)) {
		?>
		<a href='<?php echo $link['url']; ?>' class='<?php echo $css_class; ?>'
		   target='<?php echo $link['target']; ?>'><?php echo $link['title']; ?></a>
		<?php
	}
}


//show a featured image for the current page or post
//arguments:
//	$is_div_bg: true if you want the output to be a background style for a div, false if you want the output to be an <img> tag
//	$css_class: any additional css classes you want to add to the image, if output as an <img> tag
//return:
//	no return value
//side-effects:
//	outputs a string consisting of the html for displaying the image
function show_featured_img($is_div_bg = false, $css_class = '')
{
	global $post;

	//if a feature image is set then get the url so it can be injected as a css background property
	if (has_post_thumbnail($post->ID)) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
		$image = $image[0];
		if ($is_div_bg) {
			echo ' style="background-image:url(\'' . $image . '\');" ';
		} else {
			?>
			<img src='<?php echo $image; ?>' alt='Featured Image' class='<?php echo $css_class; ?>'>
			<?php
		}
	}
}

function show_ft_img_srcset($css_class = '', $alt = '')
{
	global $post;
	global $_wp_additional_image_sizes;

	$ftId = $post->ID;

	if ((has_post_thumbnail($ftId))):
		$sizes = ['fp-small', 'fp-medium', 'fp-large', 'xlarge', '1080p', 'retina'];
		$srcset = '';
		foreach ($sizes as $size):
			$srcset .= get_the_post_thumbnail_url($ftId, $size) . ' ' . $_wp_additional_image_sizes[$size]['width'] / 2 . 'w, ';
		endforeach;

		if (empty($alt)):
			$alt = get_bloginfo('name', 'display').' London Ontario '. get_the_title($ftId) . '\'s featured image';
		endif;
		?>
		<img alt="<?php echo $alt; ?>"
		     class="<?php echo $css_class;?>"
		     src="<?php echo get_the_post_thumbnail_url($ftId, $sizes[1]); ?>"
		     srcset="<?php echo $srcset; ?>"
		/>
	<?php
	endif;
}
