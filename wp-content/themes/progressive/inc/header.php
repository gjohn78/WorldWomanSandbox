<?php
/**
 * Header part of the template
 *
 * @package progressive
 */

$xv_data = ts_get_redux_data();
?>

<header class="header header-two">
	<div class="header-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-2 col-lg-3 logo-box">
					<div class="logo">
						<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
							<?php if (!empty($xv_data['logo']['thumbnail'])) { ?>
								<img src="<?php echo esc_url($xv_data['logo']['url']); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>"/>
							<?php } else {
								?>
								<?php bloginfo('name'); ?>
							<?php } ?>
						</a>
					</div>
				</div><!-- .logo-box -->
				<div class="col-xs-6 col-md-10 col-lg-9 right-box">
					<div class="right-box-wrapper">
						<div class="header-icons">
							<div class="search-header hidden-600">
								<a href="#">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
									<path d="M12.001,10l-0.5,0.5l-0.79-0.79c0.806-1.021,1.29-2.308,1.29-3.71c0-3.313-2.687-6-6-6C2.687,0,0,2.687,0,6
										  s2.687,6,6,6c1.402,0,2.688-0.484,3.71-1.29l0.79,0.79l-0.5,0.5l4,4l2-2L12.001,10z M6,10c-2.206,0-4-1.794-4-4s1.794-4,4-4
										  s4,1.794,4,4S8.206,10,6,10z"></path>
									</svg>
								</a>
							</div><!-- .search-header -->

							<div class="phone-header hidden-600">

								<a>
									<?php if (!empty($xv_data['topbar-phone'])) { ?>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
										<path d="M11.001,0H5C3.896,0,3,0.896,3,2c0,0.273,0,11.727,0,12c0,1.104,0.896,2,2,2h6c1.104,0,2-0.896,2-2
											  c0-0.273,0-11.727,0-12C13.001,0.896,12.105,0,11.001,0z M8,15c-0.552,0-1-0.447-1-1s0.448-1,1-1s1,0.447,1,1S8.553,15,8,15z
											  M11.001,12H5V2h6V12z"></path>
										</svg>
									<?php } ?>
								</a>
							</div><!-- .phone-header -->

							<?php if ($xv_data['cart_in_header'] == 1) { ?>
								<div class="cart-inner"></div><!-- .cart-inner -->
							<?php } ?>

						</div><!-- .header-icons -->

						<div class="primary">
							<div class="navbar navbar-default" role="navigation">
								<button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target=".primary .navbar-collapse">
									<span class="text"><?php _e('Menu', 'progressive'); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>            
								<nav class="collapse collapsing navbar-collapse">
									<?php
									$primary_menu = 'main';
									$menu = '';
									if (is_page()) {
										$menu_slug = xv_get_field('primary_menu');
										
										if (!empty($menu_slug) && $menu_slug != 'default') {
											$menu = $menu_slug;
										}
									}
									
									if (has_nav_menu('main') || !empty($menu)):
										$args = array(
											'theme_location' => $primary_menu,
											'menu' => $menu,
											'container' => false,
											'menu_class' => 'nav navbar-nav navbar-center',
											'fallback_cb' => '',
											'menu_id' => 'home-menu',
											'depth' => 4,
											'walker' => new ts_walker_nav_menu
										);
										wp_nav_menu($args);
									endif;

									?>
								</nav>             
							</div>
						</div><!-- .primary -->
					</div>
				</div>
				<?php if (!empty($xv_data['topbar-phone'])) { ?>
					<div class="phone-active col-sm-9 col-md-9">
						<a href="#" class="close"><span><?php _e('close', 'progressive'); ?></span>&times;</a>
						<span class="title"><?php _e('Call Us:', "progressive"); ?></span> <strong><?php echo esc_html($xv_data['topbar-phone']); ?></strong>
					</div>
				<?php } ?>
				<div class="search-active col-sm-9 col-md-9">
					<a href="#" class="close"><span><?php _e('close', 'progressive'); ?></span>&times;</a>
					<form role="search"  name="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input class="search-string form-control" type="search" placeholder="Search here" name="s">
						<button class="search-submit">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
							<path fill="#231F20" d="M12.001,10l-0.5,0.5l-0.79-0.79c0.806-1.021,1.29-2.308,1.29-3.71c0-3.313-2.687-6-6-6C2.687,0,0,2.687,0,6
								  s2.687,6,6,6c1.402,0,2.688-0.484,3.71-1.29l0.79,0.79l-0.5,0.5l4,4l2-2L12.001,10z M6,10c-2.206,0-4-1.794-4-4s1.794-4,4-4
								  s4,1.794,4,4S8.206,10,6,10z"></path>
							</svg>
						</button>
					</form>
				</div>
			</div><!--.row -->
		</div>
	</div><!-- .header-wrapper -->
</header><!-- .header -->

