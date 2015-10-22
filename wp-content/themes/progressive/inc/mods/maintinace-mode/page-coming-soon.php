
<!doctype html>
<?php $xv_data = ts_get_redux_data(); ?>
<html class="full-height">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> data-spy="scroll" data-target="#sticktop" data-offset="70">
		<div class="page-box">

			<header class="header header-three">
				<div class="header-wrapper">
					<div class="container">
						<div class="row">
							<div class="logo-box col-sm-12 col-md-12">
								<div class="logo">

									<?php if (!empty($xv_data['coming_soon_logo']['thumbnail'])) { ?>
										<img src="<?php echo esc_url($xv_data['coming_soon_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>"/>
									<?php } else {
										?>
										<?php bloginfo('name'); ?>
									<?php } ?>
								</div>
							</div>
						</div><!--.row -->
					</div>
				</div><!-- .header-wrapper -->
			</header><!-- .header -->

			<section id="main">
				<div class="container">
					<div class="row">
						<div class="count-down-box col-sm-12 col-md-8">

							<?php
							$hours = '';
							$mints = '00';
							if (isset($xv_data['hours'])) {
								$hours = $xv_data['hours'];
							}
							if (isset($xv_data['mints'])) {
								$mints = $xv_data['mints'];
							}
							?>

							<div id="timer" data-targetDate="<?php echo date("j F Y", strtotime($xv_data['coming_soon_date'])); ?> <?php echo esc_attr($hours) . ':' . esc_attr($mints) . ':01'; ?>">
								<span class="hours"><?php
									if (isset($xv_data['slider_hours'])) {
										echo esc_html($xv_data['slider_hours']);
									}
									?></span>
								<span class="minutes"><?php
									if (isset($xv_data['slider_mints'])) {
										echo esc_html($xv_data['slider_mints']);
									}
									?></span>
								<span class="seconds"><?php
									if (isset($xv_data['slider_sec'])) {
										echo esc_html($xv_data['slider_sec']);
									}
									?></span>
							</div>

							<div id="count-down"></div>
						</div>

						<div class="coming-text col-sm-12 col-md-4">
							<?php
							if (isset($xv_data['coming_soon_des'])) {
								echo esc_html($xv_data['coming_soon_des']);
							}
							?>
							<hr>
							<div class="sidebar"> 
								<div class="widget newsletter newsletter-style2">  
									<?php
									if (isset($xv_data['coming_soon_form'])) {
										echo do_shortcode(wp_strip_all_tags($xv_data['coming_soon_form']));
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- .container -->
			</section><!-- #main -->
		</div><!-- .page-box -->

		<footer id="footer" class="footer-two">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="social col-sm-12 col-md-12">
							<p><?php _e('Follow us in social media', 'progressive'); ?></p>
							<?php
							if ($xv_data['coming_soon_facebook']) {
								echo '<a class="sbtnf sbtnf-rounded color color-hover icon-facebook" href="' . esc_url($xv_data['coming_soon_facebook']) . '"></a>';
							}

							if ($xv_data['coming_soon_twitter']) {
								echo '<a class="sbtnf sbtnf-rounded color color-hover icon-twitter" href="' . esc_url($xv_data['coming_soon_twitter']) . '"></a>';
							}

							if ($xv_data['coming_soon_gplus']) {
								echo '<a class="sbtnf sbtnf-rounded color color-hover icon-gplus" href="' . esc_url($xv_data['coming_soon_gplus']) . '"></a>';
							}

							if ($xv_data['coming_soon_linkedin']) {
								echo '<a class="sbtnf sbtnf-rounded color color-hover icon-linkedin" href="' . esc_url($xv_data['coming_soon_linkedin']) . '"></a>';
							}
							?>
						</div>
					</div>
				</div>
			</div><!-- .footer-top -->
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>