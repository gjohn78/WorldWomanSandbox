<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

global $woocommerce;
?>

<div class="m-t-b clearfix">
	<aside class="col-xs-12 col-sm-4 col-md-3 sidebar">
		<?php dynamic_sidebar('shop-checkout'); ?>
	</aside>
	<section class="col-xs-12 col-sm-8 col-md-9">
		<?php
		wc_print_notices();

		do_action('woocommerce_before_checkout_form', $checkout);

		// If checkout registration is disabled and not logged in, the user cannot checkout
		if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
			echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
			return;
		}

		// filter hook for include new pages inside the payment method
		$get_checkout_url = apply_filters('woocommerce_get_checkout_url', WC()->cart->get_checkout_url());
		?>
		<form name="checkout" method="post" class="checkout" action="<?php echo esc_url($get_checkout_url); ?>">
			<?php if (sizeof($checkout->checkout_fields) > 0) : ?>
				<?php do_action('woocommerce_checkout_before_customer_details'); ?>


				<ul class="clearfix panel-group" id="checkoutsteps">
					<li class="panel active">
						<a data-toggle="collapse" data-parent="#checkoutsteps" class="step-title" href="#step-1">
							<div class="number">1</div>
							<h6><?php _e(' Checkout Infomation', 'progressive'); ?></h6>
						</a>

						<div class="collapse in" id="step-1" style="">
							<div class="step-content">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<?php do_action('woocommerce_checkout_billing'); ?>
									</div>
								</div>
							</div>
						</div>
					</li>

					<li class="panel">
						<a data-toggle="collapse" data-parent="#checkoutsteps" class="collapsed step-title" href="#step-2">
							<div class="number">2</div>
							<h6><?php _e('Shipping Information', 'progressive'); ?></h6>
						</a>

						<div class="collapse" id="step-2">
							<div class="step-content">
								<?php do_action('woocommerce_checkout_shipping'); ?>
							</div>
						</div>
					</li>

					<li class="panel">
						<a data-toggle="collapse" data-parent="#checkoutsteps" class="step-title collapsed" href="#step-3">
							<div class="number">3</div>
							<h6><?php _e('Order Infomation', 'progressive'); ?></h6>
						</a>

						<div class="collapse" id="step-3" style="height: 0px;">
							<div class="step-content">
								<?php do_action('woocommerce_checkout_order_review'); ?>

							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>
		</form>
		<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
	</section>
</div>