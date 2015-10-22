<?php
/**
 * Visual Composer Eelement: Post Slider
 * 
 */
add_shortcode('posts_slider', 'posts_slider_func');

function posts_slider_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'count' => '3',
		'length' => '125',
		'blog_text' => '',
		'blog_url' => '',
		'category' => '',
		'style' => '',
		'autoplay' => ''
	), $atts));

	ob_start();

	query_posts(
		array(
			'post_type' => 'post',
			'posts_per_page' => $count,
			'category_name' => $category,
		)
	);
	?>

	<?php
	if ($style == 'normal' || $style == 'wide') {
		if ($style == 'normal') {
			echo '<div class="content">';
			$width = 720;
			$height = 442;
		} else {
			$width = 1170;
			$height = 550;
		}
		
		if (!empty($title)) {
			echo '<h2 class="title">' . $title . '</h2>';
		}
		?>
		<div class="slider progressive-slider load <?php echo ts_get_animation_class($animation); ?>" data-carousel-autoplay="<?php echo ($autoplay == 'enabled' ? 'true' : 'false') ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
			<div class="container"> 
				<div class="row">
					<div class="sliders-box">
						<?php
						if (have_posts()) : while (have_posts()) : the_post();

							$thumb = get_xv_thumbnail($width, $height);
							?>
							<div class="col-sm-12 col-md-12">
								<div class="slid row">
									<div class="col-sm-12 col-md-12">
										<img class="slid-img" src="<?php echo esc_url($thumb); ?>" alt="">
									</div>

									<div class="slid-content col-sm-4 col-md-4">
										<h1 class="title"><?php the_title(); ?></h1>
										<p class="descriptions"><?php echo get_xv_excerpt($length); ?></p>
										<?php if ($style == 'wide') { ?> 
											<a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-block btn-default btn-lg"><?php _e('More', 'progressive'); ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php
							endwhile;
						endif;
						wp_reset_query(); ?>  
					</div><!-- .sliders-box -->

					<div class="slider-nav col-sm-4 col-md-4">
						<div class="nav-box">
							<a class="next" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
									<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#838383" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
								</svg>
							</a>
							<a class="prev" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
									<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#838383" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
								</svg>
							</a>
							<div class="pagination switches"></div> 
						</div>
					</div>

				</div>
			</div> <!-- .container -->
		</div> <!-- .progressive-slider -->
		<?php
		if ($style == 'normal') {
			echo '</div>';
		}
	} else {  //end normal or wide 
		?>

		<?php
		$attributes = 'data-carousel-autoplay="' . ($autoplay == 'enabled' ? 'true' : '') . '" ';

		if ($style == 'style4') {

			$attributes .= 'data-carousel-one="true" data-carousel-nav="false"';
		} else {
			$attributes .= 'data-carousel-pagination="true" data-carousel-one="true"';
		}
		?>

		<div class="carousel-box posts-carousel load overflow <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?> <?php echo $attributes; ?>>
			<div class="title-box">
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
				<?php } ?>
				<?php
				if (!empty($title)) {
					echo '<h2 class="title">' . $title . '</h2>';
				}
				?>
			</div>

			<div class="clearfix"></div>

			<div class="row">
		        <div class="carousel no-responsive">

					<?php
					if (have_posts()) : 
						while (have_posts()) : the_post(); ?>

							<div class="post">
								<h2 class="entry-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
								<div class="entry-content">
									<?php echo get_xv_excerpt($length); ?>
								</div>

								<footer class="entry-meta">
									<span class="autor-name"><?php the_author(); ?></span>,
									<span class="time"><?php the_time('j.m.Y'); ?></span>
									<span class="separator">|</span>
									<span class="meta"><?php _e('Posted in', 'progressive'); ?> <?php echo get_the_category_list(__(', ', 'progressive')); ?></span>

									<span class="comments-link pull-right">
										<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php comments_number('0', '1', '%'); ?> <?php _e('comment(s)', 'progressive'); ?></a>
									</span>
								</footer>
							</div>


							<?php
						endwhile;
					endif;
					wp_reset_query(); ?>  
		        </div>
			</div>
			<div class="clearfix"></div>
		<?php if ($style == 'style1' || $style == 'style3') { ?>
				<div class="pagination switches"></div>
		<?php } ?>
		</div>


	<?php }
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
