<?php
/**
 * Visual Composer Eelement: Mao Container
 * 
 */
add_shortcode('map_container', 'ts_map_container_func');

function ts_map_container_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' => '',
		'height' => '300',
		'zoom' => '6',
		'lat' => '40.748441',
		'lng' => '73.985664',
		'marker_title' => '',
		'marker_content' => '',
		'style' => '',
		'color' => '',
		'area_1_title' => '',
		'area_1_content' => '',
		'area_2_title' => '',
		'area_2_content' => '',
		'area_3_title' => '',
		'area_3_content' => ''
					), $atts));

	$class = '';
	$path = get_template_directory_uri();

	$output = '';
	if (!empty($title)) {
		$output = '<div class="title-box">
					<h2 class="title">' . $title . '</h2>
				  </div>';
	}

	$overlay = '';

	if (!empty($area_1_title) || !empty($area_1_content) ||
			!empty($area_2_title) || !empty($area_2_content) ||
			!empty($area_3_title) || !empty($area_3_content)
	) {
		$overlay = '
			<div class="contact-info col-sm-6 col-md-6 ' . ts_get_animation_class('fadeInLeftBig') . '" ' . ts_get_animation_data_class(1500, 0) . '>
				<address>
				  <div class="title">' . $area_1_title . '</div>
				  ' . ts_emailize($area_1_content) . '
				</address>
				<div class="row">
				  <address class="col-sm-6 col-md-6">
					<div class="title">' . $area_2_title . '</div>
					' . ts_emailize($area_2_content) . '
				  </address>
				  <address class="col-sm-6 col-md-6">
					<div class="title">' . $area_3_title . '</div>
					' . ts_emailize($area_3_content) . '
				  </address>
				</div>
			</div>';
	}

	$output .= '
		<div class="map-box">
			' . $overlay . '
			<div
			  class="map-canvas"
			  style="height: ' . esc_attr($height) . 'px;"
			  data-zoom="' . esc_attr($zoom) . '"
			  data-lat="' . esc_attr($lat) . '"
			  data-lng="' . esc_attr($lng) . '"
			  data-title="' . esc_attr($marker_title) . '"
			  data-content="' . esc_attr($marker_content) . '"
			  data-pin="' . esc_url($path) . '/img/svg/map-marker.svg"
			  data-type="' . esc_attr($style) . '"></div>
		</div>';
	
	wp_enqueue_script('google-map-api');
	
	return $output;
}
