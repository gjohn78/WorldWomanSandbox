<?php

/**
 * Visual Composer Eelement: Circular Skills
 * 
 */
add_shortcode('skills_circular', 'ts_skills_circular_func');

function ts_skills_circular_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => 'Honesty',
		'percent' => '75',
		'animation' => '',
		'color' => '',
	), $atts));

	$output = " 
		<div class='progress-circular bottom-padding bottom-padding-mini " . ts_get_animation_class($animation) . "' " . ts_get_animation_data_class($animation_delay, $animation_iteration) . ">
            <input type='text' class='knob' value='0' rel='" . esc_attr($percent) . "' data-linecap='round' data-width='200' data-bgcolor='#f2f2f2' data-fgcolor='" . esc_attr($color) . "' data-thickness='.15' data-readonly='true' disabled=''>
            <p class='white'>{$title}</p>
        </div>";

			
	wp_enqueue_script('knob');
			
	return $output;
}
