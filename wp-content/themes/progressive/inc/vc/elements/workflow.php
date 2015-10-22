<?php
/**
 * Visual Composer Eelement: Workflow
 * 
 */
add_shortcode('workflow', 'ts_workflow_func');

function ts_workflow_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'animation' => '',
		'limit' => 5,
					), $atts));

	ob_start();

	$current_animation_delay = $animation_delay;
	?>

	<div class="bottom-padding <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
	<?php if (!empty($title)) { ?>
			<div class="title-box text-center">
				<h1 class="title"><?php echo esc_html($title); ?></h1>
			</div>
	<?php } ?>
	<div class="steps">


		<?php
		query_posts(array('post_type' => 'workflow', 'posts_per_page' => $limit));

		if (have_posts()) : 
			while (have_posts()) : the_post();
				$icon = get_post_meta(get_the_ID(), 'xv_workflow_icon', TRUE);
				$style = get_post_meta(get_the_ID(), 'xv_workflow_style', TRUE);
				?>
				<div class="step text-center white <?php echo sanitize_html_classes($style); ?>">
					<div class="step-wrapper">
						<span class="livicon" data-n="<?php echo esc_attr($icon); ?>" data-s="48" data-c="#fff" data-hc="#f6f5f5"></span>
						<div class="title-box text-center title-white">
							<h4 class="title"><?php the_title(); ?></h4>
						</div>
						<p><?php the_content(); ?></p>
					</div>
				</div>
			<?php
			endwhile;
		endif;
		wp_reset_query(); ?>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
