<?php
/**
 * Visual Composer Eelement: Portfolio Carousel
 * 
 */
add_shortcode('portfolio_carousel', 'ts_portfolio_carousel_func');

function ts_portfolio_carousel_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'carousel_style' => '',
		'category' => '',
		'limit' => '',
		'width' => 270,
		'height' => 197,
					), $atts));


	ob_start();
	?>


	<div class="carousel-box load overflow" data-carousel-pagination="true" data-carousel-nav="false" data-carousel-autoplay="true">
		<div class="clearfix"></div>

		<div class="row">
			<div class="carousel no-responsive">
				<?php
				$current_animation_delay = $animation_delay;
				$term = get_terms("portfolio_category");
				query_posts(array('post_type' => 'portfolio', 'posts_per_page' => $limit, 'portfolio_category' => $category, 'post_status' => 'publish'));
				if (have_posts()) : while (have_posts()) : the_post();

					$thumb = get_xv_thumbnail($width, $height); ?>  
					<div class="col-sm-4 col-md-3 <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<a href="portfolio-single.html" class="work">
							<img src="<?php echo esc_url($thumb); ?>"  alt="">
							<span class="shadow"></span>
							<div class="bg-hover"></div>
							<div class="work-title">
								<h3 class="title"><?php the_title(); ?></h3>
								<div class="description"><?php echo strip_tags(get_the_term_list($post->ID, 'portfolio_category', '', ', ')); ?></div>
							</div>
						</a>
					</div>
						<?php
						$current_animation_delay += $animation_delay_item;
					endwhile;
				endif;
				wp_reset_query();
				?>
			</div>
		</div>
		<div>
			<div class="pagination switches <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>></div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
