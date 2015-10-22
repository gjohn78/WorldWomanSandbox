<?php
/**
 * The timeline template for displaying image content
 *
 * @package progressive
 * @since progressive 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="timeline-time">
		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
	</div>

	<div class="timeline-icon bg-primary">
		<div class="livicon" data-n="camera" data-c="#fff" data-hc="0" data-s="22"></div>
	</div>

	<div class="timeline-content border border-primary" data-appear-animation="<?php echo esc_attr(ts_get_timeline_fadein()); ?>">
		<h2 class="entry-title">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-content">
			<img src="<?php echo get_xv_thumbnail(451, 329); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
		</div>
	</div>
</article><!-- .post -->