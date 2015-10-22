<?php
/*
 * Portfolio genearal
*/

$sections[] = array(
	'icon' => 'el-icon-adjust-alt',
	//'title' => __('General settings', 'progressive'),
	'fields' => array(
		
		array(
			'id'        => 'client',
			'type'      => 'text',
			'title'     => __('Client', 'progressive'),
			'subtitle'  => __('Your client name.', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'project_url',
			'type'      => 'text',
			'title'     => __('Project URL', 'progressive'),
			'subtitle'  => __('External URL to the project.', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'data',
			'type'      => 'text',
			'title'     => __('Date', 'progressive'),
			'subtitle'  => __('Project date.', 'progressive'),
			'default'   => '',
		),
		
		array(
			'id'        => 'portfolio_slider',
			'type'      => 'slides',
			'title'     => __('Slider images', 'progressive'),
			'subtitle'  => __('Upload images or add from media library.', 'progressive'),
			'placeholder'   => array(
//				'title' => __('Title', 'progressive'),
			),
			'show' => array(
				'title' => false,
				'description' => false,
				'url' => false,
			)
		),
		
		array(
			'id'=>'show_related_posts',
			'type' => 'button_set',
			'title' => __('Show related posts', 'progressive'),
			'subtitle'=> __('Related post will show based on posts tags.', 'progressive'),
			'options' => array(
				'Yes' => 'Yes',
				'No' => 'No',
			),
			'default' => '',
		),
		
	), // #fields
);