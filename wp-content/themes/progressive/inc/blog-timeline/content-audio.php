<?php
/**
 * The timeline template for displaying audio content
 *
 * @package progressive
 * @since progressive 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="timeline-time">
		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
	</div>

	<div class="timeline-icon bg-success">
		<div class="livicon" data-n="music" data-c="#fff" data-hc="0" data-s="22"></div>
	</div>

	<div class="timeline-content border border-success" data-appear-animation="<?php echo esc_attr(ts_get_timeline_fadein()); ?>">
		<h2 class="entry-title">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-content">
			<?php $audio_url = xv_get_field('audio_url');
			if ($audio_url != '') {
				?>
				<div class="audio-box">
					<audio controls>
						<source type="audio/<?php echo (strstr($audio_url, 'ogg') ? 'ogg' : 'mpeg') ?>" src="<?php echo esc_url($audio_url); ?>">
						<?php _e('Your browser does not support the audio element.', 'progressive'); ?>
					</audio>
				</div>
			<?php } ?>
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
</article><!-- .post -->