<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

global $product, $post;

$parent_product_post = $post;

do_action('woocommerce_before_add_to_cart_form');
?>

<form class="cart" method="post" enctype='multipart/form-data'>


	<div class="product-options-table">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th><?php _e('Product Name', 'progressive'); ?></th>
					<th class="price"><?php _e('Price', 'progressive'); ?></th>
					<th class="qty"><?php _e('Qty', 'progressive'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($grouped_products as $product_id) :
					$product = get_product($product_id);
					$post = $product->post;
					setup_postdata($post);
					?>
					<tr>
						<td>
							<label for="product-<?php echo esc_attr($product_id); ?>">
							<?php echo $product->is_visible() ? '<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>' : get_the_title(); ?></td>
						</label>
						<td class="price">
							<?php
							echo $product->get_price_html();

							if (( $availability = $product->get_availability() ) && $availability['availability'])
								echo apply_filters('woocommerce_stock_html', '<p class="stock ' . esc_attr($availability['class']) . '">' . esc_html($availability['availability']) . '</p>', $availability['availability']);
							?>
						</td>
						<td class="qty">
							<?php if ($product->is_sold_individually() || !$product->is_purchasable()) : ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>
							<?php else : ?>
								<?php
								$quantites_required = true;
								woocommerce_quantity_input(array('input_name' => 'quantity[' . $product_id . ']', 'input_value' => '0'));
								?>
							<?php endif; ?>
						</td>
					</tr><?php
				endforeach;

				// Reset to parent grouped product
				$post = $parent_product_post;
				$product = get_product($parent_product_post->ID);
				setup_postdata($parent_product_post);
				?>
			</tbody>
		</table>
	</div><!-- .product-options-table -->

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->id); ?>" />

	<?php if ($quantites_required) : ?>

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

<?php endif; ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>