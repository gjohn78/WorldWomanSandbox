<?php
/**
 * Visual Composer Eelement: Pricing Tables
 * 
 */
add_shortcode('pricing_table', 'ts_pricing_table_func');

function ts_pricing_table_func($atts, $content = null) {

	//$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'subtitle' => 'Starting at',
		'price' => '199$',
		'duration' => 'monthly',
		'livicon' => 'shopping-cart',
		'style' => '',
		'more_btn' => '',
		'more_url' => '',
		'stars' => '80',
		'table_btn_text' => 'Read More',
		'table_btn_url' => '',
		'values' => '',
		'checked' => '',
					), $atts));
	wp_enqueue_script('waypoints');

	$output = '';
	$textAr = explode("\n", $values);
	$textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind

	ob_start();

	if ($style == 'info') {
		$table_style = 'prising-info';
	} else {
		$table_style = 'pricing-' . $style;
	}
	?>  

	<div class='pricing <?php echo sanitize_html_classes($table_style); ?> <?php echo ts_get_animation_class($animation); ?>' <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class='title'><a href='#'><?php echo esc_html($title); ?></a></div>
		<div class='price-box'>
			<div class='icon pull-right border circle'>
				<span class="livicon" data-n="<?php echo esc_attr($livicon); ?>" data-s="32" data-c="#1e1e1e" data-hc="0"></span>
			</div>
			<div class='starting'><?php echo esc_html($subtitle); ?></div>
			<div class='price'><?php echo esc_html($price); ?><span>/<?php echo esc_html($duration); ?></span></div>
		</div>
		<ul class='options'>
	<?php
	if (is_array($textAr)) {
		foreach ($textAr as $line) {
			if ($line[0] == '*') {
				$line = substr($line, 1);
				echo "<li class='active'><span><i class='icon-check'></i></span>" . wp_kses_post($line) . "</li>";
			} else {
				echo "<li><span><i class='icon-check'></i></span>" . wp_kses_post($line) . "</li>";
			}
		}
	}
	?>
	</ul>
	<div class='bottom-box'>
		<?php if (!empty($more_btn)) { ?>
				<a href='<?php echo esc_url($more_url); ?>' class='more'><?php echo esc_html($more_btn); ?><span class='fa fa-angle-right'></span></a>
			<?php } ?>
			<div class='rating-box'>
				<div style='width: <?php echo esc_attr($stars); ?>%' class='rating'>
					<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='73px' height='12px' viewBox='0 0 73 12' enable-background='new 0 0 73 12' xml:space='preserve'>
						<polygon fill-rule='evenodd' clip-rule='evenodd' fill='#1e1e1e' points='6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5'></polygon>
						<polygon fill-rule='evenodd' clip-rule='evenodd' fill='#1e1e1e' points='66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 '></polygon>
						<polygon fill-rule='evenodd' clip-rule='evenodd' fill='#1e1e1e' points='21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 '></polygon>
						<polygon fill-rule='evenodd' clip-rule='evenodd' fill='#1e1e1e' points='51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 '></polygon>
						<polygon fill-rule='evenodd' clip-rule='evenodd' fill='#1e1e1e' points='36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 '></polygon>
					</svg>
				</div>
			</div>
			<?php if (!empty($table_btn_text)) { ?>
				<a href='<?php echo esc_url($table_btn_url); ?>' class='btn btn-default btn-lg btn-<?php echo esc_attr($style); ?>'><?php echo esc_html($table_btn_text); ?></a>
			<?php } ?>
		</div>
	</div><!-- .pricing -->
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
