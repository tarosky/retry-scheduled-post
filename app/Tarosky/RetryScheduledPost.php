<?php

namespace Tarosky;

use Tarosky\RetryScheduledPost\Admin\Admin;
use Tarosky\RetryScheduledPost\Command\Cli;
use Tarosky\RetryScheduledPost\Hooks\Schedule;
use Tarosky\RetryScheduledPost\Pattern\Singleton;

/**
 * Class RetryScheduledPost
 *
 * @package Tarosky
 */
class RetryScheduledPost extends Singleton {

	private $slug = 'retry-scheduled-post';

	/**
	 * Register
	 */
	public function register() {
		if ( is_admin() ) {
			Admin::get_instance();
		}
		Schedule::get_instance();

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			Cli::get_instance();
		}
	}

	/**
	 * Aactivation
	 */
	public function activation() {
		Schedule::get_instance()->update_cron_schedule();
	}

	/**
	 * Deactivation
	 */
	public function deactivation() {
		delete_option( $this->get_slug() );
		Schedule::get_instance()->clear_cron_schedule();
	}

	/**
	 * Get plugin slug.
	 */
	public function get_slug() {
		return $this->slug;
	}
}
