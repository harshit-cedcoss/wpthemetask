<?php
/**
 * Trigger this file on Plugin Uninstall
 *
 * @package Harshit Plugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

$option_name = 'wporg_option';

// $option_name['delete_all'] contains my option setting to delete all settings.
if ( 1 === $option_name['delete_all'] ) {

	delete_option( $option_name );

	// for site options in Multisite.
	delete_site_option( $option_name );

}
