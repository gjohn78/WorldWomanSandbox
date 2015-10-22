<?php

/**
 * Shortcodes
 *
 * @package framework
 * @since framework 1.0
 */

function ts_get_vc_map_textfield($heading, $param_name, $group = '', $admin_label = false) {
	return array(
		'type' => 'textfield',
		'heading' => $heading,
		'param_name' => $param_name,
		'admin_label' => $admin_label,
		'description' => '',
		'group' => $group,
	);
}

function ts_get_vc_map_colorpicker($heading, $param_name, $group = '') {
	return array(
		'type' => 'colorpicker',
		'heading' => $heading,
		'param_name' => $param_name,
		'admin_label' => false,
		'description' => '',
		"group" => $group,
	);
}

function ts_get_vc_map_icons() {
	return array(
		'type' => 'dropdown',
		'heading' => __('Icon', 'framework'),
		'param_name' => 'icon',
		'admin_label' => true,
		'value' => ts_getFontAwesomeArray(),
		'description' => '',
		'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown'
	);
}

function ts_get_vc_element_align() {
	return array(
		'type' => 'dropdown',
		'heading' => __('Align', 'framework'),
		'param_name' => 'align',
		'admin_label' => false,
		'value' => array(
			'Left' => 'text-left',
			'Center' => 'text-center',
			'Right' => 'text-right',
			'None' => 'none'
		),
	);
}

function ts_get_vc_element_target($heading = '', $param_name = '', $group = '', $admin_label = false) {
	if (empty($heading)) {
		$heading = __('Target', 'progressive');
	}
	if (empty($param_name)) {
		$param_name = 'target';
	}

	return array(
		'type' => 'dropdown',
		'heading' => $heading,
		'param_name' => $param_name,
		'admin_label' => $admin_label,
		'group' => $group,
		'value' => array(
			'_blank' => '_blank',
			'_parent' => '_parent',
			'_self' => '_self',
			'_top' => '_top'
		),
	);
}

function ts_get_percentage_select_values($add_zero = false) {
	$a = array();

	if ($add_zero) {
		$start_from = 0;
	} else {
		$start_from = 1;
	}

	for ($i = $start_from; $i <= 100; $i++) {
		$a[$i] = $i;
	}
	return $a;
}

function ts_get_vc_animation_effects_settings() {
	return array(
		'type' => 'dropdown',
		'heading' => __('Animation', 'framework'),
		'param_name' => 'animation',
		'admin_label' => true,
		'value' => ts_get_animation_effects_list(true),
		'description' => ''
	);
}

function ts_get_vc_animation_delay_settings() {
	return array(
		'type' => 'textfield',
		'heading' => __('Animation delay (ms)', 'framework'),
		'param_name' => 'animation_delay',
		'admin_label' => false,
		'value' => '',
		'description' => ''
	);
}

function ts_get_vc_animation_delay_item_settings() {
	return array(
		'type' => 'textfield',
		'heading' => __('Animation delay each item (ms)', 'framework'),
		'param_name' => 'animation_delay_item',
		'admin_label' => false,
		'value' => '',
		'description' => ''
	);
}

function ts_get_vc_animation_iteration_settings() {
	return array(
		'type' => 'dropdown',
		'heading' => __('Animation iteration', 'framework'),
		'param_name' => 'animation_iteration',
		'admin_label' => false,
		'value' => array_flip(array(
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
			6 => 6,
			7 => 7,
			8 => 8,
			9 => 9,
			10 => 10,
			'infinite' => __('infinite', 'framework')
		)),
		'description' => ''
	);
}

function ts_get_animation_effects_list() {
	$animations = array(
		'bounce',
		'flash',
		'pulse',
		'shake',
		'swing',
		'tada',
		'wobble',
		'bounceIn',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'bounceInUp',
		'bounceOut',
		'bounceOutDown',
		'bounceOutLeft',
		'bounceOutRight',
		'bounceOutUp',
		'fadeIn',
		'fadeInDown',
		'fadeInDownBig',
		'fadeInLeft',
		'fadeInLeftBig',
		'fadeInRight',
		'fadeInRightBig',
		'fadeInUp',
		'fadeInUpBig',
		'fadeOut',
		'fadeOutDown',
		'fadeOutDownBig',
		'fadeOutLeft',
		'fadeOutLeftBig',
		'fadeOutRight',
		'fadeOutRightBig',
		'fadeOutUp',
		'fadeOutUpBig',
		'flip',
		'flipInX',
		'flipInY',
		'flipOutX',
		'flipOutY',
		'lightSpeedIn',
		'lightSpeedOut',
		'rotateIn',
		'rotateInDownLeft',
		'rotateInDownRight',
		'rotateInUpLeft',
		'rotateInUpRight',
		'rotateOut',
		'rotateOutDownLeft',
		'rotateOutDownRight',
		'rotateOutUpLeft',
		'rotateOutUpRight',
		'slideInDown',
		'slideInLeft',
		'slideInRight',
		'slideOutLeft',
		'slideOutRight',
		'slideOutUp',
		'hinge',
		'rollIn',
		'rollOut'
	);
	$animation_effects = array();
	$animation_effects[__('None', 'framework')] = '';

	foreach ($animations as $animation) {
		$animation_effects[$animation] = $animation;
	}

	return $animation_effects;
}

function ts_get_livicons() {

	return array(
		'type' => 'dropdown',
		'heading' => __('Livicons', 'framework'),
		'param_name' => 'livicon',
		'admin_label' => true,
		'value' => ts_get_livicon_list(true),
		'description' => 'If you want to use simple icons select none for livicons.',
		'group' => 'Livicons',
		'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown'
	);
}

function ts_get_livicons_animate_on() {
	return array(
		'type' => 'dropdown',
		'heading' => __('Animate on', 'progressive'),
		'param_name' => 'animate_on',
		'admin_label' => true,
		'value' => array_flip(array(
			'parent' => __('Parent', 'progressive'),
			'icon' => __('Icon', 'progressive')
		)),
		'group' => 'Livicons',
		'description' => ''
	);
}

function ts_get_vc_menus_dropdown() {

	$menus = wp_get_nav_menus(array('orderby' => 'name'));

	// If no menus exists, direct the user to go and create some.
	if (!$menus) {
		return;
	}

	$options = array(
		'Select' => 0
	);

	if ($menus) {
		foreach ($menus as $menu) {
			$options[esc_html($menu->name)] = $menu->term_id;
		}
	}

	return array(
		'type' => 'dropdown',
		'heading' => __('Menu', 'progressive'),
		'param_name' => 'nav_menu',
		'admin_label' => true,
		'value' => $options,
		'description' => ''
	);
}
