<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package progressive
 */
function progressive_wp_head() {

	$xv_data = ts_get_redux_data();
	?>
	<link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>"/>
	<?php if (isset($xv_data['fav_icon']) && isset($xv_data['fav_icon']['url']) && !empty($xv_data['fav_icon']['url'])): ?>
		<link rel="shortcut icon" href="<?php echo esc_url($xv_data['fav_icon']['url']); ?>" type="image/x-icon" />
	<?php endif; ?>
	<?php
}

add_action('wp_head', 'progressive_wp_head', 5);

if (!function_exists('theme_styles')) :

	function progressive_styles() {
		?>
		<style type="text/css">
		<?php
		if (is_page()) {
			$background_image = xv_get_field('background_image');
			if (is_array($background_image) && !empty($background_image['url'])) {
				?> 
					#boxed-bg {
						background-image: url(<?php echo esc_url($background_image['url']); ?>);
					}	
			<?php
			}

			$footer_up_button_color = xv_get_field('footer_up_button_color');
			$footer_up_button_hover_color = xv_get_field('footer_up_button_hover_color');

			if (!empty($footer_up_button_color)) {
				?> 
					#footer .up {
						background-color: <?php echo esc_attr($footer_up_button_color); ?>
					}	
			<?php }
			if (!empty($footer_up_button_hover_color)) {
				?> 
					#footer .up:hover {
						background-color: <?php echo esc_attr($footer_up_button_hover_color); ?>
					}	
			<?php }
		}
		?>
		</style>
		<?php
	}

	add_action('wp_head', 'progressive_styles', 500);
endif;

if (!function_exists('progressive_content_nav')) :

	/**
	 * Display navigation to next/previous pages when applicable.
	 */
	function progressive_content_nav($nav_id) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if (is_single()) {
			$previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
			$next = get_adjacent_post(false, '', false);

			if (!$next && !$previous)
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ($wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ))
			return;

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
		?>
		<nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo sanitize_html_classes($nav_class); ?>">
			<h1 class="screen-reader-text"><?php _e('Post navigation', 'progressive'); ?></h1>

			<?php if (is_single()) : // navigation links for single posts ?>

				<?php previous_post_link('<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'progressive') . '</span> %title'); ?>
				<?php next_post_link('<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'progressive') . '</span>'); ?>

			<?php elseif ($wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() )) : // navigation links for home, archive, and search pages  ?>

				<?php if (get_next_posts_link()) : ?>
					<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'progressive')); ?></div>
			<?php endif; ?>

			<?php if (get_previous_posts_link()) : ?>
					<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'progressive')); ?></div>
			<?php endif; ?>

		<?php endif; ?>

		</nav><!-- #<?php echo esc_html($nav_id); ?> -->
		<?php
	}

endif; // progressive_content_nav

