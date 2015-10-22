<?php
/**
 * Shortcodes Visual Composer integration
 *
 * @package progressive
 * @since progressive 1.0
 */

add_action( 'init', 'ts_integrateWithVC' );

function ts_integrateWithVC() {
	
	if (!function_exists('vc_map')) {
		return;
	}
	

/*----------------------------------------------------------------------------*
 * Alerts
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Alert', 'progressive'),
			'base' => 'alert',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Info', 'progressive') => 'info',
                        __('Error', 'progressive') => 'error',
                        __('Notice', 'progressive') => 'notice',
                        __('Success', 'progressive') => 'success',
                        __('Danger', 'progressive') => 'danger',
                        __('Warning', 'progressive') => 'warning',
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'progressive' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Hide Icon', 'progressive' ),
					'param_name' => 'hide_icon',
					'admin_label' => true,
					'value' => array(
                        __('yes', 'progressive') => 'yes',
                        __('no', 'progressive') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Close button', 'progressive' ),
					'param_name' => 'close_btn',
					'admin_label' => true,
					'value' => array(
                        __('yes', 'progressive') => 'yes',
                        __('no', 'progressive') => 'no'
                    ),
					'description' => ''
				),
					array(
					'type' => 'textarea_html',
					'heading' => __( 'Message', 'progressive' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Message', 'progressive' ),
					'param_name' => 'message1',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	

/*----------------------------------------------------------------------------*
 * Blockqoute
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Blockquote', 'progressive'),
			'base' => 'blockquote',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Author', 'progressive' ),
					'param_name' => 'author',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	
	
	

/*----------------------------------------------------------------------------*
 * Button
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Button', 'progressive'),
			'base' => 'button',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_icons(),
				ts_get_livicons(),
				ts_get_livicons_animate_on(),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'progressive' ),
					'param_name' => 'background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Border color', 'progressive' ),
				// 	'param_name' => 'border',
				// 	'admin_label' => false,
				// 	'description' => ''
				// ),
				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Hover color', 'progressive' ),
				// 	'param_name' => 'hover',
				// 	'admin_label' => false,
				// 	'description' => ''
				// ),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'progressive' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array(
						__('Small', 'progressive')  => 'btn-sm',
						__('Medium', 'progressive') => 'btn-default',
						__('Large', 'progressive')  => 'btn-lg',
						__('Block Button', 'progressive')  => 'btn-lg btn-block',
						__('Metro', 'progressive')  => 'metro',
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'progressive' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'framework' ),
					'param_name' => 'align',
					'admin_label' => false,
					'value' => array(
						'Left'   => 'text-left',
						'Center' => 'text-center',
						'Right'  => 'text-right',
						'Pull left' => 'pull-left',
						'Pull right' => 'pull-right',
						'None'  => 'none'
					),
				)
			)
		)
	);
	
	
/*----------------------------------------------------------------------------*
 * Button
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Button outlined', 'progressive'),
			'base' => 'button_outlined',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_icons(),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text hover color', 'progressive' ),
					'param_name' => 'hover_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'progressive' ),
					'param_name' => 'background_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background hover color', 'progressive' ),
					'param_name' => 'background_hover_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'progressive' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array(
						__('Small', 'progressive')  => 'btn-sm',
						__('Medium', 'progressive') => 'btn-default',
						__('Large', 'progressive')  => 'btn-lg',
						__('Block Button', 'progressive')  => 'btn-lg btn-block',
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'progressive' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
				),
				ts_get_vc_element_align(),
			)
		)
	);

	
	/*-----------------------------------------------------*
	 * Divider
	 *-----------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Divider', 'progressive'),
			'base' => 'divider',
			'class' => '',
			'category' => __('Structure', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'progressive' ),
				'param_name' => 'style',
				'admin_label' => false,
				'value' => array(
					__('Solid', 'progressive') => '',
					__('shadow', 'progressive') => 'shadow',
					__('Dotted', 'progressive') => 'dotted',
					__('Dashed', 'progressive') => 'dashed',
					__('Double', 'progressive') => 'double'
                ),
				'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	

	/*-----------------------------------------------------*
	 * Sequence
	 *-----------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Steps', 'progressive'),
			'base' => 'steps',
			'class' => '',
			'category' => __('Structure', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Step', 'progressive' ),
					'param_name' => 'step',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'progressive' ),
				'param_name' => 'style',
				'admin_label' => false,
				'value' => array(
					__('Style1', 'progressive') => 'border-warning',
					__('Style2', 'progressive') => 'border-info bg-info',
					__('Style3', 'progressive') => 'border-error',
					__('Style4', 'progressive') => 'border-success bg-success'
                ),
				'description' => ''
				),
				array(
				'type' => 'dropdown',
				'heading' => __( 'Align', 'progressive' ),
				'param_name' => 'align',
				'admin_label' => false,
				'value' => array(
					__('Left', 'progressive') => '',
					__('Right', 'progressive') => 'step-right',
				),
				'description' => ''
				),
			)
		)
	);


	/*-----------------------------------------------------*
	 * Sequence2
	 *-----------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Steps2', 'progressive'),
			'base' => 'steps2',
			'class' => '',
			'category' => __('Structure', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'progressive' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => '',
					'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown',
				),
						ts_get_vc_map_colorpicker('Icon Color','icon_color'),


				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon Size', 'progressive' ),
					'param_name' => 'icon_size',
				
					'value' => array(
                        __('44'   , 'progressive') 	=> '44',
                        __('54'  , 'progressive') 	=> '54',
                        __('64'  , 'progressive') 	=> '64',
                    ),
					'description' => ''
				),

			
							ts_get_livicons(),
					ts_get_vc_map_colorpicker('Icon Color','livicon_color','Livicons'),


				array(
					'type' => 'dropdown',
					'heading' => __( 'Livicons Size', 'progressive' ),
					'param_name' => 'livicon_size',
					'group' => 'Livicons',
					'value' => array(
                        __('44'   , 'progressive') 	=> '44',
                        __('54'  , 'progressive') 	=> '54',
                        __('64'  , 'progressive') 	=> '64',
                    ),
					'description' => ''
				),

				
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Description', 'progressive' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				),	
				
				array(
				'type' => 'dropdown',
				'heading' => __( 'Border Style', 'progressive' ),
				'param_name' => 'border',
				'admin_label' => false,
				'value' => array(
					__('None', 'progressive') => '',
					__('Style1', 'progressive') => 'border-warning',
					__('Style2', 'progressive') => 'border-info',
					__('Style3', 'progressive') => 'border-error',
					__('Style4', 'progressive') => 'border-success'
                ),
				'description' => ''
				),

				array(
				'type' => 'dropdown',
				'heading' => __( 'Background Style', 'progressive' ),
				'param_name' => 'bg',
				'admin_label' => false,
				'value' => array(
					__('None', 'progressive') => '',
					__('Style1', 'progressive') => 'bg-warning',
					__('Style2', 'progressive') => 'bg-info',
					__('Style3', 'progressive') => 'bg-error',
					__('Style4', 'progressive') => 'bg-success'
                ),
				'description' => ''
				),


			array(
				'type' => 'dropdown',
				'heading' => __( 'Text Style', 'progressive' ),
				'param_name' => 'text',
				'admin_label' => false,
				'value' => array(
					__('Normal', 'progressive') => '',
					__('White', 'progressive') => 'white title-white',
				
                ),
				'description' => ''
				),

				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'progressive' ),
					'param_name' => 'img_url',
					'admin_label' => false,
					'description' => 'Only works if background style is not none.'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Last Step', 'progressive' ),
					'param_name' => 'last_step',
				
					'value' => array(
                        __('No'   , 'progressive') 	=> 'steps-apart',
                        __('Yes'  , 'progressive') 	=> '',
                      
                    ),
				),

			
			)
		)
	);
	

	

/*----------------------------------------------------------------------------*
 * Heading 
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Heading', 'progressive'),
			'base' => 'heading',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Type', 'progressive' ),
					'param_name' => 'type',
					'admin_label' => true,
					'value' => array(
						'H1' => '1',
						'H2' => '2',
						'H3' => '3',
						'H4' => '4',
						'H5' => '5'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Heading Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
						__('Normal', 'progressive') => '',
						__('Border Style', 'progressive') => 'title-box',
						__('Border Style White', 'progressive') => 'title-box title-white',
						__('Big Border Style', 'progressive') => 'inner-page-header',
						__('Big Border Style White', 'progressive') => 'inner-page-header white',
						
						
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),

				ts_get_vc_element_align(),
				array(
					'type' => 'textfield',
					'heading' => __( 'ID (optional)', 'progressive' ),
					'param_name' => 'id',
					'admin_label' => false,
					'description' => 'Enter a unique id for this heading.',
				),

			)
		)
	);
	

/*----------------------------------------------------------------------------*
 * icon
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Icon', 'progressive'),
			'base' => 'icon',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Default', 'progressive') => 'default',
						__('Outlined', 'progressive') => 'outlined'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Hover color', 'progressive' ),
					'param_name' => 'hover_color',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Size', 'progressive' ),
					'param_name' => 'size',
					'admin_label' => true,
					'description' => 'Height in px. e.g. 16, 24'
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => 'Title attribute'
				)
			)
		)
	);

/*----------------------------------------------------------------------------*
 * icon
 *----------------------------------------------------------------------------*/
	
	vc_map( 
		array(
			'name' => __('Icon List', 'progressive'),
			'base' => 'icons',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_map_icons(),
				
					array(
					'type' => 'dropdown',
					'heading' => __( 'Icon Size', 'progressive' ),
					'param_name' => 'size',
					'admin_label' => true,
					'description' => __('Select size', 'progressive'),
					'value' => array(
						'24px' 						 => __('icon-24', 'progressive'),
						'32px' 						 => __('icon-32', 'progressive'),
						'40px' 						 => __('icon-40', 'progressive'),
						'60px' 						 => __('icon-60', 'progressive'),
						'100px' 					=> __('icon-100', 'progressive'),
                    ),
					
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Radius', 'progressive' ),
					'param_name' => 'bg_radius',
					'admin_label' => false,
					'description' => 'icons radius in px. only write 20 or 30'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon Background Color', 'progressive' ),
					'param_name' => 'icon_bg_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon Border Color', 'progressive' ),
					'param_name' => 'icon_border_color',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * image
	 */
	vc_map( 
		array(
			'name' => __('Image', 'progressive'),
			'base' => 'image',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Image Caption', 'progressive' ),
					'param_name' => 'caption',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'External URL', 'progressive' ),
					'param_name' => 'img_link',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'progressive' ),
					'param_name' => 'img_url',
					'admin_label' => false,
					'description' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Image Frame', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'description' => __('Select an Image frame', 'progressive'),
					'value' => array(
						'No Style' 						 => '',
						'Rounded' 						 => __('frame img-rounded', 'progressive'),
						'Solid Border'					 => __('frame manufactures', 'progressive'),	
						'Solid Border'					 => __('frame manufactures', 'progressive'),		
                        'Padding' 				  		 => __('frame frame-padding', 'progressive'),
                        'Shaddow' 				  		 => __('frame frame-shadow-metro', 'progressive'),
                        'Padding, Border' 		  		 => __('frame frame-padding frame-border', 'progressive'),
                        'Padding, Shaddow' 		  		 => __('frame frame-padding frame-shadow', 'progressive'),
                        'Padding, Lifted Shaddow' 		 => __('frame frame-padding frame-shadow-lifted', 'progressive'),
                        'Padding, Shaddow Curved' 		 => __('frame frame-padding frame-shadow-curved', 'progressive'),
                        'Shaddow, Lifted, Rotated' 		 => __('frame frame-shadow-lifted rotated-box', 'progressive'),
                        'Pading, Shaddow, Raised' 		 => __('frame frame-padding frame-shadow-raised', 'progressive'),
                        'Shaddow, Lifted, Rotated Right' => __('frame frame-shadow-lifted rotated-right-box', 'progressive')
                    ),
					
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Width', 'progressive' ),
					'param_name' => 'width',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Height', 'progressive' ),
					'param_name' => 'height',
					'admin_label' => false,
					'description' => ''
				),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Hover Border', 'progressive' ),
					'param_name' => 'hover_border',
					'admin_label' => true,
					'description' => __('Enable or disable hover border.', 'progressive'),
					'value' => array(
						'Disable' 						 => '',
						'Enable' 						 => __('hover-border', 'progressive'),
						
                        
                    ),
					
				),
			array(
					'type' => 'dropdown',
					'heading' => __( 'Hover opacity', 'progressive' ),
					'param_name' => 'hover_opacity',
					'admin_label' => true,
					'description' => __('Change opacity on hover.', 'progressive'),
					'value' => array(
						__('Default','Progressive') => '',
						'10%' => 'hover-opacity hover-opacity-10',
						'20%' => 'hover-opacity hover-opacity-20',
						'30%' => 'hover-opacity hover-opacity-30',
						'40%' => 'hover-opacity hover-opacity-40',
						'50%' => 'hover-opacity hover-opacity-50',
						'60%' => 'hover-opacity hover-opacity-60',
						'70%' => 'hover-opacity hover-opacity-70',
						'80%' => 'hover-opacity hover-opacity-80',
						'90%' => 'hover-opacity hover-opacity-90'
					),
					
				),
				ts_get_vc_element_align(),
			)
		)
	);
	
	/**
	 * livicon
	 */
	vc_map( 
		array(
			'name' => __('Livicon', 'progressive'),
			'base' => 'livicon',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Default', 'progressive') => 'default',
						__('Outlined', 'progressive') => 'outlined'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Livicon', 'framework' ),
					'param_name' => 'livicon',
					'admin_label' => true,
					'value' => ts_get_livicon_list(true),
					'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon animation', 'progressive' ),
					'param_name' => 'icon_animation',
					'admin_label' => true,
					'value' => array_flip(array(
                        'yes' => __('Yes', 'progressive'),
						'no' => __('No', 'progressive')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Event', 'progressive' ),
					'param_name' => 'event',
					'admin_label' => true,
					'value' => array_flip(array(
                        'hover' => __('Hover', 'progressive'),
						'click' => __('Click', 'progressive')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Loop', 'progressive' ),
					'param_name' => 'loop',
					'admin_label' => true,
					'value' => array_flip(array(
                        'no' => __('No', 'progressive'),
                        'yes' => __('Infinite loop', 'progressive'),
						'1' => '1 '.__('Loop', 'progressive'),
						'2' => '2 '.__('Loops', 'progressive'),
						'3' => '3 '.__('Loops', 'progressive'),
						'4' => '4 '.__('Loops', 'progressive'),
						'5' => '5 '.__('Loops', 'progressive'),
						'6' => '6 '.__('Loops', 'progressive'),
						'7' => '7 '.__('Loops', 'progressive'),
						'8' => '8 '.__('Loops', 'progressive'),
						'9' => '9 '.__('Loops', 'progressive'),
						'10' => '10 '.__('Loops', 'progressive'),
                    )),
					'description' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => __( 'Shadow', 'progressive' ),
					'param_name' => 'shadow',
					'admin_label' => true,
					'value' => array_flip(array(
                        'no' => __('No', 'progressive'),
						'yes' => __('Yes', 'progressive')
                    )),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Hover color', 'progressive' ),
					'param_name' => 'hover_color',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Size', 'progressive' ),
					'param_name' => 'size',
					'admin_label' => true,
					'description' => 'Height in px. e.g. 16, 24'
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => 'Title attribute'
				)
			)
		)
	);
	

	
	/**
	 * map_container
	 */
	vc_map( 
		array(
			'name' => __('Google Map', 'progressive'),
			'base' => 'map_container',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				
				ts_get_vc_map_textfield('Title','title'),
				array(
					'type' => 'textfield',
					'heading' => __( 'Height', 'progressive' ),
					'param_name' => 'height',
					'admin_label' => true,
					'description' => 'Height in px. e.g 300 , 400'
				),
				ts_get_vc_map_textfield('Latitude','lat'),
				ts_get_vc_map_textfield('Lanitude','lng'),
				ts_get_vc_map_textfield('Marker title','marker_title'),
				ts_get_vc_map_textfield('Marker content','marker_content'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Zoom', 'progressive' ),
					'param_name' => 'zoom',
					'admin_label' => false,
					'value' => array(
						__('4', 'progressive') => '4',
						__('5', 'progressive') => '5',
						__('6', 'progressive') => '6',
						__('7', 'progressive') => '7',
                    	__('8', 'progressive') => '8',
						__('9', 'progressive') => '9',
                    ),
					'description' => ''
				),
			
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => false,
					'value' => array(
						__('Normal', 'progressive') => 'normal',
						__('Satellite', 'progressive') => 'satellite',
						__('Terrain', 'progressive') => 'terrain',
                    ),
					'description' => ''
				),
				ts_get_vc_map_textfield('Area 1 Title','area_1_title','Overlay'),
				array(
					'type' => 'textarea',
					'heading' => __( 'Area 1 Content', 'progressive' ),
					'param_name' => 'area_1_content',
					'admin_label' => false,
					'group' => 'Overlay'
				),
				ts_get_vc_map_textfield('Area 2 Title','area_2_title','Overlay'),
				array(
					'type' => 'textarea',
					'heading' => __( 'Area 2 Content', 'progressive' ),
					'param_name' => 'area_2_content',
					'admin_label' => false,
					'group' => 'Overlay'
				),
				ts_get_vc_map_textfield('Area 3 Title','area_3_title','Overlay'),
				array(
					'type' => 'textarea',
					'heading' => __( 'Area 3 Content', 'progressive' ),
					'param_name' => 'area_3_content',
					'admin_label' => false,
					'group' => 'Overlay'
				)
			)
		)
	);
	
	/*--------------------------------------------------*
	 * social_icons
	 *-----------------------------------------------------*/
	
	vc_map( 
		array(
			'name' => __('Social Icons', 'progressive'),
			'base' => 'social_icons',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			"icon" => "xv_vc_icon",
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Facebook', 'progressive' ),
					'param_name' => 'facebook',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Twitter', 'progressive' ),
					'param_name' => 'twitter',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Google Plus', 'progressive' ),
					'param_name' => 'gplus',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Linked In', 'progressive' ),
					'param_name' => 'linkedin',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
			)
		)
	);
	
	
	
	/*------------------------------------------------------------*
	 * special_text
	 -----------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Special Text', 'progressive'),
			'base' => 'special_text',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Tag name', 'progressive' ),
					'param_name' => 'tagname',
					'admin_label' => true,
					'value' => array_flip(array(
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span'
                    )),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Font color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Font size', 'progressive' ),
					'param_name' => 'font_size',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Font weight', 'progressive' ),
					'param_name' => 'font_weight',
					'admin_label' => true,
					'value' => array_flip(array(
                        'default' => __('Default', 'progressive'),
                        'normal' => __('Normal', 'progressive'),
                        'bold' => __('Bold', 'progressive'),
                        'bolder' => __('Bolder', 'progressive'),
                        '300' => __('Light', 'progressive')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Font', 'progressive' ),
					'param_name' => 'font',
					'admin_label' => true,
					'value' => array_flip(ts_get_font_choices(true)),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin top (px)', 'progressive' ),
					'param_name' => 'margin_top',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin bottom (px)', 'progressive' ),
					'param_name' => 'margin_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'progressive' ),
					'param_name' => 'align',
					'admin_label' => true,
					'value' => array_flip(array(
                        'left' => __('Left', 'progressive'),
                        'center' => __('Center', 'progressive'),
                        'right' => __('Right', 'progressive')
                    )),
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Replace', 'progressive' ),
					'param_name' => 'replace',
					'admin_label' => false,
					'description' => __( 'This text will be replaced with rotating text', 'progressive' ),
					'group' => __( 'Text rotation', 'progressive' ),
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Replace with', 'progressive' ),
					'param_name' => 'replace_with',
					'admin_label' => false,
					'description' => __( 'Use one phrase per line', 'progressive' ),
					'group' => __( 'Text rotation', 'progressive' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'rotating_style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'solid' => __('Solid', 'progressive'),
                        'outlined' => __('Outlined', 'progressive')
                    )),
					'group' => __( 'Text rotation', 'progressive' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'rotating_color',
					'admin_label' => false,
					'group' => __( 'Text rotation', 'progressive' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'progressive' ),
					'param_name' => 'rotating_text_color',
					'admin_label' => false,
					'group' => __( 'Text rotation', 'progressive' ),
				),
			)
		)
	);


/*----------------------------------------------------------------------------*
 * Testimonials
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Testimonials', 'progressive'),
			'base' => 'testimonials_posts',
			'class' => '',
			"icon" => "xv_vc_icon",
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                                                 	                                      		
                   		__('Carousel with Pagination'   , 'progressive') 	=> 'style1',
                   		__('Carousel with Navigation'   , 'progressive') 	=> 'style2',
                   		__('Carousel with Navigation & Pagination'   , 'progressive') 	=> 'style3',  
                   		__('Carousel with Auto Scroll'   , 'progressive') 	=> 'style4',  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background', 'progressive' ),
					'param_name' => 'bg',
					'admin_label' => true,
					'value' => array(
                                                 	                                      		
                   		__('Border'   , 'progressive') 	 => '',
                   		__('Backgorund'   , 'progressive') => '1',
                   
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),

					array(
					'type' => 'dropdown',
					'heading' => __( 'Name & Designation Style', 'progressive' ),
					'param_name' => 'white',
					'admin_label' => true,
					'value' => array(
                                                 	                                      		
                   		__('Normal'   , 'progressive') 	=> '',
                   		__('Light'   , 'progressive') 	=> 'white',
                
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text Color', 'progressive' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'progressive' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				
			)
		)
	);


/*----------------------------------------------------------------------------*
 * Text with size
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Text', 'progressive'),
			'base' => 'text',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Paragraph Font Size', 'progressive' ),
					'param_name' => 'pfont',
					'admin_label' => false,
					'value' => array(     
                        	'8px' => __('8px', 'progressive'),
                        	'9px' => __('9px', 'progressive'),
		                	'10px' => __('10px', 'progressive'),
		                	'11x' => __('11px', 'progressive'),
                        	'12px' => __('12px', 'progressive'),
		                	'13px' => __('13px', 'progressive'),
		                	'14px' => __('14px', 'progressive'),
                        	'15px' => __('15px', 'progressive'),
		                	'16px' => __('16px', 'progressive'),
		                	'17px' => __('17px', 'progressive'),
		                	'18px' => __('18px', 'progressive'),
		                	'19px' => __('19px', 'progressive'),
		                	'20px' => __('20px', 'progressive'),
		                	'21px' => __('21px', 'progressive'),
		                	'22px' => __('22px', 'progressive'),
		                	'23px' => __('23px', 'progressive'),
        					'24px' => __('24px', 'progressive'),
                        
                    	),

				),
			)
		)
	);
	
	
	
/*----------------------------------------------------------------------------*
 * Call to Action
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Another Call To Action', 'progressive'),
			'base' => 'another_call_to_action',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button label', 'progressive' ),
					'param_name' => 'btn1_text',
					'admin_label' => true,
					'description' => ''
				),
			
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'btn1_url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button label', 'progressive' ),
					'param_name' => 'btn2_text',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'btn2_url',
					'admin_label' => false,
					'description' => ''
				),
			)			
		)
	);
		
	
/*----------------------------------------------------------------------------*
 * Container
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Container Text', 'progressive'),
			'base' => 'container',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Style1'   , 'progressive') 	=> '1',
                        __('Style2'  , 'progressive') 	=> '2',
                        __('Style3' , 'progressive') 	=> '3',
                        __('Style4', 'progressive') 	=> '4',
                        __('Style5' , 'progressive') 	=> '5',
                        __('Style6', 'progressive') 	=> '6',
                        __('Style7', 'progressive') 	=> '7',
                        __('Style8' , 'progressive') 	=> '8',
                        __('Style9', 'progressive') 	=> '9',
                          __('Style10', 'progressive') 	=> '10',
                          __('Style11 - rotated box', 'progressive') 	=> '11',
                          __('Style12 - rotated right box', 'progressive') 	=> '12',
                          __('Style13', 'progressive') 	=> '13',
                    ),
					'description' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'progressive' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => '',
					'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown',
					'dependency' => array( 'element' => 'style', 'value' => array('12'))
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon color', 'progressive' ),
					'param_name' => 'icon_color',
					'admin_label' => true,
					'description' => '',
					'dependency' => array( 'element' => 'style', 'value' => array('12'))
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Content', 'progressive' ),
					'param_name' => 'content_box',
					'admin_label' => true,
					'description' => ''
				),
				
			)			
		)
	);
/*----------------------------------------------------------------------------*
 * Posts List
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Post list', 'progressive'),
			'base' => 'post_list',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Number of Posts', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Carousel pagination', 'progressive' ),
					'param_name' => 'carousel_pagination',
					'admin_label' => true,
					'value' => array(
                        __('yes'   , 'progressive') 	=> 'yes',
                        __('no'  , 'progressive') 	=> 'no'
                    )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Carousel navigation', 'progressive' ),
					'param_name' => 'carousel_navigation',
					'admin_label' => true,
					'value' => array(
                        __('yes'   , 'progressive') 	=> 'yes',
                        __('no'  , 'progressive') 	=> 'no'
                    )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Image align', 'progressive' ),
					'param_name' => 'image_align',
					'admin_label' => true,
					'value' => array(
                        __('Left'   , 'progressive') 	=> 'left',
                        __('Right'  , 'progressive') 	=> 'right'
                    )
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Post Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Banner Carousel', 'progressive'),
			'base' => 'banner_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Carousel Style', 'progressive' ),
					'param_name' => 'carousel_style',
					'admin_label' => true,
					'value' => array(
						__('Normal', 'progressive') => '',
						__('Mini', 'progressive') => 'mini'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Full width lines', 'progressive' ),
					'param_name' => 'full_width_lines',
					'admin_label' => true,
					'value' => array(
						__('Disabled', 'progressive') => '',
						__('Enabled', 'progressive') => 'enabled'
                    ),
					'description' => ''
				),
 				array(
				 	'type' => 'textfield',
				 	'heading' => __( 'Category ID', 'progressive' ),
				 	'param_name' => 'category',
				 	'admin_label' => true,
				 	'description' => ''
				 ),
				 array(
				 	'type' => 'textfield',
				 	'heading' => __( 'Number of Posts', 'progressive' ),
				 	'param_name' => 'limit',
				 	'admin_label' => true,
				 	'description' => ''
				 )

			)
		)
	);
	
/*----------------------------------------------------------------------------*
 * Post Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Woo Product Post Carousel', 'progressive'),
			'base' => 'post_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Carousel Style', 'progressive' ),
					'param_name' => 'carousel_style',
					'admin_label' => true,
					'value' => array(
						__('Normal', 'progressive') => '',
						__('Mini', 'progressive') => 'mini'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Full width lines', 'progressive' ),
					'param_name' => 'full_width_lines',
					'admin_label' => true,
					'value' => array(
						__('Disabled', 'progressive') => '',
						__('Enabled', 'progressive') => 'enabled'
                    ),
					'description' => ''
				),
 				array(
				 	'type' => 'textfield',
				 	'heading' => __( 'Category ID', 'progressive' ),
				 	'param_name' => 'category',
				 	'admin_label' => true,
				 	'description' => ''
				 ),
				 array(
				 	'type' => 'textfield',
				 	'heading' => __( 'Number of Posts', 'progressive' ),
				 	'param_name' => 'limit',
				 	'admin_label' => true,
				 	'description' => ''
				 )

			)
		)
	);
	
	
	/**
	 * tabs
	 */
	vc_map(
		array(
			"name" => __("Tabs (theme)", "framework"),
			"base" => "tabs",
			"as_parent" => array('only' => 'tab'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "framework"),
					"param_name" => "style",
					'admin_label' => true,
					"value" => array_flip(array(
                        'horizontal' => __('Horizonal', 'framework'),
                        'tabs_left' => __('Vertical left', 'framework'),
                        'tabs_right' => __('Vertical right', 'framework'),
                    )),
					"description" => __("Select the default style for this tabs group", "framework")
				)
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	vc_map( 
		array(
			"name" => __("Tab", "framework"),
			"base" => "tab",
			"content_element" => true,
			"as_child" => array('only' => 'tabs'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Tab Title", "framework"),
					"param_name" => "title",
					'admin_label' => true,
					"description" => __("Enter title for this tab.", "framework")
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Tab Content', 'framework' ),
					'param_name' => 'content',
					'value' => ''
				),
			)
		) 
	);
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tabs extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_tab extends WPBakeryShortCode {
		}
	}
	
