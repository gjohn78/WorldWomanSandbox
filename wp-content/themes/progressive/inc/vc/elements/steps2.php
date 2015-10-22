<?php
/**
 * Visual Composer Eelement: Step2
 * 
 */
add_shortcode('steps2', 'ts_steps2_func');

function ts_steps2_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'step' => '',
		'border' => '',
		'bg' => '',
		'message' => '',
		'text' => '',
		'livicon' => '',
		'icon' => '',
		'livicon_size' => '64',
		'livicon_color' => '',
		'img_url' => '',
		'icon_size' => '#c10841',
		'icon_color' => '',
		'last_step' => '',
	), $atts));

	ob_start();

	$classes = array();
	$classes [] = $border;
	$classes [] = $bg;
	$classes [] = $text;

	if ($icon != '') {
		$icon = '<div class="service-icon ' . sanitize_html_class($icon) . '" style="font-size:' . esc_attr($icon_size) . 'px;color:' . esc_attr($icon_color) . '"></div>';
	}

	if (!empty($livicon)) {
		$icon = "<div class='livicon' data-n='" . esc_attr($livicon) . "' data-c='" . esc_attr($livicon_color) . "' data-s='" . esc_attr($livicon_size) . "' data-hc='0'></div>";
	}

	$attachment_id = $img_url;
	$image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); // returns an array
	$img_url = '';
	if (isset($image_attributes[0])) {
		$img_url = $image_attributes[0];
	}
	
	$background = '';
	if (!empty($img_url)) {
		$background = "style=background:url(" . esc_url($img_url) . ")";
	}
	?>

	<div class="steps <?php echo sanitize_html_class($last_step); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>

		<div class="step text-center <?php echo sanitize_html_classes(implode(' ', $classes)); ?>">
			<div class="bg-image" id="bg-steps-apart1" <?php echo $background; ?>></div>
			<div class="step-wrapper">
				<?php echo $icon; ?>
				<div class="title-box text-center <?php echo sanitize_html_classes($text); ?>">
					<h4 class="title"><?php echo esc_html($title); ?></h4>
				</div>
				<p><?php echo wp_kses_post($message); ?></p>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
