<?php
/**
 * Plugin Name        Hello World
 *
 * @package           PluginPackage
 * @author            Harshit
 * @copyright         2019 Your Name or Company Name
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Hello World
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
{Hello World} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Hello World} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Hello World}. If not, see {URI to Plugin License}.
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
/**
 * Deactivation
 */
function deactivate() {
	// Deleting Option.
	delete_option( 'installed_on' );
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}

// activation.
register_activation_hook( __FILE__, 'activate' );

// deactivation.
register_deactivation_hook( __FILE__, 'deactivate' );
/**
 * @$content: Fetches the content
 *
 * function for filtering
 */
function helloworld_filter_content( $content ) {
	global $post;
	$url   = get_permalink();
	$count = strlen( html_entity_decode( strip_shortcodes( wp_strip_all_tags( $post->post_content ) ) ) );
	if ( is_single() ) {
		return '<a href="https://twitter.com/intent/tweet?url=' . rawurlencode( $url ) . '">Link To Twitter</a>' . $content . 'Number of characters in post: <b>' . $count . '</b>';
	}
}
add_filter( 'the_content', 'helloworld_filter_content' );
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function wporg_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'wporg_dashboard_widget',                          // Widget slug.
		esc_html__( 'Example Dashboard Widget' ), // Title.
		'wporg_dashboard_widget_render'                    // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function wporg_dashboard_widget_render() {
	// Display whatever you want to show.
	esc_html_e( "Howdy! I'm a great Dashboard Widget." );
}
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
/**
 * Custom option and settings
 */
function wporg_settings_init() {
	// register a new setting for "wporg" page.
	register_setting( 'wporg', 'wporg_options' );

	// register a new section in the "wporg" page.
	add_settings_section(
		'wporg_section_developers',
		__( 'The Matrix has you.', 'wporg' ),
		'wporg_section_developers_cb',
		'wporg'
	);

	// register a new section in the "wporg" page.
	add_settings_section(
		'wporg_section_developers_social_links',
		__( 'Social Links.', 'wporg' ),
		'wporg_section_developers_social_links_cb',
		'wporg'
	);

	// register a new field in the "wporg_section_developers" section, inside the "wporg" page.
	add_settings_field(
		'wporg_field_pill', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback.
		__( 'Pill', 'wporg' ),
		'wporg_field_pill_cb',
		'wporg',
		'wporg_section_developers',
		array(
			'label_for'         => 'wporg_field_pill',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		)
	);
	// register a new "Text" field in the "wporg_section_developers" section, inside the "wporg" page.
	add_settings_field(
		'wporg_field_text', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback.
		__( 'Text', 'wporg' ),
		'wporg_field_text_cb',
		'wporg',
		'wporg_section_developers',
		array(
			'label_for'         => 'wporg_field_text',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		)
	);
	// register a new "Facebook" field in the "wporg_section_developers" section, inside the "wporg" page.
	add_settings_field(
		'wporg_field_facebook_link', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback.
		__( 'Facebook Link', 'wporg' ),
		'wporg_field_facebook_link_cb',
		'wporg',
		'wporg_section_developers_social_links',
		array(
			'label_for'         => 'wporg_field_facebook_link',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		)
	);
	// register a new "Facebook" field in the "wporg_section_developers" section, inside the "wporg" page.
	add_settings_field(
		'wporg_field_twitter_link', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback.
		__( 'Twitter Link', 'wporg' ),
		'wporg_field_twitter_link_cb',
		'wporg',
		'wporg_section_developers_social_links',
		array(
			'label_for'         => 'wporg_field_twitter_link',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		)
	);
}

/**
 * Register our wporg_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'wporg_settings_init' );

/**
 * Custom option and settings:
 * callback functions
 */

// developers section cb.

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function wporg_section_developers_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
	<?php
}

function wporg_section_developers_social_links_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Find the social links here.', 'wporg' ); ?></p>
	<?php
}
/** Pill field cb.
 * Field callbacks can accept an $args parameter, which is an array.
 * $args is defined at the add_settings_field() function.
 * WordPress has magic interaction with the following keys: label_for, class.
 * The "label_for" key value is used for the "for" attribute of the <label>.
 * The "class" key value is used for the "class" attribute of the <tr> containing the field.
 * You can add custom key value pairs to be used inside your callbacks.
 */
