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
 * Activation.
 */
function activate() {
	add_op();
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}
function add_op() {
	// adding a new option.
	add_option( 'installed_on' );
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
