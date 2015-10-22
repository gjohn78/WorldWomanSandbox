<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progressive
 */
get_header();
?>
<div class="breadcrumb-box">
	<div class="container">
		<?php if (function_exists('progressive_breadcrumbs')) {
			progressive_breadcrumbs();
		} ?>	
	</div>
</div>
<section id="main">
	<header class="page-header">
		<div class="container">
			<h1 class="title">

				<h1 class="page-title">
					<?php
					if (is_category()) :
						single_cat_title();

					elseif (is_tag()) :
						single_tag_title();

					elseif (is_author()) :
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 */
						the_post();
						printf(__('Author: %s', 'progressive'), '<span class="vcard">' . get_the_author() . '</span>');
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif (is_day()) :
						printf(__('Day: %s', 'progressive'), '<span>' . get_the_date() . '</span>');

					elseif (is_month()) :
						printf(__('Month: %s', 'progressive'), '<span>' . get_the_date('F Y') . '</span>');

					elseif (is_year()) :
						printf(__('Year: %s', 'progressive'), '<span>' . get_the_date('Y') . '</span>');

					elseif (is_tax('post_format', 'post-format-aside')) :
						_e('Asides', 'progressive');

					elseif (is_tax('post_format', 'post-format-image')) :
						_e('Images', 'progressive');

					elseif (is_tax('post_format', 'post-format-video')) :
						_e('Videos', 'progressive');

					elseif (is_tax('post_format', 'post-format-quote')) :
						_e('Quotes', 'progressive');

					elseif (is_tax('post_format', 'post-format-link')) :
						_e('Links', 'progressive');

					else :
						_e('Archives', 'progressive');

					endif;
					?>
				</h1>
				<h5>
					<?php
					// Show an optional term description.
					$term_description = term_description();
					if (!empty($term_description)) :
						printf('<div class="taxonomy-description">%s</div>', $term_description);
					endif;
					?>
				</h5></h1>
		</div>	
	</header>
	<div class="container">
		<div class="row">
			<div class="content blog col-sm-9 col-md-9">
				<?php
				while (have_posts()) : the_post();

					get_template_part('content', 'blog');

				endwhile; // end of the loop. 
				?>		
				<div class="pagination-box">
					<?php if (function_exists('progressive_get_pagination')) {
						progressive_get_pagination();
					} ?>
				</div><!-- .pagination-box -->

			</div><!-- .content -->

			<div class="col-lg-3 col-md-4 col-sm-4">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div><!-- .container -->
</section>
<?php get_footer(); ?>