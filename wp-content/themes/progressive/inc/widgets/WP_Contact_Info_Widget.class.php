<?php
/**
 * Recent works widget
 * @package framework
 * @since framework 1.0
 */
add_action('widgets_init', 'init_WP_Contact_Info_Widget');

function init_WP_Contact_Info_Widget() {
	register_widget('WP_Contact_Info_Widget');
}

class WP_Contact_Info_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_contact_info', 'description' => __("Displays contact info.", "framework"));
		parent::__construct('contact-info', __('Contact Info', "framework"), $widget_ops);

		$this->alt_option_name = 'widget_contact_info';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	function widget($args, $instance) {
		global $post;

		$cache = wp_cache_get('widget_contact_info', 'widget');

		if (!is_array($cache)) {
			$cache = array();
		}
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);
		echo $before_widget;

		if (!empty($instance['title'])) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="contact-info-widget">							
		<?php if (!empty($instance['address'])): ?>
				<div class="address">
					<div class="footer-icon">
						<svg xml:space="preserve" enable-background="new 0 0 16 16" viewBox="0 0 16 16" height="16px" width="16px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
							<g>
								<g>
									<path d="M8,16c-0.256,0-0.512-0.098-0.707-0.293C7.077,15.491,2,10.364,2,6c0-3.309,2.691-6,6-6
										  c3.309,0,6,2.691,6,6c0,4.364-5.077,9.491-5.293,9.707C8.512,15.902,8.256,16,8,16z M8,2C5.795,2,4,3.794,4,6
										  c0,2.496,2.459,5.799,4,7.536c1.541-1.737,4-5.04,4-7.536C12.001,3.794,10.206,2,8,2z" fill="#c6c6c6"/>
								</g>
								<g>
									<circle r="2" cy="6" cx="8.001" fill="#c6c6c6"/>
								</g>
							</g>
						</svg>
					</div>
			<?php echo nl2br(esc_html($instance['address'])); ?> <br/>
				</div>
		<?php endif; ?>
		<?php if (!empty($instance['phone'])): ?>
				<div class="phone">
					<div class="footer-icon">
						<svg xml:space="preserve" enable-background="new 0 0 16 16" viewBox="0 0 16 16" height="16px" width="16px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
							<path d="M11.001,0H5C3.896,0,3,0.896,3,2c0,0.273,0,11.727,0,12c0,1.104,0.896,2,2,2h6c1.104,0,2-0.896,2-2
								  c0-0.273,0-11.727,0-12C13.001,0.896,12.105,0,11.001,0z M8,15c-0.552,0-1-0.447-1-1s0.448-1,1-1s1,0.447,1,1S8.553,15,8,15z
								  M11.001,12H5V2h6V12z" fill="#c6c6c6"/>
						</svg>
					</div>
			<?php echo esc_html($instance['phone']); ?><br/>
				</div>
		<?php endif; ?>
		<?php if (!empty($instance['fax'])): ?>

				<div class="phone">
					<div class="footer-icon">

					</div>
				<?php echo esc_html($instance['fax']); ?><br/><br/>
				</div>
		<?php endif; ?>

		<?php if (!empty($instance['email'])): ?>								
				<div class="phone">
					<div class="footer-icon">
						<i class="icon-email"></i>
					</div>
					<a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo esc_html($instance['email']); ?></a><br/>
				</div>

		<?php endif; ?>
		</div>
			<?php
			echo $after_widget;
			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('widget_contact_info', $cache, 'widget');
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['address'] = strip_tags($new_instance['address']);
			$instance['phone'] = strip_tags($new_instance['phone']);
			$instance['fax'] = strip_tags($new_instance['fax']);
			$instance['email'] = strip_tags($new_instance['email']);
			$this->flush_widget_cache();

			$alloptions = wp_cache_get('alloptions', 'options');
			if (isset($alloptions['widget_contact_info'])) {
				delete_option('widget_contact_info');
			}
			return $instance;
		}

		function flush_widget_cache() {
			wp_cache_delete('widget_contact_info', 'widget');
		}

		function form($instance) {
			$title = isset($instance['title']) ? $instance['title'] : '';
			$address = isset($instance['address']) ? $instance['address'] : '';
			$phone = isset($instance['phone']) ? $instance['phone'] : '';
			$fax = isset($instance['fax']) ? $instance['fax'] : '';
			$email = isset($instance['email']) ? $instance['email'] : '';
			?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', "framework"); ?></label>
			<textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo esc_textarea($address); ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($fax); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', "framework"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>

		<?php
	}

}
