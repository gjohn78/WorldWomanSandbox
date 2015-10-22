<?php
/*
 * Service
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-magic',
	'fields' => array(
		array(
			'id'        => 'xv-services-style',
			'type'      => 'select',
			'title'     => __('Service Style', 'progressive'),
			'options'   => array(
				'style1' => 'Style1',
				'style2' => 'Style2',
				'style3' => 'Style3',
				'style4' => 'Style4',
				'style5' => 'Style5',
			),
		),
		
		array(
			'id'        => 'xv-simple-icon',
			'type'      => 'select',
			'title'     => __('Simple Icon', 'progressive'),
			'options'   => ts_getFontAwesomeArray(),
		),
	)
);