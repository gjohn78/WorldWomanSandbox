<?php
/**
 * Shortcode Title: Containers
 * Shortcode: container
 * Usage: [container animation="fade" style="1" content_box="Lorem ipsum..." icon="icon-airport" icon_color="#FF0000"]
 * */

add_shortcode('container', 'ts_container_func');

function ts_container_func($atts)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'content_box' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore libero autem tempora cumque officiis sapiente maxime sit facere assumenda quisquam amet consequatur ad delectus accusantium quia saepe quas repellendus optio distinctio nobis consequuntur culpa eligendi quibusdam nesciunt maiores alias ex.',
		'style'     => '1',
		'icon' => '',
		'icon_color' => ''
	),
	$atts));
	
	$class_wrapper = null;
	
    switch ($style) {
      case '1':
        $classes = 'content-block bottom-padding frame';
        break;
      case '2':
        $classes = 'content-block bottom-padding frame border-radius';
        break;
      case '3':
        $classes = 'content-block bottom-padding frame-shadow-lifted';
        break;
      case '4':
        $classes = 'content-block bottom-padding frame frame-shadow-lifted';
        break;
       case '5':
        $classes = 'content-block bottom-padding frame-shadow-lifted bg';
        break;
       case '6':
        $classes = 'content-block bottom-padding frame-shadow-raised text-center';
        break;
        case '7':
        $classes = 'content-block bottom-padding frame frame-shadow-curved';
        break;
       case '8':
        $classes = 'content-block bottom-padding frame frame-shadow-lifted';
        break;
       case '9':
        $classes = 'content-block bottom-padding frame frame-shadow-curved border-radius';
        break;   
       case '10':
        $classes = 'bottom-padding frame-shadow-lifted bg';
        break;
	   case '11':
		$class_wrapper = 'rotated-box';
        $classes = 'content-block bottom-padding frame frame-shadow-lifted';
        break;
	   case '12':
		$class_wrapper = 'rotated-right-box';
        $classes = 'content-block bottom-padding frame frame-shadow-curved border-radius';
        break;
	
	  case '13':
		$classes = 'content-block text-center frame-shadow bottom-padding';
		break;
      default:
        $classes = 'bottom-padding frame-shadow-lifted bg';
        break;
    }

	$icon_html = '';
	if (!empty($icon)) {
		$icon_html = '<span class="icon bg circle icon-60 pull-left"><i class="'.sanitize_html_class($icon).'" '.(!empty($icon_color) ? 'style="color: '.esc_attr($icon_color).'"' : '').'></i></span>';
	}
	
    $output = "
		<div class='".sanitize_html_classes($classes)." ".ts_get_animation_class($animation)."' ".ts_get_animation_data_class($animation_delay,$animation_iteration).">
			{$icon_html}
			<span class='lead'>{$content_box}</span>
		</div>";

	if (!empty($class_wrapper)) {
		return "<div class='".sanitize_html_classes($class_wrapper)."'>{$output}</div>";
	}
    
    return $output;
}