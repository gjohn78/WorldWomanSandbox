<?php
/**
 * progressive functions and definitions
 *
 * @package progressive
 */

define('REDUX_OPT_NAME','xv_data');

/**
 * Framework functions
 */
include_once ('framework/framework.php');

/**
 * Redux Options Framework
 *
 */
require_once ('admin/admin-init.php');

/**
 * TGM Plugin Installer
 *
 */
require_once ('framework/plugins-activation.php');

/**
 * Image resizer
 *
 */
require_once ('inc/mr-image-resize.php');

/**
 * Maintinace Mode
 *
 */
require_once ('inc/mods/maintinace-mode/maintinace-mode.php');


/**
 * Widgets initalization
 */
include_once ('inc/widgets.php');

/**
 * xvelopers Core Functions
 *
 */
require_once ('inc/xv-core.php');

/**
 * Framework menus
 */
include_once ('inc/custom-menus.php');
/**
 * Widgets
 *
 */
require_once ('inc/vc/vc-config.php');
/**
 * Enabe Woocommerce Supprt for theme
 */
require get_template_directory() . '/inc/woo-config.php';

/**
 * Theme arguments class
 */
require get_template_directory() . '/framework/class/ThemeArguments.class.php';

/**
 * Theme arguments class
 */
require get_template_directory() . '/framework/importer/importer.php';

/**
 * Auto import a XML file
 */
// require_once ('inc/wordpress-importer/wordpress-importer.php'); 

/**
 * Exerpt length
 * Usage ts_the_excerpt_theme('short');
 */
define('TINY_EXCERPT', 12);
define('SHORT_EXCERPT', 22);
define('REGULAR_EXCERPT', 40);
define('LONG_EXCERPT', 55);

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
	$content_width = 640; /* pixels */

if (!function_exists('progressive_setup')) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function progressive_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on progressive, use a find and replace
		 * to change 'progressive' to the name of your theme in all the template files
		 */
		load_theme_textdomain('progressive', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');
		
		//add title-tag support (for WP >= 4.1)
		add_theme_support( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support('post-thumbnails');

		function theme_thumb($url, $width, $height = 0, $align = '') {
			return mr_image_resize($url, $width, $height, true, $align, false);
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'top' => __('Top Menu', 'progressive'),
			'main' => __('Main Menu', 'progressive'),
			'blog' => __('Blog Menu', 'progressive'),
			'footer' => __('Footer Menu', 'progressive'),
		));

		// Enable support for Post Formats.
		add_theme_support('post-formats', array(
			'aside',
			'gallery',
			'image',
			'audio',
			'video',
			'quote',
			'status'
		));

		// Setup the WordPress core custom background feature.
		add_theme_support('custom-header');
	}

endif; // progressive_setup
add_action('after_setup_theme', 'progressive_setup');

/**
 * Register theme widgets
 *
 * @since progressive 1.0
 */
