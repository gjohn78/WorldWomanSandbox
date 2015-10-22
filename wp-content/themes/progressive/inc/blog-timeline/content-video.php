<?php
/**
 * The timeline template for displaying video content
 *
 * @package progressive
 * @since progressive 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="timeline-time">
		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
	</div>

	<div class="timeline-icon bg-warning">
		<div class="livicon" data-n="camcoder" data-c="#fff" data-hc="0" data-s="22"></div>
	</div>

	<div class="timeline-content bg bg-warning" data-appear-animation="<?php echo esc_attr(ts_get_timeline_fadein()); ?>">
		<h2 class="entry-title">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-content">
			<?php
			$url = xv_get_field('video_url');
			if (!empty($url)) {
				$embadded_video = ts_get_embaded_video($url);
			} else if (empty($url)) {
				$embadded_video = htmlspecialchars_decode(xv_get_field('embedded_video'));
			}

			if ($embadded_video != '') {
				echo wp_kses($embadded_video, ts_add_iframe_to_allowed_tags());
			}
			?>
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
</article><!-- .post -->