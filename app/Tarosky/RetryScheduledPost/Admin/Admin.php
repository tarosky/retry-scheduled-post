<?php

namespace Tarosky\RetryScheduledPost\Admin;

use Tarosky\RetryScheduledPost\Pattern\Singleton;
use Tarosky\RetryScheduledPost\Utility\Util;

/**
 * Class Admin
 *
 * @package Tarosky\RetryScheduledPost\Admin
 */
class Admin extends Singleton {

	/**
	 * Constructor
	 */
	protected function init() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'updated_option', [ $this, 'updated_option' ], 10, 3 );
	}

	/**
	 * Register admin menu.
	 */
	public function admin_menu() {
		add_options_page(
			__( 'Retry Scheduled Post', 'retry-scheduled-post' ),
			__( 'Retry Scheduled Post', 'retry-scheduled-post' ),
			'manage_options',
			$this->slug,
			[ $this, 'display' ]
		);
	}

	/**
	 * Register settings.
	 */
	public function admin_init() {
		register_setting( $this->slug, $this->slug );

		add_settings_section( 'basic_settings', __( 'Basic Settings', 'retry-scheduled-post' ), function () {
			printf(
				'<p class="description">%s</p>',
				esc_html__( 'You can adjust the plugin basic settings.', 'retry-scheduled-post' )
			);
		}, $this->slug );

		add_settings_field(
			'retry_post_count',
			__( 'Retry post count', 'retry-scheduled-post' ),
			[ $this, 'retry_post_count_callback' ],
			$this->slug,
			'basic_settings'
		);
	}

	/**
	 * Render callback for retry post count.
	 */
	public function retry_post_count_callback() {
		$retry_post_count = isset( $this->options['retry_post_count'] ) ? $this->options['retry_post_count'] : '';
		?>
        <input name="<?php echo $this->slug; ?>[retry_post_count]" type="number" step="1" min="1" max="100"
               id="retry_post_count" value="<?php echo esc_attr( $retry_post_count ); ?>"
               class="small-text">
        <p class="description"><?php printf( __( 'Retry this number at one time. Default is <code>%s</code>.', 'retry-scheduled-post' ), Util::default_retry_post_count() ); ?></p>
		<?php
	}

	/**
	 * Admin menu render callback.
	 */
	public function display() {
		$action = untrailingslashit( admin_url() ) . '/options.php';
		?>
        <div class="wrap retry-scheduled-post-settings">
            <h1 class="wp-heading-inline"><?php _e( 'Retry Scheduled Post Settings', 'retry-scheduled-post' ); ?></h1>
            <form action="<?php echo esc_url( $action ); ?>" method="post">
				<?php
				settings_fields( $this->slug );
				do_settings_sections( $this->slug );
				submit_button();
				?>
            </form>
        </div>
		<?php
	}

	/**
	 * Fires after the value of an option has been successfully updated.
	 *
	 * @param $option
	 * @param $old_value
	 * @param $value
	 */
	public static function updated_option( $option, $old_value, $value ) {
		switch( $option ) {
			case 'retry-scheduled-post':
				//
				break;
		}
	}
}