/*----------------------------------------------------------------------------*
 * Team Post Loop
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Team Post Loop', 'progressive'),
			'base' => 'team_post_loop',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Number of Posts','limit'),

			)
		)
	);

/*----------------------------------------------------------------------------*
 * Team Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Team Post Carousel', 'progressive'),
			'base' => 'team_post_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Number of Posts','limit'),

			)
		)
	);

/*----------------------------------------------------------------------------*
 * Client Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Client Post Carousel', 'progressive'),
			'base' => 'client_post_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Number of Posts','limit'),
				ts_get_vc_map_textfield('Thumb Width (optional)','width'),
				ts_get_vc_map_textfield('Height (optional)','height'),
					array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('clients_category'),
					'description' => ''
				),
			)
		)
	);
	//////////////////
		vc_map( 
		array(
			'name' => __('Client Posts', 'progressive'),
			'base' => 'client_posts',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Number of Posts','limit'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('clients_category'),
					'description' => ''
				),
				ts_get_vc_map_textfield('Thumb Width (optional)','width'),
				ts_get_vc_map_textfield('Height (optional)','height'),

			)

		)
	);
/*----------------------------------------------------------------------------*
 * Contact form
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Contact Form', 'progressive'),
			'base' => 'contact_form',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Email (Where your want to recive emails)','email'),

	
			)
		)
	);	

/*----------------------------------------------------------------------------*
 * Circular Skills
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Circular Skills', 'progressive'),
			'base' => 'skills_circular',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Percentage','percent'),
				ts_get_vc_map_colorpicker('Color','color'),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Workflow Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Workflow', 'progressive'),
			'base' => 'workflow',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
			)
		)
	);
	
/*----------------------------------------------------------------------------*
 * Services Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Services Carousel', 'progressive'),
			'base' => 'services_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Number of Posts','limit'),
				
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Sitemap
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Sitemap', 'progressive'),
			'base' => 'sitemap',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
						'type' => 'dropdown',
						'heading' => __( 'Sitemap', 'progressive' ),
						'param_name' => 'sitemap',
						'admin_label' => true,
						'value' => array(
							__('Pages'   , 'progressive') 	=> 'pages',
	                        __('Posts'  , 'progressive')   	=> 'posts',
	                      //  __('Categories'   , 'progressive') 	=> 'categories',
	                     //   __('Archives'  , 'progressive')   	=> 'archives',
	                    ),
                     ),
				
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Newsletter
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Newsletter', 'progressive'),
			'base' => 'newsletter',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Newsletter ID','id'),
				
			)
		)
	);
/*----------------------------------------------------------------------------*
 * Contact Info
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Contact Info', 'progressive'),
			'base' => 'contact_info',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textarea',
					'heading' => __( 'Address', 'progressive' ),
					'param_name' => 'address',
					'admin_label' => false,

				),

				
			array(
						'type' => 'textarea',
						'heading' => __( 'Phone', 'progressive' ),
						'param_name' => 'phone',
						'admin_label' => false,

					),
	//			ts_get_vc_map_textfield('Email','email'),
				
			)
		)
	);	
	
/*----------------------------------------------------------------------------*
 * Portfolio Filter
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Portfolio Grid With Filter', 'progressive'),
			'base' => 'portfolio_filter',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Number of Posts','limit',null,true),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Style', 'progressive' ),
						'param_name' => 'style',
						'admin_label' => true,
						'value' => array(
							__('4 Columns'   , 'progressive') 	=> '4col',
	                        __('3 Columns'  , 'progressive')   	=> '3col',
	                        __('2 Columns'   , 'progressive') 	=> '2col',
	                        __('1 Column'  , 'progressive')   	=> '1col',
	                    ),
                     ),
				
                    array(
						'type' => 'dropdown',
						'heading' => __( 'Filter Color', 'progressive' ),
						'param_name' => 'filter_style',
						'admin_label' => true,
						'value' => array(
							__('Normal'   , 'progressive') 	=> '',
							__('Light'  , 'progressive')   	=> 'white',

						)
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Filter', 'progressive' ),
						'param_name' => 'filter',
						'admin_label' => true,
						'description' => 'Enable or disable filter',
						'value' => array(
							__('Enabled'   , 'progressive') 	=> 'enabled',
							__('Disabled'  , 'progressive')  	=> 'disabled'
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Year filter', 'progressive' ),
						'param_name' => 'year_filter',
						'admin_label' => true,
						'description' => 'Enable or disable year filter',
						'value' => array(
							__('Enabled'   , 'progressive') 	=> 'enabled',
							__('Disabled'  , 'progressive')  	=> 'disabled'
						)
					),


				ts_get_vc_map_textfield('Excerpt Length','limit2'),
			)
		)
	);	
/*----------------------------------------------------------------------------*
 * Portfolio carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Portfolio Carousel', 'progressive'),
			'base' => 'portfolio_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('portfolio_category'),
					'description' => ''
				),

			)
		)
	);
	
/*----------------------------------------------------------------------------*
 * Portfolio item
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Portfolio Item', 'progressive'),
			'base' => 'portfolio_item',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('ID','id',null,true),
			)
		)
	);
	
/*----------------------------------------------------------------------------*
 * Portfolio carousel2
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Portfolio Carousel 2', 'progressive'),
			'base' => 'portfolio_carousel2',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('portfolio_category'),
					'description' => ''
				),

			)
		)
	);
	

/*----------------------------------------------------------------------------*
 * Pricing Tables
 *----------------------------------------------------------------------------*/
	
	vc_map( 
		array(
			'name' => __('Pricing Table', 'progressive'),
			'base' => 'pricing_table',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => get_template_directory_uri() . '/inc/vc/assets/js/skills.js',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Subtitle','subtitle'),
				ts_get_livicons(),
				ts_get_vc_map_textfield('Price','price'),
				ts_get_vc_map_textfield('Duration','duration'),
				ts_get_vc_map_icons(),
				array(
					'type' => 'textarea',
					'heading' => __( 'Features', 'progressive' ),
					'param_name' => 'values',
					'admin_label' => false,
					'description' => 'Add one feature at one line. Add * to highlight feature.',
					"value" => __("*Responsive Design\nColor Customization\n*HTML5 & CSS3\n*Styled elements\nEasy Setup", 'progressive'),
					'group' => 'Features List',

				),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
						__('Red', 'progressive') => 	'',
						__('Green', 'progressive') => 'success',
						__('Blue', 'progressive') => 	'info',
                    ),
					'description' => '',

				),
				ts_get_vc_map_textfield('Read more Text','more_btn','Table Bottom'),
				ts_get_vc_map_textfield('Read More URL','more_url','Table Bottom'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Stars', 'progressive' ),
					'param_name' => 'stars',
					'admin_label' => true,
					'value' => array(
						__('1 Star', 'progressive') => '20',
						__('2 Stars', 'progressive') => '40',
						__('3 Stars', 'progressive') => '60',
						__('4 Stars', 'progressive') => '80',
						__('5 Stars', 'progressive') => '100',
                    ),
					'description' => '',
					'group' => 'Table Bottom',
				),
				ts_get_vc_map_textfield('Table Button Text','table_btn_text','Table Bottom'),
				ts_get_vc_map_textfield('Table Button URL','table_btn_url','Table Bottom'),
			


			)
		)
	);	



/*----------------------------------------------------------------------------*
 * Pricing Tables 2
 *----------------------------------------------------------------------------*/
	
	vc_map( 
		array(
			'name' => __('Pricing Table 2', 'progressive'),
			'base' => 'pricing_table2',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => get_template_directory_uri() . '/inc/vc/assets/js/skills.js',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				ts_get_vc_map_textfield('Subtitle','subtitle'),
				//ts_get_livicons(),
				ts_get_vc_map_textfield('Price','price'),
				ts_get_vc_map_textfield('Duration','duration'),
				ts_get_vc_map_icons(),
				array(
					'type' => 'textarea',
					'heading' => __( 'Features', 'progressive' ),
					'param_name' => 'values',
					'admin_label' => false,
					"value" => __("*Responsive Design\nColor Customization\n*HTML5 & CSS3\n*Styled elements\nEasy Setup", 'progressive'),

				),


				ts_get_vc_map_textfield('Read more Text','more_btn','Table Bottom'),
				ts_get_vc_map_textfield('Read More URL','more_url','Table Bottom'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Stars', 'progressive' ),
					'param_name' => 'stars',
					'admin_label' => true,
					'value' => array(
						__('1 Star', 'progressive') => '20',
						__('2 Stars', 'progressive') => '40',
						__('3 Stars', 'progressive') => '60',
						__('4 Stars', 'progressive') => '80',
						__('5 Stars', 'progressive') => '100',
                    ),
					'description' => '',
					'group' => 'Table Bottom',
				),
			


			)
		)
	);	

