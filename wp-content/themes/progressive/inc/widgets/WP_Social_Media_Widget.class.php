<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */
add_action('widgets_init', 'init_WP_Social_Media_Widget');

function init_WP_Social_Media_Widget() {
	register_widget('WP_Social_Media_Widget');
}

class WP_Social_Media_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'widget_social_media',
			'description' => __("Social Media Icons", "framework"));
		parent::__construct('social-media', __('Social Media Icons', "framework"), $widget_ops);

		$this->alt_option_name = 'widget_social_media_entries';
	}

	function widget($args, $instance) {
		global $post;

		ob_start();
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		?>


		<div class="widget social">

			<?php echo '<h3>' . esc_html($title) . '</h3>'; ?>
			<?php if ($instance['sk_icons'] != ''): ?><p><?php echo $instance['sk_icons']; ?></p><?php endif; ?>

			<?php if ($instance['fb_icons'] != ''): ?><a href="<?php echo esc_url($instance['fb_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-facebook"></a><?php endif; ?>
			<?php if ($instance['tw_icons'] != ''): ?><a href="<?php echo esc_url($instance['tw_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-twitter"></a> <?php endif; ?>
			<?php if ($instance['gp_icons'] != ''): ?>  <a href="<?php echo esc_url($instance['gp_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-gplus"></a> <?php endif; ?>
			<?php if ($instance['in_icons'] != ''): ?><a href="<?php echo esc_url($instance['in_icons']); ?>" class="sbtnf sbtnf-rounded color color-hover icon-linkedin"></a> <?php endif; ?>
			<div class="clearfix"></div>
		</div>
			<?php
			echo $after_widget;
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['fb_icons'] = strip_tags($new_instance['fb_icons']);
			$instance['tw_icons'] = strip_tags($new_instance['tw_icons']);
			$instance['sk_icons'] = strip_tags($new_instance['sk_icons']);
			$instance['gp_icons'] = strip_tags($new_instance['gp_icons']);
			$instance['vi_icons'] = strip_tags($new_instance['vi_icons']);
			$instance['in_icons'] = strip_tags($new_instance['in_icons']);
			$instance['ig_icons'] = strip_tags($new_instance['ig_icons']);
			return $new_instance;
		}

		function form($instance) {
			$title = isset($instance['title']) ? $instance['title'] : '';
			$fb_icons = isset($instance['fb_icons']) ? $instance['fb_icons'] : '';
			$tw_icons = isset($instance['tw_icons']) ? $instance['tw_icons'] : '';
			$sk_icons = isset($instance['sk_icons']) ? $instance['sk_icons'] : '';
			$gp_icons = isset($instance['gp_icons']) ? $instance['gp_icons'] : '';
			$vi_icons = isset($instance['vi_icons']) ? $instance['vi_icons'] : '';
			$in_icons = isset($instance['in_icons']) ? $instance['in_icons'] : '';
			$ig_icons = isset($instance['ig_icons']) ? $instance['ig_icons'] : '';
			?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text"
				   value="<?php echo esc_attr($title); ?>"/></p>

		<p><label for="<?php echo $this->get_field_id('sk_icons'); ?>"><?php _e('Description:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('sk_icons'); ?>" name="<?php echo $this->get_field_name('sk_icons'); ?>" type="text" value="<?php echo esc_attr($sk_icons); ?>"
				   size="3"/></p>

		<p><label for="<?php echo $this->get_field_id('fb_icons'); ?>"><?php _e('Facebook:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('fb_icons'); ?>" name="<?php echo $this->get_field_name('fb_icons'); ?>" type="text" value="<?php echo esc_attr($fb_icons); ?>"
				   size="3"/></p>


		<p><label for="<?php echo $this->get_field_id('tw_icons'); ?>"><?php _e('Twitter:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tw_icons'); ?>" name="<?php echo $this->get_field_name('tw_icons'); ?>" type="text" value="<?php echo esc_attr($tw_icons); ?>"
				   size="3"/></p>


		<p><label for="<?php echo $this->get_field_id('gp_icons'); ?>"><?php _e('Google+:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('gp_icons'); ?>" name="<?php echo $this->get_field_name('gp_icons'); ?>" type="text" value="<?php echo esc_attr($gp_icons); ?>"
				   size="3"/></p>

		<p><label for="<?php echo $this->get_field_id('in_icons'); ?>"><?php _e('Linkdin:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('in_icons'); ?>" name="<?php echo $this->get_field_name('in_icons'); ?>" type="text" value="<?php echo esc_attr($in_icons); ?>"
				   size="3"/></p>

		<?php
	}

}
