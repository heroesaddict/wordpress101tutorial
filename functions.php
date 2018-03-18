<?php 
/* ===============================
   Include Scripts
   ===============================
*/

function wordpress101_script_enqueue() {
	//css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0', 'all' );
	wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/css/wordpress101.css', array(), '1.0.0', 'all' );
	//js
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '4.0', true );
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/wordpress101.js', array(), '1.0.0', true );
	
}

add_action( 'wp_enqueue_scripts', 'wordpress101_script_enqueue');

/* ===============================
   Active Menus
   ===============================
*/

function wordpress101_theme_setup() {

	add_theme_support( 'menus' );
	register_nav_menu( 'primary', 'Primary Header Navigation' );
	register_nav_menu( 'secondary', 'Footer Navigation' );

}

add_action('init','wordpress101_theme_setup'); /*can use after_setup_theme instead of init */

/* ===============================
   Theme Support function
   ===============================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside', 'image', 'video'));
add_theme_support('html5',array('search-form'));

/* ===============================
   Sidebar Functions
   ===============================
*/
function wordpress101_widget_setup() {
	
	register_sidebar(
		array(
			'name' => 'kate sidebar',
			'id'   => 'sidebar1',
			'class'=> 'custom',
			'description'   => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widgettitle">',
			'after_title'   => '</h1>',

		)
	);	
	register_sidebar(
		array(
			'name' => 'kim sidebar',
			'id'   => 'sidebar2',
			'class'=> 'custom',
			'description'   => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widgettitle">',
			'after_title'   => '</h1>',

		)
	);			
}

add_action( 'widgets_init', 'wordpress101_widget_setup');
/* ===============================
   Include Walker file
   ===============================
*/

require get_template_directory() . '/inc/walker.php';

/* ===============================
   Head function
   ===============================
*/

function wordpress101_remove_version() {
	return '';
}

add_filter('the_generator','wordpress101_remove_version');

/* ===============================
   Custom Post Type
   ===============================
*/
   function wordpress101_custom_post_type (){
	
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Item',
		'all_items' => 'All Items',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('portfolio',$args);
}
add_action('init','wordpress101_custom_post_type');

flush_rewrite_rules();

/* ===============================
   Custom Taxonomies
   ===============================
*/
   function wordpress101_custom_taxonomies (){
   		//add new taxonomy hierarchical
	$labels = array(
		'name' => 'Fields',
		'singular_name' => 'Field',
		'search_items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field:',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Work Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'field' )
	);
	
	register_taxonomy('field', array('portfolio'), $args);
	
	//add new taxonomy NOT hierarchical
	
	register_taxonomy('software', 'portfolio', array(
		'label' => 'Software',
		'rewrite' => array( 'slug' => 'software' ),
		'hierarchical' => false
	) );
}
add_action( 'init' , 'wordpress101_custom_taxonomies' );

/* ===============================
   Custom Term function
   ===============================
*/
	function wordpress101_get_terms( $postID, $term ){
	
	$terms_list = wp_get_post_terms($postID, $term); 
	$output = '';
					
	$i = 0;
	foreach( $terms_list as $term ){ $i++;
		if( $i > 1 ){ $output .= ', '; }
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
	}
	
	return $output;
	
}

