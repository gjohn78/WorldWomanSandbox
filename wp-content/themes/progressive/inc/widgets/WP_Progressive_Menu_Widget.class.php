<?php
/**
 * Progressive Menu widget
 * @package framework
 * @since framework 1.0
 */
add_action('widgets_init', 'init_WP_Progressive_Menu_Widget');

function init_WP_Progressive_Menu_Widget() {
	register_widget('WP_Progressive_Menu_Widget');
}

class WP_Progressive_Menu_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'menu', 'description' => __("Displays 2 levels accordion style menu.", "framework"));
		parent::__construct('progressive-menu', __('Progressive Menu', "framework"), $widget_ops);

		$this->alt_option_name = 'widget_progressive_menu';

		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}

	function widget($args, $instance) {
		global $post;

		$cache = wp_cache_get('widget_progressive_menu', 'widget');

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

		$nav_menu = !empty($instance['nav_menu']) ? wp_get_nav_menu_object($instance['nav_menu']) : false;

		if (!$nav_menu)
			return;

		ob_start();
		extract($args);
		echo $before_widget;

		if (!empty($instance['title'])) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
			echo $before_title . esc_html($title) . $after_title;
		}
		echo '<nav>';
		wp_nav_menu(array(
			'fallback_cb' => '',
			'container' => false,
			'menu' => $nav_menu,
			'menu_class' => 'theme-menu',
			'depth' => 2,
			'walker' => new progressive_menu_widget_walker_nav_menu
		));
		echo '</nav>';
		?>

		<?php
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_progressive_menu', $cache, 'widget');
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_progressive_menu', 'widget');
	}

	public function update($new_instance, $old_instance) {

		$instance = array();
		if (!empty($new_instance['title'])) {
			$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		}
		if (!empty($new_instance['nav_menu'])) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}

		return $instance;
	}

	public function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus(array('orderby' => 'name'));

		// If no menus exists, direct the user to go and create some.
		if (!$menus) {
			echo '<p>' . sprintf(__('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php')) . '</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'progressive') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:', 'progressive'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
				<option value="0"><?php _e('&mdash; Select &mdash;', 'progressive') ?></option>
		<?php
		foreach ($menus as $menu) {
			echo '<option value="' . esc_attr($menu->term_id) . '"'
			. selected($nav_menu, $menu->term_id, false)
			. '>' . esc_html($menu->name) . '</option>';
		}
		?>
			</select>
		</p>
	<?php
	}
}
		