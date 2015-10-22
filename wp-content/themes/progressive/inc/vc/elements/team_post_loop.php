<?php
/**
 * Visual Composer Eelement: Team Post Loop
 * 
 */
add_shortcode('team_post_loop', 'ts_team_post_loop_func');

function ts_team_post_loop_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => 8,
		'width' => 270,
		'height' => 270
					), $atts));

	ob_start();

	$current_animation_delay = $animation_delay;
	?>

	<div class="bottom-padding bottom-padding-min">
	<?php if (!empty($title)) { ?>
		<div class="title-box  <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
			<h2 class="title"><?php echo esc_html($title); ?> </h2>
		</div>
		<div class="clearfix"></div>  
	<?php } ?>
		<div class="row text-center">
			<?php
			query_posts(array('post_type' => 'team', 'posts_per_page' => $limit));
			if (have_posts()) : 
				while (have_posts()) : the_post();
					$thumb = get_xv_thumbnail($width, $height);
					$designation = get_post_meta(get_the_ID(), 'xv_member_designation', TRUE);
					$about = get_post_meta(get_the_ID(), 'xv_member_about', TRUE);
					$email = get_post_meta(get_the_ID(), 'xv_member_email', TRUE);
					$phone = get_post_meta(get_the_ID(), 'xv_member_phone', TRUE);
					$facebook = esc_url(get_post_meta(get_the_ID(), 'xv_member_facebook', TRUE));
					$twitter = esc_url(get_post_meta(get_the_ID(), 'xv_member_twiiter', TRUE));
					$gplus = esc_url(get_post_meta(get_the_ID(), 'xv_member_gplus', TRUE));
					$linkedin = esc_url(get_post_meta(get_the_ID(), 'xv_member_linkedin', TRUE));
					?>
			        <div class="col-sm-3 col-md-3 employee fixed-width rotation <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay += $animation_delay_item, $animation_iteration); ?>>
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
			<div class="clearfix"></div>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
