<?php

/**
 * @package WP Product Feed Manager/Application/Functions
 * @version 1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Activates the feed update schedules using Cron Jobs
 */
function wppfm_update_feeds() {
	// include the required WordPress files
	require_once( ABSPATH . 'wp-load.php' );
	require_once( ABSPATH . 'wp-admin/includes/admin.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' ); // required for using the file system
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // required to prevent a fatal error about not finding the is_plugin_active function

	// include all product feed manager files
	require_once( __DIR__ . '/../wppfm-wpincludes.php' );
	require_once( __DIR__ . '/../data/wppfm-admin-functions.php' );
	require_once( __DIR__ . '/../user-interface/wppfm-messaging-functions.php' );
	require_once( __DIR__ . '/../user-interface/wppfm-url-functions.php' );
	require_once( __DIR__ . '/../application/wppfm-feed-processing-support.php' );

	// WooCommerce needs to be installed and active
	if ( ! wppfm_wc_installed_and_active() ) {
		wppfm_write_log_file( 'Tried to start the auto update process but failed because WooCommerce is not installed.' );
		exit;
	}

	// Feed Manager requires at least WooCommerce version 3.0.0
	if ( ! wppfm_wc_min_version_required() ) {
		wppfm_write_log_file( sprintf( 'Tried to start the auto update process but failed because WooCommerce is older than version %s', WPPFM_MIN_REQUIRED_WC_VERSION ) );
		exit;
	}

	WC_Post_types::register_taxonomies(); // make sure the woocommerce taxonomies are loaded
	WC_Post_types::register_post_types(); // make sure the woocommerce post types are loaded

	// include all required classes
	include_classes();
	include_channels();

	do_action( 'wppfm_automatic_feed_processing_triggered' );

	global $background_process;
	$background_process = new WPPFM_Feed_Processor();

	// update the database if required
	wppfm_check_db_version();

	// start updating the active feeds
	$wppfm_schedules = new WPPFM_Schedules();
	$wppfm_schedules->update_active_feeds();
}