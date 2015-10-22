<?php
/**
 * Visual Composer Eelement: Livicon
 * 
 */
add_shortcode('livicon', 'ts_livicon_func');

function ts_livicon_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'style' => '',
		'livicon' => '',
		'icon_animation' => '',
		'event' => '',
		'loop' => 'no',
		'shadow' => 'no',
		'color' => '',
		'hover_color' => '',
		'size' => '',
		'title' => ''
					), $atts));
	$html = null;

	$attr = 'class="livicon ' . ts_get_animation_class($animation);

	if ($shadow == 1) {
		$attr .= ' shadowed2';
	}

	$attr .= '"';

	$attr .= 'data-n="' . esc_attr($livicon) . '" ';
	$attr .= 'data-s="' . esc_attr($size) . '" ';
	$attr .= 'data-op="0" data-c="' . esc_attr($color) . '" ';
	$attr .= 'data-hc="' . esc_attr($hover_color) . '" ';
	$attr .= 'title="' . esc_attr($title) . '" ';
	$attr .= ts_get_animation_data_class($animation_delay, $animation_iteration) . ' ';

	if ($icon_animation == 'no') {
		$attr .= 'data-a="0" ';
	}
	if ($event == 'click') {
		$attr .= 'data-et="click" ';
	}

	if ($loop == 'yes') {
		$attr .= 'data-l="1" ';
	} else if (intval($loop) > 1) {
		$attr .= 'data-i="' . esc_attr(intval($loop)) . '" ';
	}

	$html = '<div ' . $attr . '></div>';
	if ($style == 'outlined') {
		$html = '<div class="icon liviconslist-item">' . $html . '</div>';
	}
	return $html;
}
