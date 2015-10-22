<?php
/**
 * Visual Composer Eelement: Woo Products Widget
 * 
 */
add_shortcode('woo_products_widget', 'woo_products_widget_func');

function woo_products_widget_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'orderby' => '',
		'limit' => '',
		'show' => '',
		'order' => '',
		'style' => '',
		'url' => '',
		'anchor_text' => '',
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
	?>

	<div class="sidebar woo_products_widget <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
		<aside class="widget specials">

			<?php if (!empty($title)) { ?>
		        <header class="title-block">
					<h3 class="title"><?php echo esc_html($title); ?></h3>
		        </header>
			<?php } ?>
			<ul>
				<?php
				$loop = new WP_Query($query_args);
				if ($loop->have_posts()) {
					while ($loop->have_posts()) : $loop->the_post();
						$product = new WC_Product(get_the_ID());
						?>
						<li class="clearfix">
							<a class="product-image" href="<?php the_permalink(); ?>">
								<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
							</a>
							<a href="<?php echo esc_url(get_the_permalink()); ?>"><span class="product-title"><?php the_title(); ?></span></a>
							<div class="price-box">              
								<?php echo $product->get_price_html(); ?>
								<div class="clearfix"></div>
							</div>
						</li>
						<?php
					endwhile;
				} else {
					echo __('No products found', 'progressive');
				}
				wp_reset_postdata();
				?>
			</ul>
			<?php if (!empty($url)) { ?>
			<a class="more" href="<?php echo esc_url($url) ?>"><?php echo (!empty($anchor_text) ? $anchor_text : __('Learn More', 'progressive') ) ?><span class="icon icon-angle-right">&nbsp;</span></a>
			<?php } ?>
	    </aside>
	</div>

	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
		