<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $xv_data; //fetch options stored in $xv_data

if (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9left') {

	echo '</div>';
	echo '<div class="col-lg-3 col-md-3 col-sm-12">';
	get_sidebar('shop');
	echo '</div>';
} elseif (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9right') {
	echo '</div>';
} else {
	echo '</div>';
}

if (isset($_GET['layout']) && $_GET['layout'] == 'list' && is_shop()) {

	echo '</div><div class="content col-sm-12 col-md-3" id="catalog">';

	get_sidebar('shop');
	echo '</div>';
}
?>



</div>
</div> <!--container-->