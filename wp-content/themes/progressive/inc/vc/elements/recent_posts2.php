<?php
/**
 * Visual Composer Eelement: Recent Posts2
 * 
 */
add_shortcode('recent_posts2', 'recent_posts2_func');

function recent_posts2_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'style' => '',
		'count' => '4',
		'length' => '125',
		'blog_text' => '',
		'blog_url' => ''
					), $atts));
	ob_start();
	?>
	<?php
	if (!empty($title)) {
		$t_class = 'title-box';
	} else {
		$t_class = '';
	}
	$current_animation_delay = $animation_delay;
	?>
	<div class="news <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
	    <div class="<?php echo esc_attr($t_class); ?>">
			<?php if (!empty($blog_text)) { ?>
				<a href="<?php echo esc_url($blog_url); ?> " class="btn btn-default"><?php echo esc_html($blog_text); ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
			<?php } ?>
			<h2 class="title"><?php echo esc_html($title); ?></h2>
	    </div>
	    <div class="row">

			<?php
			$current_animation_delay += $animation_delay_item;

			query_posts(
					array(
						'post_type' => 'post',
						'posts_per_page' => $count
					)
			);
			if (have_posts()) : while (have_posts()) : the_post();

					$thumb = get_xv_thumbnail(84, 84);
					$excerpt = get_xv_excerpt($length);
					?>

					<div class="news-item col-sm-12 <?php echo esc_attr($style); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<div class="time"><?php the_time('j.m.Y'); ?></div>
						<h3 class="title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
						<div class="news-body"><?php echo wp_kses_post($excerpt); ?></div>
						<a href="<?php echo esc_url(get_the_permalink()); ?>" class="more"><?php _e('Read more', 'progressive'); ?> <span class="fa fa-angle-right"></span></a>
					</div><!-- .news-item -->

					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>  
	    </div>
	</div><!-- .news -->
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
