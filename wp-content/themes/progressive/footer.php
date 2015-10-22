
<?php
/**
 * The Footer for our theme.
 *
 * @package progressive
 * @since progressive 1.0
 */
?>
</div>
</div>

<?php
$top_bar_bg = get_post_meta(get_the_ID(), 'top_bar_bg', TRUE);
$footer_color = get_post_meta(get_the_ID(), 'footer_color', TRUE);
$footer_text_color = get_post_meta(get_the_ID(), 'footer_text_color', TRUE);
$footer_bottom_color = get_post_meta(get_the_ID(), 'footer_bottom_color', TRUE);
$footer_bottom_text_color = get_post_meta(get_the_ID(), 'footer_bottom_text_color', TRUE);
$bottom_footer_border_color = get_post_meta(get_the_ID(), 'bottom_footer_border_color', TRUE);

$footer1_style = 'background-color:' . $footer_color . ';';
$footer1_style .= 'color:' . $footer_text_color . ';';
$footer2_style = 'background-color:' . $footer_bottom_color . ';';
$footer2_style .= 'border-top-color:' . $bottom_footer_border_color . ';';
$footer2_style .= 'color:' . $footer_bottom_text_color . ';';
?>
<style>
	#top-box {
		background: <?php echo esc_attr($top_bar_bg); ?>;
	}

	#footer .sidebar .widget h3, #footer .sidebar .widget .title-block .title,.sidebar .menu li a, .sidebar li a{
		color: <?php echo esc_attr($footer_text_color) . ' !important'; ?>;
	}
</style>
<footer id="footer">
	<div class="footer-top" style="<?php echo esc_attr($footer1_style); ?>">
		<div class="container">
			<div class="row sidebar">
				<aside class="col-xs-12 col-sm-6 col-md-3 widget social">
					<?php dynamic_sidebar('footer-area-1'); ?>       
				</aside>

				<aside class="col-xs-12 col-sm-6 col-md-3 widget newsletter">
					<?php dynamic_sidebar('footer-area-2'); ?>
				</aside><!-- .newsletter -->

				<aside class="col-xs-12 col-sm-6 col-md-3 widget links">
					<?php dynamic_sidebar('footer-area-3'); ?>
				</aside>

				<aside class="col-xs-12 col-sm-6 col-md-3 widget links">
					<?php dynamic_sidebar('footer-area-4'); ?>
				</aside>
			</div>
		</div>
	</div><!-- .footer-top -->
	<div class="footer-bottom" style="<?php echo esc_attr($footer2_style); ?>">
		<div class="container">
			<div class="row sidebar">
				<div class="copyright col-xs-12 col-sm-3 col-md-3">
					<?php dynamic_sidebar('footer-2-area-1'); ?>
				</div>

				<div class="phone-cont col-xs-6 col-sm-3 col-md-3">
					<?php _e('Call Us:', 'progressive'); ?>  <br /> <?php dynamic_sidebar('footer-2-area-2'); ?>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-3 adress-block">
					<?php dynamic_sidebar('footer-2-area-3'); ?>
				</div>

				<div class="col-xs-12 col-sm-3 col-md-3">
					<a href="#" class="up">
						<span class="icon-up"></span>
					</a>
				</div>
			</div>
		</div>
	</div><!-- .footer-bottom -->
</footer>
<div class="clearfix"></div>
<?php wp_footer(); ?>
</body>
</html>