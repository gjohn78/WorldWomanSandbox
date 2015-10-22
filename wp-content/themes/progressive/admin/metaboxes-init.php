<?php
// INCLUDE THIS BEFORE you load your ReduxFramework object config file.

// The metabox opt name should be the same as our main theme options
// name to allow it overwrite the values.
$redux_opt_name = REDUX_OPT_NAME;

function ts_redux_add_metaboxes($metaboxes) {
	
	// Variable used to store the configuration array of metaboxes
	$metaboxes = array();
	
	$metaboxes[] = ts_redux_get_portfolio_metaboxes();
	$metaboxes[] = ts_redux_get_team_metaboxes();
	$metaboxes[] = ts_redux_get_product_metaboxes();
	$metaboxes[] = ts_redux_get_workflow_metaboxes();
	$metaboxes[] = ts_redux_get_testimonial_metaboxes();
	$metaboxes[] = ts_redux_get_page_metaboxes();
	$metaboxes[] = ts_redux_get_service_metaboxes();
	$metaboxes[] = ts_redux_get_video_post_metaboxes();
	$metaboxes[] = ts_redux_get_gallery_post_metaboxes();
	$metaboxes[] = ts_redux_get_audio_post_metaboxes();
	
	return $metaboxes;
}
add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'ts_redux_add_metaboxes');

/**
 * Get configuration array for portfolio single post
 * @return type
 */
function ts_redux_get_portfolio_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/portfolio.php';
	
	return array(
		'id' => 'ts-portfolio-options',
		'title' => __('Portfolio Options', 'progressive'),
		'post_types' => array('portfolio'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for team single post
 * @return type
 */
function ts_redux_get_team_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/team.php';
	
	return array(
		'id' => 'ts-team-options',
		'title' => __('Team Member Options', 'progressive'),
		'post_types' => array('team'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for workflow single post
 * @return type
 */
function ts_redux_get_workflow_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/workflow.php';
	
	return array(
		'id' => 'ts-workflow-options',
		'title' => __('Workflow Options', 'progressive'),
		'post_types' => array('workflow'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for product single post
 * @return type
 */
function ts_redux_get_product_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/product.php';
	
	return array(
		'id' => 'ts-product-options',
		'title' => __('Product Options', 'progressive'),
		'post_types' => array('product'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for testimonial single post
 * @return type
 */
function ts_redux_get_testimonial_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/testimonial.php';
	
	return array(
		'id' => 'ts-testimonial-options',
		'title' => __('Testimonial Options', 'progressive'),
		'post_types' => array('testimonials'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for page metaboxes
 * @return type
 */
function ts_redux_get_page_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();

	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/page-colors.php';
	require get_template_directory() . '/admin/metaboxes/page-general.php';
	
	return array(
		'id' => 'ts-page-options',
		'title' => __('Options', 'progressive'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for social-site custom post type metaboxes
 * @return type
 */
function ts_redux_get_service_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/service.php';
	
	return array(
		'id' => 'ts-service-options',
		'title' => __('Service Options', 'progressive'),
		'post_types' => array('service'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function ts_redux_get_video_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-video.php';
	
	return array(
		'id' => 'ts-video-post-options',
		'title' => __('Video Post Options', 'progressive'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('video')
	);
}

/**
 * Get configuration array for gallery post metaboxes
 * @return type
 */
function ts_redux_get_gallery_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-gallery.php';
	
	return array(
		'id' => 'ts-gallery-post-options',
		'title' => __('Gallery Post Options', 'progressive'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('gallery')
	);
}

/**
 * Get configuration array for audio post metaboxes
 * @return type
 */
function ts_redux_get_audio_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-audio.php';
	
	return array(
		'id' => 'ts-audio-post-options',
		'title' => __('Audio Post Options', 'progressive'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('audio')
	);
}