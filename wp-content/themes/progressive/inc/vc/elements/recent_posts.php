<?php
/**
 * Visual Composer Eelement: Recent Posts
 * 
 */
add_shortcode('recent_posts', 'recent_posts_func');

function recent_posts_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'post_style' => '',
		'count' => '3',
		'length' => '125',
		'blog_text' => '',
		'blog_url' => '',
	), $atts));

	$current_animation_delay = $animation_delay;
	ob_start();

	if ($post_style == 'latest-posts-white') {
		$title_class = "title-white";
	} else {
		$title_class = "";
	}
	?>
	<?php
	if (!empty($title)) {
		$t_class = 'title-box';
	} else {
		$t_class = '';
	}
	$current_animation_delay = $animation_delay;
	?>
	<div class="recent-posts">
		<div class="<?php echo esc_attr($t_class); ?> <?php echo ts_get_animation_class($animation); ?>">
	<?php if (!empty($blog_text)) { ?>
		<a class="btn btn-default" href="<?php echo esc_url($blog_url); ?>"><?php echo esc_html($blog_text); ?><span class="glyphicon glyphicon-arrow-right"></span></a>
	<?php } ?>
			<h2 class="title <?php echo esc_attr($title_class); ?>"><?php echo esc_html($title); ?></h2>
		</div>
		<ul class="latest-posts <?php echo esc_attr($post_style); ?>">

			<?php
			$current_animation_delay += $animation_delay_item;
			query_posts(
					array(
						'post_type' => 'post',
						'posts_per_page' => $count
					)
			);

			if (have_posts()) : 
				while (have_posts()) : the_post();
					$thumb = get_xv_thumbnail(84, 84);
					?>
					<li <?php echo ts_get_animation_class($animation, true); ?> <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<img class="image img-circle animated" title="" alt="" src="<?php echo esc_url($thumb); ?>">
						<div class="meta">
			                <span><?php the_title(); ?></span>, 
			                <span class="time"><?php the_time('j.m.Y'); ?></span>
						</div>
						<div class="description">
			                <a href="<?php echo esc_url(get_the_permalink()); ?>">
								<?php echo wp_kses_post(get_xv_excerpt($length)); ?>
			                </a>
						</div>
					</li>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>  
		</ul>
	</div>
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
		