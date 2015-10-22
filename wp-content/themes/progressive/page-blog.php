<?php
/**
 *  Template Name: Blog
 * @package progressive
 * @since progressive 1.0
 */
get_header();
?>
<?php get_template_part('content', 'top'); ?>


<section id="main">
	<header class="page-header">
		<div class="container">
			<h1 class="title"><?php _e('Our Blog', 'progressive'); ?></h1>
		</div>	
	</header>
	<div class="container">
		<div class="row">
			<div class="content blog col-sm-9 col-md-9">
				<?php
				$temp = $wp_query;
				$wp_query = null;
				$wp_query = new WP_Query();

				$args = array(
					'numberposts' => '',
					'posts_per_page' => $posts_per_page,
					'offset' => 0,
					'cat' => '',
					'orderby' => 'date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post',
					'post_mime_type' => '',
					'post_parent' => '',
					'paged' => $paged,
					'post_status' => 'publish'
				);

				$wp_query->query($args);
				while ($wp_query->have_posts()) : $wp_query->the_post();

					get_template_part('/inc/blog/content', get_post_format());

				endwhile; // end of the loop. 
				wp_reset_postdata();
				?>		
				<div class="pagination-box">
				<?php if (function_exists('progressive_get_pagination')) {
					progressive_get_pagination();
				} ?>
				</div><!-- .pagination-box -->

			</div><!-- .content -->

			<div class="col-sm-3 col-md-3 col-lg-3">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div><!-- .container -->
</section>

<?php get_footer(); ?>