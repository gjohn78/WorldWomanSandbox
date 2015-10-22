<?php
/**
 * Visual Composer Eelement: Gallery Carousel
 * 
 */
add_shortcode('gallery_carousel', 'xv_gallery_carousel_func');

function xv_gallery_carousel_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'category' => '',
		'title' => '',
		'height' => '',
		'style' => '',
					), $atts));

	ob_start();
	?>
	<?php
	$terms = get_terms("gallery_category");
	$count = count($terms);
	
	if (empty($title)) {
		$title_class = '';
	} else {
		$title_class = 'title-box';
	}
	?>

	<div class="carousel-box load overflow <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="title-box">
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
			<?php if (!empty($title)) { ?>
				<h2 class="title"><?php echo esc_html($title); ?></h2>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="carousel gallery">

				<?php
				$terms = get_terms("gallery_category");
				$count = count($terms);
				$post_per_page = 2;
				global $post;

				$adcount = 1;

				query_posts(array('post_type' => 'gallery', 'gallery_category' => $category, 'orderby' => 'date', 'order' => 'ASC'));
				if (have_posts()) : 
					while (have_posts()) : the_post();

						$thumb = get_xv_thumbnail(270, 135);
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
						<div class="col-sm-4 col-md-3">
							<a class="gallery-images" rel="fancybox" href="<?php echo esc_url($image_url); ?>">
								<img src="<?php echo esc_url($thumb); ?>" alt="">
									<span class="bg-images"><i class="icon-search-1"></i></span>
							</a>
						</div>

					<?php
					endwhile;
				endif;
				wp_reset_query();
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
