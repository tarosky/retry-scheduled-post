<?php
/**
 * Plugin Name:     Retry Scheduled Post
 * Plugin URI:      https://github.com/tarosky/retry-scheduled-post
 * Description:     If the future scheduled post failed to publish, this plugin will republish it.
 * Author:          tarosky, ko31
 * Author URI:      https://tarosky.co.jp
 * Text Domain:     retry-scheduled-post
 * Domain Path:     /languages
 * Version:         1.1.1
 *
 * @package         Retry_Scheduled_Post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );

require_once( dirname( __FILE__ ) . '/functions.php' );

/**
 * Initialize plugin.
 */
add_action( 'plugins_loaded', function () {
	load_plugin_textdomain(
		'retry-scheduled-post',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);
	Tarosky\RetryScheduledPost::get_instance()->register();
} );

/**
 * Activation hook.
 */
register_activation_hook( __FILE__, function () {
	Tarosky\RetryScheduledPost::get_instance()->activation();
} );

/**
 * Deactivation hook.
 */
register_deactivation_hook( __FILE__, function () {
	Tarosky\RetryScheduledPost::get_instance()->deactivation();
} );
