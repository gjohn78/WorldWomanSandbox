<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progressive
 */
get_header();

wp_enqueue_script('isotope');

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
			<div class="content portfolio col-sm-12 col-md-12">

				<?php while (have_posts()) : the_post(); ?>
					<div class="slider progressive-slider progressive-slider-four page-slider load bottom-padding load">
						<div class="slider-wrapper">
							<?php 
							$portfolio_slider = ts_get_post_opt('portfolio_slider');
							if (is_array($portfolio_slider) && count($portfolio_slider) > 0) { ?>
								<div class="sliders-box">

									<?php
									$width = 1170;
									$height = 400;
									if (isset($xv_data['porfolio-single-slider-size'])) {

										$width = $xv_data['porfolio-single-slider-size']['width'];
										$height = $xv_data['porfolio-single-slider-size']['height'];
									}
									
									foreach ($portfolio_slider as $slide) {
										$image_url = $slide['image'];
										if (!empty($image_url)) {
											echo '<img src="' . esc_url($image_url) . '" alt=" " />';
										}
									}
									
									?>

								</div><!-- .sliders-box -->

								<div class="nav-box">
									<a class="prev" href="#">
										<i class="icon-angle-left"></i>
									</a>
									<a class="next" href="#">
										<i class="icon-angle-right"></i>
									</a>
								</div>
							<?php
							} else {
								if (has_post_thumbnail()) {
									the_post_thumbnail();
								}
							}
							?>
						</div>
					</div><!-- .progressive-slider -->                

					<div class="row">
						<div class="portfolio-tags bottom-padding col-sm-4 col-md-4">
							<?php
							$taxonomies = wp_get_post_terms(get_the_ID(), 'portfolio_category', array("fields" => "all"));
							$comma_separated = array();
							foreach ($taxonomies as $tax) {
								$comma_separated[] = $tax->name;
							}
							?>
							<p><b><?php _e('Category', 'progressive'); ?>: </b><span><?php echo implode(", ", $comma_separated); ?></span></p>
							<p><b><?php _e('Client', 'progressive'); ?>: </b><span><?php echo get_post_meta(get_the_ID(), 'client', TRUE); ?></span></p>
							<p><b><?php _e('Date', 'progressive'); ?>: </b><span> <?php echo get_post_meta(get_the_ID(), 'data', TRUE); ?></span></p>
							<p><b><?php _e('Tags', 'progressive'); ?>: </b><span>
							<?php
							$taxonomies = wp_get_post_terms(get_the_ID(), 'post_tag', array("fields" => "all"));
							$comma_separated = array();
							foreach ($taxonomies as $tax) {
								$comma_separated[] = $tax->name;
							}
							echo implode(", ", $comma_separated);
							?>
							</span></p>
							<a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'project_url', TRUE)); ?>" class="btn btn-default"><?php _e('Visit Project', 'progressive');?></a>
						</div>

						<div class="bottom-padding col-sm-8 col-md-8">
							<?php the_content(); ?> 
						</div>
					</div>

					<div class="clearfix"></div>
					<?php endwhile; // end of the loop.  ?>
					<?php if (get_post_meta(get_the_ID(), 'show_related_posts', TRUE) == 'Yes') { ?>
						<div class="carousel-box load overflow">
							<div class="title-box">
								<a class="next" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
									<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="1,0.001 0,1.001 7,8 0,14.999 1,15.999 9,8 "></polygon>
									</svg>
								</a>
								<a class="prev" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="16px" viewBox="0 0 9 16" enable-background="new 0 0 9 16" xml:space="preserve">
									<polygon fill-rule="evenodd" clip-rule="evenodd" fill="#fcfcfc" points="8,15.999 9,14.999 2,8 9,1.001 8,0.001 0,8 "></polygon>
									</svg>
								</a>
								<h2 class="title"><?php _e('Related Projects', 'progressive'); ?></h2>
							</div>

							<div class="clearfix"></div>

							<div class="row">
								<div class="carousel no-responsive gallery">

									<?php
									$orig_post = $post;
									global $post;

									$args = array(
										'orderby' => 'rand',
										'post_type' => 'portfolio',
										'posts_per_page' => 8, // Number of related posts to display.  
										'ignore_sticky_posts' => 1
									);



									query_posts($args);


									if (have_posts()) : while (have_posts()) : the_post();


											$thumb = get_xv_thumbnail(270, 135);
											?>  

											<div class="col-sm-3 col-md-3">
												<a href="<?php echo esc_url(get_the_permalink()); ?>">
													<?php echo '<img class="img-rounded" src="' . esc_url($thumb) . '" alt="' . esc_attr(get_the_title()) . '">'; ?>
												</a>
											</div> 


										<?php
										endwhile;
									endif;


									$post = $orig_post;
									wp_reset_query();
									?>


								</div>
							</div>
						</div><!-- .carousel-box -->
					<?php } ?>
			</div><!-- .content -->
		</div>
	</div><!-- .container -->
</section>

<?php get_footer(); ?>
