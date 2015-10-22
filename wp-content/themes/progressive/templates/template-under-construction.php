<?php
/**
 * Template Name: Under Construction  
 *
 * @package progressive
 * @since progressive 1.0
 */
 ?>
<!doctype html>
<html class="full-height">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
<link rel="shortcut icon" href="<?php if(!empty($xv_data['fav_icon']['url'])){ echo $xv_data['fav_icon']['url'];}else{ echo get_template_directory_uri() .  '/assets/img/favicon.png'; }?>" type="image/x-icon" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#sticktop" data-offset="70">
<div class="page-box">
<header class="header header-three">
  <div class="header-wrapper">
  <div class="container">
    <div class="row">
    <div class="logo-box col-sm-12 col-md-12">
      <div class="logo">
     
                    <?php if(!empty($xv_data['coming_soon_logo']['thumbnail'])) { ?>
                        <img src="<?php echo $xv_data['coming_soon_logo']['url']; ?>" alt="<?php bloginfo('name'); ?>"/>
                   <?php }else{
                          ?>
                         <?php bloginfo('name'); ?>
                    <?php } ?>
      </div>
    </div>
    </div><!--.row -->
  </div>
  </div><!-- .header-wrapper -->
</header><!-- .header -->


<section>

	<div class="container under">
        <div class="row">
       <div class="col-sm-12 col-md-12">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

       
            </div>
    	</div>
	</div>
</section>
</div>
<?php wp_footer(); ?>

</body>
</html>