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
 * $content filtering
 */
function helloworld_filter_content( $content ) {
	if ( is_single() ) {
		return '<a href="https://twitter.com/intent/tweet?url=<?=urlencode($url)?>">The Link for upload on twitter</a>' . $content;
	}
}
add_filter( 'the_content', 'helloworld_filter_content' );
