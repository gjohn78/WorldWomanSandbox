<?php
/**
 * Visual Composer Eelement: Person
 * 
 */
add_shortcode('person', 'ts_person_func');

function ts_person_func($atts) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'id' => '',
					), $atts));

	global $post;

	ob_start();

	$new_post = get_post($id);

	if ($new_post && !is_wp_error($new_post)) {
		setup_postdata($new_post);
		?>
		<div class="bottom-padding">
			<div class="employee employee-single <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<div class="row">
					<div class="images-box col-xs-9 col-sm-6 col-md-4">
						<?php 
						$post_gallery = ts_get_post_opt('post_gallery',$id);
				
						if (is_array($post_gallery) && count($post_gallery) > 0) { ?>
							<div class="carousel-box load" data-carousel-pagination="true" data-carousel-nav="false" data-carousel-one="true">
								<div class="carousel">
									<?php foreach ($post_gallery as $slide) {
										if (!empty($slide['image'])) {
											$image = theme_thumb($slide['image'], 370, 370);
										}
										if (esc_url($image)) { ?>
											<div class="image">
												<img src="<?php echo esc_url($image); ?>" alt="" title="" width="370" height="370">
											</div>
											<?php
										}
									} ?>
								</div>
								<div class="clearfix"></div>
								<div class="pagination switches"></div>
							</div>
						<?php } ?>
					</div>
					<div class="employee-description col-sm-8 col-md-8">
						<h3 class="name"><?php echo get_the_title($id); ?></h3>
						<div class="role"><?php echo xv_get_field('xv_member_designation', $id); ?></div>
						<div>
							<p><?php echo xv_get_field('xv_member_about', $id); ?></p>
							<?php
							$email = xv_get_field('xv_member_email', $id);
							$phone = xv_get_field('xv_member_phone', $id);
							?>
							<div class="contact"><b><?php _e('Email:', 'progressive'); ?> </b><?php echo wp_kses_data($email); ?></div>
							<div class="contact"><b><?php _e('Phone:', 'progressive'); ?> </b><?php echo wp_kses_data($phone); ?></div>
						</div>
						<div class="social">
							<?php
							$facebook = xv_get_field('xv_member_facebook', $id);
							$twitter = xv_get_field('xv_member_twiiter', $id);
							$gplus = xv_get_field('xv_member_gplus', $id);
							$linkedin = xv_get_field('xv_member_linkedin', $id);

							if (!empty($facebook)) { ?>
								<div class="item"><a class="sbtnf sbtnf-rounded color color-hover icon-facebook" href="<?php echo esc_url($facebook); ?>"></a></div>
							<?php }
							if (!empty($twitter)) { ?>
								<div class="item"><a class="sbtnf sbtnf-rounded color color-hover icon-twitter" href="<?php echo esc_url($twitter); ?>"></a></div>
							<?php }
							if (!empty($gplus)) { ?>
								<div class="item"><a class="sbtnf sbtnf-rounded color color-hover icon-gplus" href="<?php echo esc_url($gplus); ?>"></a></div>
							<?php }
							if (!empty($linkedin)) { ?>
								<div class="item"><a class="sbtnf sbtnf-rounded color color-hover icon-linkedin" href="<?php echo esc_url($linkedin); ?>"></a></div>
							<?php } ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div><!-- .employee -->
		</div>
		<?php
		wp_reset_postdata();
	}
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
