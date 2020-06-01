<?php
/**
 * Theme1 functions and definitions
 *
 * @package WordPress
 * @subpackage Theme1
 * @since Theme1 1.0
 */

/**
 * Theme1 function for stylesheets
 */
function themeslug_enqueue_style() {
	wp_enqueue_style( 'blog-home', get_template_directory_uri() . '/css/blog-home.css', array(), '1.1', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', array(), '1.1', 'all' );
}
/**
 * Theme1 function for script
 */
function themeslug_enqueue_script() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap1', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '1.1', true );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );
/**
 * Theme1 function for registering menus
 */
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'extra-menue' => __( 'Extra Menu' ),
		)
	);
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, array( 'center', 'center' ) ); // 50 pixels wide by 50 pixels tall, crop from the center
	add_image_size( 'category-thumb', 300, 9999 ); // 300 pixels wide (and unlimited height)
	the_post_thumbnail( 'category-thumb' );
	$args = array(
		'default-color' => '0000ff',
		'default-image' => get_template_directory_uri() . '/images/wapuu.jpg',
	);
	add_theme_support( 'custom-background', $args );
}
add_action( 'init', 'register_my_menus' );
/**
 * Theme1 function for registering menus
 */
function themename_custom_header_setup() {
	$args = array(
		'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
		'default-text-color' => '000',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );

