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

if ( ! defined( 'ABSPATH' ) ) { // global variable is to defined.
	die( 'Canot access this site' );
}

if ( ! function_exists( 'add_action' ) ) { // checking if a predefined function exists or not.
	echo 'This site cannot be accessed';
	exit;
}
/**
 * Custom class
 */
class Hello_World {

	/**
	 * Constructor function.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
	}
	/**
	 * Activation.
	 */
	public function activate() {
		// generate a CPT(Custom Post Type).
		$this->custom_post_type();
		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules();
	}
	/**
	 * Deactivation
	 */
	public function deactivate() {
		// Unregister the post type, so the rules are no longer in memory.
		unregister_post_type( 'book' );
		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules();
	}
	/**
	 * Custom Post Type
	 */
	protected function custom_post_type() {
		register_post_type(
			'book',
			array(
				'public' => true,
				'label'  => 'Book_Tuts',
			)
		);
	}

}
if ( class_exists( 'My_Plugin' ) ) {
	$my_plugin1 = new Hello_World(); // Object Creation.
}
// activation.
register_activation_hook( __FILE__, array( $my_plugin1, 'activate' ) );

// deactivation.
register_deactivation_hook( __FILE__, array( $my_plugin1, 'deactivate' ) );
