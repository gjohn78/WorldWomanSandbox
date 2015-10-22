<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product; 
$xv_data = ts_get_redux_data();
?>
	<?php 
 		$col = '';
            if(isset($xv_data['shop-layout']) &&  $xv_data['shop-layout']  == 'shop9left'){

 				echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
 		
 		    }elseif(isset($xv_data['shop-layout']) &&  $xv_data['shop-layout']  == 'shop9right'){		        
				echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
 	      	
 	      	}else{
 	      		echo '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">';
 	      	} 
 	?>

	<?php
		$gallery = '';
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			
			if(class_exists( 'YITH_WCMG' ) ) {    
				$image = get_the_post_thumbnail( $post->ID, apply_filters( ), array('title' => $image_title) );
				}else{
					$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('title' => $image_title) );
				}
			
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . esc_attr($gallery) . '">%s</a>', esc_url($image_link), esc_attr($image_title), $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
		$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
