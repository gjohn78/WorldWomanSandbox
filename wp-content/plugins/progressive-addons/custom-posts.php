<?php
///////////////////////////////////services////////////////////////////////
function my_custom_post_Service() {
    $labels = array(
        'name'               => _x( 'Service', 'Service','progressive' ),
        'singular_name'      => _x( 'Service', 'Service','progressive' ),
        'add_new'            => _x( 'Add New', 'Service','progressive' ),
        'add_new_item'       => __( 'Add New Service','progressive' ),
        'edit_item'          => __( 'Edit Service','progressive' ),
        'new_item'           => __( 'New Service','progressive' ),
        'all_items'          => __( 'All Services','progressive' ),
        'view_item'          => __( 'View Services','progressive' ),
        'search_items'       => __( 'Search Service Member','progressive' ),
        'not_found'          => __( 'No Service found','progressive' ),
        'not_found_in_trash' => __( 'No Service found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Services'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','editor','thumbnail' ),
        'has_archive'   => true,
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_red.png',
    );
    register_post_type( 'Service', $args ); 
}
add_action( 'init', 'my_custom_post_Service' );
//////////////////////////////////////////////////////////////////////////
function my_custom_post_Workflow() {
    $labels = array(
        'name'               => _x( 'Workflow', 'Workflow','progressive' ),
        'singular_name'      => _x( 'Workflow', 'Workflow','progressive' ),
        'add_new'            => _x( 'Add New', 'Workflow','progressive' ),
        'add_new_item'       => __( 'Add New Workflow','progressive' ),
        'edit_item'          => __( 'Edit Workflow','progressive' ),
        'new_item'           => __( 'New Workflow','progressive' ),
        'all_items'          => __( 'All Workflows','progressive' ),
        'view_item'          => __( 'View Workflows','progressive' ),
        'search_items'       => __( 'Search Workflow Member','progressive' ),
        'not_found'          => __( 'No Workflow found','progressive' ),
        'not_found_in_trash' => __( 'No Workflow found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Workflow'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','editor','thumbnail' ),
        'has_archive'   => true,
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_red.png',
    );
    register_post_type( 'workflow', $args ); 
}
add_action( 'init', 'my_custom_post_Workflow' );
///////////////////////////////////profile////////////////////////////////
function my_custom_post_profile() {
    $labels = array(
        'name'               => _x( 'Profile', 'Profile','progressive' ),
        'singular_name'      => _x( 'Profile', 'Profile','progressive' ),
        'add_new'            => _x( 'Add New', 'Profile','progressive' ),
        'add_new_item'       => __( 'Add New Profile','progressive' ),
        'edit_item'          => __( 'Edit Profile','progressive' ),
        'new_item'           => __( 'New Profile','progressive' ),
        'all_items'          => __( 'All Profiles','progressive' ),
        'view_item'          => __( 'View Profiles','progressive' ),
        'search_items'       => __( 'Search Profile Member','progressive' ),
        'not_found'          => __( 'No Profile found','progressive' ),
        'not_found_in_trash' => __( 'No Profile found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Profiles'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => false,
        'menu_position' => 10,
        'supports'      => array( 'title','thumbnail'),
        'has_archive'   => false,
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_blue.png',
    );
    register_post_type( 'Profile', $args ); 
}
add_action( 'init', 'my_custom_post_profile' );


///////////////////TEAM CUSTOM POST TYPE//////////////////////////////////////////////
function my_custom_post_Team() {
    $labels = array(
        'name'               => _x( 'Team', 'Team','progressive' ),
        'singular_name'      => _x( 'Team', 'Team','progressive' ),
        'add_new'            => _x( 'Add New', 'Team','progressive' ),
        'add_new_item'       => __( 'Add New Team Member','progressive' ),
        'edit_item'          => __( 'Edit Team Memeber','progressive' ),
        'new_item'           => __( 'New Team Member','progressive' ),
        'all_items'          => __( 'All Team Memebers','progressive' ),
        'view_item'          => __( 'View Team','progressive' ),
        'search_items'       => __( 'Search Team Member','progressive' ),
        'not_found'          => __( 'No Member found','progressive' ),
        'not_found_in_trash' => __( 'No Team Member found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Team'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title', 'thumbnail' ),
        'has_archive'   => true,
        'rewrite'            => array( 'slug' => 'xv-team' ),
          'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_green.png',
    );
    register_post_type( 'Team', $args ); 
}
add_action( 'init', 'my_custom_post_Team' );

/////////////////////////////////////PORTFOLIO CUSTOM POST/////////////////////////////////////
function my_custom_post_portfolio() {
    $labels = array(
        'name'               => _x( 'Portfolio', 'Items','progressive' ),
        'singular_name'      => _x( 'Portfolio', 'Item','progressive' ),
        'add_new'            => _x( 'Add New', 'Item','progressive' ),
        'add_new_item'       => __( 'Add New Item','progressive' ),
        'edit_item'          => __( 'Edit Item','progressive' ),
        'new_item'           => __( 'New Item','progressive' ),
        'all_items'          => __( 'All Items','progressive' ),
        'view_item'          => __( 'View Item','progressive' ),
        'search_items'       => __( 'Search Items','progressive' ),
        'not_found'          => __( 'No Items found','progressive' ),
        'not_found_in_trash' => __( 'No Items found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title', 'thumbnail','editor' ),
        'has_archive'   => true,
         'menu_icon' => get_template_directory_uri() . '/admin/assets/images/pin_yellow.png',
         'taxonomies' => array('post_tag') ,
    );
    register_post_type( 'portfolio', $args ); 
}
add_action( 'init', 'my_custom_post_portfolio' );
function my_taxonomies_portfolio_category() {
    $labels = array(
        'name'              => _x( 'Items Categories', 'Categories','progressive' ),
        'singular_name'     => _x( 'Product Type', 'Categories','progressive' ),
        'search_items'      => __( 'Search Portfolio Categories','progressive' ),
        'all_items'         => __( 'All Portfolio Categories','progressive' ),
        'parent_item'       => __( 'Parent Portfolio Type','progressive' ),
        'parent_item_colon' => __( 'Parent Portfolio Type:','progressive' ),
        'edit_item'         => __( 'Edit Portfolio Type','progressive' ), 
        'update_item'       => __( 'Update Portfolio Type','progressive' ),
        'add_new_item'      => __( 'Add New Portfolio Type','progressive' ),
        'new_item_name'     => __( 'New Portfolio Type','progressive' ),
        'menu_name'         => __( 'Categories','progressive' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'portfolio_category', 'portfolio', $args );
}
add_action( 'init', 'my_taxonomies_portfolio_category', 0 );

///////////////////////////////////process////////////////////////////////
function my_custom_post_process() {
    $labels = array(
        'name'               => _x( 'Process', 'Process','progressive' ),
        'singular_name'      => _x( 'Process', 'Process','progressive' ),
        'add_new'            => _x( 'Add New', 'Process','progressive' ),
        'add_new_item'       => __( 'Add New Process','progressive' ),
        'edit_item'          => __( 'Edit Process','progressive' ),
        'new_item'           => __( 'New Process','progressive' ),
        'all_items'          => __( 'All Processs','progressive' ),
        'view_item'          => __( 'View Processs','progressive' ),
        'search_items'       => __( 'Search Process Member','progressive' ),
        'not_found'          => __( 'No Process found','progressive' ),
        'not_found_in_trash' => __( 'No Process found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Processs'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','editor','thumbnail'),
        'has_archive'   => true,
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_blue.png',
    );
    register_post_type( 'Process', $args ); 
}
add_action( 'init', 'my_custom_post_process' );


///////////////////TEAM CUSTOM POST TYPE//////////////////////////////////////////////
function my_custom_post_Showcase() {
    $labels = array(
        'name'               => _x( 'Showcase', 'Showcase','progressive' ),
        'singular_name'      => _x( 'Showcase', 'Showcase','progressive' ),
        'add_new'            => _x( 'Add New', 'Showcase','progressive' ),
        'add_new_item'       => __( 'Add New Item','progressive' ),
        'edit_item'          => __( 'Edit Item','progressive' ),
        'new_item'           => __( 'New Showcase Item','progressive' ),
        'all_items'          => __( 'All Showcase Items','progressive' ),
        'view_item'          => __( 'View Showcase Items','progressive' ),
        'search_items'       => __( 'Search Showcase Item','progressive' ),
        'not_found'          => __( 'No Item found','progressive' ),
        'not_found_in_trash' => __( 'No Showcase found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Showcase'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','editor'),
        'has_archive'   => true,
          'menu_icon' =>  get_template_directory_uri(). '/admin/assets/images/pin_black.png',
    );
    register_post_type( 'Showcase', $args ); 
}
add_action( 'init', 'my_custom_post_Showcase' );



///////////////////////////////////testimonials////////////////////////////////
function my_custom_post_testimonials() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'Testimonial','progressive' ),
        'singular_name'      => _x( 'Testimonials', 'Testimonial','progressive' ),
        'add_new'            => _x( 'Add New', 'Testimonial','progressive' ),
        'add_new_item'       => __( 'Add New Testimonials','progressive' ),
        'edit_item'          => __( 'Edit Testimonial','progressive' ),
        'new_item'           => __( 'New Testimonial','progressive' ),
        'all_items'          => __( 'All Testimonial','progressive' ),
        'view_item'          => __( 'View Testimonials','progressive' ),
        'search_items'       => __( 'Search Testimonial','progressive' ),
        'not_found'          => __( 'No Testimonials found','progressive' ),
        'not_found_in_trash' => __( 'No Testimonials found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Testimonials'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','thumbnail','editor' ),
        //'rewrite'            => array( 'slug' => 'xv-team' ),
        'has_archive'   => false,
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_red.png',
    );
    register_post_type( 'testimonials', $args ); 
}
add_action( 'init', 'my_custom_post_testimonials' );
///////////////////////////////////Clients////////////////////////////////

function my_custom_post_clients() {
    $labels = array(
        'name'               => _x( 'Clients', 'Client','progressive' ),
        'singular_name'      => _x( 'Clients', 'Client','progressive' ),
        'add_new'            => _x( 'Add New', 'Client','progressive' ),
        'add_new_item'       => __( 'Add New Clients','progressive' ),
        'edit_item'          => __( 'Edit Client','progressive' ),
        'new_item'           => __( 'New Client','progressive' ),
        'all_items'          => __( 'All Client','progressive' ),
        'view_item'          => __( 'View Clients','progressive' ),
        'search_items'       => __( 'Search Client','progressive' ),
        'not_found'          => __( 'No Clients found','progressive' ),
        'not_found_in_trash' => __( 'No Clients found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Clients'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','thumbnail','editor' ),
        //'has_archive'   => true,
       // 'rewrite'            => array( 'slug' => 'clients-archive' ),
        'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_red.png',
    );
    register_post_type( 'clients', $args ); 
}
add_action( 'init', 'my_custom_post_clients' );

add_action( 'init', 'my_taxonomies_clients_category', 0 );
function my_taxonomies_clients_category() {
    $labels = array(
        'name'              => _x( 'Categories', 'Categories','progressive'  ),
        'singular_name'     => _x( 'Product Type', 'Categories','progressive'  ),
        'search_items'      => __( 'Search clients Categories','progressive' ),
        'all_items'         => __( 'All Faq Categories','progressive' ),
        'parent_item'       => __( 'Parent clients Type','progressive' ),
        'parent_item_colon' => __( 'Parent clients Type:','progressive' ),
        'edit_item'         => __( 'Edit clients Type','progressive' ), 
        'update_item'       => __( 'Update clients Type','progressive' ),
        'add_new_item'      => __( 'Add New clients Type','progressive' ),
        'new_item_name'     => __( 'New clients Type','progressive' ),
        'menu_name'         => __( 'Categories','progressive' ),
        'taxonomies' => array( 'faq-categories' ),
        
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'has_archive'        => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'clients_category',array('clients'), $args  );
     $set = get_option('clients');
    if ($set !== true){
        flush_rewrite_rules(false);
        update_option('clients',true);
    }
}



///////////////////////FAQ CUSTOM POST TYPE///////////////////////////////////////////
function my_custom_post_faq() {
    $labels = array(
        'name'               => _x( 'FAQ', 'Items','progressive' ),
        'singular_name'      => _x( 'FAQ', 'Item','progressive' ),
        'add_new'            => _x( 'Add New', 'FAQ','progressive' ),
        'add_new_item'       => __( 'Add New FAQ','progressive' ),
        'edit_item'          => __( 'Edit FAQ','progressive' ),
        'new_item'           => __( 'New FAQ','progressive' ),
        'all_items'          => __( 'All FAQs','progressive' ),
        'view_item'          => __( 'View Item','progressive' ),
        'search_items'       => __( 'Search FAQ','progressive' ),
        'not_found'          => __( 'No Items found','progressive' ),
        'not_found_in_trash' => __( 'No Items found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'FAQ'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 10,
        'supports'      => array( 'title','editor' ),
        'has_archive'   => true,
        'rewrite'            => array( 'slug' => 'xv-faq' ),
         'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_green.png',
    );
    register_post_type( 'faq', $args ); 
}

add_action( 'init', 'my_custom_post_faq' );

add_action( 'init', 'my_taxonomies_faq_category', 0 );
function my_taxonomies_faq_category() {
    $labels = array(
        'name'              => _x( 'Items Categories', 'Categories','progressive'  ),
        'singular_name'     => _x( 'Product Type', 'Categories','progressive'  ),
        'search_items'      => __( 'Search Faq Categories','progressive' ),
        'all_items'         => __( 'All Faq Categories','progressive' ),
        'parent_item'       => __( 'Parent Faq Type','progressive' ),
        'parent_item_colon' => __( 'Parent Faq Type:','progressive' ),
        'edit_item'         => __( 'Edit Faq Type','progressive' ), 
        'update_item'       => __( 'Update Faq Type','progressive' ),
        'add_new_item'      => __( 'Add New Faq Type','progressive' ),
        'new_item_name'     => __( 'New Faq Type','progressive' ),
        'menu_name'         => __( 'Categories','progressive' ),
        'taxonomies' => array( 'faq-categories' ),
        
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'has_archive'        => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'faq_category',array('faq'), $args  );
     $set = get_option('faq');
    if ($set !== true){
        flush_rewrite_rules(false);
        update_option('faq',true);
    }
}




/////////////////////////////////////GALLERY CUSTOM POST/////////////////////////////////////
function my_custom_post_gallery() {
    $labels = array(
        'name'               => _x( 'Gallery', 'Items','progressive'  ),
        'singular_name'      => _x( 'Gallery', 'Item','progressive'  ),
        'add_new'            => _x( 'Add New', 'Item' ,'progressive' ),
        'add_new_item'       => __( 'Add New Item','progressive' ),
        'edit_item'          => __( 'Edit Item','progressive' ),
        'new_item'           => __( 'New Item','progressive' ),
        'all_items'          => __( 'All Items','progressive' ),
        'view_item'          => __( 'View Item','progressive' ),
        'search_items'       => __( 'Search Items','progressive' ),
        'not_found'          => __( 'No Items found','progressive' ),
        'not_found_in_trash' => __( 'No Items found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Gallery'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'menu_position' => 13,
        'supports'      => array( 'title', 'thumbnail'),
        'has_archive'   => false,
        'rewrite'            => array( 'slug' => 'xv-gallery' ),
        'menu_icon' => get_template_directory_uri() . '/admin/assets/images/cd.png',
        // 'taxonomies' => array('post_tag') ,
    );
    register_post_type( 'gallery', $args ); 
         $set = get_option('gallery');
    if ($set !== true){
        flush_rewrite_rules(false);
        update_option('gallery',true);
    }
}
add_action( 'init', 'my_custom_post_gallery' );


add_action( 'init', 'my_taxonomies_gallery_category', 0 );
function my_taxonomies_gallery_category() {
    $labels = array(
        'name'              => _x( 'Items Categories', 'Categories','progressive'  ),
        'singular_name'     => _x( 'Product Type', 'Categories','progressive'  ),
        'search_items'      => __( 'Search Gallery Categories','progressive' ),
        'all_items'         => __( 'All Gallery Categories','progressive' ),
        'parent_item'       => __( 'Parent Gallery Type','progressive' ),
        'parent_item_colon' => __( 'Parent Gallery Type:','progressive' ),
        'edit_item'         => __( 'Edit Gallery Type','progressive' ), 
        'update_item'       => __( 'Update Gallery Type','progressive' ),
        'add_new_item'      => __( 'Add New Gallery Type','progressive' ),
        'new_item_name'     => __( 'New Gallery Type','progressive' ),
        'menu_name'         => __( 'Categories','progressive' ),
        'taxonomies' => array( 'gallery-categories' ),
        
    );
    $args = array(
        'hierarchical'      => true,
        'labels' => $labels,
        'has_archive'   => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'gallery_category',array('gallery'), $args  );
 
}

add_action( 'init', 'my_banners', 0 );
function my_banners() {
    
	$labels = array(
        'name'               => _x( 'Banner', 'Banner','progressive' ),
        'singular_name'      => _x( 'Banner', 'Banner','progressive' ),
        'add_new'            => _x( 'Add New', 'Banner','progressive' ),
        'add_new_item'       => __( 'Add New Banner Item','progressive' ),
        'edit_item'          => __( 'Edit Banner','progressive' ),
        'new_item'           => __( 'New Banner','progressive' ),
        'all_items'          => __( 'All Banners','progressive' ),
        'view_item'          => __( 'View Banners','progressive' ),
        'search_items'       => __( 'Search Banner Member','progressive' ),
        'not_found'          => __( 'No Banner found','progressive' ),
        'not_found_in_trash' => __( 'No Banner found in the Trash','progressive' ), 
        'parent_item_colon'  => '',
        'menu_name'          => 'Banner'
	);
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'has_archive'        => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'supports'      => array( 'title','editor','thumbnail' , 'page-attributes')
    );
	
	register_post_type( 'banner', $args );
	
	$set = get_option('banner');
    if ($set !== true){
        flush_rewrite_rules(false);
        update_option('banner',true);
    }
	
    register_taxonomy(
        'banner-cat',
        array("banner"),
        array(
            "hierarchical" => true,
            "label" => __("Categories",'progressive'),
            "singular_label" => __("Category","progressive"),
            "rewrite" => true
        )
    );
    
}
?>