<?php

namespace Tarosky\RetryScheduledPost\Command;

use Tarosky\RetryScheduledPost\Hooks\Schedule;
use Tarosky\RetryScheduledPost\Pattern\Singleton;

/**
 * Class Cli
 *
 * @package Tarosky\RetryScheduledPost\Command
 */
class Cli extends Singleton {

	/**
	 * Initialize
	 */
	public function init() {
		\WP_CLI::add_command( 'retry-scheduled-post', array( $this, 'retry_scheduled_post_command' ) );
	}

	/**
	 * Retry scheduled post command
	 *
	 * ## EXAMPLES
	 *
	 *  wp retry-scheduled-post
	 *
	 * @synopsis [<environment>]
	 *
	 * @param $args
	 */
	public function retry_scheduled_post_command( $args ) {

		\WP_CLI::line( 'Retry scheduled post.' );

		$schedule = Schedule::get_instance();
		$schedule->retry_scheduled_post();

		\WP_CLI::success( 'Retry scheduled post.' );
	}
}
