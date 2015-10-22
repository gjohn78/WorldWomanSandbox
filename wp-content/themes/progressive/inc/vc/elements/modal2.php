<?php
/**
 * Visual Composer Eelement: Modal2
 * 
 */
add_shortcode('modal2', 'ts_modal2_func');

function ts_modal2_func($atts) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'message' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.',
		'image' => '',
		'button_text' => '',
					), $atts));
	ob_start();

	$attachment_id = $image;
	$image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); // returns an array
	$img_url = '';
	if (isset($image_attributes[0])) {
		$img_url = $image_attributes[0];
	}
	?>
	<div <?php echo ts_get_animation_class($animation, true); ?> <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>> 
		<div class="button-list">
			<button data-target="#modal-2" data-toggle="modal" class="btn push-top push-bottom btn-primary">
				<?php echo wp_kses_post($button_text); ?>
			</button>
		</div>
		<div class="modal modal-center fade" id="modal-2" tabindex="-1" role="dialog" aria-labelledby="modalLabel-2" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" style="background-image:url(<?php echo esc_url($img_url); ?>)">
					<div class="modal-header">
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-offset-0 col-sm-offset-3 col-sm-6 text-center">
								<div class="title-box text-center">
									<?php if (!empty($title)) {
										echo '<div class="title-box"><h1 class="title">' . esc_html($title) . '</h1>';
									} ?>
								</div>
								<?php echo wp_kses_post($message); ?>
							</div>
						</div>
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
