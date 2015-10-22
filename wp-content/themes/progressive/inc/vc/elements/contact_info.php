<?php
/**
 * Visual Composer Eelement: Contact Info
 * 
 */
add_shortcode('contact_info', 'ts_contact_info_func');

function ts_contact_info_func($atts, $content = null) {
	
	extract(
		shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'address' => '',
		'email' => '',
		'phone' => '',
		'fax' => '',
		), $atts)
	);
	ob_start();
	?>
	<div class="contact-info-widget under-contact <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>             
	<?php if (!empty($address)): ?>
			<div class="address">
				<div class="footer-icon">
		            <svg xml:space="preserve" enable-background="new 0 0 16 16" viewBox="0 0 16 16" height="16px" width="16px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<g>
							<g>
								<path d="M8,16c-0.256,0-0.512-0.098-0.707-0.293C7.077,15.491,2,10.364,2,6c0-3.309,2.691-6,6-6
									  c3.309,0,6,2.691,6,6c0,4.364-5.077,9.491-5.293,9.707C8.512,15.902,8.256,16,8,16z M8,2C5.795,2,4,3.794,4,6
									  c0,2.496,2.459,5.799,4,7.536c1.541-1.737,4-5.04,4-7.536C12.001,3.794,10.206,2,8,2z" fill="#000"/>
							</g>
							<g>
								<circle r="2" cy="6" cx="8.001" fill="#000"/>
							</g>
						</g>
		            </svg>
				</div>
		<?php echo nl2br(wp_kses_data($address)); ?> <br/>
			</div>
	<?php endif; ?>
	<?php if (!empty($phone)): ?>
			<div class="phone">
				<div class="footer-icon">
		            <svg xml:space="preserve" enable-background="new 0 0 16 16" viewBox="0 0 16 16" height="16px" width="16px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<path d="M11.001,0H5C3.896,0,3,0.896,3,2c0,0.273,0,11.727,0,12c0,1.104,0.896,2,2,2h6c1.104,0,2-0.896,2-2
							  c0-0.273,0-11.727,0-12C13.001,0.896,12.105,0,11.001,0z M8,15c-0.552,0-1-0.447-1-1s0.448-1,1-1s1,0.447,1,1S8.553,15,8,15z
							  M11.001,12H5V2h6V12z" fill="#000"/>
		            </svg>
				</div>
		<?php echo wp_kses_data($phone); ?><br/>
			</div>
	<?php endif; ?>
	<?php if (!empty($fax)): ?>

			<div class="phone">
				<div class="footer-icon">

				</div>
			<?php echo wp_kses_data($fax); ?><br/><br/>
			</div>
	<?php endif; ?>

	<?php if (!empty($email)): ?>               
			<div class="phone">
				<div class="footer-icon">
		            <i class="icon-email"></i>
				</div>
				<a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a><br/>
			</div>

	<?php endif; ?>

	</div>
	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
