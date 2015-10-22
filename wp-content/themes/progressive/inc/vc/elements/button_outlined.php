<?php
/**
 * Visual Composer Element: Button Outline
 *	
*/
add_shortcode('button_outlined', 'ts_button_outlined_func');

function ts_button_outlined_func($atts, $content = null)
{
	$oArgs = ThemeArguments::getInstance('ts_button_outlined_func');
	$button_id = (int)$oArgs -> get('button_id') + 1;
	$oArgs -> set('button_id', $button_id);
	
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		"icon" => '',
		"color" => '',
		"hover_color" => '',
		"background_color" => '',
		"background_hover_color" => '',
		"size" => '',
		"url" => '',
		'target' => '_self',
		'align' => ''
	),
	$atts));


    $button_class = 'button btn btn-border ' . $size;

    if (empty($url)) {
        $url = '#';
    }

    $button_styles = '';
    $button_data = '';
    if(!empty($color)){
        $button_styles .= "color:{$color}; border-color: {$color};";
		$button_data .= 'data-color="'.esc_attr($color).'"';
    }
	
	if(!empty($hover_color)){
        $button_data .= 'data-hover-color="'.esc_attr($hover_color).'"';
    }
	
    if(!empty($background_color)){
        $button_styles .= "background-color:{$background_color};";
		$button_data .= 'data-background-color="'.esc_attr($background_color).'"';
    }
	
	if(!empty($background_hover_color)){
        $button_data .= 'data-background-hover-color="'.esc_attr($background_hover_color).'"';
    }
	
    $icon_html = '';
    if ($icon && $icon != 'no') {
        $icon_html = '<i class="icons '.esc_attr($icon).'"></i>';
    }
	
	return '<div class="xbtn '.sanitize_html_classes($align).'"><a id="button-'.esc_attr($button_id).'" '.esc_attr($button_data).' class="' . esc_attr($button_class) . ' ' . ts_get_animation_class($animation) . '" '.ts_get_animation_data_class($animation_delay,$animation_iteration).' href="' . esc_url($url) . '" target="' . esc_attr($target) . '" style="'.$button_styles.'">' . $icon_html . $content . '</a></div>';
}