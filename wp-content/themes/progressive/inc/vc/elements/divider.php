<?php
/**
 * Visual Composer Eelement: Divider
 * 
 */
add_shortcode('divider', 'ts_hr_func');

function ts_hr_func($atts, $content = null)
{

    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'color' => '',
		'style' => ''
		),
        $atts));
    $html = null;

    $divider_style= array();
    if(!empty($color)){
        $divider_style[]= 'border-color:' . esc_attr($color);
    }

    $divider_style_html=null;
    if(is_array($divider_style)){
        $divider_style_html = 'style="'.implode(';',$divider_style).'"';
    }

    $html .= '<hr class="divider '.sanitize_html_classes($style).' '.ts_get_animation_class($animation).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).' '.$divider_style_html.' >';
    return $html;
}