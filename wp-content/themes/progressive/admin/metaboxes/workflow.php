<?php
/*
 * Workflow
*/

$sections[] = array(
	'title' => __(' General', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		 array(
			'id'        => 'xv_workflow_style',
			'type'      => 'select',
			'title'     => __('Workflow Style', 'progressive'),
			'options'   => array(
				'border-warning bg-warning' => 'Orange',
				'border-grey bg-grey' => 'Grey',
				'border-info bg-info' => 'Blue',
				'border-success bg-success' => 'Green',
				'border-error bg-error' => 'Red',
			),
			'default'   => 'border-grey bg-grey : Grey',
		),
		array(
			'id'        => 'xv_workflow_icon',
			'type'      => 'select',
			'title'     => __('Workflow Icon', 'progressive'),
			'options'   => ts_get_livicon_list(),
			'default'   => '',
		),
	)
);