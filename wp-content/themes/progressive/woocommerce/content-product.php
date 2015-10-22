<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

global $product, $woocommerce_loop, $xv_data;
;
$attachment_ids = $product->get_gallery_attachment_ids();
// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if (empty($woocommerce_loop['columns']))
	$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);

// Ensure visibility
if (!$product || !$product->is_visible())
	return;

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array();
if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
	$classes[] = 'first';
if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
	$classes[] = 'last';
?>

<?php if (isset($_GET['layout']) && $_GET['layout'] == 'list') { ?>

	<div <?php post_class($classes); ?>>	
		<?php do_action('woocommerce_before_shop_loop_item'); ?>

		<div class="col-sm-4 col-md-4">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" class="product-image">
				<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
			</a>
		</div>
		<div class="col-sm-8 col-md-8">
			<h3 class="product-name">
				<a href="<?php echo esc_url(get_the_permalink()); ?>" class="xv_product_title"><?php the_title(); ?></a>
			</h3>
			<div class="reviews-box">
				<div class="rating-box">
					<?php wc_get_template('/loop/rating.php'); ?>

				</div>
				<span><?php comments_number('0 reviews', '1 review', '% reviews'); ?></span>
				<span class="separator">|</span>
				<a class="add-review" href="<?php echo esc_url(get_the_permalink()); ?>/#tab-reviews">Add your review</a>
			</div>
			<div class="excerpt">
				<?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
			</div>
			<div class="price-box">
				<span class="price"><?php echo $product->get_price_html(); ?></span>
			</div>	
			<div class="actions list-shop">

				<?php wc_get_template('/loop/add-to-cart.php'); ?>
				<a class="add-compare" href="<?php echo esc_url(get_the_permalink()); ?>">
					<svg xml:space="preserve" enable-background="new 0 0 16 16" viewBox="0 0 16 16" height="16px" width="16px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<path d="M16,3.063L13,0v2H1C0.447,2,0,2.447,0,3s0.447,1,1,1h12v2L16,3.063z" fill="#1e1e1e"/>
						<path d="M16,13.063L13,10v2H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h12v2L16,13.063z" fill="#1e1e1e"/>
						<path d="M15,7H3V5L0,7.938L3,11V9h12c0.553,0,1-0.447,1-1S15.553,7,15,7z" fill="#1e1e1e"/>
					</svg>
				</a>
				<?php if (class_exists('YITH_WCWL')) echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>

			</div><!-- .actions -->
		</div>
		<?php //echo $product->get_categories( ', ');  ?>

		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action('woocommerce_after_shop_loop_item_title');
		?>


		<?php do_action('woocommerce_after_shop_loop_item'); ?>

	</div>





<?php }else { ?>

	<?php
	$col = '';
	if (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9left') {

		$col = "col-lg-4 col-md-4 col-sm-4 col-xs-12 rotation";
	} elseif (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9right') {

		$col = "col-lg-4 col-md-4 col-sm-4 col-xs-12 rotation";
	} else {

		$col = "col-lg-3 col-md-3 col-sm-4 col-xs-12 rotation";
	}
	?>
	<?php $classes[] = $col; ?>
	<div <?php post_class($classes); ?>>	
	<?php do_action('woocommerce_before_shop_loop_item'); ?>

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
			<a href="<?php the_permalink(); ?>" class="product-image">
			<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
			</a>
			<div class="product-description">
				<div class="vertical">
					<h3 class="product-name">
						<a href="<?php the_permalink(); ?>" class="xv_product_title"><?php the_title(); ?></a>
					</h3>
					<div class="price"><?php echo $product->get_price_html(); ?></div>	
				</div>
			</div>
		</div>

		<div class="product-hover">
			<h3 class="product-name">
				<a href="<?php the_permalink(); ?>" class="xv_product_title"><?php the_title(); ?></a>
			</h3>
			<div class="price"><?php echo $product->get_price_html(); ?></div>
			<a href="<?php the_permalink(); ?>" class="product-image">
	<?php echo get_the_post_thumbnail($post->ID, 'shop_catalog') ?>
			</a>

			<div class="short-description">
				<?php echo nl2br(trim(ts_get_shortened_string_by_letters(strip_tags($post->post_excerpt), 230))); ?>
			</div>

			<div class="actions">

	<?php wc_get_template('/loop/add-to-cart.php'); ?>


				<?php
				if (class_exists('YITH_WCWL')) {
					echo do_shortcode('[yith_wcwl_add_to_wishlist]');
				}
				?>


				<a href="<?php the_permalink(); ?>" class="add-compare">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
						<path fill="#1e1e1e" d="M16,3.063L13,0v2H1C0.447,2,0,2.447,0,3s0.447,1,1,1h12v2L16,3.063z"></path>
						<path fill="#1e1e1e" d="M16,13.063L13,10v2H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h12v2L16,13.063z"></path>
						<path fill="#1e1e1e" d="M15,7H3V5L0,7.938L3,11V9h12c0.553,0,1-0.447,1-1S15.553,7,15,7z"></path>
					</svg>
				</a>
			</div><!-- .actions -->
		</div><!-- .product-hover -->


	<?php //echo $product->get_categories( ', ');  ?>

		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action('woocommerce_after_shop_loop_item_title');
		?>


		<?php do_action('woocommerce_after_shop_loop_item'); ?>

	</div>

	<?php
	$_GET['layout'] = 'grid';
}
?>


