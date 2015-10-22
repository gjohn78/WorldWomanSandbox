<?php
/**
 * @package progressive
 */
?>        
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<?php if (get_post_format() != 'aside' && get_post_format() != 'status'): ?>
		<h2 class="entry-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		switch (get_post_format()) {
			case 'audio':
				$audio_url = xv_get_field('audio_url');
				if ($audio_url != '') {
					?>
					<div class="audio-box">
						<audio controls>
							<source type="audio/<?php echo (strstr($audio_url, 'ogg') ? 'ogg' : 'mpeg') ?>" src="<?php echo esc_url($audio_url); ?>">
								<?php _e('Your browser does not support the audio element.', 'progressive'); ?>
						</audio>
					</div>
				<?php } ?>
				<?php if (has_post_thumbnail()) { ?>
					<div class="entry-thumb"><img src="<?php echo esc_url(get_xv_thumbnail(870, 400)); ?>" /></div>
				<?php
				}

				break;

			case 'gallery':
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
				<?php
				}

				break;

			case 'image':
				if (has_post_thumbnail()) {
					?>
					<div class="entry-thumb"><img src="<?php echo esc_url(get_xv_thumbnail(870, 400)); ?>" /></div>
				<?php
				}

				break;

			case 'video':
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
				<?php
				}

				break;

			default:
				if (has_post_thumbnail()) {
					?>
					<div class="entry-thumb"><img src="<?php echo esc_url(get_xv_thumbnail(870, 400)); ?>" /></div>
					<?php
					}
		}

		if (get_post_format() == 'quote'): ?>
			<blockquote>
		<?php endif;
		the_content();
		if (get_post_format() == 'quote'): ?>
			</blockquote>
		<?php
		endif;

		wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'progressive'), 'after' => '</div>')); ?>
	</div>
	<footer class="entry-meta">
        <span class="autor-name"><?php the_author(); ?></span>,
        <span class="time"><?php the_time('j.m.Y'); ?></span>
        <span class="separator">|</span>
        <span class="meta"><?php _e('Posted in', 'progressive'); ?> <?php echo get_the_category_list(__(', ', 'progressive')); ?></span>

        <span class="comments-link pull-right">
			<a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?> <?php _e('comment(s)', 'progressive'); ?></a>
        </span>
	</footer>
</article><!-- .post -->