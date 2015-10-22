<?php
/**
 * Visual Composer Eelement: Woo Products 2
 * 
 */
add_shortcode('woo_products_2', 'woo_products_2_func');

function woo_products_2_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_delay_item' => '',
		'animation_iteration' => '',
		'orderby' => '',
		'limit' => '',
		'show' => '',
		'order' => ''
					), $atts));

	if (!class_exists('woocommerce')) {
		return '';
	}

	ob_start();

	global $post;

	$query_args = array(
		'posts_per_page' => $limit,
		'post_status' => 'publish',
		'post_type' => 'product',
		'no_found_rows' => 1,
		'order' => $order == 'asc' ? 'asc' : 'desc'
	);

	$query_args['meta_query'] = array();

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

	$current_animation_delay = $animation_delay;
	?>
	<div class="bottom-padding">
		<div class="row text-center">

			<?php
			$j = 1;
			$k = 1;
			$loop = new WP_Query($query_args);
			if ($loop->have_posts()) {
				while ($loop->have_posts()) : $loop->the_post();


					$temp = 1;
					$product = new WC_Product(get_the_ID());
					?>
					<div class="col-sm-3 col-md-3 product product-centered <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
						<div class="default">
					<?php if ($product->is_on_sale()) : ?>
						<?php echo apply_filters('woocommerce_sale_flash', '<span class="sale-custome"></span>', $post, $product); ?>
					<?php endif; ?>

							<a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image">
								<img src="<?php echo esc_url(get_xv_thumbnail(270, 270)); ?>" />
							</a>
							<div class="actions not-rotation-actions">
								<?php wc_get_template('/loop/add-to-cart.php'); ?>
								<?php
								if (class_exists('YITH_WCWL')) {
									echo do_shortcode('[yith_wcwl_add_to_wishlist]');
								}
								?>

								<a href="<?php echo esc_url(get_the_permalink()); ?>" class="add-compare">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
										<path fill="#1e1e1e" d="M16,3.063L13,0v2H1C0.447,2,0,2.447,0,3s0.447,1,1,1h12v2L16,3.063z"></path>
										<path fill="#1e1e1e" d="M16,13.063L13,10v2H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h12v2L16,13.063z"></path>
										<path fill="#1e1e1e" d="M15,7H3V5L0,7.938L3,11V9h12c0.553,0,1-0.447,1-1S15.553,7,15,7z"></path>
									</svg>
								</a>
							</div>
							<div class="product-description">
								<div class="vertical">
									<h3 class="product-name">
										<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="price"><?php echo $product->get_price_html(); ?></div>	
								</div>
							</div>
						</div>
					</div><!-- .product -->
			<?php
			$current_animation_delay += $animation_delay_item;
			$k++;
		endwhile;
	} else {
		echo __('No products found', 'progressive');
	}
	wp_reset_postdata();
	?>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
