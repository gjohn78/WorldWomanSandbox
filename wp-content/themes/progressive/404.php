<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package progressive
 * @since progressive 1.0
 */
get_header();
?>

<?php get_template_part('content', 'top'); ?>
<section id="main">
	<div class="container">
		<div class="row">
			<div class="content col-sm-12 col-md-12">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="box-404 bg">
							<h1><?php _e('404', 'progressive'); ?></h1>
							<h2><?php _e('This page couldn\'t be found!', 'progressive'); ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .container -->
</section><!-- #main -->

<?php get_footer(); ?>