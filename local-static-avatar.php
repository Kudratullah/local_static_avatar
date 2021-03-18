<?php
/**
 *
 * Plugin Name: Local Static Avatar
 * Author: Kudratullah
 * Author URI: https://pixelhive.pro/
 * Plugin URI: https://github.com/pixelhive/local_static_avatar
 * Description: Loads Gravatar's Mystery Man From Local Directory to eliminate requests to gravatar server, improve page load on local development environment.
 * Version: 1.0.0
 * License: GPL v2 or later
 */

if ( ! defined( 'LOCAL_AVATAR_ENABLED' ) ) {
	define( 'LOCAL_AVATAR_ENABLED', true );
}

if ( ! defined( 'LOCAL_AVATAR_DIR' ) ) {
	define( 'LOCAL_AVATAR_DIR', plugin_dir_path( __FILE__ ) .'avatars' );
}

if ( ! defined( 'LOCAL_AVATAR_URL' ) ) {
	define( 'LOCAL_AVATAR_URL', plugin_dir_url( __FILE__ ) .'avatars' );
}

if ( LOCAL_AVATAR_ENABLED ) {
	add_filter( 'pre_get_avatar_data', function( $args ) {
		if ( ! isset( $args['size'] ) ) {
			$args['size'] = 96;
		}
		$size = $args['size'];
		if ( file_exists( LOCAL_AVATAR_DIR . "/avatar-{$size}x{$size}.jpg" ) ) {
			$args['url'] = LOCAL_AVATAR_URL . "/avatar-{$size}x{$size}.jpg";
		} else if ( LOCAL_AVATAR_DIR . '/avatar-2048x2048.jpg' ) {
			$args['url'] = LOCAL_AVATAR_URL . '/avatar-2048x2048.jpg';
		} else {
			$args['url'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
		}
		
		return $args;
	} );
}
