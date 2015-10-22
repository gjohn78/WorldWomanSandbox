<?php
/**
 * @package progressive
 */
?>        
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<div class="entry-content aside">
		<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_excerpt(); ?></a>
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
