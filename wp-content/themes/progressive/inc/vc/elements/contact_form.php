<?php
/**
 * Visual Composer Eelement: Contact Form
 * 
 */
add_shortcode('contact_form', 'ts_contact_form_func');

function ts_contact_form_func($atts, $content = null) {
	extract(
			shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'title' => '',
		'email' => '',
		'email_label' => '',
		'email_icon' => '',
		'message_label' => '',
		'send_label' => '',
		'clear_label' => '',
		'skin' => 1,
		'button_align' => 'left',
					), $atts)
	);
	ob_start();

	$action = admin_url('admin-ajax.php');
	
	$your_email = $email;
	?>
	<div class="contact_wraper <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>

		<form method="POST" data-action="<?php echo esc_url($action); ?>" class="form-box register-form contact-form" id="contactform">
			<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'my-contact-form' ); ?>" />
			<h3 class="title"><?php echo esc_html($title); ?></h3>
			<div id="success"></div>
			<label><?php _e('Name', 'progressive'); ?>: <span class="required">*</span></label>
			<input id="cf_name" type="text" name="name" class="form-control">
			<label><?php _e('Email Address:', 'progressive'); ?> <span class="required">*</span></label>
			<input id="cf_email" type="email" name="email" class="form-control">
			<label><?php _e('Telephone:', 'progressive'); ?></label>
			<input id="cf_phone" type="text" name="phone" class="form-control">
			<label><?php _e('Comment:', 'progressive'); ?></label>
			<textarea id="cf_message" name="comment" class="form-control"></textarea>
			<div class="clearfix"></div>
			<div class="buttons-box clearfix">
				<input type="hidden" name="your_email" id="your_email" value="<?php echo esc_attr(get_the_ID()); ?>" />
				<button class="btn btn-default" id="submit"><?php _e('Submit', 'progressive'); ?></button>
				<span class="required"><b>*</b> <?php _e('Required Field', 'progressive'); ?></span>
			</div><!-- .buttons-box -->
		</form>
		<div id="valid-issue" style="display:none;"> <?php _e('Please Provide Valid Information', 'progressive'); ?></div>
	</div>
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
