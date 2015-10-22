<?php
/**
 * Visual Composer Eelement:Pricing Tables2
 * 
 */
add_shortcode('pricing_table2', 'ts_pricing_table2_func');

function ts_pricing_table2_func($atts, $content = null) {

	//$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'subtitle' => '',
		'price' => '',
		'duration' => '',
		'icon' => '',
		'style' => '',
		'more_btn' => '',
		'more_url' => '',
		'stars' => '',
		'table_btn_text' => '',
		'table_btn_url' => '',
		'values' => '',
		'checked' => '',
	), $atts));

	ob_start();
	?>  

	<div class="package <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class='title'><a><?php echo esc_html($title); ?></a></div>
		<div class="price-box">
			<div class="icon bg-white rounded pull-right"><i class="<?php echo esc_attr($icon); ?>"></i></div>
			<div class="description">
				<?php echo wp_kses_post($values); ?>
			</div>	
			<div class='starting'><?php echo esc_html($subtitle); ?></div>
			<div class='price'><?php echo esc_html($price); ?><span>/<?php echo esc_html($duration); ?></span></div>
		</div>
		<div class="bottom-box">
			<a href='<?php echo esc_url($more_url); ?>' class='more'><?php echo esc_html($more_btn); ?><span class='fa fa-angle-right'></span></a>
			<div class="rating-box">
				<div style='width: <?php echo esc_attr($stars); ?>%' class='rating'>
					<svg xml:space="preserve" enable-fwb-bg="new 0 0 73 12" viewBox="0 0 73 12" height="12px" width="73px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<polygon points="6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5" fill="#1e1e1e" clip-rule="evenodd" fill-rule="evenodd"/>
						<polygon points="66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 " fill="#1e1e1e" clip-rule="evenodd" fill-rule="evenodd"/>
						<polygon points="21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 " fill="#1e1e1e" clip-rule="evenodd" fill-rule="evenodd"/>
						<polygon points="51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 " fill="#1e1e1e" clip-rule="evenodd" fill-rule="evenodd"/>
						<polygon points="36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 " fill="#1e1e1e" clip-rule="evenodd" fill-rule="evenodd"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