function ts_theme_widgets_init() {
	
	register_sidebar(array(
		'name' => __('Main Sidebar', 'progressive'),
		'id' => 'main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Twitter Sidebar', 'progressive'),
		'id' => 'twitter',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Facebook Sidebar', 'progressive'),
		'id' => 'facebook',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Under Constraction Widgets', 'progressive'),
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	for ($i = 1; $i <= 4; $i ++) {
		register_sidebar(array(
			'name' => __('Footer Area', 'progressive') . ' ' . $i,
			'id' => 'footer-area-' . $i,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title-block">',
			'after_title' => '</h3>'
		));
	}

	for ($i = 1; $i <= 3; $i ++) {
		register_sidebar(array(
			'name' => __('Footer 2 Area', 'progressive') . ' ' . $i,
			'id' => 'footer-2-area-' . $i,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title-block">',
			'after_title' => '</h3>'
		));
	}

	$xv_data = ts_get_redux_data();

	if (isset($xv_data) && isset($xv_data['custom-sidebars']) && is_array($xv_data['custom-sidebars'])) {
		foreach ($xv_data['custom-sidebars'] as $sidebar) {
			register_sidebar(array(
				'name' => $sidebar,
				'id' => sanitize_title($sidebar),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));
		}
	}
}

add_action('widgets_init', 'ts_theme_widgets_init');

function ts_theme_scripts() {

	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('google-fonts', $protocol.'://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic', array(), null, 'all');
	// Plagins CSS
	wp_register_style('buttons-style', get_template_directory_uri() . '/css/buttons/buttons.css', array(), null, 'all');
	wp_register_style('social-icons', get_template_directory_uri() . '/css/buttons/social-icons.css', array(), null, 'all');
	wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null, 'all');
	wp_register_style('twitter-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null, 'all');
	wp_register_style('jslider', get_template_directory_uri() . '/css/jslider.css', array(), null, 'all');
	wp_register_style('settings', get_template_directory_uri() . '/css/settings.css', array(), null, 'all');
	wp_register_style('fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), null, 'all');
	wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), null, 'all');
	wp_register_style('video-js', get_template_directory_uri() . '/css/video-js.min.css', array(), null, 'all');
	wp_register_style('morris', get_template_directory_uri() . '/css/morris.css', array(), null, 'all');

	wp_register_style('ladda', get_template_directory_uri() . '/css/ladda.min.css', array(), null, 'all');
	wp_register_style('datepicker', get_template_directory_uri() . '/css/datepicker.css', array(), null, 'all');

	//Custom CSS
	wp_register_style('pages', get_template_directory_uri() . '/css/customizer/pages.css', array(), null, 'all');
	wp_register_style('home-pages-customizer', get_template_directory_uri() . '/css/customizer/home-pages-customizer.css', array(), null, 'all');
	//IE Styles
	wp_register_style('ie', get_template_directory_uri() . '/css/ie/ie.css', array(), null, 'all');

	wp_register_style('fontello', get_template_directory_uri() . '/css/fontello.css', array(), null, 'all');
	wp_enqueue_style('fontello');
	wp_enqueue_style('buttons-style');
	wp_enqueue_style('twitter-bootstrap');
	wp_enqueue_style('jslider');
	wp_enqueue_style('settings');
	wp_enqueue_style('fancybox');
	wp_enqueue_style('animate');
	// wp_enqueue_style ( 'video-js' );
	wp_enqueue_style('morris');
	//wp_enqueue_style ( 'royalslider' );
	//wp_enqueue_style ( 'rs-minimal-white' );
	// wp_enqueue_style ( 'layerslider' );
	//wp_enqueue_style('ladda');
	wp_enqueue_style('datepicker');

	wp_enqueue_style('progressive-style', get_stylesheet_uri());
	wp_enqueue_style('pages');
	wp_enqueue_style('home-pages-customizer');
	wp_enqueue_style('ie');

	wp_enqueue_style('options', get_template_directory_uri() . '/admin/assets/css/options.css', 'style');

	//register scripts
	wp_register_script('jshashtable', get_template_directory_uri() . '/js/price-regulator/jshashtable-2.1_src.js', array('jquery'), null, true);
	wp_register_script('jquery.numberformatter', get_template_directory_uri() . '/js/price-regulator/jquery.numberformatter-1.2.3.js', array('jquery'), null, true);
	wp_register_script('price-regulator', get_template_directory_uri() . '/js/price-regulator/tmpl.js', array('jquery'), null, true);
	wp_register_script('jquery.dependClass', get_template_directory_uri() . '/js/price-regulator/jquery.dependClass-0.1.js', array('jquery'), null, true);
	wp_register_script('draggable', get_template_directory_uri() . '/js/price-regulator/draggable-0.1.js', array('jquery'), null, true);
	wp_register_script('jquery.slider', get_template_directory_uri() . '/js/price-regulator/jquery.slider.js', array('jquery'), null, true);
	wp_register_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), null, true);
	wp_register_script('google-map-api', 'https://maps.googleapis.com/maps/api/js', array(), null, true);
	wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), null, true);
	wp_register_script('knob', get_template_directory_uri() . '/js/jquery.knob.js', array('jquery'), null, true);
	wp_register_script('raphael', get_template_directory_uri() . '/js/raphael.min.js', array('jquery'), null, true);
	wp_register_script('main', get_template_directory_uri() . '/js/main.js', array(), '1.1', true);
	
	wp_enqueue_script('raphael');
	
	//enqueue scripts
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0', true);
	wp_enqueue_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), null, true);
	wp_enqueue_script('touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), null, true);
	wp_enqueue_script('elevateZoom', get_template_directory_uri() . '/js/jquery.elevateZoom-3.0.8.min.js', array('jquery'), null, true);
	wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), null, true);
	wp_enqueue_script('SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array('jquery'), null, true);	
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), null, true);	
	wp_enqueue_script('stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), null, true);
	wp_enqueue_script('selectBox', get_template_directory_uri() . '/js/jquery.selectBox.min.js', array('jquery'), null, true);
	wp_enqueue_script('SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array('jquery'), null, true);
	wp_enqueue_script('spin', get_template_directory_uri() . '/js/spin.min.js', array('jquery'), null, true);
	wp_enqueue_script('ani', get_template_directory_uri() . '/js/css3-animate-it.js', array(), '1.0', true);
	wp_enqueue_script('pixastic.custom', get_template_directory_uri() . '/js/pixastic.custom.js', array('jquery'), null, true);
	wp_enqueue_script('livicons', get_template_directory_uri() . '/js/livicons-1.3.min.js', array('jquery'), null, true);
	wp_enqueue_script('wow', get_template_directory_uri() . '/js/dist/wow.min.js', array(), null, true);
	
	wp_localize_script( 'main', 'plocal', array(
		'valid_information' => __('Please Provide Valid Information', 'progressive'),
		'message_sent' => __('Your message has been sent,<BR> We will contact you back with in next 24 hours.', 'progressive'),
	) );
	
	wp_enqueue_script('main');

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'ts_theme_scripts');


$html5shim = create_function('', 'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5shiv.js"></script><![endif]-->\';');
add_action('wp_head', $html5shim);

$html5shim = create_function('', 'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/respond.min.js"></script><![endif]-->\';');
add_action('wp_head', $html5shim);


$ie_style = create_function('', 'echo \'<!--[if lt IE 9]><link href="\'.get_template_directory_uri().\'/css/ie/ie8.css" rel="stylesheet"><![endif]-->\';');
add_action('wp_head', $ie_style);

$dynamic_style = create_function('', 'echo \'<style id="dynamic-styles" type="text/css"></style>\';');
add_action('wp_head', $dynamic_style);

/**
 * Get redux options data array
 * @global array $xv_data
 * @return boolean
 */
function ts_get_redux_data() {
	global $xv_data_theme;
	
	if (!isset($xv_data_theme)) {
		$xv_data_theme = get_option('xv_data');
	}
	
	if (isset($xv_data_theme)) {
		return $xv_data_theme;
	}
	return false;
}

function ts_custom_css_code() {

	$xv_data = ts_get_redux_data();

	if (isset($xv_data['css-code'])) {
		echo '<style type="text/css">';
		echo wp_strip_all_tags($xv_data['css-code']);
		echo '</style>';
	}
}

add_action('wp_head', 'ts_custom_css_code');

function ts_custom_js_code() {

	$xv_data = ts_get_redux_data();

	if (isset($xv_data['js-code'])) {
		echo '<script type="text/javascript">';
		echo htmlspecialchars_decode(wp_kses_data($xv_data['js-code']));
		echo '</script>';
	}
}

add_action('wp_head', 'ts_custom_js_code');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';


add_filter('add_to_cart_fragments', 'progressive_add_to_cart_dropdown');

function progressive_add_to_cart_dropdown($fragments) {
	global $woocommerce;
	ob_start();
	?>
	<div class="btn-group cart-header">
	    <div class="cart-inner">

			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<div class="icon">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
						<g>
							<path d="M15.001,4h-0.57l-3.707-3.707c-0.391-0.391-1.023-0.391-1.414,0c-0.391,0.391-0.391,1.023,0,1.414L11.603,4
								  H4.43l2.293-2.293c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L1.602,4H1C0.448,4,0,4.448,0,5s0.448,1,1,1
								  c0,2.69,0,7.23,0,8c0,1.104,0.896,2,2,2h10c1.104,0,2-0.896,2-2c0-0.77,0-5.31,0-8c0.553,0,1-0.448,1-1S15.554,4,15.001,4z
								  M13.001,14H3V6h10V14z"></path>
							<path d="M11.001,13c0.553,0,1-0.447,1-1V8c0-0.553-0.447-1-1-1s-1,0.447-1,1v4C10.001,12.553,10.448,13,11.001,13z"></path>
							<path d="M8,13c0.553,0,1-0.447,1-1V8c0-0.553-0.448-1-1-1S7,7.447,7,8v4C7,12.553,7.448,13,8,13z"></path>
							<path d="M5,13c0.553,0,1-0.447,1-1V8c0-0.553-0.447-1-1-1S4,7.447,4,8v4C4,12.553,4.448,13,5,13z"></path>
						</g>
					</svg>
				</div>
				<?php _e('Cart', 'woocommerce'); ?>
				<span class="count">/ <?php echo $woocommerce->cart->get_cart_total(); ?></span> 
			</a>
			<div class="dropdown-menu">
				<strong><?php _e('Recently added item(s)', 'progressive') ?></strong>
				<ul class="list-unstyled">
					<?php
					if (sizeof($woocommerce->cart->cart_contents) > 0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
							$_product = $cart_item['data'];
							if ($_product->exists() && $cart_item['quantity'] > 0) :
								?>  
								<li>
									<?php echo '<a class="product-image" href="' . esc_url(get_permalink($cart_item['product_id'])) . '">' . str_replace(array('http:', 'https:'), '', $_product->get_image()) . '</a>'; ?>

									<?php
									$remove_url = " <a href='%s' class='product-remove remove' title='%s'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='16px' height='16px' viewBox='0 0 16 16' enable-background='new 0 0 16 16' xml:space='preserve'>
                                                          <g>
                                                          <path d='M6,13c0.553,0,1-0.447,1-1V7c0-0.553-0.447-1-1-1S5,6.447,5,7v5C5,12.553,5.447,13,6,13z'></path>
                                                          <path d='M10,13c0.553,0,1-0.447,1-1V7c0-0.553-0.447-1-1-1S9,6.447,9,7v5C9,12.553,9.447,13,10,13z'></path>
                                                          <path d='M14,3h-1V1c0-0.552-0.447-1-1-1H4C3.448,0,3,0.448,3,1v2H2C1.447,3,1,3.447,1,4s0.447,1,1,1
                                                          c0,0.273,0,8.727,0,9c0,1.104,0.896,2,2,2h8c1.104,0,2-0.896,2-2c0-0.273,0-8.727,0-9c0.553,0,1-0.447,1-1S14.553,3,14,3z M5,2h6v1
                                                          H5V2z M12,14H4V5h8V14z'></path>
                                                          </g>
                                                        </svg>
                                                        </a>";
									?>                     
									<?php echo apply_filters('woocommerce_cart_item_remove_link', sprintf($remove_url, esc_url($woocommerce->cart->get_remove_url($cart_item_key)), __('Remove this item', 'woocommerce')), $cart_item_key); ?>
									<?php
									$product_title = $_product->get_title();
									echo ' <h4 class="product-name"><a class="cart_list_product_title" href="' . esc_url(get_permalink($cart_item['product_id'])) . '">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a></h4>';
									echo '<div class="product-price">' . $cart_item['quantity'] . ' x <span class="price">' . woocommerce_price($_product->get_price()) . '</span></div>';
									?>
									<div class="clearfix"></div>
								</li>



								<?php
							endif;
						endforeach;
						?>

					</ul><!-- Cart list -->

					<div class="cart-button">
						<?php
						global $woocommerce;
						$checkout_url = $woocommerce->cart->get_checkout_url();
						$cart_url = $woocommerce->cart->get_cart_url();
						?>
						<a href="<?php echo esc_url($cart_url); ?>" class="btn btn-default"><?php _e('View Cart', 'woocommerce'); ?></a>    
						<a href="<?php echo esc_url($checkout_url); ?>" class="btn checkout btn-default"><?php _e('Proceed to Checkout', 'woocommerce'); ?></a>
					</div>
					<?php
				else: echo '<p class="empty">' . __('No products in the cart.', 'woocommerce') . '</p>';
				endif;
				?>                                                                        

			</div><!-- .nav-dropdown -->
	    </div><!-- .cart-inner -->
	</div>
	<?php
	$fragments['.cart-inner'] = ob_get_clean();
	return $fragments;
}

function ts_get_animation_class($animation, $add_class_attr = false) {
	if (!empty($animation)) {
		$class = ' wow animated ' . $animation;

		if ($add_class_attr === true) {
			return 'class="' . sanitize_html_classes($class) . '"';
		}
		return sanitize_html_classes($class);
	}
	return '';
}

/**
 * Get animation class for animated shortcodes
 * @param type $animation
 * @return string
 */
function ts_get_animation_data_class($animation_delay, $animation_iteration) {

	$data = '';
	if (!empty($animation_delay) && intval($animation_delay) > 0) {
		$data .= ' data-wow-delay="' . esc_attr(intval($animation_delay)) . 'ms"';
	} else {
		$data .= ' data-wow-delay="0ms"';
	}

	if (!empty($animation_iteration)) {
		$data .= ' data-wow-iteration="' . esc_attr($animation_iteration) . '" ';
	}
	return $data;
}

function ts_get_livicon_list($flip = false) {

	$livicons = array(
		'rocket',
		'sun',
		'settings',
		'cloud-rain',
		'hand-up',
		'sitemap',
		'arrow-left',
		'facebook-alt',
		'info',
		'star-half',
		'info',
		'ghost',
		'help',
		'pacman',
		'hammer',
		'bug',
		'cloud-sun',
		'refresh',
		'cloud-snow',
		'tag',
		'angle-double-up',
		'twitter',
		'facebook-alt',
		'chrome',
		'ie',
		'quote-right',
		'share',
		'warning-alt',
		'signal',
		'comments',
		'download',
		'spinner-one',
		'spinner-two',
		'morph-o-s',
		'morph-s-c',
		'caret-right',
		'caret-right',
		'caret-right',
		'caret-right',
		'caret-right',
		'caret-right',
		'eye-open',
		'download',
		'align-left',
		'align-center',
		'align-right',
		'align-justify',
		'refresh',
		'shopping-cart',
		'trash',
		'gear',
		'info',
		'search',
		'user',
		'chevron-down',
		'edit',
		'trash',
		'ban',
		'home',
		'edit',
		'gears',
		'mail',
		'sign-in',
		'key',
		'leaf',
		'piggybank',
		'upload',
		'clock',
		'truck',
		'wrench',
		'tablet',
		'html5',
		'responsive',
		'comments',
		'shopping-cart',
		'tag',
		'settings',
		'calendar',
		'wrench',
		'rocket',
		'info',
		'laptop',
		'phone',
		'responsive',
		'signal',
		'star-empty',
		'gift',
		'credit-card',
		'alarm',
		'apple-logo',
		'bing',
		'bitbucket',
		'blogger',
		'concrete5',
		'deviantart',
		'dribbble',
		'github',
		'github-alt',
		'instagram',
		'opera',
		'reddit',
		'soundcloud',
		'tumblr',
		'vimeo',
		'vk',
		'xing',
		'yahoo',
		'connect',
		'disconnect',
		'collapse-down',
		'collapse-up',
		'expand-left',
		'expand-right',
		'battery',
		'medal',
		'servers',
		'address-book',
		'albums',
		'anchor',
		'archive-add',
		'archive-extract',
		'asterisk',
		'bluetooth',
		'brightness-down',
		'brightness-up',
		'crop',
		'eyedropper',
		'file-export',
		'file-import',
		'folder-add',
		'folder-flag',
		'folder-lock',
		'folder-new',
		'folder-open',
		'folder-remove',
		'inbox-empty',
		'inbox-in',
		'inbox-out',
		'indent-left',
		'indent-right',
		'message-add',
		'message-flag',
		'message-in',
		'message-lock',
		'message-new',
		'message-out',
		'message-remove',
		'microphone',
		'moon',
		'new-window',
		'pin-off',
		'pin-on',
		'playlist',
		'save',
		'shopping-cart-in',
		'shopping-cart-out',
		'striked',
		'text-decrease',
		'text-height',
		'text-increase',
		'text-size',
		'text-width',
		'thumbnails-big',
		'thumbnails-small',
		'timer',
		'unlink',
		'user-add',
		'user-ban',
		'user-flag',
		'user-remove',
		'users-add',
		'users-ban',
		'users-remove',
		'vector-circle',
		'vector-curve',
		'vector-line',
		'vector-polygon',
		'vector-square',
		'webcam',
		'wifi',
		'wifi-alt',
		'adjust',
		'alarm',
		'apple',
		'balance',
		'ban',
		'barchart',
		'barcode',
		'beer',
		'bell',
		'biohazard',
		'bolt',
		'bookmark',
		'briefcase',
		'brush',
		'bug',
		'calendar',
		'camcoder',
		'camera',
		'camera-alt',
		'car',
		'cellphone',
		'certificate',
		'check',
		'check-circle',
		'check-circle-alt',
		'checked-off',
		'checked-on',
		'circle',
		'circle-alt',
		'clapboard',
		'clip',
		'clock',
		'cloud',
		'cloud-bolts',
		'cloud-rain',
		'cloud-snow',
		'cloud-sun',
		'cloud-down',
		'cloud-up',
		'code',
		'comment',
		'comments',
		'compass',
		'credit-card',
		'css3',
		'dashboard',
		'desktop',
		'doc-landscape',
		'doc-portrait',
		'download',
		'download-alt',
		'drop',
		'edit',
		'eye-close',
		'eye-open',
		'film',
		'filter',
		'fire',
		'flag',
		'gear',
		'gears',
		'ghost',
		'gift',
		'glass',
		'globe',
		'hammer',
		'heart',
		'heart-alt',
		'help',
		'home',
		'html5',
		'image',
		'inbox',
		'info',
		'key',
		'lab',
		'laptop',
		'leaf',
		'legal',
		'linechart',
		'link',
		'location',
		'lock',
		'magic',
		'magic-alt',
		'magnet',
		'mail',
		'mail-alt',
		'map',
		'minus',
		'minus-alt',
		'money',
		'more',
		'move',
		'music',
		'notebook',
		'pacman',
		'pen',
		'pencil',
		'phone',
		'piechart',
		'piggybank',
		'plane-down',
		'plane-up',
		'plus',
		'plus-alt',
		'presentation',
		'printer',
		'qrcode',
		'question',
		'quote-left',
		'quote-right',
		'remove',
		'remove-alt',
		'remove-circle',
		'responsive',
		'responsive-menu',
		'retweet',
		'rocket',
		'sandglass',
		'scissors',
		'screenshot',
		'search',
		'settings',
		'share',
		'shield',
		'shopping-cart',
		'shuffle',
		'sign-in',
		'sign-out',
		'signal',
		'sitemap',
		'sky-dish',
		'sort',
		'sort-down',
		'sort-up',
		'star-empty',
		'star-full',
		'star-half',
		'stopwatch',
		'sun',
		'tablet',
		'tag',
		'tags',
		'tasks',
		'thermo-down',
		'thermo-up',
		'thumbs-down',
		'thumbs-up',
		'trash',
		'tree',
		'trophy',
		'truck',
		'umbrella',
		'unlock',
		'upload',
		'upload-alt',
		'user',
		'users',
		'warning',
		'warning-alt',
		'wrench',
		'zoom-in',
		'zoom-out',
		'angle-down',
		'angle-left',
		'angle-right',
		'angle-up',
		'angle-double-down',
		'angle-double-left',
		'angle-double-right',
		'angle-double-up',
		'angle-wide-down',
		'angle-wide-left',
		'angle-wide-right',
		'angle-wide-up',
		'arrow-down',
		'arrow-left',
		'arrow-right',
		'arrow-up',
		'arrow-circle-down',
		'arrow-circle-left',
		'arrow-circle-right',
		'arrow-circle-up',
		'caret-down',
		'caret-left',
		'caret-right',
		'caret-up',
		'chevron-down',
		'chevron-left',
		'chevron-right',
		'chevron-up',
		'exchange',
		'external-link',
		'hand-down',
		'hand-left',
		'hand-right',
		'hand-up',
		'recycled',
		'redo',
		'refresh',
		'resize-big',
		'resize-big-alt',
		'resize-horizontal',
		'resize-horizontal-alt',
		'resize-small',
		'resize-small-alt',
		'resize-vertical',
		'resize-vertical-alt',
		'rotate-left',
		'rotate-right',
		'undo',
		'align-center',
		'align-justify',
		'align-left',
		'align-right',
		'bold',
		'columns',
		'font',
		'italic',
		'list',
		'list-ol',
		'list-ul',
		'table',
		'underline',
		'video-play',
		'video-play-alt',
		'video-stop',
		'video-pause',
		'video-eject',
		'video-backward',
		'video-step-backward',
		'video-fast-backward',
		'video-forward',
		'video-step-forward',
		'video-fast-forward',
		'screen-full',
		'screen-full-alt',
		'screen-small',
		'screen-small-alt',
		'speaker',
		'dropbox',
		'facebook',
		'facebook-alt',
		'flickr',
		'flickr-alt',
		'google-plus',
		'google-plus-alt',
		'linkedin',
		'linkedin-alt',
		'myspace',
		'pinterest',
		'pinterest-alt',
		'rss',
		'skype',
		'stumbleupon',
		'stumbleupon-alt',
		'twitter',
		'twitter-alt',
		'wordpress',
		'wordpress-alt',
		'youtube',
		'android',
		'ios',
		'windows',
		'windows8',
		'chrome',
		'firefox',
		'ie',
		'safari',
		'bootstrap',
		'jquery',
		'raphael',
		'paypal',
		'livicon',
		'spinner-one',
		'spinner-two',
		'spinner-three',
		'spinner-four',
		'spinner-five',
		'spinner-six',
		'spinner-seven',
		'morph-c-s',
		'morph-c-o',
		'morph-s-c',
		'morph-s-o',
		'morph-o-c',
		'morph-o-s',
		'morph-c-t-up',
		'morph-s-t-up',
		'morph-o-t-up',
		'morph-t-up-c',
		'morph-t-up-s',
		'morph-t-up-o',
		'morph-c-t-right',
		'morph-s-t-right',
		'morph-o-t-right',
		'morph-t-right-c',
		'morph-t-right-s',
		'morph-t-right-o',
		'morph-c-t-down',
		'morph-s-t-down',
		'morph-o-t-down',
		'morph-t-down-c',
		'morph-t-down-s',
		'morph-t-down-o',
		'morph-c-t-left',
		'morph-s-t-left',
		'morph-o-t-left',
		'morph-t-left-c',
		'morph-t-left-s',
		'morph-t-left-o',
	);
	$livicon_effects = array();

	if ($flip == true) {
		$livicon_effects[__('None', 'framework')] = '';
	} else {
		$livicon_effects[''] = __('None', 'framework');
	}


	foreach ($livicons as $livicon) {
		$livicon_effects[$livicon] = $livicon;
	}

	return $livicon_effects;
}

function ts_get_post_type_categories($post_type = '') {
	if (!empty($post_type)) {

		$terms = get_terms($post_type);
	} else {

		$args = array(
			'orderby' => 'name',
			'parent' => 0
		);
		$terms = get_categories($args);
	}


	$categories = array();
	$categories[__('All', 'framework')] = '';
	foreach ($terms as $term) {
		$categories[] = $term->slug;
	}




	return $categories;
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
function ts_get_font_choices($return_strict = false) {
	$aFonts = array(
		array(
			'value' => 'default',
			'label' => __('Default', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'Verdana',
			'label' => 'Verdana',
			'src' => ''
		),
		array(
			'value' => 'Geneva',
			'label' => 'Geneva',
			'src' => ''
		),
		array(
			'value' => 'Arial',
			'label' => 'Arial',
			'src' => ''
		),
		array(
			'value' => 'Arial Black',
			'label' => 'Arial Black',
			'src' => ''
		),
		array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
			'src' => ''
		),
		array(
			'value' => 'Helvetica',
			'label' => 'Helvetica',
			'src' => ''
		),
		array(
			'value' => 'sans-serif',
			'label' => 'sans-serif',
			'src' => ''
		),
		array(
			'value' => 'Georgia',
			'label' => 'Georgia',
			'src' => ''
		),
		array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
			'src' => ''
		),
		array(
			'value' => 'Times',
			'label' => 'Times',
			'src' => ''
		),
		array(
			'value' => 'serif',
			'label' => 'serif',
			'src' => ''
		),
		array(
			'value' => 'Nella Sue',
			'label' => 'Nella Sue',
			'src' => ''
		)
	);

	if (file_exists(get_template_directory() . '/framework/fonts/google-fonts.json.php')) {
		
		require_once get_template_directory() . '/framework/fonts/google-fonts.json.php';
		
		$aGoogleFonts = array();
		if (!empty($google_fonts)) {
			$aGoogleFonts = json_decode($google_fonts, true);
		}
		
		if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
			//nothing to do
		} else {

			$aFonts[] = array(
				'value' => 'google_web_fonts',
				'label' => '---Google Web Fonts---',
				'src' => ''
			);
			
			foreach ($aGoogleFonts['items'] as $aGoogleFont) {
				$aFonts[] = array(
					'value' => 'google_web_font_' . $aGoogleFont['family'],
					'label' => $aGoogleFont['family'],
					'src' => ''
				);
			}
		}
	}

	if ($return_strict) {
		$aFonts2 = array();
		foreach ($aFonts as $font) {
			$aFonts2[$font['value']] = $font['label'];
		}
		return $aFonts2;
	}
	return $aFonts;
}

function ts_get_sidebars_array() {
	
	$xv_data = get_option('xv_data');

	$sidebars = array();
	$sidebars['default'] = __('Default', 'framework');
	if (isset($xv_data) && isset($xv_data['custom-sidebars']) && is_array($xv_data['custom-sidebars'])) {
		foreach ($xv_data['custom-sidebars'] as $sidebar) {
			$sidebars[sanitize_title($sidebar)] = $sidebar;
		}
	}
	return $sidebars;
}

/**
 * Check if display element, firstchecking for post and then for theme options
 * @return boolean
 */
function ts_check_if_display($field) {

	$xv_data = ts_get_redux_data();

	$value = 'default';
	if (is_page()) {

		$value = xv_get_field($field);	
		if ($value == 'yes') {
			return true;
		} else if ($value == 'no') {
			return false;
		}
	}
	
	if (isset($xv_data[$field]) && $xv_data[$field] == 1) {
		return true;
	}
	return false;
}

/**
 * Get timeline fadein value
 * @return string
 */
function ts_get_timeline_fadein() {
	
	$oArgs = ThemeArguments::getInstance('templates/template-blog-timeline');
	if ($oArgs -> get('ts_loop_it') % 2 == 0) {
		return 'fadeInLeft';
	} else {
		return 'fadeInRight';
	}
}

/**
 * Changing the number of posts per page
 */
function textdomain_set_post_per_page($query) {

	//Display 20 posts for a custom post type called 'movie'




	$query->set('posts_per_page', $_GET['posts_per_page']);
	$query->set('post_parent', 0);
	return $query;
}

if (isset($_GET['posts_per_page'])) {
	add_action('pre_get_posts', 'textdomain_set_post_per_page', 1);
}

function ts_get_menus_list() {
	$menus = get_terms('nav_menu', array('hide_empty' => false));
	$menus_array = array();
	$menus_array['default'] = __('Default', 'progressive');
	if ($menus && !is_wp_error($menus)) {
		foreach ($menus as $menu) {
			$menus_array[$menu->slug] = $menu->name;
		}
	}
	return $menus_array;
}

// Filter to replace default css class names for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'ts_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function ts_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {

	if (strstr($class_string, 'remove-all-vc-classes')) {

		$pattern = '/(vc_|wpb_)\S+(\s|$)/';
		$new_class_string = $class_string;
		while (preg_match($pattern, $class_string)) {
			$class_string = preg_replace($pattern, '', $class_string);
			$class_string = trim($class_string);
		}
		$class_string = str_replace('remove-all-vc-classes', '', $class_string);
	}
	return $class_string; // Important: you should always return modified or original $class_string
}

