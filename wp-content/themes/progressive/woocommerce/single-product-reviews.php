<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
global $product;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

if (!comments_open())
	return;
?>
<div id="reviews">
	<div id="comments">
		<h2><?php
			if (get_option('woocommerce_enable_review_rating') === 'yes' && ( $count = $product->get_rating_count() ))
				printf(_n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), $count, get_the_title());
			else
				_e('Reviews', 'woocommerce');
			?></h2>

		<?php if (have_comments()) : ?>

			<ol class="commentlist">
				<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
			</ol>

			<?php
			if (get_comment_pages_count() > 1 && get_option('page_comments')) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type' => 'list',
				)));
				echo '</nav>';
			endif;
			?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e('There are no reviews yet.', 'woocommerce'); ?></p>

		<?php endif; ?>
	</div>

	<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->id)) : ?>

		<div id="review_form_wrapper">
			<div id="review_form" class="comments-form">
				<?php
				$commenter = wp_get_current_commenter();

				$ratings_html = '';
				if (get_option('woocommerce_enable_review_rating') === 'yes') {
					$ratings_html = '<p class="comment-form-rating"><label for="rating">' . __('Your Rating', 'woocommerce') . '</label><select name="rating" id="rating">
							<option value="">' . __('Rate&hellip;', 'woocommerce') . '</option>
							<option value="5">' . __('Perfect', 'woocommerce') . '</option>
							<option value="4">' . __('Good', 'woocommerce') . '</option>
							<option value="3">' . __('Average', 'woocommerce') . '</option>
							<option value="2">' . __('Not that bad', 'woocommerce') . '</option>
							<option value="1">' . __('Very Poor', 'woocommerce') . '</option>
						</select></p>';

					$ratings_html = '
							<div class="evaluation">
								<div class="pull-left">' . __('Your Rating', 'woocommerce') . ' <span class="required">*</span></div>
								<div class="add-rating">
								  <label class="radio"><input type="radio" name="rating" value="1"><span class="number">1</span></label>
								  <label class="radio"><input type="radio" name="rating" value="2"><span class="number">2</span></label>
								  <label class="radio"><input type="radio" name="rating" value="3"><span class="number">3</span></label>
								  <label class="radio"><input type="radio" name="rating" value="4"><span class="number">4</span></label>
								  <label class="radio"><input type="radio" name="rating" value="5"><span class="number">5</span></label>
								</div>
							</div>';
				}

				$comment_form = array(
					'title_reply' => have_comments() ? __('Add a review', 'woocommerce') : __('Be the first to review', 'woocommerce') . ' &ldquo;' . get_the_title() . '&rdquo;',
					'title_reply_to' => __('Leave a Reply to %s', 'woocommerce'),
					'comment_notes_before' => '<div class="evaluation-box">' . $ratings_html . '</div><div class="row">',
					'comment_notes_after' => '</div>',
					'fields' => array(
						'author' => '<div class="col-sm-5 col-md-5"><label for="author">' . __('Name', 'woocommerce') . ' <span class="required">*</span></label> ' .
						'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" />',
						'email' => '<label for="email">' . __('Email', 'woocommerce') . ' <span class="required">*</span></label> ' .
						'<input class="form-control" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true" />
										</div>',
					),
					'label_submit' => __('Submit', 'woocommerce'),
					'logged_in_as' => '',
					'comment_field' => ''
				);

				if (is_user_logged_in()) {
					$comment_form['comment_field'] .= '<div class="evaluation-box">' . $ratings_html . '</div><div class="row"><div class="col-sm-12 col-md-12"><label for="comment">' . __('Your Review', 'woocommerce') . '</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea><i>' . __('Note: HTML is not supported!', 'progressive') . '</i></div></div>';
				} else {
					$comment_form['comment_field'] .= '<div class="col-sm-7 col-md-7"><label for="comment">' . __('Your Review', 'woocommerce') . '</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea><i>' . __('Note: HTML is not supported!', 'progressive') . '</i></div>';
				}



				comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				?>
			</div><!-- #review_form -->
		</div>

	<?php else : ?>
		<p class="woocommerce-verification-required"><?php _e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>

	<?php endif; ?>
	<div class="clear"></div>
</div>