<?php
/**
 * Visual Composer Eelement: Modal
 * 
 */
add_shortcode('modal', 'ts_modal_func');

function ts_modal_func($atts) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'message' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.',
		'button_text' => '',
					), $atts));
	ob_start();
	?>

	<div <?php echo ts_get_animation_class($animation, true); ?> <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="button-list">
			<button data-target="#modal-1" data-toggle="modal" class="btn push-top push-bottom btn-default">
				<?php echo wp_kses_post($button_text); ?>
			</button>
		</div>
		<div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="modalLabel-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<a aria-hidden="true" data-dismiss="modal" class="close" href="#">&times;</a>
						<?php if (!empty($title)) {
							echo '<div class="title-box"><h4 class="title">' . esc_html($title) . '</h4></div>';
						} ?>
					</div>
					<div class="modal-body">
						<?php echo wp_kses_post($message); ?>
					</div>
					<div class="modal-footer">
						<button data-dismiss="modal" class="btn btn-default" type="button"><?php _e('Close', 'progressive') ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	wp_enqueue_script('raphael');
	//  wp_enqueue_script( 'liviv', get_template_directory_uri() . '/js/livicons-1.3.min.js', array ('jquery'), null, true  );
	ob_end_clean();
	return $output;
}
