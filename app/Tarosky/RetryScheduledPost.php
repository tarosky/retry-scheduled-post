<?php

namespace Tarosky;

use Tarosky\RetryScheduledPost\Admin\Admin;
//use Tarosky\RetryScheduledPost\Hooks\Rules;
use Tarosky\RetryScheduledPost\Pattern\Singleton;

/**
 * Run this plugin.
 *
 * @package Retry_Scheduled_Post
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
//		Rules::get_instance();
//		News::get_instance();
//		Sitemap::get_instance();
	}

	/**
	 * Deactivation
	 */
	public function deactivation() {
		delete_option( $this->get_slug() );
		flush_rewrite_rules();
	}

	/**
	 * Get plugin slug.
	 */
	public function get_slug() {
		return $this->slug;
	}
}
