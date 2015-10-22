<?php
/**
 * Visual Composer Eelement: Testimonials Posts
 * 
 */
add_shortcode('testimonials_posts', 'testimonials_posts_func');

function testimonials_posts_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'style' => '',
		'bg' => '',
		'count' => '3',
		'length' => '125',
		'blog_text' => '',
		'blog_url' => '',
		'white' => '',
		'text_color' => '',
		'color' => ''
	), $atts));

	$oArgs = ThemeArguments::getInstance('testimonials_posts_func');
	$ts_testimonials_i = (int)$oArgs -> get('ts_testimonials_i') + 1;
	$oArgs -> set('ts_testimonials_i', $ts_testimonials_i);
	
	ob_start();
	?>
	<?php
	if ($style == 'style4') {

		$attributes = 'data-carousel-autoplay="true" data-carousel-one="true" data-carousel-nav="false"';
	} else {
		$attributes = 'data-carousel-pagination="true" data-carousel-one="true"';
	}
	$title_class = '';
	if (!empty($title)) {
		$title_class = 'title-box';
	}
	?>

	<div class="respond-carousel <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="carousel-box load overflow" <?php echo $attributes; ?>>
			<div class="<?php echo esc_attr($title_class); ?>">
				<?php if ($style == 'style2' || $style == 'style3') { ?>
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
				<?php } 
				if (!empty($title)) {
					echo '<h2 class="title">' . $title . '</h2>';
				}
				?>
			</div>
			<div class="row">
				<?php
				$data = '';
				if (!empty($text_color)) {
					$data .= 'data-text-color="' . esc_attr($text_color) . '" ';
				}
				if (!empty($color)) {
					$data .= 'data-color="' . esc_attr($color) . '" ';
				}
				?>
				<div class="carousel testimonials-wrapper" id="testimonials-<?php echo esc_attr($ts_testimonials_i); ?>" <?php echo $data; ?>>

					<?php
					query_posts(
						array(
							'post_type' => 'testimonials',
							'posts_per_page' => $count
						)
					);
					if (have_posts()) : 
						while (have_posts()) : the_post();

							$thumb = get_xv_thumbnail(84, 84);
							$excerpt = get_xv_excerpt($length);
							?>
							<?php
							if ($bg == '1') {
								$bg_style = 'bg-info';
								$bg_class = 'bg';
							} else {
								$bg_style = 'border-info';
								$bg_class = 'border white';
							}
							?>


							<div class="respond respond-blockquote <?php echo sanitize_html_classes($bg_class); ?> col-sm-12 col-md-12">
								<div class="description <?php echo esc_attr($bg_style); ?>">
									<blockquote>
										<?php the_content(); ?>
									</blockquote>
								</div>
								<div class="name">
									<div class="icon">
										<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail();
										}
										?>
									</div>
									
									<strong <?php echo ($white == 'white' ? 'class="white"' : ''); ?>><?php the_title(); ?></strong>
									<div <?php echo ($white == 'white' ? 'class="white"' : ''); ?>><?php echo get_post_meta(get_the_ID(), 'designation', TRUE); ?></div>
								</div>
							</div>
							<?php
						endwhile;
					endif;
					wp_reset_query();
					?>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php if ($style == 'style1' || $style == 'style3') { ?>
				<div class="pagination switches"></div>
			<?php } ?>
		</div>
	</div>

	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
