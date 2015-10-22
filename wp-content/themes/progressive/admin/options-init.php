<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        /*
        function compiler_action($options, $css) {

             global $xv_data; 
                   
            $uploads = wp_upload_dir();
            $css_dir = get_template_directory() . '/admin/assets/css/'; // Shorten code, save 1 call
       
            if(is_multisite()) {
            $aq_uploads_dir =$css_dir;
            } else {
            $aq_uploads_dir = $css_dir;
            }
            ob_start();
            require($css_dir . 'styles.php');
            $css = ob_get_clean();
  
            WP_Filesystem();
            global $wp_filesystem;
            if ( ! $wp_filesystem->put_contents( $aq_uploads_dir . 'options.css', $css, 0644) ) {
            return true;
            }
                     
        }
        */

        // function compiler_action($options, $css) {
        //     global $wp_filesystem;
        //     $filename = dirname(__FILE__) . '/assets/css/options.css';

        //     if( empty( $wp_filesystem ) ) {
        //         require_once( ABSPATH .'/wp-admin/includes/file.php' );
        //         WP_Filesystem();
        //     }

        //     if( $wp_filesystem ) {
        //         $wp_filesystem->put_contents(
        //             $filename,
        //             $css,
        //             FS_CHMOD_FILE // predefined mode settings for WP files
        //         );
        //     }
        // }

                function compiler_action($options, $css) {

           

               /** Define some vars **/
    //$$xv_data = $options;
    $uploads = wp_upload_dir();
    $css_dir = get_template_directory() . '/admin/assets/css/'; // Shorten code, save 1 call
    /** Save on different directory if on multisite **/
    if(is_multisite()) {
    $aq_uploads_dir =$css_dir;
    } else {
    $aq_uploads_dir = $css_dir;
    }
    /** Capture CSS output **/
    ob_start();
    require($css_dir . 'styles.php');
    $css = ob_get_clean();
    /** Write to options.css file **/
    WP_Filesystem();
    global $wp_filesystem;
    if ( ! $wp_filesystem->put_contents( $aq_uploads_dir . 'options.css', $css, 0644) ) {
    return true;
    }
             


        }
        

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'progressive'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'progressive'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'progressive'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'progressive'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'progressive'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'progressive') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'progressive'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            
  $this->sections[] = array(
            'title' => 'General Settings',
            'fields' => array( 
				array(
                    'desc' => 'Enable or Disable preloader',
                    'id' => 'preloader',
                    "default" => false,
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Preloader',
                ),
				array(
                    'desc' => 'Upload your logo.',
                    'id' => 'logo',
                    'type' => 'media',
                    'title' => 'Logo',
                    'url' => true,
                ),
                array(
                    'desc' => 'Upload your fav icon.',
                    'id' => 'fav_icon',
                    'type' => 'media',
                    'title' => 'Fav Icon',
                    'url' => true,
                ),
                array(
                    'desc' => 'Enter the phone number which will be visible at top bar.',
                    'id' => 'topbar-phone',
                    'type' => 'text',
                    'title' => 'Top Phone Number',
                ),
				array(
                    'desc' => 'Enable or Disable sticky menu',
                    'id' => 'sticky_menu',
                    "default" => 1,
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Sticky menu',
                ),
				array(
                    'desc' => 'Enable or Disable top bar',
                    'id' => 'switch-topbar',
                    "default" => 1,
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Top Bar',
                ),
				array(
                    'desc' => 'Top Bar must be enabled first to use this option',
                    'id' => 'topbar-always-on',
                    "default" => 0,
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Top Bar on',
                ),
				array(
                    'desc' => 'Enable or Disable promo panel',
                    'id' => 'promo_panel',
                    "default" => 0,
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Promo panel',
                ),
                array(
                    'desc' => 'Enter the Shortcode if you have any eg. [wpml_languages].',
                    'id' => 'language-options',
                    'type' => 'text',
                    'title' => 'Top Bar Shortcode 1',
                ),
                array(
                    'desc' => 'Enter the Shortcode if you have any.',
                    'id' => 'currency-options',
                    'type' => 'text',
                    'title' => 'Top Bar Shortcode 2',
                ),
            ),
            'icon' => 'el-icon-cog',
        );



///////////////////////////////////////---custom Code Blocks-----//////////////////////////////////////////////////////////////////////////

                $this->sections[] = array(
                    'icon' => 'el-icon-tint',
                    'title' => __('Code Editors', 'progressive'),
                    'fields' => array(
                    
                    array(
                        'id' => 'css-code',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'progressive'),
                        'subtitle' => __('Paste your CSS code here.', 'progressive'),
                        'mode' => 'css',
                        'compiler' =>true,
                        'theme' => 'monokai',
                    ),
                    array(
                        'id' => 'js-code',
                        'type' => 'ace_editor',
                        'title' => __('JS Code', 'progressive'),
                        'subtitle' => __('Paste your JS code here. Js will be included in footer.', 'progressive'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'default' => "jQuery(document).ready(function(){\n\n});"
                    ),
                  
                )
            );


