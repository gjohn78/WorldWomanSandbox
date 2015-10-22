<?php
/**
 * Template Name: Blog Timeline
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
		<div class="content">
			<div class="timeline">
				<?php
				//adhere to paging rules
				if (get_query_var('paged')) {
					$paged = get_query_var('paged');
				} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
					$paged = get_query_var('page');
				} else {
					$paged = 1;
				}

				$args = array(
					'numberposts' => '',
					'posts_per_page' => get_option('posts_per_page'),
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

				$custom_query = new WP_Query($args);
				$found_posts = null;

				$max_num_pages = 0;
				if ($custom_query->have_posts()):
					$max_num_pages = $custom_query->max_num_pages;

					$ts_loop_it = 0;
					$oArgs = ThemeArguments::getInstance('templates/template-blog-timeline');
					
					while ($custom_query->have_posts()) :
						$custom_query->the_post();
						get_template_part('/inc/blog-timeline/content', get_post_format());
						$ts_loop_it ++;
						$oArgs -> set('ts_loop_it',$ts_loop_it);
					endwhile; // end of the loop. 
					$oArgs -> reset();
				endif;
				?>
            </div>
			<?php wp_reset_postdata(); ?>
			<div class="pagination-box">
				<?php if (function_exists('progressive_get_pagination')) {
					progressive_get_pagination($max_num_pages);
				} ?>
			</div><!-- .pagination-box -->

		</div>
	</div>
</section>
<?php get_footer(); ?>