if (!function_exists('progressive_comment')) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function progressive_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
				?>

				<li class="comment media" id="comment-<?php comment_ID(); ?>">
					<div class="media-body">
						<p>
					<?php _e('Pingback:', 'progressive'); ?> <?php comment_author_link(); ?>
						</p>
					</div><!--/.media-body -->
						<?php
				break;
			default :
				// Proceed with normal comments.
				global $post;
				?>

				<li class="comment media" id="li-comment-<?php comment_ID(); ?>">
					<a href="<?php echo esc_url($comment->comment_author_url); ?>" class="pull-left">
						<?php echo get_avatar($comment, 64); ?>
					</a>

					<div class="meta">   
						<?php
						printf('<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
										'Post author', 'progressive'
								) . '</span> ' : ''); ?>, <span>
							<?php
							printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'), sprintf(
											__('%1$s at %2$s', 'progressive'), get_comment_date(), get_comment_time()
									)
							);
							?>
						</span>
					</div>   
					<div class="media-body description">
						<?php if ('0' == $comment->comment_approved) : ?>
							<p class="comment-awaiting-moderation"><?php
							_e('Your comment is awaiting moderation.', 'progressive'); ?></p>
						<?php endif; ?>

						<?php comment_text(); ?>

						<p class="reply">
							<?php
							comment_reply_link(array_merge($args, array(
								'reply_text' => __('<i class=" fa fa-mail-forward"></i> Reply', 'progressive'),
								'depth' => $depth,
								'max_depth' => $args['max_depth']
											)
							));
							?>
						</p>
					</div>
					<!--/.media-body -->
				<?php
				break;
			endswitch;
		}

	endif; // ends check for progressive_comment()

	if (!function_exists('progressive_posted_on')) :

		/**
		 * Prints HTML with meta information for the current post-date/time and author.
		 */
		function progressive_posted_on() {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			if (get_the_time('U') !== get_the_modified_time('U'))
				$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

			$time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
			);

			printf(__('<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'progressive'), sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string
					), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())
			));
		}
	endif;

	/**
	 * Returns true if a blog has more than 1 category.
	 */
	function progressive_categorized_blog() {
		if (false === ( $all_the_cool_cats = get_transient('all_the_cool_cats') )) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(array(
				'hide_empty' => 1,
					));

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count($all_the_cool_cats);

			set_transient('all_the_cool_cats', $all_the_cool_cats);
		}

		if ('1' != $all_the_cool_cats) {
			// This blog has more than 1 category so progressive_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so progressive_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * Flush out the transients used in progressive_categorized_blog.
	 */
	function progressive_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient('all_the_cool_cats');
	}

	add_action('edit_category', 'progressive_category_transient_flusher');
	add_action('save_post', 'progressive_category_transient_flusher');

	/**
	 * Output preloader
	 */
	function progressive_preloader() {

		$xv_data = ts_get_redux_data();

		if (isset($xv_data['preloader']) && $xv_data['preloader'] == 1) {
			?>
			<div class="preloading-screen">
				<div class="spinners">
					<div class="bounce1"></div>
				</div>
			</div>
		<?php
		}
	}

	/**
	 * Outputs promo panel
	 */
	function progressive_promo_panel() {

		$xv_data = ts_get_redux_data();

		if (ts_check_if_display('promo_panel')) {
			?>
			<div class="top-fixed-box">
				<div class="container">
					<div class="contact-box pull-left">
						<div class="phone pull-left">
							<?php if (!empty($xv_data['promo_panel_icon_1'])) { ?>
								<i class="<?php echo sanitize_html_classes($xv_data['promo_panel_icon_1']); ?>"></i>
							<?php } ?>
							<?php echo wp_kses_data($xv_data['promo_panel_text_1']); ?>
						</div>
						<div class="email pull-left">
							<?php if (!empty($xv_data['promo_panel_icon_2'])) { ?>
								<i class="<?php echo sanitize_html_classes($xv_data['promo_panel_icon_2']); ?>"></i>
							<?php } ?>
							<?php echo wp_kses_data($xv_data['promo_panel_text_2']); ?>
						</div>
					</div>

					<div class="pull-right">
						<div class="social">
							<?php if (!empty($xv_data['promo_panel_facebook'])) { ?>
								<a class="sbtnf sbtnf-rounded color color-hover icon-facebook" href="<?php echo esc_url($xv_data['promo_panel_facebook']); ?>"></a>
							<?php } ?>
							<?php if (!empty($xv_data['promo_panel_twitter'])) { ?>
								<a class="sbtnf sbtnf-rounded color color-hover icon-twitter" href="<?php echo esc_url($xv_data['promo_panel_twitter']); ?>"></a>
							<?php } ?>
							<?php if (!empty($xv_data['promo_panel_google_plus'])) { ?>
								<a class="sbtnf sbtnf-rounded color color-hover icon-gplus" href="<?php echo esc_url($xv_data['promo_panel_google_plus']); ?>"></a>
						<?php } ?>
						<?php if (!empty($xv_data['promo_panel_linkedin'])) { ?>
								<a class="sbtnf sbtnf-rounded color color-hover icon-linkedin" href="<?php echo esc_url($xv_data['promo_panel_linkedin']); ?>"></a>
						<?php } ?>
						</div>
						<?php if (!empty($xv_data['promo_panel_button_label'])) { ?>
							<a href="<?php echo esc_url($xv_data['promo_panel_button_url']); ?>" class="btn btn-primary"><?php echo esc_html($xv_data['promo_panel_button_label']); ?></a>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php
		}
	}

	/**
	 * Outputs topbar
	 */
	function progressive_topbar() {

		$xv_data = ts_get_redux_data();

		if (ts_check_if_display('switch-topbar')) {
			?>
			<div id="top-box">
				<div class="container">
					<div class="row">
						<div class="col-xs-9 col-sm-5">
							<?php if (!empty($xv_data['language-options'])) {
								echo do_shortcode($xv_data['language-options']);
							} ?>
							<?php if (!empty($xv_data['currency-options'])) {
								echo do_shortcode($xv_data['currency-options']);
							} ?>
						</div>  
						<div class="col-xs-3 col-sm-7">
							<div class="navbar navbar-inverse top-navbar top-navbar-right" role="navigation">
								<button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target=".top-navbar .navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<nav class="collapse collapsing navbar-collapse">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'top',
											'menu' => 'dropdown',
											'container' => false,
											'menu_class' => 'nav navbar-nav navbar-right',
											'fallback_cb' => '',
											'menu_id' => 'top-menu',
											'depth' => 1,
											'walker' => has_nav_menu('main') ? new ts_walker_nav_menu : null
										)
									);
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div><!-- #top-box -->
	<?php
	}
}
