<?php
/**
 * Visual Composer Eelement: Progressive Menu
 * 
 */

add_shortcode('progressive_menu', 'ts_progressive_menu_func');

function ts_progressive_menu_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'nav_menu'=>''
	),
	$atts));
	
	$output='';
    $output .= '<aside class="sidebar '. ts_get_animation_class($animation,true).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).'>';
    ob_start();
	$args = array();
	the_widget( 'WP_Progressive_Menu_Widget', $atts, $args );
	$output .= ob_get_clean();
    $output .= '</aside>';

    return $output;
}
