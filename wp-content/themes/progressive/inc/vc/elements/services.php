<?php
/**
 * Visual Composer Eelement: Services
 * 
 */
add_shortcode('service', 'ts_service_func');

function ts_service_func($atts) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => 'Your Service Title',
		'style' => '1',
		'style_color' => '1',
		'icon' => '',
		'message' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.',
		'button_text' => '',
		'url' => '',
		//colors
		'livicon' => '',
		'livicon_size' => '64',
		'livicon_color' => '',
		'icon_color' => '#c10841',
		'icon_bg_color' => '',
		'icon_border_color' => '',
		'read_btn_color' => '#c10841',
		'read_txt_color' => '',
		'hide_icon' => '',
		'close_btn' => '',
					), $atts));


	$html = '';
	ob_start();


	if ($icon != '' && $hide_icon != 'yes') {
		$icon = '<div class="service-icon ' . esc_attr($icon) . '"></div>';
	}

	if (!empty($livicon)) {
		$icon = "<div class='livicon livicon-size-" . esc_attr($livicon_size) . "' data-n='" . esc_attr($livicon) . "' data-c='" . esc_attr($livicon_color) . "' data-s='" . esc_attr($livicon_size) . "' data-hc='0'></div>";
	}
	?>  

	<?php
	if ($style_color == 'white') {
		echo '<div class="white">';
	}

	if ($style == 1) { ?>

		<div class="big-services-box <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
			<div  class="big-icon bg"><?php echo $icon; ?></div>
			<h4   class="title"><?php echo esc_html($title); ?></h4>
			<div  class="text-small"><?php echo wp_kses_post($message); ?><div class="clearfix"></div><br>
				<?php
				if (!empty($button_text)) {

					echo "<a href='" . esc_url($url) . "' class='btn btn-default'>" . esc_html($button_text) . "</a>";
				}
				?> 
			</div>
		</div>
		<?php } elseif ($style == 2) { ?>
			<div class="big-services-box <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<a href="<?php echo esc_url($url); ?>">
					<div class="big-icon border border">
					<?php echo $icon; ?>
					</div>
					<h4 class="title"><?php echo esc_html($title); ?></h4>
					<div class="text-small"><?php echo wp_kses_post($message); ?></div>
				</a>
			</div><!-- .services-box-two -->

	<?php } elseif ($style == 3) { ?>

		<div class="service <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
			<a href="<?php echo esc_url($url); ?>">
				<div class="icon border">
					<?php echo $icon; ?>
				</div>
				<h6 class="title"><?php echo esc_html($title); ?></h6>
				<div class="text-small"><?php echo wp_kses_post($message); ?></div>
			</a>
		</div>

	<?php } elseif ($style == 4) { ?>

		<div class="big-services-box <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
			<a href="#">
				<div class="big-icon bg" data-animation="fadeInUp"><?php echo $icon; ?></div>
				<h4 class="title"><?php echo esc_html($title); ?></h4>
				<div class="text-small"><?php echo wp_kses_post($message); ?></div>
			</a>
		</div><!-- .services-box-two -->

	<?php } elseif ($style == 5) { ?>
		<div class="service <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
			<div class="icon bg">
				<?php echo $icon; ?>
			</div>
			<h6 class="title"><?php echo esc_html($title); ?></h6>
			<div class="text-small">
				<?php echo wp_kses_post($message); ?><br><br>
				<?php
				if (!empty($button_text)) {

					echo "<a href='" . esc_url($url) . "' class='btn btn-default'>" . esc_html($button_text) . "</a>";
				}
				?> 
			</div>
		</div>
	<?php } ?>

	<?php
	if ($style_color == 'white') {
		echo '</div>';
	}
	
	$output = ob_get_contents();
	wp_enqueue_script('raphael');
	
	ob_end_clean();

	return $output;
}
