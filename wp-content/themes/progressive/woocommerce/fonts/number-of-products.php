<?php
/**
 * Number of products on shop page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( is_single() || ! have_posts() ) return;
$num_prod = ( isset( $_GET['posts_per_page'] ) ) ? $_GET['posts_per_page'] :1;

$num_prod_x1 = 1;
//$num_prod_x2 = $num_prod_x1 * 2;

$link = ( get_option( 'permalink_structure' ) == "" ) ? get_post_type_archive_link('product') : get_permalink( wc_get_page_id( 'shop' ) );

if( ! empty( $_GET ) ) {
    foreach( $_GET as $key => $value ){
        $link = add_query_arg( $key, $value, $link );
    }
}

?>
<?php 
$posts_per_page ='';
	if(isset( $_GET['posts_per_page'])){
		$posts_per_page = $_GET['posts_per_page'];		
	}
?>

<div class="product-per-page">
    <div class="styled-dd">
        <select id="number-of-products">
            <?php for($i=1; $i<=3; $i++) {?>
                  <option <?php if($i==$posts_per_page) echo'selected="selected"'; ?> value="<?php echo add_query_arg( 'posts_per_page',$num_prod_x1, $link );?>">
                      <?php echo $num_prod_x1++; ?> 
                  </option>
            <?php  } ?>
            <option value="<?php echo add_query_arg( 'posts_per_page',-1, $link );?>">
                All 
            </option>
        </select>
    </div>
</div>