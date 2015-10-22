<?php
/**
 * @package progressive
 */
?>        
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<h2 class="entry-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-content">
		<?php
		$url = xv_get_field('video_url');
		if (!empty($url)) {
			$embadded_video = ts_get_embaded_video($url);
		} else if (empty($url)) {
			$embadded_video = htmlspecialchars_decode(xv_get_field('embedded_video'));
		}

		if ($embadded_video != '') {
			echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags());
		} else if (has_post_thumbnail()) {
			?>
			<div class="entry-thumb"><img src="<?php echo esc_url(get_xv_thumbnail(870, 400)); ?>" /></div>
		<?php } ?>
		<p><?php the_excerpt(); ?></p>
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
</article><!-- .post -->