function wporg_field_pill_cb( $args ) {
	// get the value of the setting we've registered with register_setting().
	$options = get_option( 'wporg_options' );
	// output the field.
	?>
	<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
	data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
	name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	>
		<option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
		<?php esc_html_e( 'red pill', 'wporg' ); ?>
		</option>
		<option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
		<?php esc_html_e( 'blue pill', 'wporg' ); ?>
		</option>
	</select>
	<p class="description">
		<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
	</p>
	<p class="description">
		<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
	</p>

	<?php
}
/**
 * Text field cb.
 * Field callbacks can accept an $args parameter, which is an array.
 * $args is defined at the add_settings_field() function.
 * WordPress has magic interaction with the following keys: label_for, class.
 * The "label_for" key value is used for the "for" attribute of the <label>.
 * The "class" key value is used for the "class" attribute of the <tr> containing the field.
 * You can add custom key value pairs to be used inside your callbacks.
 */
function wporg_field_text_cb( $args ) {
	// get the value of the setting we've registered with register_setting().
	$options = get_option( 'wporg_options' );
	// output the field.
	?>
	<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>" name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
	<?php
}
function wporg_field_facebook_link_cb( $args ) {
	// get the value of the setting we've registered with register_setting().
	$options = get_option( 'wporg_options' );
	// output the field.
	?>
	<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>" name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
	<?php
}
function wporg_field_twitter_link_cb( $args ) {
	// get the value of the setting we've registered with register_setting().
	$options = get_option( 'wporg_options' );
	// output the field.
	?>
	<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>" name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
	<?php
}

/**
 * Top level menu.
 */
function wporg_options_page() {
	// add top level menu page.
	add_menu_page(
		'WPOrg',
		'WPOrg Options',
		'manage_options',
		'wporg',
		'wporg_options_page_html'
	);
}

/**
 * Register our wporg_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'wporg_options_page' );

/**
 * Top level menu:
 * callback functions
 */
function wporg_options_page_html() {
	// check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
			return;
	}

	// Add error/update messages.

	// check if the user have submitted the settings.
	// WordPress will add the "settings-updated" $_GET parameter to the url.
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated".
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
	}

	// show error/update messages.
	settings_errors( 'wporg_messages' );
	?>
	<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "wporg".
		settings_fields( 'wporg' );
		// output setting sections and their fields
		// (sections are registered for "wporg", each field is registered to a specific section).
		do_settings_sections( 'wporg' );
		// output save settings button.
		submit_button( 'Save Settings' );
		?>
	</form>
</div>
	<?php
}
/**
 * Custom-Post
 *
 * @return void
 */
function wporg_custom_post_type() {
			$labels       = array(
				'name'                  => _x( 'Products', 'Post type general name', 'wporg_product' ),
				'singular_name'         => _x( 'Product', 'Post type singular name', 'wporg_product' ),
				'menu_name'             => _x( 'Product Menu', 'Admin Menu text', 'wporg_product' ),
				'add_new'               => _x( 'Add New', 'product', 'wporg_product' ),
				'add_new_item '         => __( 'Add New Product', 'wporg_product' ),
				'edit_item'             => __( 'Edit Product', 'wporg_product' ),
				'new_item'              => __( 'New Product', 'wporg_product' ),
				'name_admin_bar'        => _x( 'Products', 'Add new on toolbar', 'wporg_product' ),
				'view_item'             => __( 'View Product', 'wporg_product' ),
				'all_items'             => __( 'All Product', 'wporg_product' ),
				'search_items'          => __( 'Search Product', 'wporg_product' ),
				'not_found'             => __( 'No product found', 'wporg_product' ),
				'not_found_in_trash'    => __( 'No products found in trash', 'wporg_product' ),
				'parent_items_colon'    => __( 'Parent Product', 'wporg_product' ),
				'archives'              => __( 'Archives', 'wporg_product' ),
				'attributes'            => __( 'Attributes', 'wporg_product' ),
				'insert_into_item'      => __( 'Insert into product', 'wporg_product' ),
				'uploaded_to_this_item' => __( 'Upload to this product', 'wporg_product' ),
				'featured_image'        => _x( 'Product Cover Image', 'Overrides the featured image phrase for this post type', 'wporg_product' ),
			);
			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'description'        => __( 'Here the products are described', 'wporg_product' ),
				'has_archive'        => true,
				'rewrite'            => array( 'slug' => 'products' ), // my custom slug.
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
				'menu_icon'          => 'none',
				'map_meta_cap'       => true,
				'query-var'          => true,
			// 'register_meta_box_cb' => 'wporg_dashboard_widget_render',
			);
			register_post_type( 'wporg_product', $args );
}
add_action( 'init', 'wporg_custom_post_type' );
register_activation_hook( __FILE__, 'my_rewrite_flush' );
/**
 * 
 *
 * @return void
 */
