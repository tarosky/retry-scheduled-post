<?php

namespace Tarosky\RetryScheduledPost\Hooks;

use Tarosky\RetryScheduledPost\Pattern\Singleton;
use Tarosky\RetryScheduledPost\Utility\Util;

/**
 * Class Schedule
 *
 * @package Tarosky\MediaXmlSitemap\Hooks
 */
class Schedule extends Singleton {

	/**
	 * Constructor
	 */
	protected function init() {
		add_filter( 'cron_schedules', [ $this, 'cron_schedules' ] );
		add_action( 'retry_scheduled_post', [ $this, 'retry_scheduled_post' ] );
	}

	/**
	 * Filter cron schedule.
	 *
	 * @param $schedules
	 *
	 * @return mixed
	 */
	public function cron_schedules( $schedules ) {

		if ( ! $retry_interval = $this->options['retry_interval'] ) {
			$retry_interval = Util::default_retry_interval();
		}
		$schedules['rsp_interval'] = [
			'interval' => $retry_interval * MINUTE_IN_SECONDS,
			'display'  => sprintf( __( 'Every %d minutes', 'retry-scheduled-post' ), $retry_interval )
		];

		return $schedules;
	}

	/**
	 * Update cron schedule event.
	 */
	public function update_cron_schedule() {
		$this->clear_cron_schedule();
		wp_schedule_event( current_time( 'timestamp', true ), 'rsp_interval', 'retry_scheduled_post' );
	}

	/**
	 * Clear cron schedule event.
	 */
	public function clear_cron_schedule() {
		if ( wp_next_scheduled( 'retry_scheduled_post' ) ) {
			wp_clear_scheduled_hook( 'retry_scheduled_post' );
		}
	}

	/**
	 * Run cron schedulee event.
	 */
	public function retry_scheduled_post() {
		$query = "SELECT ID FROM {$this->db->posts} WHERE post_status='future' AND post_date<=CURRENT_TIMESTAMP() LIMIT 5";
		if ( $post_ids = $this->db->get_col( $query ) ) {
			foreach ( $post_ids as $post_id ) {
				wp_publish_post( $post_id );
			}
		}
	}
}