/*----------------------------------------------------------------------------*
 * Gallery
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Gallery', 'progressive'),
			'base' => 'gallery',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('gallery_category'),
					'description' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                       	__('Small'   , 'progressive') 	=> 'small',
                        __('Big'  , 'progressive')   	=> 'big',
                    
                    ),
					'description' => ''
				),

	//				ts_get_vc_map_textfield('Thumb Width (optional)','width'),
	//			ts_get_vc_map_textfield('Height (optional)','height'),

			
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Gallery Grid
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Gallery Grid', 'progressive'),
			'base' => 'gallery_grid',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('gallery_category'),
					'description' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                       	__('4 Columns'   , 'progressive') 	=> '4col',
                        __('3 Columns'  , 'progressive')   	=> '3col',
                        __('2 Columns'   , 'progressive') 	=> '2col',
                        __('1 Column'  , 'progressive')   	=> '1col',
                       	__('Modern Gallery'   , 'progressive') 	=> 'modern',
                    
                    ),
					'description' => ''
				),

				ts_get_vc_map_textfield('Limit','limit'),

				array(
					'type' => 'dropdown',
					'heading' => __( 'Post Order', 'progressive' ),
					'param_name' => 'order',
					'admin_label' => false,
					'value' => array(
                       	__('ASC'   , 'progressive') 	=> 'ASC',
                        __('DESC'  , 'progressive')  	=> 'DESC',
                    
                    ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'progressive' ),
					'param_name' => 'pagination',
					'admin_label' => false,
					'description' => 'Enable or disable pagination',
					'value' => array(
                       	__('No'   , 'progressive') 	=> '',
                        __('Yes'  , 'progressive')  	=> '1',
                    
                    ),
				),
				ts_get_vc_map_textfield('Thumb Height (optional)','thumb_height'),


			
			)
		)
	);
/*----------------------------------------------------------------------------*
 * Gallery
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Gallery Carousel', 'progressive'),
			'base' => 'gallery_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				ts_get_vc_map_textfield('Title','title'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories('gallery_category'),
					'description' => ''
				),

			)
		)
	);

/*----------------------------------------------------------------------------*
 * FAQ
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('FAQ', 'progressive'),
			'base' => 'faq',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings()
			)
		)
	);



/*----------------------------------------------------------------------------*
 * Sevices
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Services', 'progressive'),
			'base' => 'service',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Style1'   , 'progressive') 	=> '1',
                        __('Style2'  , 'progressive') 	=> '2',
                        __('Style3' , 'progressive') 	=> '3',
                        __('Style4', 'progressive') 	=> '4',
                        __('Style5' , 'progressive') 	=> '5',
                        __('Style6', 'progressive') 	=> '6',
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style Color', 'progressive' ),
					'param_name' => 'style_color',
					'admin_label' => true,
					'value' => array(
                        __('Normal'   , 'progressive') 	=> '',
                        __('Light'  , 'progressive') 	=> 'white',
                    ),
					'description' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'progressive' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => '',
					'edit_field_class' => 'vc_col-sm-12 vc_column icons-dropdown',
				),
			
					ts_get_livicons(),
					ts_get_vc_map_colorpicker('Icon Color','livicon_color','Livicons'),


				array(
					'type' => 'dropdown',
					'heading' => __( 'Livicons Size', 'progressive' ),
					'param_name' => 'livicon_size',
					'group' => 'Livicons',
					'value' => array(
                        __('44'   , 'progressive') 	=> '44',
                        __('54'  , 'progressive') 	=> '54',
                        __('64'  , 'progressive') 	=> '64',
                    ),
					'description' => ''
				),


				
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Description', 'progressive' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text (no button if empty)', 'progressive' ),
					'param_name' => 'button_text',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				// //Severice Styling
				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Icon Color', 'progressive' ),
				// 	'param_name' => 'icon_color',
				// 	'admin_label' => false,
				// 	'description' => '',
				// 	"group" => __( "Styling", 'progressive'),
				// ),

				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Icon Background Color', 'progressive' ),
				// 	'param_name' => 'icon_bg_color',
				// 	'admin_label' => false,
				// 	'description' => '',
				// 	"group" => __( "Styling", 'progressive'),
				// ),
				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Icon Border Color', 'progressive' ),
				// 	'param_name' => 'icon_border_color',
				// 	'admin_label' => false,
				// 	'description' => '',
				// 	"group" => __( "Styling", 'progressive'),
				// ),

				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Button Color', 'progressive' ),
				// 	'param_name' => 'read_btn_color',
				// 	'admin_label' => false,
				// 	'description' => '',
				// 	"group" => __( "Styling", 'progressive'),
				// ),

				// array(
				// 	'type' => 'colorpicker',
				// 	'heading' => __( 'Button Text Color', 'progressive' ),
				// 	'param_name' => 'read_txt_color',
				// 	'admin_label' => false,
				// 	'description' => '',
				// 	"group" => __( "Styling", 'progressive'),
				// ),

			)
		)
	);



/*----------------------------------------------------------------------------*
 * SModal1
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Modal', 'progressive'),
			'base' => 'modal',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Description', 'progressive' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text ', 'progressive' ),
					'param_name' => 'button_text',
					'admin_label' => false,
					'description' => ''
				),
				

			)
		)
	);


/*----------------------------------------------------------------------------*
 * Modal2
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Modal2', 'progressive'),
			'base' => 'modal2',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Description', 'progressive' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text ', 'progressive' ),
					'param_name' => 'button_text',
					'admin_label' => false,
					'description' => ''
				),
				
					array(
					'type' => 'attach_image',
					'heading' => __( 'Background Image', 'progressive' ),
					'param_name' => 'image',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);


/*----------------------------------------------------------------------------*
 * Recent Posts2
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Recent Posts2', 'progressive'),
			'base' => 'recent_posts2',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => false,
					'value' => array(
						__('2 Column'   , 'progressive') 	=> 'col-md-6',
                        __('1 Column'  , 'progressive')   	=> 'col-md-12',
                     
                    ),
					'description' => '',
				),	
				
				array(
					'type' => 'textfield',
					'heading' => __( 'Excerpt length', 'progressive' ),
					'param_name' => 'length',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Number of Posts', 'progressive' ),
					'param_name' => 'count',
					'admin_label' => false,
					'description' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'All Post Button Text', 'progressive' ),
					'param_name' => 'blog_text',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'All Post Button URL', 'progressive' ),
					'param_name' => 'blog_url',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Recent Posts
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Recent Posts', 'progressive'),
			'base' => 'recent_posts',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				  array(
					'type' => 'dropdown',
					'heading' => __( 'Post Style', 'progressive' ),
					'param_name' => 'post_style',
					'admin_label' => false,
					'value' => array(
						__('Normal'   , 'progressive') 	=> '',
                        __('Light'  , 'progressive')   	=> 'latest-posts-white',
                     
                    ),
					'description' => '',
				),	
				array(
					'type' => 'textfield',
					'heading' => __( 'Excerpt length', 'progressive' ),
					'param_name' => 'length',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'count',
					'admin_label' => false,
					'description' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'All Post Button Text', 'progressive' ),
					'param_name' => 'blog_text',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'All Post Button URL', 'progressive' ),
					'param_name' => 'blog_url',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Posts Slider
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Progressive Posts Slider', 'progressive'),
			'base' => 'posts_slider',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			  "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Carousel with Image'   , 'progressive') 	=> 'normal',
                        __('Carousel with Image Full Width'   , 'progressive') 	=> 'wide',                         	                                      		
                   		__('Carousel with Pagination'   , 'progressive') 	=> 'style1',
                   		__('Carousel with Navigation'   , 'progressive') 	=> 'style2',
                   		__('Carousel with Navigation & Pagination'   , 'progressive') 	=> 'style3',  
                   		__('Carousel with Auto Scroll'   , 'progressive') 	=> 'style4',  
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Excerpt length', 'progressive' ),
					'param_name' => 'length',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Number of Posts', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'progressive' ),
					'param_name' => 'category',
					'admin_label' => true,
					'value' => ts_get_post_type_categories(),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Autoplay', 'progressive' ),
					'param_name' => 'autoplay',
					'admin_label' => true,
					'value' => array(
						__('Disabled', 'progressive') => '',
						__('Enabled', 'progressive') => 'enabled'
                    ),
					'description' => ''
				)
			)

		)
	);

/*----------------------------------------------------------------------------*
 * Woo Products
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Woo Products', 'progressive'),
			'base' => 'woo_products',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
								array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Large'   , 'progressive') 	=> 'style1',
                        __('Medium'   , 'progressive') 	=> 'style2',                        
                        __('Small'  , 'progressive') 	=> 'style3',                  
                        __('Small Alt. Columns Layout'  , 'progressive') 	=> 'style4',                  
                    ),
					'description' => ''
				),
	
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order By', 'progressive' ),
					'param_name' => 'orderby',
					'admin_label' => true,
					'value' => array(
                        __('Date'   , 'progressive') 	=> 'date',
                        __('Price'  , 'progressive') 	=> 'price',
                        __('Random' , 'progressive') 	=> 'rand',
                        __('Sales', 'progressive') 	=> 'sales',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Show', 'progressive' ),
					'param_name' => 'show',
					'admin_label' => true,
					'value' => array(
                        __('All Products'   , 'progressive') 	=> '',
                        __('Featured Products'  , 'progressive') 	=> 'featured',
                        __('On-sale Products', 'progressive') 	=> 'onsale',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting Order', 'progressive' ),
					'param_name' => 'order',
					'admin_label' => true,
					'value' => array(
                        __('ASC'   , 'progressive') 	=> 'asc',
                        __('DESC', 'progressive') 	=> 'desc',
                  

                    ),
					'description' => ''
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Woo Products Carousel
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Woo Products Carousel', 'progressive'),
			'base' => 'woo_products_carousel',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
								array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'progressive' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Large'   , 'progressive') 	=> 'style2',
                        __('Medium'   , 'progressive') 	=> 'style1',
                        __('Small'  , 'progressive') 		=> 'style3'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Double Row', 'progressive' ),
					'param_name' => 'double_product',
					'admin_label' => false,
					'value' => array(
                        __('No'   , 'progressive') 	=> 'no',   
                        __('Yes'   , 'progressive') 	=> 'yes',
                                           
                  
                    ),
					'description' => ''
				),
//				array(
//					'type' => 'textfield',
//					'heading' => __( 'Excerpt length', 'progressive' ),
//					'param_name' => 'length',
//					'admin_label' => false,
//					'description' => ''
//				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order By', 'progressive' ),
					'param_name' => 'orderby',
					'admin_label' => true,
					'value' => array(
                        __('Date'   , 'progressive') 	=> 'date',
                        __('Price'  , 'progressive') 	=> 'price',
                        __('Random' , 'progressive') 	=> 'rand',
                        __('Sales', 'progressive') 	=> 'sales',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Show', 'progressive' ),
					'param_name' => 'show',
					'admin_label' => true,
					'value' => array(
                        __('All Products'   , 'progressive') 	=> '',
                        __('Featured Products'  , 'progressive') 	=> 'featured',
                        __('On-sale Products', 'progressive') 	=> 'onsale',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting Order', 'progressive' ),
					'param_name' => 'order',
					'admin_label' => true,
					'value' => array(
                        __('ASC'   , 'progressive') 	=> 'asc',
                        __('DESC', 'progressive') 	=> 'desc',
                  

                    ),
					'description' => ''
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Woo Products 2
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Woo Products 2', 'progressive'),
			'base' => 'woo_products_2',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_delay_item_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order By', 'progressive' ),
					'param_name' => 'orderby',
					'admin_label' => true,
					'value' => array(
                        __('Date'   , 'progressive') 	=> 'date',
                        __('Price'  , 'progressive') 	=> 'price',
                        __('Random' , 'progressive') 	=> 'rand',
                        __('Sales', 'progressive') 	=> 'sales',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Show', 'progressive' ),
					'param_name' => 'show',
					'admin_label' => true,
					'value' => array(
                        __('All Products'   , 'progressive') 	=> '',
                        __('Featured Products'  , 'progressive') 	=> 'featured',
                        __('On-sale Products', 'progressive') 	=> 'onsale',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting Order', 'progressive' ),
					'param_name' => 'order',
					'admin_label' => true,
					'value' => array(
                        __('ASC'   , 'progressive') 	=> 'asc',
                        __('DESC', 'progressive') 	=> 'desc',
                  

                    ),
					'description' => ''
				)
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Woo Products Widget
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Woo Products Widget', 'progressive'),
			'base' => 'woo_products_widget',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			"icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'progressive' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order By', 'progressive' ),
					'param_name' => 'orderby',
					'admin_label' => true,
					'value' => array(
                        __('Date'   , 'progressive') 	=> 'date',
                        __('Price'  , 'progressive') 	=> 'price',
                        __('Random' , 'progressive') 	=> 'rand',
                        __('Sales', 'progressive') 	=> 'sales',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Show', 'progressive' ),
					'param_name' => 'show',
					'admin_label' => true,
					'value' => array(
                        __('All Products'   , 'progressive') 	=> '',
                        __('Featured Products'  , 'progressive') 	=> 'featured',
                        __('On-sale Products', 'progressive') 	=> 'onsale',
                  
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Sorting Order', 'progressive' ),
					'param_name' => 'order',
					'admin_label' => true,
					'value' => array(
                        __('ASC'   , 'progressive') 	=> 'asc',
                        __('DESC', 'progressive') 	=> 'desc',
                  

                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'progressive' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Anchor text', 'progressive' ),
					'param_name' => 'anchor_text',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);

/*----------------------------------------------------------------------------*
 * Person
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Person', 'progressive'),
			'base' => 'person',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Person ID', 'progressive' ),
					'param_name' => 'id',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
/*----------------------------------------------------------------------------*
 * Team Member
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Team Member', 'progressive'),
			'base' => 'team',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				//ts_get_vc_animation_effects_settings(),
				//ts_get_vc_animation_delay_settings(),
				//ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Name', 'progressive' ),
					'param_name' => 'name',
					'admin_label' => true,
					'description' => ''
				),
					
				array(
					'type' => 'textfield',
					'heading' => __( 'Designation', 'progressive' ),
					'param_name' => 'designation',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'About Member', 'progressive' ),
					'param_name' => 'about',
					'admin_label' => true,
					'description' => ''
				),
				array(
                  "type" => "attach_image",
                 // "holder" => "div",
                  "class" => "",
                  "heading" => __("Image", 'progressive'),
                  "param_name" => "member_img",
                  "description" => __("Upload team member Image.", 'progressive')
              	),
					
				array(
					'type' => 'textfield',
					'heading' => __( 'Email', 'progressive' ),
					'param_name' => 'email',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Phone', 'progressive' ),
					'param_name' => 'phone',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Facebook', 'progressive' ),
					'param_name' => 'facebook',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Twitter', 'progressive' ),
					'param_name' => 'twitter',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Google Plus', 'progressive' ),
					'param_name' => 'gplus',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Linked In', 'progressive' ),
					'param_name' => 'linkedin',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
			)
		)
	);
	
	
/*----------------------------------------------------------------------------*
 * Team Member
 *----------------------------------------------------------------------------*/
	vc_map( 
		array(
			'name' => __('Team Member with Text', 'progressive'),
			'base' => 'team_text',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Text content', 'progressive' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => __( 'Name', 'progressive' ),
					'param_name' => 'name',
					'admin_label' => true,
					'description' => ''
				),
					
				array(
					'type' => 'textfield',
					'heading' => __( 'Designation', 'progressive' ),
					'param_name' => 'designation',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'About Member', 'progressive' ),
					'param_name' => 'about',
					'admin_label' => true,
					'description' => ''
				),
				array(
                  "type" => "attach_image",
                 // "holder" => "div",
                  "class" => "",
                  "heading" => __("Image", 'progressive'),
                  "param_name" => "member_img",
                  "description" => __("Upload team member Image.", 'progressive')
              	),
					
				array(
					'type' => 'textfield',
					'heading' => __( 'Email', 'progressive' ),
					'param_name' => 'email',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Phone', 'progressive' ),
					'param_name' => 'phone',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Facebook', 'progressive' ),
					'param_name' => 'facebook',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Twitter', 'progressive' ),
					'param_name' => 'twitter',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Google Plus', 'progressive' ),
					'param_name' => 'gplus',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Linked In', 'progressive' ),
					'param_name' => 'linkedin',
					'admin_label' => true,
					'description' => '',
				//	"group" => __( "Contact Details", 'progressive'),
				),
			)
		)
	);
	
	
