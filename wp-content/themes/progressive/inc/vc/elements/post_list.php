<?php
/**
 * Visual Composer Eelement: Post List
 * 
 */
add_shortcode('post_list', 'ts_post_list_func');

function ts_post_list_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'category' => '',
		'limit' => 1,
		'carousel_pagination' => 'yes',
		'carousel_navigation' => 'yes',
		'image_align' => 'left'
					), $atts));

	if (empty($limit)) {
		$limit = 1;
	}
	$html = '';
	$args = array(
		'numberposts' => "",
		'posts_per_page' => $limit,
		'offset' => 0,
		'cat' => $category,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'post_mime_type' => '',
		'post_parent' => '',
		'paged' => 1,
		'post_status' => 'publish'
	);

	ob_start();

	$the_query = new WP_Query($args);
	$html = '';
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();

			$slider = '';
			$post_gallery = ts_get_post_opt('post_gallery');
			if (is_array($post_gallery) && count($post_gallery) > 0) {
				foreach ($post_gallery as $slide) {
					$image = theme_thumb($slide['image'], 370, 270, 'c');
					if (!empty($image)) {
						$slider .= '<img src="' . esc_url($image) . '" alt="" title="" />';
					}
				}
			} ?>
			<div class="bottom-padding <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<div class="post carousel row no-responsive">
					<div class="images-box col-xs-12 col-sm-4 col-md-4 <?php echo ($image_align == 'right' ? 'pull-right' : ''); ?>">
						<?php if (!empty($slider)): ?>

							<div class="carousel-box load" data-carousel-pagination="<?php echo ($carousel_pagination == 'yes' ? 'true' : 'false'); ?>" data-carousel-nav="<?php echo ($carousel_navigation == 'yes' ? 'true' : 'false'); ?>" data-carousel-one="true">
								<div class="carousel"> 
									<?php echo $slider; ?>
								</div>
								<div class="nav-box">
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
								</div>
								<div class="clearfix"></div>
								<div class="pagination switches"></div>
							</div>
						<?php else: ?>
							<img src="<?php echo esc_url(get_xv_thumbnail(370, 270)); ?>" class="single-image" />
						<?php endif; ?>
					</div>

					<div class="col-xs-12 col-sm-8 col-md-8">
						<h2 class="entry-title"><a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-content">
							<?php ts_the_excerpt_theme(155); ?>
						</div>

						<div class="entry-meta">
							<span class="autor-name"><?php the_author(); ?></span>,
							<span class="time"><?php the_time('j.m.Y'); ?></span>
							<span class="separator">|</span>
							<span class="meta"><?php _e('Posted in', 'progressive'); ?> <?php echo get_the_category_list(', '); ?></span>
							<span class="comments-link pull-right">
								<a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?> <?php _e('comment(s)', 'progressive'); ?></a>
							</span>
						</div>
					</div>
					<div class="clearfix"></div>
				</div><!-- .post -->
			</div>
			<?php
		}
		wp_reset_postdata();
	}
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}
