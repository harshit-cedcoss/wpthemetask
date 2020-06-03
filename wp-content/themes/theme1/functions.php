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
}
add_action( 'init', 'register_my_menus' );

/**
 * Sidebar support.
 */
function my_register_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id'            => 'primary',
			'name'          => __( 'Primary Sidebar' ),
			'description'   => __( 'A short description of the sidebar.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'my_register_sidebars' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme1_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	$args = array(
		'default-color' => '0000ff',
		'default-image' => get_template_directory_uri() . '/images/wapuu.jpg',
	);
	add_theme_support( 'custom-background', $args );

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999, array( 'center', 'center' ) ); // 50 pixels wide by 50 pixels tall, crop from the center

	// Add custom image size used in Cover Template.
	add_image_size( 'category-thumb', 300, 9999 ); // 300 pixels wide (and unlimited height)

	the_post_thumbnail( 'category-thumb' );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/**
	* Editor style support
	*/
	add_theme_support( 'editor-styles' );

	/**
	* Post formats.
	*/
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	/**
	 * Custom header.
	 */
	add_theme_support(
		'custom-header',
		array(
			'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
			'default-text-color' => '000',
			'width'              => 1000,
			'height'             => 250,
			'flex-width'         => true,
			'flex-height'        => true,
		)
	);

}
add_action( 'after_setup_theme', 'theme1_support' );



add_action( 'template_redirect', 'permission' );
/**
 * Author And Subscriber Permissions
 */
function permission() {
	// Set redirect to true by default.
	$redirect = false;
	if ( is_user_logged_in() ) {
		$user_current = wp_get_current_user();
		$user         = array_shift( $user_current->roles );
		if ( 'author' === $user ) {
			$redirect = false;
		} elseif ( 'subscriber' === $user ) {
			$redirect = false;
			if ( is_page( 1865 ) ) {
				$redirect = true;
			}
		} elseif ( 'administrator' === $user ) {
				$redirect = false;
		}
	} elseif ( is_page( array( 1865, 1867 ) ) ) {
		$redirect = true;
	}
	if ( $redirect ) {
		// $location = get_site_url();
		// wp_redirect( esc_url( home_url() ), 307 );
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 );
		// exit();.
	}
}

