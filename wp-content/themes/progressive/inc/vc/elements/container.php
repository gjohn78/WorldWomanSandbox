<?php
/**
 * Visual Composer Eelement: Container
 * 
 */
add_shortcode('container', 'ts_container_func');

function ts_container_func($atts)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'content_box' =>  '',
		'style'     => '1',

	),
	$atts));

    ob_start();

    $output = "
		<div class='content-block bottom-padding frame-shadow-lifted bg ".ts_get_animation_class($animation)."' ".ts_get_animation_data_class($animation_delay,$animation_iteration).">
			<span class='lead'>".wp_kses_post($content_box)."</span>
		</div>";

    ob_end_clean();
    
    return $output;
}