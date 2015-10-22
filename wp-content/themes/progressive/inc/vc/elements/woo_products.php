<?php
/**
 * Visual Composer Eelement: Woo Products
 * 
 */
add_shortcode('woo_products', 'woo_products_func');

function woo_products_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'title' => '',
		'orderby' => '',
		'limit' => '4',
		'show' => '',
		'order' => '',
		'style' => '',
		'length' => '',
	), $atts));

	if (!class_exists('woocommerce')) {
		return '';
	}
	$current_animation_delay = $animation_delay;
	ob_start();
	?>
	<?php if (!empty($title)) { ?>
		<div class="title-box <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
			<h2 class="title"><?php echo esc_html($title); ?></h2>
		</div>
		<?php
		$current_animation_delay += $animation_delay_item;
	}
	
	global $post;

	$query_args = array(
		'posts_per_page' => $limit,
		'post_status' => 'publish',
		'post_type' => 'product',
		'no_found_rows' => 1,
		'order' => $order == 'asc' ? 'asc' : 'desc'
	);

	$query_args['meta_query'] = array();

	if (empty($instance['show_hidden'])) {
		$query_args['meta_query'][] = WC()->query->visibility_meta_query();
		$query_args['post_parent'] = 0;
	}

	if (!empty($instance['hide_free'])) {
		$query_args['meta_query'][] = array(
			'key' => '_price',
			'value' => 0,
			'compare' => '>',
			'type' => 'DECIMAL',
		);
	}

	$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	$query_args['meta_query'] = array_filter($query_args['meta_query']);

	switch ($show) {
		case 'featured' :
			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
			break;
		case 'onsale' :
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$query_args['post__in'] = $product_ids_on_sale;
			break;
	}

	switch ($orderby) {
		case 'price' :
			$query_args['meta_key'] = '_price';
			$query_args['orderby'] = 'meta_value_num';
			break;
		case 'rand' :
			$query_args['orderby'] = 'rand';
			break;
		case 'sales' :
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby'] = 'meta_value_num';
			break;
		default :
			$query_args['orderby'] = 'date';
	}

	$loop = new WP_Query($query_args);
	?>

	<?php if ($style == 'style3' || $style == 'style4') { ?>
		<div class="row text-center">
	<?php } ?>    
	<?php
	if ($loop->have_posts()) {
		while ($loop->have_posts()) : $loop->the_post();
			$product = new WC_Product(get_the_ID());

			if ($style == 'style3' || $style == 'style4') {

				if ($style == 'style3') {
					$columns = 'col-lg-2 col-md-2 col-sm-2 col-xs-12';
				} else {
					$columns = 'col-sm-4 col-md-4 col-sm-4 col-xs-12';
				}
				?>
					<div class="product product-centered product-mini <?php echo esc_attr($columns); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<div class="default">
							<a class="product-image" href="<?php echo esc_url(get_the_permalink()); ?>">
								<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
							</a>
							<div class="product-description">
				                <div class="vertical">
									<h3 class="product-name">
										<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
									</h3>

									<div class="price">
										<?php
										echo $product->get_price_html();
										?>
									</div>   
				                </div>
							</div>
						</div>
					</div>

				<?php
				$current_animation_delay += $animation_delay_item;
			} elseif ($style == 'style1' || $style == 'style2') {

						$col = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';
						$text_limit = 220;
						if ($style == 'style1') {
							$text_limit = 300;
							$col = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
						}
						?>
					<div class="<?php echo esc_attr($col); ?> rotation product <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<div class="default">
							<?php if ($product->is_on_sale()) : ?>
								<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . __('Sale!', 'woocommerce') . '</span>', $post, $product); ?>
							<?php endif; ?>
				            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image">
								<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
				            </a>
				            <div class="product-description">
								<div class="vertical">
									<h3 class="product-name">
										<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xv_product_title"><?php the_title(); ?></a>
									</h3>
									<div class="price">
										<?php
										echo $product->get_price_html();
										?>
									</div>  
								</div>
				            </div>
						</div>
				        <div class="product-hover">
							<h3 class="product-name">
								<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xv_product_title"><?php the_title(); ?></a>
							</h3>
							<div class="price"><?php echo $product->get_price_html(); ?></div>
							<a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image">
								<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
							</a>
							<div class="short-description">
								<?php echo nl2br(trim(ts_get_shortened_string_by_letters(strip_tags($post->post_excerpt), $text_limit))); ?>
							</div>
							<div class="actions">
								<?php wc_get_template('/loop/add-to-cart.php'); ?>
								<?php
								if (class_exists('YITH_WCWL')) {
									echo do_shortcode('[yith_wcwl_add_to_wishlist]');
								} ?>
								<a href="<?php echo esc_url(get_the_permalink()); ?>" class="add-compare">
				                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
				                    <path fill="#1e1e1e" d="M16,3.063L13,0v2H1C0.447,2,0,2.447,0,3s0.447,1,1,1h12v2L16,3.063z"></path>
				                    <path fill="#1e1e1e" d="M16,13.063L13,10v2H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h12v2L16,13.063z"></path>
				                    <path fill="#1e1e1e" d="M15,7H3V5L0,7.938L3,11V9h12c0.553,0,1-0.447,1-1S15.553,7,15,7z"></path>
				                    </svg>
								</a>
							</div><!-- .actions -->
						</div><!-- .product-hover -->
					</div>
				<?php
				$current_animation_delay += $animation_delay_item;
			}
		endwhile;
	} else {
		echo __('No products found', 'progressive');
	}
	wp_reset_postdata();
	
	if ($style == 'style3' || $style == 'style4') { ?>
		</div>
	<?php } 
	
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}