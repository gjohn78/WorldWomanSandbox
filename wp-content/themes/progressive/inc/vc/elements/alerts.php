<?php
/**
 * Visual Composer Eelement: Alerts
 * 
 */

add_shortcode('alert', 'ts_alert_func');

function ts_alert_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'style' => 'info',
		'icon'=>'',
        'hide_icon' => 'yes',
		'close_btn' => 'yes',
		'message' => ''
	),
	$atts));

	$html='';
    if($icon!='' && $hide_icon != 'yes'){

        $icon = '<div class="alert-icon '.sanitize_html_class($icon).'"></div>';
    }else{
        $icon ='';
    }
    $html .= '<div class="alert alert-' . sanitize_html_class($style) . ts_get_animation_class($animation).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).'>'.$icon.'<p>' . $message . '</p>';
    if ($close_btn == 'yes') {
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    }
    $html .= '</div>';

    return $html;
}
