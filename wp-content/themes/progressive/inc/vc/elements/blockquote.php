<?php
/**
 * Visual Composer Eelement: Blockquote
 * 
 */
add_shortcode('blockquote', 'ts_blockquote_func');

function ts_blockquote_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'author' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => ''
		),
	$atts));

	return '<blockquote '.ts_get_animation_class($animation,true).' '.ts_get_animation_data_class($animation_delay,$animation_iteration).'><p>'.do_shortcode(nl2br($content)).'</p><span class="author">'.$author.'</span></blockquote>';
}