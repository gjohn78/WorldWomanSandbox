<?php

if (function_exists('vc_map')) {
	/* ----------------------------------------------------------------------------*
	 * Force Visual Composer to initialize as "built into the theme". 
	 * This will hide certain tabs under the Settings->Visual Composer page
	 * ---------------------------------------------------------------------------- */

	add_action('vc_before_init', 'xv_vcSetAsTheme');

	function xv_vcSetAsTheme() {

		vc_set_as_theme();
	}

	/* ----------------------------------------------------------------------------*
	 * VC Map (Fields for each elements)
	 * ---------------------------------------------------------------------------- */


	require_once 'vc_map.php';
	require_once 'vc_map_functions.php';


	/* ----------------------------------------------------------------------------*
	 * Custom VC Templates
	 * ---------------------------------------------------------------------------- */

	$dir = get_template_directory() . '/inc/vc/vc_templates/';
	vc_set_shortcodes_templates_dir($dir);

	//require_once 'vc_templates/vc_row.php';
	//require_once 'vc_templates/vc_accordion_tab.php';



	/* ----------------------------------------------------------------------------*
	 * Elements admin CSS and JS
	 * ---------------------------------------------------------------------------- */

	add_action('admin_init', 'xv_vc_styles');

	//add_action( 'wp_enqueue_scripts', 'xv_vc_styles' );

	function xv_vc_styles() {
		//* Register our stylesheet. */
		wp_enqueue_style('xv_vc', get_template_directory_uri() . '/inc/vc/assets/css/vc.css');
	}

	/* ----------------------------------------------------------------------------*
	 * Include All Custom Elements
	 * ---------------------------------------------------------------------------- */

	require_once 'elements/icons.php';
	require_once 'elements/contact_form.php';
	require_once 'elements/blockquote.php';
	require_once 'elements/alerts.php';
	require_once 'elements/button.php';
	require_once 'elements/button_outlined.php';
	require_once 'elements/divider.php';


	require_once 'elements/headers.php';

	require_once 'elements/image.php';
	require_once 'elements/livicon.php';

	require_once 'elements/map_container.php';

	require_once 'elements/pricing_table.php';
	require_once 'elements/pricing_table2.php';

	require_once 'elements/social_icons.php';

	require_once 'elements/testimonials.php';
	require_once 'elements/text.php';

	require_once 'elements/services_carousel.php';
	require_once 'elements/skills_circular.php';
	require_once 'elements/another_call_to_action.php';
	require_once 'elements/post_carousel.php';
	require_once 'elements/post_list.php';
	require_once 'elements/team.php';
	require_once 'elements/team_text.php';
	require_once 'elements/team_post_carousel.php';
	require_once 'elements/team_post_loop.php';
	require_once 'elements/clients_post_carousel.php';
	require_once 'elements/clients_posts.php';
	require_once 'elements/recent_posts.php';
	require_once 'elements/recent_posts2.php';
	require_once 'elements/portfolio_item.php';
	require_once 'elements/portfolio_carousel2.php';
	require_once 'elements/portfolio_carousel.php';
	require_once 'elements/portfolio_filter.php';
	require_once 'elements/gallery.php';
	require_once 'elements/gallery_grid.php';
	require_once 'elements/gallery_carousel.php';
	require_once 'elements/services.php';
	require_once 'elements/workflow.php';
	require_once 'elements/faq.php';
	require_once 'elements/woo_products_widget.php';
	require_once 'elements/woo_products.php';
	require_once 'elements/woo_products_2.php';
	require_once 'elements/posts_slider.php';
	require_once 'elements/woo_products_carousel.php';
	require_once 'elements/steps.php';
	require_once 'elements/steps2.php';
	require_once 'elements/modal.php';
	require_once 'elements/modal2.php';
	require_once 'elements/special_text.php';
	require_once 'elements/containers.php';
	require_once 'elements/sitemap.php';
	require_once 'elements/contact_info.php';
	require_once 'elements/newsletter.php';
	require_once 'elements/person.php';
	require_once 'elements/tiles.php';
	require_once 'elements/wpml_languages.php';
	require_once 'elements/progressive_menu.php';
	require_once 'elements/banner_carousel.php';
	require_once 'elements/tabs.php';
}