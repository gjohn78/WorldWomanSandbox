<?php
/**
 * Visual Composer Eelement: Clients Posts
 * 
 */
add_shortcode('client_posts', 'ts_client_posts_func');

function ts_client_posts_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => '',
		'width' => 170,
		'height' => 103,
		'category' => '',
					), $atts));

	ob_start();
	?>


	<?php if (!empty($title)) { ?>
		<div class="title-box <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		    <h2 class="title"><?php echo esc_html($title); ?></h2>
		</div>
	<?php } ?>    


	<div class="row bottom-padding <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
	<?php
	query_posts(array('post_type' => 'clients', 'clients_category' => $category, 'posts_per_page' => $limit));
	if (have_posts()) : while (have_posts()) : the_post();

			$thumb = get_xv_thumbnail($width, $height);
			?>
			    <div class="col-xs-6 col-sm-3 col-md-2 text-center">
					<a title="<?php the_title(); ?>" data-placement="top" data-toggle="tooltip" class="client" href="#" data-original-title="Yelp">
						<img src="<?php echo esc_url($thumb); ?>" class="img-rounded" alt="">
					</a>
			    </div>

		<?php
		endwhile;
	else:

	endif;
	wp_reset_query();
	?>

	</div>

	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
