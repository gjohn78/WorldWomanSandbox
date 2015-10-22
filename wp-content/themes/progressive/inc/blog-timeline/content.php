<?php
/**
 * The timeline template for displaying content
 *
 * @package progressive
 * @since progressive 1.0
 */
?>        
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="timeline-time">
		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
	</div>

	<div class="timeline-icon">
		<div class="livicon" data-n="pen" data-c="#fff" data-hc="0" data-s="22"></div>
	</div>

	<div class="timeline-content" data-appear-animation="<?php echo esc_attr(ts_get_timeline_fadein()); ?>">
		<h2 class="entry-title">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="entry-content">
			<?php if (has_post_thumbnail()) { ?>
				<img src="<?php echo get_xv_thumbnail(451, 158); ?>" />
			<?php } ?>
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
</article><!-- .post -->