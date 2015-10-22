<?php
/**
 * Visual Composer Eelement: Portfolio Carousel 2
 * 
 */
add_shortcode('portfolio_carousel2', 'ts_portfolio_carousel2_func');

function ts_portfolio_carousel2_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => 'Carousel Title',
		'category' => '',
		'limit' => '',
		'width' => 270,
		'height' => 197,
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
			<div class="carousel no-responsive">
				<?php
				$terms = get_terms("portfolio_category");
				$count = count($terms);

				$adcount = 1;

				$term = get_terms("portfolio_category");
				query_posts(array('post_type' => 'portfolio', 'posts_per_page' => $limit, 'portfolio_category' => $category, 'post_status' => 'publish'));
				if (have_posts()) : while (have_posts()) : the_post();

					$thumb = get_xv_thumbnail(370, 270);
					?>
					<div class="col-xs-12 col-sm-4 col-md-3">
						<a href="<?php echo esc_url(get_the_permalink()); ?>" class="work">
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
