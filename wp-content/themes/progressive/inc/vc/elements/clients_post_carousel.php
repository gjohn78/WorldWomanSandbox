<?php
/**
 * Visual Composer Eelement: Clients Post Carousel
 * 
 */
add_shortcode('client_post_carousel', 'ts_client_post_carousel_func');

function ts_client_post_carousel_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => 8,
		'width' => 170,
		'height' => 170,
		'category' => '',
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
	<div class="carousel-box load overflow <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
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
	<?php
	if (!empty($title)) {

		echo '<h2 class="title">' . $title . '</h2>';
	}
	?>
		</div>
		<div class="clearfix"></div>
		<div class="row">
	        <div class="carousel carousel-links">
				<?php
				query_posts(array('post_type' => 'clients', 'clients_category' => $category, 'posts_per_page' => $limit));
				if (have_posts()) : 
					while (have_posts()) : the_post();

						$thumb = get_xv_thumbnail($width, $height);
						?>
						<div class="col-sm-3 col-md-2">
							<a>
								<img src="<?php echo esc_url($thumb); ?>" class="img-rounded" alt="">
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
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
