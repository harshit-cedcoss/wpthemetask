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
		'show_in_rest'       => false,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array( 'category', 'post_tag' ),
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
