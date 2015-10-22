<?php
/**
 * Visual Composer Eelement: Services Carousel
 * 
 */
add_shortcode('services_carousel', 'ts_services_carousel_func');

function ts_services_carousel_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => 8,
		'width' => 170,
		'height' => 170,
	), $atts));

	ob_start();
	?>
	<?php
	if (empty($title)) {
		$title_class = '';
	} else {
		$title_class = 'title-box';
	}
	?>
	<div class="features-promo carousel-box bottom-padding load overflow <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="<?php echo sanitize_html_class($title_class); ?>">
	        <a class="next" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
					<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
				</svg>
	        </a>
	        <a class="prev" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
					<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
				</svg>
	        </a>
	        <h1 class="title"><?php echo esc_html($title); ?></h1>
		</div>
		<div class="clearfix"></div>

		<div class="row">
	        <div class="carousel no-responsive">

				<?php
				query_posts(array('post_type' => 'service', 'posts_per_page' => $limit));
				if (have_posts()) : 
					while (have_posts()) : the_post();
						$thumb = get_xv_thumbnail($width, $height);

						$icon = get_post_meta(get_the_ID(), 'xv-simple-icon', TRUE);
						?>
						<div class="text-small features-block col-sm-3 col-md-3">
							<div class="header-box">
								<div class="icon_box">
									<i class="<?php echo esc_attr($icon); ?>"></i>
								</div>
								<h6><?php the_title(); ?></h6>
							</div>
							<div><?php the_content(); ?></div>
						</div>
					<?php
					endwhile;
				endif;
				wp_reset_query();
				?>
	        </div>
		</div>
	</div><!-- .features-promo -->

	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
