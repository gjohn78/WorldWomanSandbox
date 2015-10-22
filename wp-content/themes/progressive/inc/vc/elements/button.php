<?php
/**
 * Visual Composer Eelement: Button
 * 
 */
add_shortcode('button', 'ts_button_func');

function ts_button_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		"icon" => '',
		"livicon" => '',
		"animate_on" => 'button',
		"background" => '',
		"color" => '',
		"hover" => '',
		"border" => '',
		"size" => '',
		"url" => '',
		'target' => '_self',
		'align' => '',
	),
    $atts));


    $button_class = 'button btn ' . $size;

    if (empty($url)) {
        $url = '#';
    }

    $button_styles = '';
    if(!empty($color)){
        $button_styles .= "color:{$color};";
    }
    if(!empty($background)){
        $button_styles .= "background-color:{$background};";
    }
      if(!empty($hover)){
        $button_styles .= "background-color:{$background};";
    }
   
    $button_styles .= "border-color:{$border};";
    
    $icon_html = '';
	if ($livicon != '') {
		
		$animate_attr = 'data-hc="0"';
		if ($animate_on == 'icon') {
			$animate_attr = 'data-op="0"';
		}
		
		$icon_html = '<i class="livicon" data-n="'.esc_attr($livicon).'" data-s="24" data-c="'.esc_attr($color).'" data-hc="'.esc_attr($color).'" '.$animate_attr.'></i>';
		$icon_metro = '<span class="livicon metro-bg" data-n="'.esc_attr($livicon).'" data-s="32" data-c="'.esc_attr($color).'" data-hc="'.esc_attr($color).'" data-op="1" style='.esc_attr($button_styles).'></span>';
	} else if ($icon && $icon != 'no') {
        $icon_html = '<i class="icons '.esc_attr($icon).'"></i>';
		$icon_metro = '<span class="metro-bg" style='.esc_attr($button_styles).'>'.$icon_html.'</span>';
    }
	
	if ($size == 'metro') {
		$html = '<a title="'.esc_attr($content).'" class="' . ts_get_animation_class($animation) . '" '.ts_get_animation_data_class($animation_delay,$animation_iteration).' href="' . esc_url($url) . '" target="' . esc_attr($target) . '">' . $icon_metro . '</a>';
		
	} else {
		$html = '<a class="' . esc_attr($button_class) . ' ' . ts_get_animation_class($animation) . '" '.ts_get_animation_data_class($animation_delay,$animation_iteration).' href="' . esc_url($url) . '" target="' . esc_attr($target) . '" style='.esc_attr($button_styles).'>' . $icon_html . $content . '</a>';
	}
	
	if (!empty($align) && $align != 'none') {
		$html = '<div class="xbtn '.esc_attr($align).'">'.$html.'</div>';
	}

    return $html;
}