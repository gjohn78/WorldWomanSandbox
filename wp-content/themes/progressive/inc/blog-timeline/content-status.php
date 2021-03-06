<?php
/**
 * The timeline template for displaying status content
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
		<div class="livicon" data-n="comment" data-c="#fff" data-hc="0" data-s="22"></div>
	</div>

	<div class="timeline-content border border-warning" data-appear-animation="<?php echo esc_attr(ts_get_timeline_fadein()); ?>">
		<div class="entry-content">
			<p><a class="aside" href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_excerpt(); ?></a></p>
		</div>
	</div>
</article><!-- .post -->