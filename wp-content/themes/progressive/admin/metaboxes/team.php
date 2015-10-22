<?php
/*
 * Team
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post_gallery',
			'type'      => 'slides',
			'title'     => __('Gallery images', 'progressive'),
			'subtitle'  => __('Upload images or add from media library.', 'progressive'),
			'placeholder'   => array(
				'title'         => __('Title', 'progressive'),
			),
			'show' => array(
				'title' => false,
				'description' => false,
				'url' => false,
			)
		),
		
		array(
			'id'        => 'xv_member_designation',
			'type'      => 'text',
			'title'     => __('Designation', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_about',
			'type'      => 'textarea',
			'title'     => __('About Team Member', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_email',
			'type'      => 'text',
			'title'     => __('Email', 'progressive'),
			'default'   => '',
			'validate'	=> 'email'
		),
		
		array(
			'id'        => 'xv_member_phone',
			'type'      => 'text',
			'title'     => __('Phone', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_facebook',
			'type'      => 'text',
			'title'     => __('Facebook', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_twiiter',
			'type'      => 'text',
			'title'     => __('Twitter', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_gplus',
			'type'      => 'text',
			'title'     => __('Googe Plus', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'xv_member_linkedin',
			'type'      => 'text',
			'title'     => __('Linked In', 'progressive'),
			'default'   => '',
		),
	)
);