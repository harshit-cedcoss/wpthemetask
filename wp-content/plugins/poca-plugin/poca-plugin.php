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

