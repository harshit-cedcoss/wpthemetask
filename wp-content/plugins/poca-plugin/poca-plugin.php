<?php
/**
 * Plugin Name        Poca Plugin
 *
 * @package           PluginPackage
 * @author            Harshit
 * @copyright         2019 Your Name or Company Name
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Poca Plugin
 * Plugin URI:        https://example.com/plugin-name
 * Description:       This is my first plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Harshit
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL2
 */

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

/*
{Poca Plugin} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Poca Plugin} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Poca Plugin}. If not, see {URI to Plugin License}.
*/


/**
 * Security measures.
 */

if ( ! defined( 'ABSPATH' ) ) { // global variable, is to be defined.
	die( 'Canot access this site' );
}

if ( ! function_exists( 'add_action' ) ) { // checking if a predefined function exists or not.
	echo 'This site cannot be accessed';
	exit;
}

/**
 * Activation.
 */
function activate() {
	// adding a new option.
	add_option( 'installed_on' );
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}
// activation.
register_activation_hook( __FILE__, 'activate' );

/**
 * Deactivation
 */
function deactivate() {
	// Deleting Option.
	delete_option( 'installed_on' );
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}
// deactivation.
register_deactivation_hook( __FILE__, 'deactivate' );

define( 'PLUGIN_DIR', dirname( __FILE__ ) . '/' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function poca_widgets_podcast_sidebar_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Podcast Sidebar', 'poca' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'poca' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="single-widget-area search-widget-area mb-80">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Top Level Sidebar', 'poca' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'poca' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'poca_widgets_podcast_sidebar_init' );


/**
 * Custom-Post
 *
 * @return void
 */
function poca_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Podcasts', 'Post type general name', 'poca_podcast' ),
		'singular_name'         => _x( 'Podcast', 'Post type singular name', 'poca_podcast' ),
		'menu_name'             => _x( 'Podcast Menu', 'Admin Menu text', 'poca_podcast' ),
		'add_new'               => _x( 'Add New', 'podcast', 'poca_podcast' ),
		'add_new_item '         => __( 'Add New Podcast', 'poca_podcast' ),
		'edit_item'             => __( 'Edit Podcast', 'poca_podcast' ),
		'new_item'              => __( 'New Podcast', 'poca_podcast' ),
		'name_admin_bar'        => _x( 'Podcast', 'Add new on toolbar', 'poca_podcast' ),
		'view_item'             => __( 'View Podcast', 'poca_podcast' ),
		'all_items'             => __( 'All Podcast', 'poca_podcast' ),
		'search_items'          => __( 'Search Podcast', 'poca_podcast' ),
		'not_found'             => __( 'No podcast found', 'poca_podcast' ),
		'not_found_in_trash'    => __( 'No podcasts found in trash', 'poca_podcast' ),
		'parent_items_colon'    => __( 'Parent Podcast', 'poca_podcast' ),
		'archives'              => __( 'Archives', 'poca_podcast' ),
		'attributes'            => __( 'Attributes', 'poca_podcast' ),
		'insert_into_item'      => __( 'Insert into Podcast', 'poca_podcast' ),
		'uploaded_to_this_item' => __( 'Upload to this Podcast', 'poca_podcast' ),
		'featured_image'        => _x( 'Podcast Cover Image', 'Overrides the featured image phrase for this post type', 'poca_podcast' ),
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'description'        => __( 'Here the Podcasts are described', 'poca_podcast' ),
	//	'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'podcasts' ), // my custom slug.
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menu'   => true,
		'show_in_admin_bar'  => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array( 'poca_podcast_category', 'poca_podcast_tag' ),
	//	'menu_icon'          => 'book',
		'map_meta_cap'       => true,
		'query-var'          => true,
	// 'register_meta_box_cb' => 'wporg_dashboard_widget_render',
	);
	register_post_type( 'poca_podcast', $args );
}
add_action( 'init', 'poca_custom_post_type' );

register_activation_hook( __FILE__, 'my_rewrite_flush' );
/**
 * Flushing the rewrite rules.
 *
 * @return void
 */
function my_rewrite_flush() {
	// First, we "add" the custom post type via the above written function.
	// Note: "add" is written with quotes, as CPTs don't get added to the DB,
	// They are only referenced in the post_type column with a post entry,
	// when you add a post of this CPT.
	poca_custom_post_type();

	// ATTENTION: This is *only* done during plugin activation hook in this example!
	// You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}
/**
 * Our Custom Taxonomy.
 *
 * @return void
 */
function poca_podcast_register_taxonomy_category() {
	$labels = array(
		'name'              => _x( 'Poca Podcast Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Poca Podcast Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search category' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'view_item'         => __( 'View Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Poca Podcast Categories' ),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories).
		'labels'            => $labels,
		'description'       => 'this is the custom taxonomy description',
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'poca_podcast_category' ),
	);
	register_taxonomy( 'poca_podcast_category', array( 'poca_podcast' ), $args );
}
add_action( 'init', 'poca_podcast_register_taxonomy_category' );

/**
 * Our Custom Taxonomy.
 *
 * @return void
 */
