<?php

new ts_custom_menu();

/**
 * Adds custom items to Menus edit screen (nav-menus.php)
 *
 * @package framework
 * @since framework 1.1
 */
class ts_custom_menu {

    /**
	 * Construct
	 */
    public function __construct() {

        add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_items'), 10, 3 );
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_edit_walker'), 10, 2 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'read_custom_menu_items' ) );

    } // end constructor
    
	/**
	 * Read custom menu itesm
	 * @param object $menu_item
	 * @return type
	 */
    function read_custom_menu_items( $menu_item ) {
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
        $menu_item->header = get_post_meta( $menu_item->ID, '_menu_item_header', true );
        $menu_item->tag = get_post_meta( $menu_item->ID, '_menu_item_tag', true );
        $menu_item->footer = get_post_meta( $menu_item->ID, '_menu_item_footer', true );
        return $menu_item;
    }
	
	/**
	 * Save custom menu items
	 * @param int $menu_id
	 * @param int $menu_item_db_id
	 * @param array $args
	 */
    function save_custom_menu_items( $menu_id, $menu_item_db_id, $args ) {
    
		if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
		
		if (!isset($_REQUEST['edit-menu-item-header'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-header'][$menu_item_db_id] = '';
        }
        $header_enabled_value = $_REQUEST['edit-menu-item-header'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_header', $header_enabled_value );
		
		if (!isset($_REQUEST['edit-menu-item-icon'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-icon'][$menu_item_db_id] = '';
        }
        $icon_value = $_REQUEST['edit-menu-item-icon'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
		
		if (!isset($_REQUEST['edit-menu-item-tag'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-tag'][$menu_item_db_id] = '';
        }
        $tag_value = $_REQUEST['edit-menu-item-tag'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_tag', $tag_value );

		if (!isset($_REQUEST['edit-menu-item-footer'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-footer'][$menu_item_db_id] = '';
        }
        $footer_value = $_REQUEST['edit-menu-item-footer'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_footer', $footer_value );
    }
    
    /**
	 * Return walker name
	 * @return string
	 */
    function nav_menu_edit_walker() {
        return 'Walker_Nav_Menu_Edit_Custom';   
    }
}




/**
 * This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = $item->ID;
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)','framework' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)','framework'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', 'framework'); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','framework'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','framework'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','framework'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item','framework' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'URL','framework'); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Navigation Label','framework' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Title Attribute','framework' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab','framework' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'CSS Classes (optional)','framework' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Link Relationship (XFN)','framework' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Description','framework' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.','framework'); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move','framework' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one','framework' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one','framework' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top','framework' ); ?></a>
					</label>
				</p>
				
	

				
				<!-- Menu Icon item -->
				<?php
				$preview = '';
				
				$value = get_post_meta( $item->ID, '_menu_item_icon', true);
				
				if (!empty($value)) {
					$preview = '<i class="'.(strstr($value,'fa-') ? 'fa' : '').' '.esc_attr($value).'"></i>';
				}
				
				?>
				<p>
				<div class="clearboth"></div>
                <div class="icon-menu-container">
					<p class="field-link-icon">
						<label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
							<div id="edit-menu-preview-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-preview-icon"><?php echo $preview; ?></div>
							<div id="edit-menu-button-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-button-icon button button-primary button-large" data-id="<?php echo esc_attr($item_id); ?>"><?php _e('Choose Icon','framework'); ?></div>
							<div id="edit-menu-remove-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-remove-icon button button-large" data-id="<?php echo esc_attr($item_id); ?>"><?php _e('Remove','framework'); ?></div>
							
							<input type="hidden" value="<?php echo esc_attr($value); ?>" id="edit-menu-item-icon_<?php echo esc_attr($item_id); ?>" name="edit-menu-item-icon[<?php echo esc_attr($item_id); ?>]" /> 
						</label>
					</p>  
				</div>
				</p>
				<!-- /Menu Icon item -->
				<p>
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_tag', true); ?>
				<div class="clearboth"></div>
                <div class="tag-menu-container">
					<p class="field-link-tag">
						<label for="edit-menu-item-tag-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'Select Tag', 'framework' ); ?><br />
							<select id="edit-menu-item-tag-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-tag[<?php echo esc_attr($item_id); ?>]" class="widefat">
								<?php
								$options = array('No Label', 'New', 'Wow','Coming Soon');
								foreach ($options as $option) {
								echo '<option value="' . esc_attr($option) . '" id="' . esc_attr($option) . '"', $value == $option ? ' selected="selected"' : '', '>', $option, '</option>';
								}
								?>
							</select>
						</label>
					</p>  
				</div>
			
				</p>
				<!-- /Mega Menu Tag -->

							<!-- Mega Menu item -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_megamenu', true);
				if ($value == "enabled") {
					$value = "checked='checked'";
				} else {
					$value = '';
				}
				?>
				<div class="clearboth"></div>
                <div class="mega-menu-container">
					<p class="field-link-mega">
						<label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo $value; ?> />
							<?php _e( 'Create Mega Menu for this item', 'framework' ); ?>
						</label>
					</p>  
				</div>
				<!-- /Mega Menu item -->
				
				<!-- Mega Menu Footer item -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_footer', true); ?>
				<div class="clearboth"></div>
                <div class="footer-menu-container">
					<p class="field-link-footer">
						<label for="edit-menu-item-footer-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'Mega Menu Image', 'framework' ); ?><br />
							<textarea id="edit-menu-item-footer-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-footer[<?php echo esc_attr($item_id); ?>]"><?php echo esc_textarea($value); ?></textarea>
						</label>
					</p>  
				</div>
				<!-- /Mega Menu Footer -->
				
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s','framework'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove','framework'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php _e('Cancel','framework'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}

/**
 * Create HTML list of nav menu items
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class ts_walker_nav_menu extends Walker_Nav_Menu {
	

	static protected $menu_lvl=0; 
	/**
	 * Blog menu parents, all child items must be skipped for blog menu items (from deppth = 0)
	 * @var array
	 */
	var $blog_menu_parents = array();
	
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
				if ($depth == 0 && self::$menu_lvl==1) {
					$output .= '<div class="sub-list">';

			}
		$output .= "\n$indent<ul class=\"sub\">\n";

		
	}



	function end_lvl( &$output, $depth = 0, $args = array() ) {
        

        $output .= "</ul>";
        		if ($depth == 0 && self::$menu_lvl==1 ) {
				$output .= '</div>';
				self::$menu_lvl=0;
			}
    }

      function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

	

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

	
		
		//skip menu elements if blog menu is activated for parent element
		if ($depth > 0  && in_array($item -> menu_item_parent, $this -> blog_menu_parents)) {
			return;
		}
		
		if ($item -> header == 'enabled') {
			$item_output = '<li><span class="open-sub"><span></span><span></span></span><span>'.apply_filters( 'the_title', $item->title, $item->ID ).'</span>';
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		} else {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$icon = '';
			if (!empty($item -> icon)) {
				$icon = '<i class="'.sanitize_html_classes(strstr($item -> icon,'fa-') ? 'fa' : '').' '. $item -> icon.'"></i>';
			}


			$megamenu_class = '';
			if ($depth == 0 && $item -> megamenu == 'enabled') {
				$megamenu_class = 'megamenu promo ';
			}

			$parent_class ='';               
			if ($item->hasChildren) {
		 	$parent_class ='parent ';
		 	}
		  

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="scroll '.sanitize_html_classes($parent_class .$megamenu_class . esc_attr( $class_names )) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';			
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			/*
			if (!empty($item -> footer)) {
				$item_output .= '<div class="promo-block">'.$item -> footer.'</div>';
			}else{
				*/

				if($item -> tag == 'New'){
					$item_tag = '<span class="item-new">New</span>';
				}elseif($item -> tag == 'Wow'){
					$item_tag = '<span class="item-new bg-warning">Wow</span>';
				}elseif($item -> tag == 'Coming Soon'){
					$item_tag = '<span class="item-new bg-success">Coming Soon</span>';
				}else{
					$item_tag ='';
				}

				$item_output = $args->before;
		

					$item_output .= '<a'. $attributes .'>';
					$item_output .= $icon;
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= $item_tag;

					if ($item->hasChildren) {
						$item_output .= '<span class="open-sub"><span></span><span></span></span>';
						}
					$item_output .= '</a>';
				

				$item_output .= $args->after;
			//}
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			
			if ($depth == 0 && $item -> megamenu == 'enabled') {
				$output .= '<ul class="sub"><li class="sub-wrapper">';

				self::$menu_lvl=1;
			}
			
		} //if header menu item
	}
	
	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
		//skip menu elements if blog menu is activated for parent element
		if ($depth > 0  && !in_array($item -> menu_item_parent, $this -> blog_menu_parents)) {
			return;
		}
		
		if ($depth == 0 && $item -> megamenu == 'enabled') {
			if (!empty($item -> footer)) {
				$output .= '<div class="promo-block">'.$item -> footer.'</div>';
			}
		$output .= '</li></ul>';
		}
		
		
		$output .= "</li>\n";
	}
}


/**
 * Progressive Menu Widget Walker
 */
class progressive_menu_widget_walker_nav_menu extends Walker_Nav_Menu {
  
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub\">\n";
	}
  
	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ($depth == 0 && $item -> hasChildren) {
			$classes[] = 'parent';
			
			if (in_array('current_page_parent', $classes)) {
				$classes[] = 'active';
			}
		}
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		if ($depth == 0 && $item -> hasChildren) {
			$item_output .= '<span class="open-sub"></span>';
		}
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
		// check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
		if ($element->hasChildren && is_array($children_elements[$element->ID])) {
			foreach ($children_elements[$element->ID] as $child) {
				if ($child -> visualmenu == 'enabled') {
					$element -> hasChildrenWithVisualMenu;
					break;
				}
			}
		}
		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
