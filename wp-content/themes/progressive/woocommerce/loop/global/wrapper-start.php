<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly
?>
<?php $xv_data = ts_get_redux_data(); ?>


<div class="breadcrumb-box">
	<div class="container">
<?php woocommerce_breadcrumb(); ?>
	</div>
</div>
<?php//if ( is_shop() || is_product() ) { ?>

<div class="banner-set banner-set-mini banner-set-no-pagination load">
	<div class="container">
		<div class="banners">
			<?php
			$width = 127;
			$height = 79;
			query_posts(array('post_type' => 'product'));
			if (have_posts()) : while (have_posts()) : the_post();

					$thumb = get_xv_thumbnail($width, $height);
					?>
					<a href="<?php the_permalink(); ?>" class="banner">
						<img src="<?php echo esc_url($thumb); ?>" alt="">
						<h2 class="title"><?php the_title(); ?></h2>
					</a>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>


		</div><!-- .banners -->
		<div class="clearfix"></div>
	</div>
	<div class="nav-box">
		<div class="container">
			<a class="prev" href="#"><span class="glyphicon glyphicon-arrow-left"></span></a>
			<div class="pagination switches"></div>
			<a class="next" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>  
		</div>
	</div>
</div><!-- .banner-set -->

<?php //}   ?>


<div class="page" id="main">
	<header class="page-header">
        <div class="container">
			<h1 class="title">
				<?php
				if (is_shop()) {

					echo _e('Product Category', 'progressive');
				} else {
					the_title();
				}
				?>
			</h1>
        </div>  
	</header>
    <div class="container">
		<div class="row">     
			<?php
			if (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9left') {

				echo '<div id="catalog" class="col-lg-9 col-md-9 col-sm-12">';
			} elseif (isset($xv_data['shop-layout']) && $xv_data['shop-layout'] == 'shop9right') {

				echo '<div class="col-lg-3 col-md-3 col-sm-12">';
				get_sidebar('shop');
				echo '</div>';
				echo '<div id="catalog" class="col-lg-9 col-md-9 col-sm-12">';
			} else {
				echo '<div id="catalog" class="col-lg-12 col-md-12 col-sm-12">';
			}
			?>


<?php if (is_shop()) { ?>
	<div class="category-img">
	<?php if (!empty($xv_data['shop_header_img']['thumbnail'])) { ?>
			<img src="<?php echo esc_url($xv_data['shop_header_img']['url']); ?>" alt=""/>
		<?php
		}
		if (isset($xv_data['shop_page_top_title'])) {
			$shop_title = $xv_data['shop_page_top_title'];
			echo '<div class="description">' . $shop_title . '</div>';
		}
		?>
	</div>

	<div class="clearfix"></div>

<?php } ?>