/**
 * Get body id attribute
 * @return string
 */
function ts_get_body_id_attr() {

	$xv_data = ts_get_redux_data();

	$body_id = '';
	$boxed_page = false;
	if (is_page()) {
		$value = xv_get_field('layout');
		if ($value == 'boxed') {
			$body_id = 'boxed-bg';
		}
	}
	if ($boxed_page === false) {
		if (isset($xv_data['layout']) && $xv_data['layout'] == 'boxed') {
			$body_id = 'boxed-bg';
		}
	}

	if (!empty($body_id)) {
		return 'id="' . $body_id . '"';
	}
	return '';
}

/**
 * Get single post option value
 * @param unknown $option
 * @param string $id
 * @return NULL|mixed
 */
function ts_get_post_opt( $option, $id = '' ) {

	if (!empty($id)) {
		$local_id = $id;
	} else {
		$id = get_the_ID();
		
		if(empty($id)) {
			return null;
		}
		$local_id = $id;
	}
	
	if(function_exists('redux_post_meta')) {
		$options = redux_post_meta(REDUX_OPT_NAME, (int)$local_id);
	} else {
		$options = get_post_meta( $local_id, REDUX_OPT_NAME, true );
	}

	if( isset( $options[$option] ) ) {
		return $options[$option];
	} else {
		return null;
	}
}


/**
 * xv_get_field - 
 */

function xv_get_field($key, $id = false, $default = '') {
	
	$value = ts_get_post_opt( $key, $id);
	if ($value == '') {
		return $default;
	}
	return $value;
}