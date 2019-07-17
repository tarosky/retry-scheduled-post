<?php

namespace Tarosky\RetryScheduledPost\Utility;

use Tarosky\RetryScheduledPost;

/**
 * Class Util
 *
 * @package Tarosky\RetryScheduledPost\Utility
 */
class Util {

	/**
	 * Constructor
	 */
	public function __construct() {
		//
	}

	/**
	 * Default retry post count.
	 */
	public static function default_retry_post_count() {

		/**
		 * Filters default retry post count.
		 *
		 * @param int
		 */
		return apply_filters( 'rsp_default_retry_post_count', 10 );
	}
}
