<?php

/**
 * Visual Composer Eelement: Post Carousel
 * 
 */
add_shortcode('post_carousel', 'ts_post_carousel_func');

function ts_post_carousel_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'carousel_style' => '',
		'full_width_lines' => '',
		'category' => '',
		'limit' => 10
					), $atts));

	// Reset and setup variables
	$output = '';
	$temp_title = '';
	$temp_link = '';

	$carousel_classes = '';
	if ($carousel_style == 'mini') {
		$width = 127;
		$height = 79;
		$carousel_classes = 'banner-set-mini banner-set-no-pagination';
	} else {
		$width = 253;
		$height = 158;
	}


	if ($full_width_lines == 'enabled') {
		$carousel_classes .= ' banner-border-shop';
	}

	$output .= "
		<div class='banner-set load {$carousel_classes}'>
            <div class='container'>
              <div class='banners'>";

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $limit
	);

	if (!empty($category)) {

		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $category
			)
		);
	}
	$current_animation_delay = $animation_delay;
	query_posts($args);
	// the loop
	if (have_posts()) : 
		while (have_posts()) : the_post();

			$temp_title = get_the_title($post->ID);
			$temp_link = get_permalink($post->ID);
			$excerpt = get_xv_excerpt(250);

			// output all findings - CUSTOMIZE TO YOUR LIKING
			$output .= "<a  class='banner " . ts_get_animation_class($animation) . "' href='" . esc_url($temp_link) . "' " . ts_get_animation_data_class($current_animation_delay, $animation_iteration) . ">";

			$thumb = get_xv_thumbnail($width, $height);

			$output .= '<img src="' . esc_url($thumb) . '" alt="' . the_title_attribute('echo=0') . '" />';

			$output .= "<h2 class='title'>{$temp_title}</h2>";
			if ($carousel_style != 'mini') {
				$output .="<div class='description'>{$excerpt}</div>";
			}
			$output .= "</a>";
			$current_animation_delay += $animation_delay_item;
		endwhile;
	endif;
	wp_reset_query();

	$output .="
		</div>
			<div class='clearfix'></div>
		   </div>
			<div class='nav-box " . ts_get_animation_class($animation) . "' " . ts_get_animation_data_class($current_animation_delay, $animation_iteration) . ">
			<div class='container'>
			  <a class='prev' href='#'><span class='icon-left'></span></a>
			  <div class='pagination switches'></div>
			  <a class='next' href='#'><span class='icon-right'></span></a>  
			</div>
			</div>
		</div>
		<div class='clearfix'></div>";

	return $output;
}
