<?php
/**
 * Number of products on shop page
 */
if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

if (is_single() || !have_posts())
	return;
$num_prod = ( isset($_GET['posts_per_page']) ) ? $_GET['posts_per_page'] : 1;

$num_prod_x1 = 1;
//$num_prod_x2 = $num_prod_x1 * 2;

$link = ( get_option('permalink_structure') == "" ) ? get_post_type_archive_link('product') : get_permalink(wc_get_page_id('shop'));

if (isset($_GET) && !empty($_GET)) {
	foreach ($_GET as $key => $value) {
		$link = add_query_arg($key, $value, $link);
	}
}
?>
<?php
$posts_per_page = '';
if (get_query_var('posts_per_page')) {
	$posts_per_page = get_query_var('posts_per_page');
} else {
	$posts_per_page = get_option('posts_per_page');
}
?>
<div class="sort-catalog">
	<div class="btn-group show-by btn-select">
        <a href="#" data-toggle="dropdown" role="button" class="btn dropdown-toggle btn-default"><?php _e('Show', 'progressive');?>: <span><?php echo intval($posts_per_page); ?></span> <span class="caret"></span></a>
        <ul class="dropdown-menu">
			<?php for ($i = 1; $i <= 12; $i++) { ?>
				<li>                   
					<a href="<?php echo add_query_arg('posts_per_page', $num_prod_x1, $link); ?>"><?php echo $num_prod_x1++; ?> </a>
				</li>
			<?php } ?>

        </ul>
	</div><!-- .show -->
	<span class="per-page"><?php _e('per page', 'progressive'); ?></span>
</div><!-- .sort-catalog -->
