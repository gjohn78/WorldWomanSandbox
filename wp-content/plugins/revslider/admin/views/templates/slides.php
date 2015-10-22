<?php if( !defined( 'ABSPATH') ) exit(); ?>
<div class="wrap settings_wrap">

	<div class="clear_both"></div>

	<div class="title_line" style="margin-bottom:10px;">
		<div id="icon-options-general" class="icon32"></div>
		<h2><?php _e("Edit Slides",REVSLIDER_TEXTDOMAIN); ?>: <?php echo $slider->getTitle(); ?></h2>

		<a href="<?php echo RevSliderGlobals::LINK_HELP_SLIDE_LIST; ?>" class="button-secondary float_right mtop_10 mleft_10" target="_blank"><?php _e("Help",REVSLIDER_TEXTDOMAIN); ?></a>

	</div>

	<div class="vert_sap"></div>
	<?php if($numSlides >= 5){?>
		<a class='button-primary' id="button_new_slide_top" href='javascript:void(0)' ><?php _e("New Slide",REVSLIDER_TEXTDOMAIN); ?></a>
		<span class="hor_sap"></span>
		<a class='button-primary' id="button_new_slide_transparent_top" href='javascript:void(0)' ><?php _e("New Transparent Slide",REVSLIDER_TEXTDOMAIN); ?></a>
		<span class="loader_round new_trans_slide_loader" style="display:none"><?php _e("Adding Slide...",REVSLIDER_TEXTDOMAIN); ?></span>
		<span class="hor_sap_double"></span>
		<a class="button_close_slide button-primary mright_20" href='<?php echo self::getViewUrl(RevSliderAdmin::VIEW_SLIDERS); ?>' ><?php _e("Close",REVSLIDER_TEXTDOMAIN); ?></a>

	<?php } ?>

	<?php if($wpmlActive == true){ ?>
		<div id="langs_float_wrapper" class="langs_float_wrapper" style="display:none">
			<?php echo $langFloatMenu; ?>
		</div>
	<?php } ?>

	<div class="vert_sap"></div>
	<div class="sliders_list_container">
		<?php require self::getPathTemplate("slides-list"); ?>
	</div>
	<div class="vert_sap_medium"></div>
	<a class='button-primary' id="button_new_slide" data-dialogtitle="<?php _e("Select image or multiple images to add slide or slides",REVSLIDER_TEXTDOMAIN); ?>" href='javascript:void(0)' ><?php _e("New Slide",REVSLIDER_TEXTDOMAIN); ?></a>
	<span class="hor_sap"></span>
	<a class='button-primary' id="button_new_slide_transparent" href='javascript:void(0)' ><?php _e("New Transparent Slide",REVSLIDER_TEXTDOMAIN); ?></a>
	<span class="loader_round new_trans_slide_loader" style="display:none"><?php _e("Adding Slide...",REVSLIDER_TEXTDOMAIN); ?></span>
	<span class="hor_sap_double"></span>
	<a class='button-primary revgray' href='<?php echo self::getViewUrl(RevSliderAdmin::VIEW_SLIDE,"id=static"); ?>' style="width:190px; "><i style="color:#fff" class="eg-icon-dribbble"></i><?php _e("Edit Static / Global Layers",REVSLIDER_TEXTDOMAIN); ?></a>
	<span class="hor_sap_double"></span>
	<a class="button_close_slide button-primary" href='<?php echo self::getViewUrl(RevSliderAdmin::VIEW_SLIDERS); ?>' ><?php _e("Close",REVSLIDER_TEXTDOMAIN); ?></a>
	<span class="hor_sap"></span>

	<a href="<?php echo $linksSliderSettings; ?>" id="link_slider_settings"><?php _e("To Slider Settings",REVSLIDER_TEXTDOMAIN); ?></a>

</div>

<?php require self::getPathTemplate("../system/dialog-copy-move"); ?>

<script type="text/javascript">

	jQuery(document).ready(function() {

		RevSliderAdmin.initSlidesListView("<?php echo $sliderID; ?>");

	});

</script>