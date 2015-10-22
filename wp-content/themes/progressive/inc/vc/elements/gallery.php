<?php
/**
 * Visual Composer Eelement: Gallery
 * 
 */
add_shortcode('gallery', 'xv_gallery_func');

function xv_gallery_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'limit' => '3',
		'category' => '',
		'width' => '',
		'height' => '',
		'style' => '',
					), $atts));

	global $post;

	ob_start();

	if ($style == 'small') {

		$width = 270;
		$height = 135;
		$col = 'col-sm-4 col-md-3';
	} else {
		$width = 270;
		$height = 135;
		$col = 'col-sm-4 col-md-4';
	}
	$current_animation_delay = $animation_delay;
	?>  

	<div class="bottom-padding load">
		<div class="clearfix"></div>
		<div class="row">
			<div class="no-responsive gallery">

				<?php
				$wp_query = new WP_Query();

				$args = array(
					'numberposts' => '',
					'posts_per_page' => $posts_per_page,
					'offset' => 0,
					'gallery_category' => $category,
					'orderby' => 'date',
					'order' => 'ASC',
					'post_type' => 'gallery',
					'post_status' => 'publish'
				);

				$wp_query->query($args);

				if ($wp_query->have_posts()) :
					while ($wp_query->have_posts()) : $wp_query->the_post();

						$thumb = get_xv_thumbnail($width, $height);
						if (has_post_thumbnail()) {
							$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
							$image_url = '';
							if (isset($image_src[0])) {
								$image_url = $image_src[0];
							}
							//  $thumb = theme_thumb($image_url, $width, $height, 'c');
						} else {

							$image_url = get_xv_thumbnail(600, 600);
						}
						?>
						<div class="<?php echo esc_attr($col); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
							<a class="gallery-images" rel="fancybox" href="<?php echo esc_url($image_url); ?>">
								<img src="<?php echo esc_url($thumb); ?>" alt="">
								<span class="bg-images"><i class="icon-search"></i></span>
							</a>
						</div>

			<?php
			$current_animation_delay += $animation_delay_item;
		endwhile;
	endif;
	wp_reset_postdata();
	?>    
	        </div>
		</div>
	</div> 


	<?php
	
	wp_enqueue_script('fancybox');
	
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