function my_rewrite_flush() {
	// First, we "add" the custom post type via the above written function.
	// Note: "add" is written with quotes, as CPTs don't get added to the DB,
	// They are only referenced in the post_type column with a post entry,
	// when you add a post of this CPT.
	wporg_custom_post_type();

	// ATTENTION: This is *only* done during plugin activation hook in this example!
	// You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}

// /**
//  * Register a custom post type called "book".
//  *
//  * @see get_post_type_labels() for label keys.
//  */
// function wpdocs_codex_book_init() {
// 	$labels = array(
// 		'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
// 		'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
// 		'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
// 		'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
// 		'add_new'               => __( 'Add New', 'textdomain' ),
// 		'add_new_item'          => __( 'Add New Book', 'textdomain' ),
// 		'new_item'              => __( 'New Book', 'textdomain' ),
// 		'edit_item'             => __( 'Edit Book', 'textdomain' ),
// 		'view_item'             => __( 'View Book', 'textdomain' ),
// 		'all_items'             => __( 'All Books', 'textdomain' ),
// 		'search_items'          => __( 'Search Books', 'textdomain' ),
// 		'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
// 		'not_found'             => __( 'No books found.', 'textdomain' ),
// 		'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
// 		'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
// 		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
// 		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
// 		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
// 		'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
// 		'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
// 		'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
// 		'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
// 		'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
// 		'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
// 	);
 
// 	$args = array(
// 		'labels'             => $labels,
// 		'public'             => true,
// 		'publicly_queryable' => true,
// 		'show_ui'            => true,
// 		'show_in_menu'       => true,
// 		'query_var'          => true,
// 		'rewrite'            => array( 'slug' => 'book' ),
// 		'capability_type'    => 'post',
// 		'has_archive'        => true,
// 		'hierarchical'       => false,
// 		'menu_position'      => null,
// 		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
// 		'show_in_rest'       => true,
// 	);
 
// 	register_post_type( 'book', $args );
// }
 
// add_action( 'init', 'wpdocs_codex_book_init' );

function wporg_add_custom_post_types( $query ) {
	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'page', 'wporg_product' ) );
	}
	return $query;
}
add_action( 'pre_get_posts', 'wporg_add_custom_post_types' );

function wporg_register_taxonomy_course() {
	$labels = array(
		'name'              => _x( 'Courses', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Courses' ),
		'all_items'         => __( 'All Courses' ),
		'parent_item'       => __( 'Parent Course' ),
		'parent_item_colon' => __( 'Parent Course:' ),
		'edit_item'         => __( 'Edit Course' ),
		'update_item'       => __( 'Update Course' ),
		'add_new_item'      => __( 'Add New Course' ),
		'new_item_name'     => __( 'New Course Name' ),
		'menu_name'         => __( 'Course' ),
	);
	$args   = array(
		'hierarchical'      => true, // make it hierarchical (like categories).
		'labels'            => $labels,
		'description'       => 'this is the custom taxonomy description',
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'course' ),
	);
	register_taxonomy( 'course', array( 'wporg_product' ), $args );
}
add_action( 'init', 'wporg_register_taxonomy_course' );
