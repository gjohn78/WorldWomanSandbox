
<?php global $product, $woocommerce_loop; 
?>
<div class="default">
	<?php
	/**
	 * woocommerce_before_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action('woocommerce_before_shop_loop_item_title');
	?>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image">
		<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
	</a>
	<div class="product-description">
		<div class="vertical">
			<h3 class="product-name">
				<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xv_product_title"><?php the_title(); ?></a>
			</h3>
			<div class="price"><?php echo $product->get_price_html(); ?></div>	
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

	<?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
	<div class="actions">

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
	</div><!-- .actions -->
</div><!-- .product-hover -->