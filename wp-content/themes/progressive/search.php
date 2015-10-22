<?php
/**
 * The template for displaying Search Results pages.
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
			<h1 class="title"><?php printf(__('Search Results for: %s', 'progressive'), '<span>' . get_search_query() . '</span>'); ?></h1>
		</div>	
	</header>

	<div class="container">
		<div class="row">
			<div class="content blog col-sm-9 col-md-9">

				<?php if (have_posts()) : ?>

					<?php /* Start the Loop */ ?>
					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('content', 'blog'); ?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part('content', 'none'); ?>

					<?php endif; ?>

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