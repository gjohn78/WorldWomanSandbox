<?php

/**
 * Visual Composer Eelement: Image
 * 
 */
add_shortcode('image', 'ts_image_func');

function ts_image_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'img_url' => '',
		'caption' => '',
		'img_link' => '',
		'style' => '',
		'width' => '',
		'height' => '',
		'align' => '',
		'output' => '',
		'hover_border' => '',
		'hover_opacity' => '',
		'frame' => '',
	), $atts));

	$attachment_id = $img_url;
	$image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); // returns an array
	if (isset($image_attributes[0])) {
		$img_url = $image_attributes[0];
	}
	//$output .= $img_url;

	$img_url = get_xv_resizer($img_url, $width, $height);


	if (!empty($img_link)) {
		$output .= "<a class='frame-hover " . esc_attr($hover_border) . "' href='" . esc_url($img_link) . "' >";
	}

	$output .= "<div class='" . sanitize_html_classes($frame) . " " . esc_attr($style) . " " . esc_attr($align) . " " . esc_attr($hover_opacity) . "'>
					<img  alt='" . esc_attr($caption) . "' src='" . esc_url($img_url) . "'>
				</div>";
	if (!empty($img_link)) {
		$output .= "</a>";
	}
	if (!empty($caption)) {
		$output .= "<div class='caption'>{$caption}</div>";
	}




	return '<div ' . ts_get_animation_class($animation, true) . ' ' . ts_get_animation_data_class($animation_delay, $animation_iteration) . '>' . $output . '</div>';
}
