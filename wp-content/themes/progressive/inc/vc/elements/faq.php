<?php
/**
 * Visual Composer Eelement: Faq
 * 
 */
add_shortcode('faq', 'ts_faq_func');

function ts_faq_func($atts, $content = null) {
	global $post;

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'limit' => 8,
		'width' => 270,
		'height' => 270,
					), $atts));

	ob_start();
	?>
	<?php
	$terms = get_terms("faq_category");
	$count = count($terms);
	?>  

	<div class="filter-box accordions-filter <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
	<?php if ($count != 0) { ?>
			<div class="btn-group filter-buttons filter-list">
				<button type="button" class="dropdown-toggle" data-toggle="dropdown">
			<?php _e('All', 'progressive'); ?> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#" data-filter="*" class="active"><?php _e('All', 'progressive'); ?></a></li>
					<?php foreach ($terms as $term) { ?>
						<li><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
					<?php } ?>
				</ul>
				<div class="clearfix"></div>
			</div><!-- .filter-buttons -->
	<?php } ?>
		<div class="panel-group filter-elements" id="accordion">
		<?php
		$terms = get_terms("faq_category");
		$count = count($terms);
		$post_per_page = -1;
		foreach ($terms as $term) {
			$adcount = 1;

			query_posts(array('post_type' => 'faq', 'faq_category' => $term->name));
			if (have_posts()) : while (have_posts()) : the_post();
					?>  
						<div class="panel panel-default panel-bg <?php echo esc_attr($term->slug); ?>">
							<div class="panel-heading">
								<div class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
							</div>
							<div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
			<?php endwhile;
		endif;
	} 
	wp_reset_query(); ?> 

		</div>
	</div>
	<!--FAQ end-->

	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
