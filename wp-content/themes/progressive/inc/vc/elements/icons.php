<?php

/**
 * Visual Composer Eelement: Icons
 * 
 */
function ts_icons_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => '',
		'size' => '',
		'color' => '',
		'icon_border_color' => '',
		'icon_bg_color' => '',
		'bg_radius' => ''
	), $atts));

	$align_class = '';


	$css = '';

	if (!empty($color)) {
		$css .= 'color:' . esc_attr($color) . ';';
	}

	if (!empty($icon_bg_color)) {
		$css .= "background:" . esc_attr($icon_bg_color) . ";";
	}
	if (!empty($icon_border_color)) {
		$css .= "border:1px solid " . esc_attr($icon_border_color) . ";";
	}
	if (!empty($bg_radius)) {
		$css .= "border-radius:" . esc_attr($bg_radius) . "px;";
	}
	$css = 'style="' . $css . '"';


	return "<div class='icon " . sanitize_html_class($size) . "' " . $css . "><i class='" . sanitize_html_class($icon) . "'></i></div>";
}

add_shortcode('icons', 'ts_icons_func');
