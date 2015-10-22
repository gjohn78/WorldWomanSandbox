<?php
/**
 * Template Name: Full Width
 *
 * @package progressive
 * @since progressive 1.0
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
				<div class="col-lg-12 col-md-12 col-sm-12">

					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>


						<?php
						if (isset($xv_data['switch_comments']) && $xv_data['switch_comments'] == 1):
							// If comments are open or we have at least one comment, load up the comment template
							if (comments_open() || '0' != get_comments_number())
								comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</div>
            </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>