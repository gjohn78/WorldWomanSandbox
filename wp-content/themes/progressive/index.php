<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progressive
 * @since progressive 1.0
 */
get_header();
?>
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
				while (have_posts()) : the_post();

					get_template_part('/inc/blog/content', get_post_format());

				endwhile; // end of the loop. 
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