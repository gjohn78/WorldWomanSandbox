<?php

/**
 * Visual Composer Eelement: Heading
 * 
 */
function ts_heading_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'color' => '',
		'type' => 1,
		'align' => '',
		'style' => '',
		'id' => '',
					), $atts));

	if (intval($type) < 1 || intval($type) > 6) {
		$type = 1;
	}

	if (!empty($color)) {
		$color = 'style="color:' . esc_attr($color) . '"';
	}

	$id_attr = '';
	if (!empty($id)) {
		$id_attr = 'id="' . esc_attr($id) . '"';
	}

	return "<div " . $id_attr . " class='" . sanitize_html_classes($style) . " " . sanitize_html_class($align) . " " . ts_get_animation_class($animation) . "' " . ts_get_animation_data_class($animation_delay, $animation_iteration) . "><h" . esc_attr($type) . " class='title' " . $color . ">" . do_shortcode($content) . "</h" . esc_attr($type) . "></div>";
}

add_shortcode('heading', 'ts_heading_func');