function poca_podcast_register_taxonomy_tags() {
	$labels = array(
		'name'              => _x( 'Poca Podcast Tags', 'taxonomy general name' ),
		'singular_name'     => _x( 'Poca Podcast Tag', 'taxonomy singular name' ),
		'search_items'      => __( 'Search tag' ),
		'all_items'         => __( 'All Tags' ),
		'parent_item'       => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item'         => __( 'Edit Tag' ),
		'view_item'         => __( 'View Tag' ),
		'update_item'       => __( 'Update Tag' ),
		'add_new_item'      => __( 'Add New Tag' ),
		'new_item_name'     => __( 'New Tag Name' ),
		'menu_name'         => __( 'Poca Podcast Tags' ),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories).
		'labels'            => $labels,
		'description'       => 'this is the custom taxonomy description',
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'poca_podcast_tag' ),
	);
	register_taxonomy( 'poca_podcast_tag', array( 'poca_podcast' ), $args );
}
add_action( 'init', 'poca_podcast_register_taxonomy_tags' );


/**
 * Custom Categories Widget for poca theme
 */
require PLUGIN_DIR . '/includes/class-my-poca-categories.php';


/**
 * Custom Recent-Posts Widget for poca theme
 */
require PLUGIN_DIR . '/includes/class-my-poca-recent-posts.php';


/**
 * Enqueuing js file and creating a global object
 *
 * @return void
 */
function podcast_ajax_enqueue() {

	// Enqueue javascript on the frontend.
	wp_enqueue_script(
		'podcast-ajax-script',
		plugins_url( '/js/myjquery_podcast.js', __FILE__ ),
		array( 'jquery' ),
		'1.0.0',
		true
	);

	// The wp_localize_script allows us to output the ajax_url path for our script to use.
	wp_localize_script(
		'podcast-ajax-script',
		'podcast_ajax_obj',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'ajax-nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'podcast_ajax_enqueue' );


/**
 * Podcast ajax handler.
 */
function podcast_ajax_request() {

	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
		die( 'Nonce value cannot be verified.' );
	}

	// The $_REQUEST contains all the data sent via ajax.
	if ( isset( $_POST ) ) {
		$current_tax     = isset( $_POST['tax'] ) ? sanitize_text_field( wp_unslash( $_POST['tax'] ) ) : '';
		$number_of_posts = isset( $_POST['num_of_posts'] ) ? sanitize_text_field( wp_unslash( $_POST['num_of_posts'] ) ) : '';

		// echo $current_tax;
		// Create post object.
		if ( '*' === $current_tax ) {
			$args = array(
				'numberposts' => $number_of_posts, // -1 is for all
				'post_type'   => 'poca_podcast', // or 'post', 'page'.
				'orderby'     => 'title', // or 'date', 'rand'.
				'order'       => 'ASC', // or 'DESC'.
			);
		} else {
			$args = array(
				'numberposts'           => $number_of_posts, // -1 is for all
				'post_type'             => 'poca_podcast', // or 'post', 'page'.
				'orderby'               => 'title', // or 'date', 'rand'.
				'order'                 => 'ASC', // or 'DESC'.
				'poca_podcast_category' => $current_tax,
			);
		}
		// Get the posts.
		$podcast_posts = get_posts( $args );
		$output        = '';
		// If there are posts.
		?>
		<div class="row poca-portfolio">
		<?php
		if ( $podcast_posts ) {
			// Loop the posts.
			foreach ( $podcast_posts as $podcast_post ) {
				$cats = get_the_category( $podcast_post->ID );
				?>
			<!-- Single gallery Item -->
			<div class="col-12 col-md-6 single_gallery_item entre wow fadeInUp" data-wow-delay="0.2s">
			<!-- Welcome Music Area -->
				<div class="poca-music-area style-2 d-flex align-items-center flex-wrap">
					<div class="poca-music-thumbnail">
					<!-- <img src="./img/bg-img/5.jpg" alt=""> -->
					<?php echo get_the_post_thumbnail( $podcast_post->ID ); ?>
					</div>
					<div class="poca-music-content text-center">
					<span class="music-published-date mb-2"><?php echo get_the_date( 'F j, Y', $podcast_post->ID ); ?></span>
					<h2><?php echo esc_html( get_the_title( $podcast_post->ID ) ); ?></h2>
					<div class="music-meta-data">
					<?php $cats = wp_get_post_terms( $podcast_post->ID, 'poca_podcast_category' ); ?>
						<p>By <a href="#" class="music-author">Admin</a> | <a href="#" class="music-catagory">
						<?php
						foreach ( $cats as $cat1 ) {
							echo esc_html( $cat1->name . ' ' );
						}
						?>
						</a> | <a href="#" class="music-duration"><?php echo esc_html( get_the_time( '', $podcast_post->ID ) ); ?></a></p>
					</div>
					<!-- Music Player -->
					<div class="poca-music-player">
						<audio preload="auto" controls>
						<source src="<?php echo esc_html( get_template_directory_uri() . '/audio/dummy-audio.mp3' ); ?>">
						</audio>
					</div>
					<!-- Likes, Share & Download -->
					<div class="likes-share-download d-flex align-items-center justify-content-between">
						<a href="#"><i class="fa fa-heart" aria-hidden="true"></i> Like (29)</a>
						<div>
						<a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> Share(04)</a>
						<a href="#"><i class="fa fa-download" aria-hidden="true"></i> Download (12)</a>
						</div>
					</div>
					</div>
				</div>
			</div>	
		<?php } ?>
	<?php } ?>
	</div>
		<?php
	}
	// Always die in functions echoing ajax content.
	die();
}

add_action( 'wp_ajax_podcast_request', 'podcast_ajax_request' );

// If you wanted to also use the function for non-logged in users (in a theme for example).
add_action( 'wp_ajax_nopriv_podcast_request', 'podcast_ajax_request' );
