<?php
/**
 * Visual Composer Eelement: Social Icons
 * 
 */
add_shortcode('social_icons', 'ts_social_icons_func');

function ts_social_icons_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'facebook' => '',
		'twitter' => '',
		'gplus' => '',
		'linkedin' => '',
		'align' => '',
	), $atts));
	$html = '';
	ob_start();

	$animation_delay = intval($animation_delay);
	$animation_delay_item = intval($animation_delay_item);
	?>
	<div class="<?php echo sanitize_html_class($align); ?>">

		<div class="social">
			<?php
			$instance['fb_icons'] = $facebook;
			$instance['tw_icons'] = $twitter;
			$instance['gp_icons'] = $gplus;
			$instance['in_icons'] = $linkedin;

			$current_animation_delay = $animation_delay;
			?>
			<?php if ($instance['fb_icons'] != ''): ?><a href="<?php echo esc_url($instance['fb_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-facebook <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>></a><?php endif; ?>
			<?php if ($instance['tw_icons'] != ''): ?><a href="<?php echo esc_url($instance['tw_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-twitter <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay += $animation_delay_item, $animation_iteration); ?>></a> <?php endif; ?>
			<?php if ($instance['gp_icons'] != ''): ?><a href="<?php echo esc_url($instance['gp_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-gplus <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay += $animation_delay_item, $animation_iteration); ?>></a> <?php endif; ?>
			<?php if ($instance['in_icons'] != ''): ?><a href="<?php echo esc_url($instance['in_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-linkedin <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay += $animation_delay_item, $animation_iteration); ?>></a> <?php endif; ?>
			<div class="clearfix"></div>
		</div>
	</div>

	<?php
	$output = ob_get_contents();

	ob_end_clean();
	return $output;
}
