<?php
/**
 * Template Name: Home Page
 *
 * @package progressive
 * @since progressive 1.0
 */
get_header();
?>
<section id="main-home">
	<div class="container">
        <div class="post detail">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>
					<?php endwhile;  // end of the loop. ?>
				</div>
            </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>



