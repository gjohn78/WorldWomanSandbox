<?php
/**
 * xvelopers's Theme Core Functions 
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package progressive
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function progressive_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'progressive_page_menu_args' );



/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function progressive_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	$xv_data = ts_get_redux_data();
	
	if (ts_check_if_coming_soon_frontend() === false) {
	
		$layout='';
		$body_id ='';
		$boxed_page = false;
		 if (is_page()) {
			$value = xv_get_field('layout');
			if ($value == 'boxed') {
				$layout ='boxed hidden-top';
				$body_id = 'boxed-bg';
				$boxed_page = true;
			} else if ($value == 'full') { 
				$layout ='hidden-top';
				$boxed_page = true;
			}
		}

		if ($boxed_page === false) {
			if(isset($xv_data['layout']) &&  $xv_data['layout']  == 'boxed'){
			   $layout ='boxed hidden-top';
			   $body_id = 'boxed-bg';
			}else{
				$layout ='hidden-top';
			}	
		}
	
		$classes[] = $layout;

		if (ts_check_if_display('sticky_menu')) {
			
			$current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			$not_allowed_fixed_header = array(
				'templates/template-under-construction.php',
			);
			if (!in_array($current_template, $not_allowed_fixed_header)) {
				$classes[] = 'fixed-header';
			}
		} else {
			$classes[] = 'top-bar-only';
		}

		if (ts_check_if_display('switch-topbar') && ts_check_if_display('topbar-always-on')) {
			$classes[] = 'topbar-always-on';
			$classes[] = 'visible-top';
		}

		if(!ts_check_if_display('switch-topbar')){ 
			$classes[] = 'no-topbar';
		}
	}
	
	return $classes;
}
add_filter( 'body_class', 'progressive_body_classes' );


//add active class in selected page
add_filter('nav_menu_css_class' , 'progressive_nav_class' , 10 , 2);
function progressive_nav_class($classes, $item){
	 if( in_array('current-menu-item', $classes) ){
			 $classes[] = 'active ';  // your new class
	 }
	 return $classes;
}

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) )  {
	
	/**
	* Filters wp_title to print a neat <title> tag based on what is being viewed.
	*
	* @param string $title Default title text for current view.
	* @param string $sep Optional separator.
	* @return string The filtered title.
	*/
	function progressive_wp_title( $title, $sep ) {
	   global $page, $paged;

	   if ( is_feed() )
		   return $title;

	   // Add the blog name
	   $title .= get_bloginfo( 'name' );

	   // Add the blog description for the home/front page.
	   $site_description = get_bloginfo( 'description', 'display' );
	   if ( $site_description && ( is_home() || is_front_page() ) )
		   $title .= " $sep $site_description";

	   // Add a page number if necessary:
	   if ( $paged >= 2 || $page >= 2 )
		   $title .= " $sep " . sprintf( __( 'Page %s', 'progressive' ), max( $paged, $page ) );

	   return $title;
	}
	add_filter( 'wp_title', 'progressive_wp_title', 10, 2 );
	
	function theme_slug_render_title() {
	?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}


//add dropdown class in menu
function progressive_menu_set_dropdown( $sorted_menu_items, $args ) {
	$last_top = 0;
	foreach ( $sorted_menu_items as $key => $obj ) {
		// it is a top lv item?
		if ( 0 == $obj->menu_item_parent ) {
			// set the key of the parent
			$last_top = $key;
		} else {
			$sorted_menu_items[$last_top]->classes['dropdown'] = 'dropdown';
		}
	}
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'progressive_menu_set_dropdown', 10, 2 );


/*
 Extra Search Form
*/
 function progressive_search_form( $form ) {
	$form = '<form role="search" method="get" id="search-form-mobile" action="'. home_url( '/' ) .'">';
	$form .= ' <input  name="s" type="text" placeholder="search"/>';
	$form .= ' <button type="submit" class="submit-search"><span class="icon-search"></span></button>';
	$form .= '</form>';
	return $form;
}


/*
* Pagination code
*/
function progressive_get_pagination($pages = '', $range = 4)
{ 
	
	$showitems = ($range * 2)+1; 
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
     if(1 != $pages)
     {
         echo "<ul class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         echo'<li>';
          previous_posts_link('<i class="icon-angle-left pagination-icon"></i>');
         echo'</li>';
          //echo "<a href='".get_pagenum_link($paged - 1)."'><i class='icon-chevron-left pagination-icon'></i></a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))

             {
                 echo ($paged == $i)? "<li class=\"active\"><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
             }
         }
          //echo "<a href=\"".get_pagenum_link($paged + 1)."\"><i class='icon-chevron-right pagination-icon'></i></a>";
          echo'<li>'; 
          next_posts_link('<i class="icon-angle-right pagination-icon"></i>','');
          echo'</li>';
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
         echo "</ul>\n";
     }
}


