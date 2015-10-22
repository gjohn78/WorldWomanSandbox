<?php
/**
 * Visual Composer Eelement: Another Call to action
 * 
 */
add_shortcode('another_call_to_action', 'ts_another_call_to_action_func');

function ts_another_call_to_action_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		"btn1_text" => '',
		"btn2_text" => '',
		"btn1_url" => '',
		"btn2_url" => '',
	), $atts));

	$output = "<div class='content-block frame text-center bottom-padding " . ts_get_animation_class($animation) . "' " . ts_get_animation_data_class($animation_delay, $animation_iteration) . ">
            <p class='lead'>{$content}</p>";
	if (!empty($btn1_text))
		$output .="<a href='" . esc_url($btn1_url) . "' data-animation='bounceIn' class='btn btn-default appear-animation bounceIn appear-animation-visible'>{$btn1_text}</a>";
	if (!empty($btn2_text))
		$output .="<a href='" . esc_url($btn2_url) . "' data-animation='bounceIn' class='btn btn-default appear-animation bounceIn appear-animation-visible'>{$btn2_text}</a>";
	$output .="</div>";


	return $output;
}
