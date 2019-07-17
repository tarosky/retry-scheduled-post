<?php
/**
 * Utility functions
 *
 * @package RetryScheduledPost
 */

/**
 * Default retry interval.
 */
function rsp_default_retry_interval() {

	/**
	 * Filters default retry interval.
	 *
	 * @param int
	 */
	return apply_filters( 'rsp_default_retry_interval', 5 );
}

/**
 * Default retry post count.
 */
function rsp_default_retry_post_count() {

	/**
	 * Filters default retry post count.
	 *
	 * @param int
	 */
	return apply_filters( 'rsp_default_retry_post_count', 10 );
}
