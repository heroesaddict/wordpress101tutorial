<?php 

function wordpress101_script_enqueue() {

	wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/css/wordpress101.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/wordpress101.js', array(), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'wordpress101_script_enqueue');

function wordpress101_theme_setup() {

	add_theme_support( 'menus' );
	register_nav_menu( 'primary', 'Primary Header Navigation' );
	register_nav_menu( 'secondary', 'Footer Navigation' );

}

add_action('init','wordpress101_theme_setup'); /*can use after_setup_theme instead of init */

 ?>