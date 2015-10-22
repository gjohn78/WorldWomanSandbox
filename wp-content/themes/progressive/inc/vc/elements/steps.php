<?php

/**
 * Visual Composer Eelement: Steps
 * 
 */
function ts_steps_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'step' => '',
		'style' => '',
		'align' => '',
	), $atts));

	$align_class = '';

	return '
    	<div class="steps progress-steps ' . ts_get_animation_class($animation) . '" ' . ts_get_animation_data_class($animation_delay, $animation_iteration) . '>
		  <div class="step ' . sanitize_html_classes($style) . ' ' . sanitize_html_classes($align) . '">
			<div class="step-wrapper">
			  <div class="number">' . $step . '</div>
			  	' . do_shortcode($content) . '
			</div>
		  </div>
		</div>';
}

add_shortcode('steps', 'ts_steps_func');
