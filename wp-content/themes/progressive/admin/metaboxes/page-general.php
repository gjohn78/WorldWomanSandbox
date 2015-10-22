<?php
/*
 * Page general
*/

$sections[] = array(
	'title' => __(' General', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		 array(
			'id'        => 'layout',
			'type'      => 'select',
			'title'     => __('Layout', 'progressive'),
			'options'   => array(
				'' => 'Default',
				'full' => 'Full',
				'boxed' => 'Boxed',
			),
			'default'   => '',
		),
		array(
			'id'        => 'background_image',
			'type'      => 'media',
			'url'       => true,
			'title'     => __('Title Background', 'progressive'),
			'compiler'  => 'true',
			'subtitle'  => __('Upload any media using the WordPress native uploader', 'rhythm'),
			'required'	=> array('layout', 'equals', 'boxed'),
		),
		array(
			'id'        => 'primary_menu',
			'type'      => 'select',
			'title'     => __('Primary menu', 'progressive'),
			'options'   => ts_get_menus_list(),
			'default'   => 'default',
		),
		
		array(
			'id'        => 'sticky_menu',
			'type'      => 'select',
			'title'     => __('Sticky menu', 'progressive'),
			'options'   => array(
				'' => 'Default',
				'yes' => 'Yes',
				'no' => 'No',
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'switch-topbar',
			'type'      => 'select',
			'title'     => __('Top Bar', 'progressive'),
			'options'   => array(
				'' => 'Default',
				'yes' => 'Yes',
				'no' => 'No',
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'topbar-always-on',
			'type'      => 'select',
			'title'     => __('Top Bar on', 'progressive'),
			'options'   => array(
				'' => 'Default',
				'yes' => 'Yes',
				'no' => 'No',
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'promo_panel',
			'type'      => 'select',
			'title'     => __('Promo panel', 'progressive'),
			'options'   => array(
				'' => 'Default',
				'yes' => 'Yes',
				'no' => 'No',
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'right_sidebar',
			'type'      => 'select',
			'title'     => __('Right sidebar', 'progressive'),
			'subtitle'     => __('Only for default page template.', 'progressive'),
			'options'   => ts_get_sidebars_array(),
			'default'   => '',
		),
	)
);