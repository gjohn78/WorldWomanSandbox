<?php
/**
 * Visual Composer Eelement: Tiles
 * 
 */
add_shortcode('tiles', 'ts_tiles_func');

function ts_tiles_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'image_1' => '',
		'url_1' => '',
		'target_1' => '',
		'background_color_1' => '',
		'image_2' => '',
		'url_2' => '',
		'target_2' => '',
		'background_color_2' => '',
		'image_3' => '',
		'url_3' => '',
		'target_3' => '',
		'background_color_3' => '',
		'hover_opacity' => ''
	), $atts));

	$oArgs = ThemeArguments::getInstance('ts_tiles_func');
	$oArgs -> set('shortcode_tiles', array());
    do_shortcode($content);
	$shortcode_tiles = $oArgs -> get('shortcode_tiles');
	
	ob_start();
	?>
	<div class="slider progressive-slider progressive-slider-two tiles load <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="row slider-wrapper">
			<div class="col-md-9 sliders-container">
				<div class="sliders-box">
					<?php 
					if (is_array($shortcode_tiles)) {
						foreach ($shortcode_tiles as $item) { ?>
							<?php if (!empty($item['url'])) { ?>
								<a href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
								<?php } ?>
								<img class="" src="<?php echo esc_url(theme_thumb($item['image'], 900, 450)); ?>" width="900" height="450" alt="" />
								<?php if (!empty($item['url'])) { ?>
								</a>
							<?php } ?>
						<?php }
					} ?>					  
				</div><!-- .sliders-box -->

				<div class="pagination switches"></div>	
			</div>

			<div class="col-md-3 slider-banners">
				<?php if (!empty($image_1)) { ?>
					<a class="banner" href="<?php echo esc_url($url_1); ?>" target="<?php echo esc_attr($target_1); ?>">
						<img alt="" src="<?php echo esc_url(ts_get_image_by_id($image_1)); ?>" />
					</a>
				<?php } ?>
				<?php if (!empty($image_2)) { ?>
					<a class="banner" href="<?php echo esc_url($url_2); ?>" target="<?php echo esc_attr($target_2); ?>">
						<img alt="" src="<?php echo esc_url(ts_get_image_by_id($image_2)); ?>" />
					</a>
				<?php } ?>
				<?php if (!empty($image_3)) { ?>
					<a class="banner" href="<?php echo esc_url($url_3); ?>" target="<?php echo esc_attr($target_3); ?>">
						<img alt="" src="<?php echo esc_url(ts_get_image_by_id($image_3)); ?>" />
					</a>
				<?php } ?>
			</div><!-- .slider-banners -->
		</div>
	</div><!-- .progressive-slider -->

	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

/**
 * Visual Composer Eelement: Tiles slider
 * 
 */
add_shortcode('tiles_slider', 'ts_tiles_slider_func');

function ts_tiles_slider_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'image' => '',
		'url' => '',
		'target' => ''
	), $atts));
	
	
	$oArgs = ThemeArguments::getInstance('ts_tiles_func');
	$shortcode_tiles = $oArgs -> get('shortcode_tiles');
	if (!is_array($shortcode_tiles)) {
		$shortcode_tiles = array();
	}
    $shortcode_tiles[] = array(
		'image' => ts_get_image_by_id($image),
		'url' => $url,
		'target' => $target
	);
	$oArgs -> set('shortcode_tiles', $shortcode_tiles);
}
