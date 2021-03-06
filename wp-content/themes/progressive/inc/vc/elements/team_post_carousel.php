<?php
/**
 * Visual Composer Eelement: Team Post Carousel
 * 
 */
add_shortcode('team_post_carousel', 'ts_team_post_carousel_func');

function ts_team_post_carousel_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => 8,
		'width' => 270,
		'height' => 270
					), $atts));

	ob_start();

	if (empty($title)) {
		$title_class = '';
	} else {
		$title_class = 'title-box';
	}
	?>

	<div class="carousel-box bottom-padding bottom-padding-mini load <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<div class="<?php echo sanitize_html_class($title_class); ?> no-margin">
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
			<?php
			if (!empty($title)) {

				echo '<h2 class="title">' . $title . '</h2>';
			}
			?>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="carousel">
				<?php
				query_posts(array('post_type' => 'team', 'posts_per_page' => $limit));
				if (have_posts()) : while (have_posts()) : the_post();

						$thumb = get_xv_thumbnail($width, $height);

						$designation = get_post_meta(get_the_ID(), 'xv_member_designation', TRUE);
						$about = get_post_meta(get_the_ID(), 'xv_member_about', TRUE);
						$email = get_post_meta(get_the_ID(), 'xv_member_email', TRUE);
						$phone = get_post_meta(get_the_ID(), 'xv_member_phone', TRUE);
						$facebook = get_post_meta(get_the_ID(), 'xv_member_facebook', TRUE);
						$twitter = get_post_meta(get_the_ID(), 'xv_member_twiiter', TRUE);
						$gplus = get_post_meta(get_the_ID(), 'xv_member_gplus', TRUE);
						$linkedin = get_post_meta(get_the_ID(), 'xv_member_linkedin', TRUE);
						?>

						<div class="col-sm-3 col-md-3 employee rotation">
							<div class="default">
								<div class="image">
									<img src="<?php echo esc_url($thumb); ?>" alt="">
								</div>
								<div class="description">
									<div class="vertical">
										<h3 class="name"><?php the_title(); ?></h3>
										<div class="role"><?php echo esc_html($designation); ?></div> 
									</div>
								</div>
							</div>
							<div class="employee-hover">
								<h3 class="name"><?php the_title(); ?></h3>
								<div class="role"><?php echo esc_html($designation); ?></div>
								<div class="image">
									<img src="<?php echo esc_url($thumb); ?>" alt="">
								</div>
								<div>
									<p><?php echo wp_kses_post($about); ?></p>
									<div class="contact"><b><?php _e('Email', 'progressive'); ?>: </b><?php echo esc_html($email); ?></div>
									<div class="contact"><b><?php _e('Phone', 'progressive'); ?>: </b><?php echo esc_html($phone); ?></div>
								</div>

								<div class="social">
									<?php
									if (!empty($facebook)) {
										echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-facebook' href='" . esc_url($facebook) . "'></a></div>";
									}
									if (!empty($twitter)) {
										echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-twitter' href='" . esc_url($twitter) . "'></a></div>";
									}
									if (!empty($gplus)) {
										echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-gplus' href='" . esc_url($gplus) . "'></a></div>";
									}
									if (!empty($linkedin)) {
										echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-linkedin' href='" . esc_url($linkedin) . "'></a></div>";
									}
									?>
								</div>
							</div><!-- .employee-hover -->
						</div>
					<?php
					endwhile;

				endif;
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
