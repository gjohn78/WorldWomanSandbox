<?php

add_theme_support( 'woocommerce' );

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );  
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)

    //Disable the default stylesheet for woocommerce
    

    add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    function wp_enqueue_woocommerce_style(){
        
        wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woo.css' );
        
        if ( class_exists( 'woocommerce' ) ) {
            
             wp_enqueue_style( 'woocommerce' );
        
        }
    }
     add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );


  

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price',20);


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function xv_woo_shop_widgets_init() {


    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'progressive' ),
        'id'            => 'shop',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Checkout Sidebar', 'progressive' ),
        'id'            => 'shop-checkout',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );


            
}
add_action( 'widgets_init', 'xv_woo_shop_widgets_init' );

/**
 * Registering custom params
 * @global object $wp
 */
function ts_register_params() { 
	global $wp; 
	$wp->add_query_var('posts_per_page');
}
add_action('init','ts_register_params');

/**
 * Custom products per page, getting value from QUERY_STRING
 * @return int
 */
function ts_woo_custom_products_per_page() {
    
	if (get_query_var( 'posts_per_page' )) {
		return get_query_var( 'posts_per_page' );
	}
	
	return get_option('posts_per_page');
}
add_filter('loop_shop_per_page',  'ts_woo_custom_products_per_page');

/**
 * Define image sizes
 */
function ts_woocommerce_image_dimensions() {
	global $pagenow;
 
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
 
  	$catalog = array(
		'width' 	=> '358',	// px
		'height'	=> '358',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '700',	// px
		'height'	=> '700',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
 
add_action( 'after_switch_theme', 'ts_woocommerce_image_dimensions', 1 );


}

function ts_woocommerce_dequeue_stylesandscripts() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'select2');
        wp_deregister_script('select2');

    } 
} 

add_action( 'wp_enqueue_scripts', 'ts_woocommerce_dequeue_stylesandscripts', 100 );

/**
 * Without flashing WooCommerce is showing 404 page on some end pints like checkout page after submitting an order
 */
function ts_flush_rules(){
	
	flush_rewrite_rules(false);
}
add_action('init','ts_flush_rules');