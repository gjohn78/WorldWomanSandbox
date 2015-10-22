<?php

/**
 * Visual Composer Eelement: Text
 * 
 */
add_shortcode('text', 'ts_text_func');

function ts_text_func($atts) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'pfont' => '12px',
		'content' => ''
	), $atts));

	$style = '';
	$style = 'style="font-size:' . esc_attr($pfont) . '"';

	return '<div ' . ts_get_animation_class($animation, true) . ' ' . ts_get_animation_data_class($animation_delay, $animation_iteration) . ' ' . $style . ' >' . $content . '</div>';
}
