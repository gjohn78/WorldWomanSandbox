<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progressive
 */
get_header();
?>
<!--=========================
Head
===========================-->
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
			<h1 class="title"><?php the_title(); ?></h1>
		</div>	
	</header>
	<div class="container">
		<div class="row">
			<div class="content blog blog-post col-sm-9 col-md-9">
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('content', 'single'); ?>
					<?php
					if (get_post_meta($post->ID, 'show_comment_form', true) != 'no'):
						// If comments are open or we have at least one comment, load up the comment template
						if (comments_open() || '0' != get_comments_number())
							comments_template();
					endif;
					?>
				<?php endwhile; // end of the loop.  ?>
			</div><!-- .content -->
			<div class="col-lg-3 col-md-4 col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- .container -->
</section>

<?php get_footer(); ?>