/**
 * Display template for breadcrumbs.
 *
 */
function progressive_breadcrumbs()
{
	$home      = __('Home', 'progressive').' '; // text for the 'Home' link
	$before    = '<li class="active">'; // tag before the current crumb
	$sep       = ' ';
	$after     = '</li>'; // tag after the current crumb

	if (!is_home() && !is_front_page() || is_paged()) {

		echo '<div class="breadcrumb"><ul>';

		global $post;
		
			echo '<li><a href="' . esc_url(home_url()) . '">' . esc_html($home) . '</a> </li> ';
			if (is_category()) {
				global $wp_query;
				$cat_obj   = $wp_query->get_queried_object();
				$thisCat   = $cat_obj->term_id;
				$thisCat   = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) {
					$parent_cat = get_category_parents($parentCat, true, $sep);
					if (is_string($parent_cat) && !is_wp_error($parent_cat)) {
						echo $parent_cat;
					}
				}
				echo $before . __('Archive by category','progressive').' "' . single_cat_title('', false) . '"' . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
					'Y'
				) . '</a></li> ';
				echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
					'F'
				) . '</a></li> ';
				echo $before . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
					'Y'
				) . '</a></li> ';
				echo $before . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo $before . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug      = $post_type->rewrite;
					echo '<li><a href="' . esc_url(home_url()) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
					echo $before . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					if (isset($cat[0])) {
						$cat = $cat[0];
						echo '<li>'.get_category_parents($cat, true, $sep).'</li>';
					}
					echo $before . get_the_title() . $after;
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search()) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					echo $before . $post_type->labels->singular_name . $after;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat    = get_the_category($parent->ID);
				if (isset($cat[0])) {
					$cat    = $cat[0];
					$parent_cat = get_category_parents($cat, true, $sep);
					if (is_string($parent_cat) && !is_wp_error($parent_cat)) {
						echo $parent_cat;
					}
				}
				echo '<li><a href="' . esc_url(get_permalink(
					$parent
				)) . '">' . $parent->post_title . '</a></li> ';
				echo $before . get_the_title() . $after;

			} elseif (is_page() && !$post->post_parent) {
				echo $before . get_the_title() . $after;
			} elseif (is_page() && $post->post_parent) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page          = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title(
						$page->ID
					) . '</a>' . $sep . '</li>';
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo $crumb;
				}
				echo $before . get_the_title() . $after;
			} elseif (is_search()) {
				echo $before . sprintf(__('Search results for "%s"','progressive'),get_search_query()) . $after;
			} elseif (is_tag()) {
				echo $before . sprintf(__('Posts tagged "%s"','progressive'),single_tag_title('', false)) . '"' . $after;
			} elseif (is_author()) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf(__('Articles posted by %s','progressive'),$userdata->display_name) . $after;
			} elseif (is_404()) {
				echo $before .__('Error 404','progressive') . $after;
			}
			// if (get_query_var('paged')) {
			//     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
			//     ) {
			//         echo ' (';
			//     }
			//     echo __('Page', 'progressive') . $sep . get_query_var('paged');
			//     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
			//     ) {
			//         echo ')';
			//     }
			// }

		echo '</ul></div>';

	}
}

function get_xv_resizer($image_url='',$width='',$height='',$crop='c'){

		$image ="http://placehold.it/{$width}x{$height}";


		if (!empty($image_url)) {        

			$image = theme_thumb($image_url, $width, $height,$crop);
		}

	return $image;
}

function get_xv_thumbnail($width,$height){
	global $post;    

	  $thumb ="http://placehold.it/{$width}x{$height}";
		 if ( has_post_thumbnail() ) {        
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full");
			$image_url = $image_src[0];
			$thumb = theme_thumb($image_url, $width, $height, 'c');
		}

	return $thumb;
}
/*
Custom Excerpt
*/
function get_xv_excerpt($count=300){
	global $post;
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	return $excerpt;
}

function ts_check_if_coming_soon_frontend() {
	
	 $xv_data = ts_get_redux_data();
	
	if (isset($xv_data['coming_soon_switch']) && $xv_data['coming_soon_switch'] == 1 && !is_user_logged_in()) {
		
		return true;
	}
	
	return false;
}