<?php
/**
 * Visual Composer Eelement: Contact Info
 * 
 */
add_shortcode('newsletter', 'ts_newsletter_func');

function ts_newsletter_func($atts, $content = null) {
	extract(
			shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'id' => '1',
	), $atts));
	ob_start();
	?>
	<div class="sidebar vc_newsletter <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="newsletter">
			<?php echo apply_filters('vc_wysija__shortcode', do_shortcode('[wysija_form id="' . $id . '"]')); ?>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