/*----------------------------------------------------------------------------*
 * tiles
 *----------------------------------------------------------------------------*/
	vc_map(
		array(
			"name" => __("Tiles", "framework"),
			"base" => "tiles",
			"as_parent" => array('only' => 'tiles_slider'),
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image 1 (270x150px)', 'progressive' ),
					'param_name' => 'image_1',
					'admin_label' => false,
					'description' => ''
				),
				ts_get_vc_map_textfield(__('URL 1', 'progressive'),'url_1'),
				ts_get_vc_element_target(__('Target 1', 'progressive'),'target_1'),
				ts_get_vc_map_colorpicker(__( 'Background color 1', 'progressive' ),'background_color_1'),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image 2 (270x150px)', 'progressive' ),
					'param_name' => 'image_2',
					'admin_label' => false,
					'description' => ''
				),
				ts_get_vc_map_textfield(__('URL 2', 'progressive'),'url_2'),
				ts_get_vc_element_target(__('Target 2', 'progressive'),'target_2'),
				ts_get_vc_map_colorpicker(__( 'Background color 2', 'progressive' ),'background_color_2'),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image 3 (270x150px)', 'progressive' ),
					'param_name' => 'image_3',
					'admin_label' => false,
					'description' => ''
				),
				ts_get_vc_map_textfield(__('URL 3', 'progressive'),'url_3'),
				ts_get_vc_element_target(__('Target 3', 'progressive'),'target_3'),
				ts_get_vc_map_colorpicker(__( 'Background color 3', 'progressive' ),'background_color_3')
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tiles extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Tiles Slider", "framework"),
			"base" => "tiles_slider",
			"content_element" => true,
			"as_child" => array('only' => 'tiles'),
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'progressive' ),
					'param_name' => 'image',
					'admin_label' => true,
					'description' => ''
				),
				ts_get_vc_map_textfield(__('URL', 'progressive'),'url','',true),
				ts_get_vc_element_target(__('Target', 'progressive'),'target','',true),
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_tiles_slider extends WPBakeryShortCode {
		}
	}

	vc_map( 
		array(
			'name' => __('Progressive Menu', 'progressive'),
			'base' => 'progressive_menu',
			'class' => '',
			'category' => __('Content', 'progressive'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			 "icon" => "xv_vc_icon",
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				ts_get_vc_animation_delay_settings(),
				ts_get_vc_animation_iteration_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'progressive' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				ts_get_vc_menus_dropdown()
			)
		)
	);

	$setting = ts_get_vc_map_colorpicker('Section Color','color');
	vc_add_param( 'vc_accordion_tab', $setting );
				
	$row_map =	array(
		'type' => 'dropdown',
		'heading' => __('Break Container', 'progressive'),
		'param_name' => 'container',
		'admin_label' => true,
		'value' => array(
			__('No', 'progressive') => 'no',
			__('Yes', 'progressive') => 'yes',
		),
		'description' => ''
	);

	vc_add_param( 'vc_row', $row_map );

}