///////////////////////////////////////---Styling Options-----//////////////////////////////////////////////////////////////////////////

            $this->sections[] = array(
                'icon' => 'el-icon-magic',
                'title' => __('Styling Options', 'progressive'),
                'fields' => array(
        
                 array(
                        'id' => 'layout',
                        'type' => 'image_select',
                        'title' => __('Layout', 'progressive'),
                        'options' => array(
                            'full' => array('alt' => 'Full', 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            'boxed' => array('alt' => 'Boxed', 'img' => ReduxFramework::$_url . 'assets/img/3cm.png'),
                            
                        ), //Must provide key => value(array:title|img) pairs for radio options
                        'default' => 'full'
                    ),

        
                    array(
                        'id' => 'skin',
                        'type' => 'color',
                        'compiler' => array(''),
                       // 'output' => array('.site-title'),
                        'title' => __('Theme Skin', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),
                   
				   /*Footer Gener styling option*/ 
					array(
                        'id' => 'footer-heading-color',
                        'type' => 'color',
                        //'compiler' => array('#footer .footer-top'),
                       'output' => array('#footer .sidebar .widget h3, #footer .sidebar .widget .title-block .title'),
                        'title' => __('Footer Heading Text Color', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),
					/*Footer top styling option*/
                    array(
                        'id' => 'footer-top-color',
                        'type' => 'background',
                        //'compiler' => array('#footer .footer-top'),
                       'output' => array('#footer .footer-top'),
                        'title' => __('Footer Top Background', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),
					array(
                        'id' => 'footer-top-text-color',
                        'type' => 'color',
                        //'compiler' => array('#footer .footer-top'),
                       'output' => array('#footer .footer-top,#footer .sidebar .menu li a, #footer .sidebar .menu li a:visited'),
                        'title' => __('Footer Top Text Color', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),
					
					/*Footer bottom styling option*/
					array(
                        'id' => 'footer-bottom-background',
                        'type' => 'background',
                        //'compiler' => array('#footer .footer-bottom'),
                       'output' => array('#footer .footer-bottom'),
                        'title' => __('Footer Bottom Background', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),

                     array(
                        'id' => 'footer-bottom-text-color',
                        'type' => 'color',
                       // 'compiler' => array(''),
                       'output' => array('#footer'),
                        'title' => __('Footer Bottom Text Color', 'progressive'),
                        //'default' => '',
                        'validate' => 'color',
                    ),



                    
                   array(   'id'       => 'opt-background',
                    'type'     => 'background',
                    'compiler' => true,
                    'output' => array('#boxed-bg'),
                    'title'    => __('Body Background', 'progressive'),
                    'subtitle' => __('Body background with image, color, etc.', 'progressive'),
                    'desc'     => __('This is the description field, again good for additional info.', 'progressive'),
                    'default'  => array(
                        'background-color' => '#1e73be',
                        ),
                    ),
                                                
                    
                     array(
                        'id'          => 'heading-typography',
                        'type'        => 'typography',
                        'title'       => __('Heading Typography', 'progressive'),
                        'google'      => true,
                        'font-backup' => true,
                        'font_family_clear' => true,
                        'output'      => array('h1,h2,h3,h4,h5'),
						'font-size'   => false,
						'font-style'  => false,
						'text-align'  => false,
						'line-height' => false,
                        'units'       =>'px',
                        'subtitle'    => __('Typography options.', 'progressive'),
                          'default'     => array(
                                'color'       => '',
                                'font-style'  => '',
                                'font-family' => 'Arimo',
                                'google'      => true,
                                'font-size'   => '',
                                'line-height' => ''
                            ),

                        ),
                    array(
                        'id'          => 'body-typography',
                        'type'        => 'typography',
                        'title'       => __('Body Typography', 'progressive'),
                        'google'      => true,
                        'font-backup' => true,
                        'font_family_clear' => true,
                        'output'      => array('body'),
                        'units'       =>'px',
                        'subtitle'    => __('Typography options.', 'progressive'),
                          'default'     => array(
                                'color'       => '',
                                'font-style'  => '',
                                'font-family' => 'Arimo',
                                'google'      => true,
                                'font-size'   => '14px',
                                'line-height' => ''
                            ),

                    ),

           
       
            ),
            
        );
			
///////////////////////////////////////---Promo panel-----//////////////////////////////////////////////////////////////////////////

            $this->sections[] = array(
				'icon' => 'el-icon-minus',
				'title' => __('Promo panel', 'framework'),
				'fields' => array(
					array(
						'id'       => 'promo_panel_icon_1',
						'type'     => 'select',
						'title'    => __( 'Icon', 'progressive' ).' 1',
						'subtitle' => '',
						'options'  => ts_getFontAwesomeArray(),
						'class'  => '',
					),
					array(  
						'title'     => __('Text', 'progressive').' 1',
						"subtitle"  => "",
						"id"        => "promo_panel_text_1",
						"std"       => "",                               
						"type"      => "text"
					),
					array(
						'id'       => 'promo_panel_icon_2',
						'type'     => 'select',
						'title'    => __( 'Icon', 'progressive' ).' 2',
						'subtitle' => '',
						'options'  => ts_getFontAwesomeArray(),
						'default'  => '',
					),
					array(  
						'title'     => __('Text', 'progressive').' 2',
						"subtitle"  => "",
						"id"        => "promo_panel_text_2",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('Facebook URL', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_facebook",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('Twitter URL', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_twitter",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('Google+ URL', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_google_plus",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('LinkedIn URL', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_linkedin",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('Button URL', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_button_url",
						"std"       => "",                               
						"type"      => "text"
					),
					array(  
						'title'     => __('Button Label', 'progressive'),
						"subtitle"  => "",
						"id"        => "promo_panel_button_label",
						"std"       => "",                               
						"type"      => "text"
					)
                )
            );
			
///////////////////////////////////////---Sidebars Blocks-----//////////////////////////////////////////////////////////////////////////

            $this->sections[] = array(
				'icon' => 'el-icon-pause',
				'title' => __('Sidebars', 'framework'),
				'fields' => array(

					array(
						'id'       => 'custom-sidebars',
						'type'     => 'multi_text',
						'title'    => __( 'Custom sidebars', 'framework' ),
						'subtitle' => __( 'Custom sidebars can be assigned to any page or post.', 'framework' ),
						'desc'     => __( 'You can add as many custom sidebars as you need.', 'framework' )
					)
                )
            );

///////////////////////////////////Shop Page/////////////////////////////////////////
            $this->sections[] = array(
                'icon' => 'el-icon-shopping-cart',
                'title' => __('Shop Settings', 'progressive'),
                'fields' => array(

                    array(
						'desc' => 'Enable or Disable cart in header',
						'id' => 'cart_in_header',
						"default" => false,
						'on' => 'Enable',
						'off' => 'Disable',
						'type' => 'switch',
						'title' => 'Cart in header',
					),

                    array(
                        'id' => 'shop-layout',
                        'type' => 'image_select',
                        'title' => __('Shop Layout', 'progressive'),
                        'options' => array(
                            '1' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            'shop9right' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'shop9left' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            
                        ), //Must provide key => value(array:title|img) pairs for radio options
                        'default' => '2'
                    ),

  
          
                         array(
                            'desc' => 'Upload your header image for blog. This will be visiable on all blog posts, archive and blog index page.',
                            'id' => 'shop_header_img',
                            'type' => 'media',
                            'title' => 'Shop Banner Image',
                            'url' => true,
                            'compiler' => 'true',
                           
                        ),        
                 
                        array(  
                                'title'     => __('Shop Banner Title', 'progressive'),
                                "subtitle"  => "Enter shop page title",
                                "id"        => "shop_page_top_title",
                                "std"       => "Shop",                               
                                "type"      => "text",
                               
                        ),



                )
            );
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->sections[] = array(
            'title' => 'Maintinace Mode',
            'fields' => array(
                

                array(
                    'desc' => 'Enable or Disable Maintinace Mode',
                    'id' => 'coming_soon_switch',
                    'on' => 'Enable',
                    'off' => 'Disable',
                    'type' => 'switch',
                    'title' => 'Maintinace Mode',
                ),
                    array(
                        'id' => 'info_warning',
                        'type' => 'info',
                        'style' => 'info',
                        'title' => __('Note:', 'progressive'),
                        'desc' => __('Only administrator will be able to visit site. If you want to check mantinance mode is enable or not please logout.', 'progressive')
                          ),

                array(
                    'desc' => 'Upload your logo for Maintinace mode',
                    'id' => 'coming_soon_logo',
                    'type' => 'media',
                    'title' => 'Maintinace Mode Logo',
                    'url' => true,
                ),


               /*
                array(
                    'desc' => 'Add main title for your page eg. Coming Soon!',
                    'id' => 'coming_soon_title',
                    'type' => 'text',
                    'title' => 'Title',
                    'default' => 'Coming soon',
                ),
                */
                array(
                    'desc' => 'Write somethig.',
                    'id' => 'coming_soon_des',
                    'type' => 'textarea',
                    'title' => 'Description',
                ),

               array(
                'id' => 'info_warning',
                'type' => 'info',
                'style' => 'info',
                'title' => __('Setting Date:', 'progressive'),
                'desc' => __('Always use future date. Otherwise count down counter will not work properly.', 'progressive'),
                  ),

    
         array(      
                        'title' => __('Timer ', 'progressive'),
                        "desc"      => "Enable or Disable Timer",
                        "id"        => "switch_timer",
                        "default"       => 1,
                        "on"        => "Enable",
                        "off"       => "Disable",
                        "type"      => "switch"
                ),
                
                    array(
                            'id' => 'hours',
                            'type' => 'slider',
                            'title' => __('Hours', 'progressive'),
                            'subtitle' => __('Set hours.', 'progressive'),
                            "default" => 23,
                            "min" => 0,
                            "step" => 1,
                            "max" => 23,
                            'display_value' => 'text',
                               'required' => array(
                                0 => 'switch_timer',
                                1 => '=',
                                2 => 1,
                            ),
                        ),
                    array(
                            'id' => 'mints',
                            'type' => 'slider',
                            'title' => __('Minutes', 'progressive'),
                            'subtitle' => __('Set Minutes.', 'progressive'),
                            "default" => 59,
                            "min" => 0,
                            "step" => 1,
                            "max" => 59,
                            'display_value' => 'text',
                               'required' => array(
                                0 => 'switch_timer',
                                1 => '=',
                                2 => 1,
                            ),
                        ),
                array(
                    'id'          => 'coming_soon_date',
                    'type'        => 'date',
                    'title'       => __('Date', 'progressive'), 
                    'subtitle'    => __('Always use future date', 'progressive'),
                    'desc'        => __('Launch date of your site.', 'progressive'),
                    'placeholder' => 'Select Date',
                    'required' => array(
                                0 => 'switch_timer',
                                1 => '=',
                                2 => 1,
                            ),
                ),

              array(
                'id'        => 'coming_soon_form',
                'type'      => 'text',
                'title'     => __('Subscibe Form Shortcode', 'progressive'),
                'subtitle'  => __('Enter your subscribe form shortcode.', 'progressive'),
            ),
                array(
                        'id' => 'info_warning',
                        'type' => 'info',
                        'style' => 'info',
                        'title' => __('More Options:', 'progressive'),
                        'desc' => __('Enable or disable anything which you want.', 'progressive')
                          ),
             
                array(
                    'desc' => 'Add your facebook url',
                    'id' => 'coming_soon_facebook',
                    'type' => 'text',
                    'title' => 'Facebook',
                ),
                array(
                    'desc' => 'Add your twitter url',
                    'id' => 'coming_soon_twitter',
                    'type' => 'text',
                    'title' => 'Twitter',
                ),
                   array(
                    'desc' => 'Add your gplus url',
                    'id' => 'coming_soon_gplus',
                    'type' => 'text',
                    'title' => 'Google+',
                ),
                array(
                    'desc' => 'Add your linkedin url',
                    'id' => 'coming_soon_linkedin',
                    'type' => 'text',
                    'title' => 'Linkedin',
                ),

              
           
       
            ),
            'icon' => 'el-icon-cog',
        );

        
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



            $this->sections[] = array(
                'title'     => __('Import / Export', 'progressive'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'progressive'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
					array(
                        'id'            => 'opt-import-sample-data',
                        'type'			=> 'raw',
                        'title'         => 'Import sample data',
						'content'		=> '
							<p class="description">'.__('Import sample data including posts, pages, portfolio items, theme options, images, sliders etc. It may take severals minutes!', 'framework').'</p>
							<p><span data-confirm="'.esc_attr__('Do you want to continue? Your data will be lost!', 'framework').'" data-import-url="'.  admin_url( 'themes.php?page=_options&import_sample_data=1' ) .'" id="import-sample-data" class="button button-primary">'.__('Import', 'progressive').'</span></p>'
                    ),
					
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'progressive'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'progressive')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'progressive'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'progressive')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'progressive');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'xv_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'progressive'),
                'page_title'        => __($theme->get('Name').' Theme Options', 'progressive'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         =>  get_template_directory_uri() . '/admin/assets/images/cd.png',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                'update_notice'     => true,
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => '#fff',
                        'shadow'        => true,
                        'rounded'       => true,
                        'style'         => 'background:#333C4E',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );



           

            // Panel Intro text -> before the form
            // if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
            //     if (!empty($this->args['global_variable'])) {
            //         $v = $this->args['global_variable'];
            //     } else {
            //         $v = str_replace('-', '_', $this->args['opt_name']);
            //     }
            //     $this->args['intro_text'] = sprintf(__('<p><strong>For free help and support kindly contact us via our <a href="http://xvelopers.com/support">Support Forums</a> and dont forget to rate our theme at themeforest.</p>', 'progressive'), $v);
            // } else {
            //     $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'progressive');
            // }

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
