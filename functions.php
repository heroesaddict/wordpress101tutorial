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

