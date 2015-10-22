<?php

$xv_data = ts_get_redux_data();

if (isset($xv_data['coming_soon_switch']) && $xv_data['coming_soon_switch'] == 1) {

	if (function_exists('bp_is_active')) {
		add_action('template_redirect', 'xv_comingsoon_page', 9);
	} else {
		add_action('template_redirect', 'xv_comingsoon_page');
	}

	// add_action( 'admin_bar_menu',array( &$this, 'admin_bar_menu' ), 1000 );          
	/**
	 * Display the coming soon page
	 */
	function xv_comingsoon_page() {
		// Return if a login page
		if (preg_match("/login/i", $_SERVER['REQUEST_URI']) > 0) {
			return false;
		}

		if (!is_admin()) {
			if (!is_feed()) {
				if (!is_user_logged_in()) {
					// $file = get_template_directory_uri().'';
					require_once('page-coming-soon.php');
					exit;
				}
			}
		}
	}

	function xv_comingsoon_scripts() {
		// wp_enqueue_style('soon', get_template_directory_uri() . '/assets/css/style-soon.css', false, '1.0', 'all');
		//wp_enqueue_script( 'set-count', get_template_directory_uri() . '/assets/js/set-countdown.js', array(), '1.0', true );
		//wp_enqueue_script( 'countdown', get_template_directory_uri() . '/assets/js/countdown.js', array(), '1.0', true );                  
	}

	add_action('wp_enqueue_scripts', 'xv_comingsoon_scripts');

	function wp_admin_bar_new_item() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu(array(
			'id' => 'wp-admin-bar-new-item',
			'title' => __('<span style="background:maroon;color:#fff;padding:7px;">' . wp_get_theme() . 'Theme Maintinace Mode Enabled</span>'), 'progressive'));
	}

	add_action('wp_before_admin_bar_render', 'wp_admin_bar_new_item');
}  