<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package progressive
 * @since progressive 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0'>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<?php wp_head(); ?>		
</head>
<body <?php echo ts_get_body_id_attr(); ?> <?php body_class(); ?>>
	<?php progressive_preloader(); ?>
	<div id="top"></div>
	<div class="page-box">
		<div class="page-box-content">
			<?php progressive_promo_panel(); ?>
			<?php progressive_topbar(); ?>
			<?php get_template_part('inc/header'); ?>

