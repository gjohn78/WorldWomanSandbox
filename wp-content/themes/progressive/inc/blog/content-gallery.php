<?php
/**
 * @package progressive
 */
?>        
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<h2 class="entry-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-content">
		<?php 
		$post_gallery = ts_get_post_opt('post_gallery');
		if (is_array($post_gallery) && count($post_gallery) > 0) { ?>
			<div class="carousel-box load" data-carousel-pagination="true" data-carousel-nav="false" data-carousel-one="true">
				<div class="carousel"> 
					<?php foreach ($post_gallery as $slide) {
						$image = theme_thumb($slide['image'], 870, 400);
						if (!empty($image)) {
							echo '<img src="' . esc_url($image) . '" alt="" title="">';
						}
					} ?>
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
		<?php } elseif (has_post_thumbnail()) { ?>
			<div class="entry-thumb"><img src="<?php echo esc_url(get_xv_thumbnail(870, 400)); ?>" /></div>
		<?php } ?>

		<?php the_excerpt(); ?>
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