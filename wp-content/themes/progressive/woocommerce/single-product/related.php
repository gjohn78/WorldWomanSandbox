<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;

$posts_per_page = 6;

$related = $product->get_related($posts_per_page);

if (sizeof($related) == 0)
	return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type' => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows' => 1,
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'post__in' => $related,
	'post__not_in' => array($product->id)
		));

$products = new WP_Query($args);

$woocommerce_loop['columns'] = $columns;

if ($products->have_posts()) :
	?>

	<div class="carousel-box bottom-padding bottom-padding-mini load overflow">

		<div class="title-box no-margin">
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
			<h2 class="title"><?php _e('Related Products', 'woocommerce'); ?></h2>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="carousel products">

				<?php while ($products->have_posts()) : $products->the_post(); ?>

					<?php
					$temp = 1;
					$product = new WC_Product(get_the_ID());
					?>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 double-product">
						<div class="product rotation">

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

							<?php
							$text_limit = 300;
							?>
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


						</div>
					</div>
				<?php endwhile; // end of the loop.  ?>
			</div>
		</div>
	</div>

<?php
endif;

wp_reset_postdata();
