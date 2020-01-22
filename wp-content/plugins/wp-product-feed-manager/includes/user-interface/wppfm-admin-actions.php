<?php

/**
 * @package WP Product Feed Manager/User Interface/Functions
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add the feed manager menu in the Admin page
 *
 * @param bool $channel_updated default false
 */
function wppfm_add_feed_manager_menu( $channel_updated = false ) {
	// defines the feed manager menu
	add_menu_page(
		__( 'WP Feed Manager', 'wp-product-feed-manager' ),
		__( 'Feed Manager', 'wp-product-feed-manager' ),
		'manage_woocommerce',
		'wp-product-feed-manager',
		'wppfm_feed_manager_main_page',
		esc_url( WPPFM_PLUGIN_URL . '/images/app-rss-plus-xml-icon.png' )
	);

	// add the channels page only for the full version ref MKFRPLGN
	if ( WPPFM_EDD_SL_ITEM_NAME === 'Woocommerce Product Feed Manager' ) {
		$channel_class            = new WPPFM_Channel();
		$channels_updates_counter = (int) $channel_class->get_number_of_updates_from_server( $channel_updated );

		$counter_title = sprintf(
		/* translators: %d: Number of channel updates available */
			_n(
				'%d channel update',
				'%d channel updates',
				$channels_updates_counter,
				'wp-product-feed-manager'
			),
			$channels_updates_counter
		);

		$menu_label = sprintf(
		/* translators: %d: Number of channel updates available */
			__(
				'Manage Channels %s',
				'wp-product-feed-manager'
			),
			"<span class='update-plugins count-$channels_updates_counter' data-counter='$channels_updates_counter'
				id='channel-update-counter' title='$counter_title'><span
				class='wppfm-update-counter'>" . $channels_updates_counter . '</span></span>'
		);
	}

	// add the settings
	add_submenu_page(
		'wp-product-feed-manager',
		__( 'Settings', 'wp-product-feed-manager' ),
		__( 'Settings', 'wp-product-feed-manager' ),
		'manage_woocommerce',
		'wppfm-options-page',
		'wppfm_options_page'
	);
}

add_action( 'admin_menu', 'wppfm_add_feed_manager_menu' );

/**
 * Checks if the backups are valid for the current database version and warns the user if not
 *
 * @since 1.9.6
 */
function wppfm_check_backups() {
	if ( ! wppfm_check_backup_status() ) {
		$msg = __( 'Due to the latest update your Feed Manager backups are no longer valid! Please open the Feed Manager Settings page, remove all your backups in and make a new one.', 'wp-product-feed-manager' )
		?>
		<div class="notice notice-warning is-dismissible">
			<p><?php echo $msg; ?></p>
		</div>
		<?php
	}
}

add_action( 'admin_notices', 'wppfm_check_backups' );

/**
 * Sets the global background process
 *
 * @since 1.10.0
 *
 * @global WPPFM_Feed_Processor $background_process
 */
function initiate_background_process() {
	global $background_process;

	if ( isset( $_GET['tab'] ) ) {
		$active_tab = $_GET['tab'];
		set_transient( 'wppfm_set_global_background_process', $active_tab, WPPFM_TRANSIENT_LIVE );
	} else {
		$active_tab = ! get_transient( 'wppfm_set_global_background_process' ) ? 'feed-list' : get_transient( 'wppfm_set_global_background_process' );
	}

	if ( ( 'product-feed' === $active_tab || 'feed-list' === $active_tab ) ) {
		if ( ! class_exists( 'WPPFM_Feed_Processor' ) ) {
			require_once( __DIR__ . '/../application/class-wppfm-feed-processor.php' );
		}

		$background_process = new WPPFM_Feed_Processor();
	}

	if ( 'product-review-feed' === $active_tab ) {
		if ( ! class_exists( 'WPPRFM_Review_Feed_Processor' ) ) {
			require_once( __DIR__ . '/../../../wp-product-review-feed-manager/includes/classes/class-wpprfm-review-feed-processor.php' );
		}

		$background_process = new WPPRFM_Review_Feed_Processor();
	}
}

// register the background process
add_action( 'wp_loaded', 'initiate_background_process' );
