<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'video_url',
			'type'      => 'text',
			'title'     => __('Video URL', 'rhythm'),
			'subtitle'  => __('YouTube or Vimeo video URL', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'embedded_video',
			'type' => 'textarea',
			'title' => __('Embadded video', 'rhythm'),
			'subtitle' => __('Use this option when the video does not come from YouTube or Vimeo', 'rhythm'),
			'default' => '',
		),
	)
);