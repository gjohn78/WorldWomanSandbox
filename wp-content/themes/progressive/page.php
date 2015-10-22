<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package progressive
 */
get_header();
?>
<?php get_template_part('content', 'top'); ?>
<section id="main">
	<header class="page-header">
		<div class="container">
			<h1 class="title"><?php the_title(); ?></h1>
		</div>
    </header>

	<div class="container">
        <div class="post detail">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>
						<?php
						if (get_post_meta($post->ID, 'show_comment_form', true) != 'no'):
							// If comments are open or we have at least one comment, load up the comment template
							if (comments_open() || '0' != get_comments_number())
								comments_template();
						endif;
						?>
					<?php endwhile; // end of the loop.  ?>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<?php get_sidebar(); ?>
				</div>
            </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>