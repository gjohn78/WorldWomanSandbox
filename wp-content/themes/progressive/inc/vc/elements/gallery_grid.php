<?php
/**
 * Visual Composer Eelement: Gallery Grid
 * 
 */
add_shortcode('gallery_grid', 'xv_gallery_grid_func');

function xv_gallery_grid_func($atts, $content = null) {


	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'limit' => '',
		'category' => '',
		'thumb_height' => '',
		'order' => '',
		'style' => '',
		'pagination' => '',
					), $atts));

	ob_start();

	if ($style == '4col') {
		$width = 270;
		$height = 197;
		$col = 'col-sm-6 col-md-3';
	} elseif ($style == '3col') {
		$width = 370;
		$height = 270;
		$col = 'col-sm-6 col-md-4';
	} elseif ($style == '2col') {
		$width = 570;
		$height = 416;
		$col = 'col-sm-6 col-md-6';
	} else {
		$width = 1170;
		$height = 418;
		$col = 'col-sm-6 col-md-12';
	}

	if (!empty($thumb_height)) {
		$height = $thumb_height;
	}

	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	query_posts(array(
		'posts_per_page' => $limit,
		'post_type' => 'gallery',
		'order' => $order,
		'gallery_category' => $category,
		'paged' => $paged));

	$current_animation_delay = $animation_delay;
	?>
	<div class="content gallery row">
		<div class="listings clearfix">

			<?php
			global $post;
			$j = 1;
			$even = 0;
			$counter = 1;
			while (have_posts()) : the_post();


				if ($style == 'modern') {

					if ($counter == 6) {
						$pos = 'pull-right';
					} else {
						$pos = '';
					}

					if ($counter == 1 || $counter == 6) {
						$col = ' col-sm-6 col-md-6 ' . $pos;
						$width = 570;
						$height = 450;
						$even = 1;
					} else {
						$width = 270;
						$height = 197;
						$col = ' col-sm-3 col-md-3';
					}

					if ($counter == 10) {
						$counter = 0;
					}
					$counter++;
				}//end modern

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
			<div class="images-box <?php echo sanitize_html_classes($col); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
					<a class="gallery-images" rel="fancybox" href="<?php echo esc_url($image_url); ?>">
						<img src="<?php echo esc_url($thumb); ?>" alt="">
						<span class="bg-images"><i class="icon-search-1"></i></span>
					</a>
				</div>
				<?php
				$current_animation_delay += $animation_delay_item;
			endwhile;
			?>

		</div>
		<?php if ($pagination == 1) { ?>
			<div class="pagination-box container <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
				<?php
				if (function_exists('progressive_get_pagination')) {
					progressive_get_pagination();
				}
				?>
			</div><!-- .pagination-box -->
	<?php } ?>
	</div>

	<?php
	
	wp_enqueue_script('fancybox');
	
	wp_reset_query();

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
