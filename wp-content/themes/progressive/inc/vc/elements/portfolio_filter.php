<?php
/**
 * Visual Composer Eelement: Portfolio Filter
 * 
 */
add_shortcode('portfolio_filter', 'xv_portfolio_filter_func');

function xv_portfolio_filter_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'limit' => '',
		'limit2' => '300',
		'style' => '',
		'filter_style' => '',
		'filter' => 'enabled',
		'year_filter' => 'enabled'
					), $atts));
	ob_start();

	if ($style == '4col') {
		$width = 270;
		$height = 197;
		$col = 'col-sm-4 col-md-3';
		$wrapper_class = 'portfolio';
	} elseif ($style == '3col') {
		$width = 370;
		$height = 270;
		$col = 'col-sm-4 col-md-4';
		$wrapper_class = 'portfolio';
	} elseif ($style == '2col') {
		$width = 570;
		$height = 416;
		$col = 'col-sm-4 col-md-6';
		$wrapper_class = 'portfolio';
	} else {
		$width = 770;
		$height = 270;
		$col = 'col-sm-4 col-md-12';
		$wrapper_class = 'portfolio';
	}
	$current_animation_delay = $animation_delay;
	if (!empty($thumb_height)) {
		$height = $thumb_height;
	}

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $limit,
	);

	$terms = get_terms("portfolio_category");

	$years = array();
	if ($year_filter == 'enabled') {
		foreach ($terms as $term) {
			$args['portfolio_category'] = $term->slug;
			query_posts($args);

			if (have_posts()) {
				while (have_posts()) {
					the_post();
					$data = get_post_meta(get_the_ID(), 'data', TRUE);
					if ($data) {
						$dataobj = DateTime::createFromFormat('Y, m, d', $data);
						$year = $dataobj->format('Y');
						$years[$year] = $year;
					}
				}
			}
		}
		sort($years);
	}
	$year_filter_exists = false;
	?>
	<div class="content <?php echo esc_attr($wrapper_class); ?>">
		<div class="row">
			<div class="col-sm-12 col-md-8 btn-group <?php echo esc_attr($filter_style); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<?php if ($filter == 'enabled') { ?>
					<div class="filter-buttons filter-list">
						<button type="button" class="dropdown-toggle" data-toggle="dropdown">
							<?php _e('All Works', 'progressive'); ?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" data-filter="*" class="active"><?php _e('All Works', 'progressive'); ?></a></li>
							<?php foreach ($terms as $term) { ?>
								<li><a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
							<?php } ?>
						</ul>
						<div class="clearfix"></div>
					</div>
				<?php
				} else if ($year_filter == 'enabled' && count($years) > 0) {
					$year_filter_exists = true;
					?>
					<div class="year-regulator year-regulator-wrapper">
						<div class="label"><?php _e('Year:', 'progressive'); ?></div>
						<div class="layout-slider">
							<input class="year-filter-slider" type="slider" name="year" value="<?php echo esc_attr($years[0]); ?>;<?php echo esc_attr(end($years)); ?>" class="form-control">
						</div>
						<div class="clearfix"></div>
					</div>
				<?php } ?>
			</div><!-- .filter-buttons -->

			<div class="col-sm-6 col-md-4">
				<?php if ($year_filter_exists === false && $year_filter == 'enabled' && count($years) > 0) { ?>
					<div class="year-regulator">
						<div class="label"><?php _e('Year:', 'progressive'); ?></div>
						<div class="layout-slider">
							<input class="year-filter-slider" type="slider" name="year" value="<?php echo esc_attr($years[0]); ?>;<?php echo esc_attr(end($years)); ?>" class="form-control">
						</div>
						<div class="clearfix"></div>
					</div>
				<?php } ?>
			</div><!-- .price-regulator -->
		</div>
		<div class="row filter-elements">
			<?php
			$current_animation_delay += $animation_delay_item;
			?>
			<?php
			global $post;
			if ($style == '1col') {
				foreach ($terms as $term) {
					$args['portfolio_category'] = $term->slug;
					if ($year_filter == 'enabled' && count($years) > 0) {
						$args['meta_query'] = array(
							array(
								'key' => 'data',
								'value' => array(''),
								'compare' => 'NOT IN'
							)
						);
					}
					query_posts($args);
					if (have_posts()) : while (have_posts()) : the_post();
							$thumb = get_xv_thumbnail($width, $height);
							$excerpt = get_xv_excerpt($limit2);

							$data = get_post_meta(get_the_ID(), 'data', TRUE);
							$year = '';
							if ($data) {
								$dataobj = DateTime::createFromFormat('Y, m, d', $data);
								$year = $dataobj->format('Y');
							}
							?>

							<div class="work-one <?php echo esc_attr($term->slug); ?> <?php echo esc_attr($year); ?> <?php echo ts_get_animation_class($animation); ?>">
								<div class="work-title col-sm-4 col-md-4">
									<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="description"><?php echo esc_html($term->name); ?></div>
									<p><?php echo wp_kses_post($excerpt); ?></p>
								</div>
								<div class="col-sm-8 col-md-8">
									<a href="<?php echo esc_url(get_the_permalink()); ?>" class="work-image">
										<img src="<?php echo esc_url($thumb); ?>"  alt="" />
									</a>
								</div>
							</div>

							<?php
							$current_animation_delay += $animation_delay_item;
						endwhile;
					endif;
				} wp_reset_query();
			} else {

				$terms = get_terms("portfolio_category");
				$count = count($terms);
				foreach ($terms as $term) {
					$args['portfolio_category'] = $term->slug;
					if ($year_filter == 'enabled' && count($years) > 0) {
						$args['meta_query'] = array(
							array(
								'key' => 'data',
								'value' => array(''),
								'compare' => 'NOT IN'
							)
						);
					}
					query_posts($args);
					if (have_posts()) : while (have_posts()) : the_post();
							$thumb = get_xv_thumbnail($width, $height);

							$data = get_post_meta(get_the_ID(), 'data', TRUE);
							$year = '';
							if ($data) {
								$dataobj = DateTime::createFromFormat('Y, m, d', $data);
								$year = $dataobj->format('Y');
							}
							?>

							<div class="work-element <?php echo esc_attr($term->slug); ?> <?php echo esc_attr($year); ?> <?php echo esc_attr($col); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
								<a href="<?php the_permalink(); ?>" class="work">
									<img src="<?php echo esc_url($thumb); ?>"  alt="" />
									<span class="shadow"></span>
									<div class="bg-hover"></div>
									<div class="work-title">
										<h3 class="title"><?php the_title(); ?></h3>
										<div class="description"><?php echo esc_html($term->name); ?></div>
									</div>
								</a>
							</div><!-- .work-element -->

							<?php
							$current_animation_delay += $animation_delay_item;
						endwhile;
					endif;
				} wp_reset_query();
				?>
		        <div class="clearfix"></div>
			</div>
		</div> 

	<?php } ?>


	<?php
	wp_enqueue_script('isotope');
	
	
	wp_enqueue_script('jshashtable');
	wp_enqueue_script('jquery.numberformatter');
	wp_enqueue_script('price-regulator');
	wp_enqueue_script('jquery.dependClass');
	wp_enqueue_script('draggable');
	wp_enqueue_script('jquery.slider');
	
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
