<?php

/**
 * Visual Composer Eelement: Portfolio Item
 * 
 */
add_shortcode('portfolio_item', 'ts_portfolio_item_func');

function ts_portfolio_item_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'id' => 0
	), $atts));

	global $post;

	$html = '';
	$new_post = null;
	if (!empty($id)) {
		$new_post = get_post($id);
	}
	if ($new_post) {
		$post = $new_post;

		setup_postdata($post);
		$image = '';

		$slider = '';
		
		$portfolio_slider = ts_get_post_opt('portfolio_slider');
		if (is_array($portfolio_slider) && count($portfolio_slider) > 0) {
			
			foreach ($portfolio_slider as $slide) {
				
				if (!empty($slide['image'])) {
					$image = theme_thumb($slide['image'], 370, 270, 'c');
				}

				$slider .= ' 
					<div class="col-sm-12 col-md-12">
					  <img src="' . esc_url($image) . '" alt="" title="">
					</div>';
				
			}
		}
		
		if (!empty($slider)) {
			$gallery = '
				<div class="carousel-box load" data-carousel-pagination="true" data-carousel-nav="false" data-carousel-one="true">
					<div class="row">
						<div class="carousel">' . $slider . '</div>
					</div>
					<div class="clearfix"></div>
					<div class="pagination switches"></div>
				</div>';
		} else {
			$gallery = '<img src="' . esc_url(get_xv_thumbnail(370, 270)) . '" class="single-image" />';
		}

		$html = '
			<div class="work-single row ' . ts_get_animation_class($animation) . '" ' . ts_get_animation_data_class($animation_delay, $animation_iteration) . '>
				<div class="images-box col-sm-5 col-md-4">
					' . $gallery . '
				</div>

				<div class="work-description col-sm-7 col-md-8">
				  <h3 class="title">' . get_the_title() . '</h3>
				  <div class="type">' . xv_get_field('client') . '</div>

				  <div>
					' . apply_filters('the_content', get_the_content()) . '
					<div class="tags"><b>' . __('Categories', 'progressive') . ': </b>' . strip_tags(get_the_term_list($post->ID, 'portfolio_category', '', ', ')) . '</div>
				  </div>
				</div>
				<div class="clearfix"></div>
			  </div>';

		wp_reset_postdata();
	}
	return $html;
}
