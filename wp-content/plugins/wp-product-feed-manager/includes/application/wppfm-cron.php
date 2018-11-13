<?php

/**
 * @package WP Product Feed Manager/Application/Functions
 * @version 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Activates the feed update schedules using Cron Jobs
 * 
 * @param none
 * @return nothing
 */
function wppfm_update_feeds() {
	// include the required wordpress files
	require_once ( ABSPATH . 'wp-load.php' );
	require_once ( ABSPATH . 'wp-admin/includes/admin.php' );
	require_once ( ABSPATH . 'wp-admin/includes/file.php' ); // required for using the file system
	
	// include all product feed manager files
	require_once ( __DIR__ . '/../wppfm-wpincludes.php' );
	require_once ( __DIR__ . '/../data/wppfm-admin-functions.php' );
	require_once ( __DIR__ . '/../user-interface/wppfm-messaging.php' );	
	require_once ( __DIR__ . '/../application/wppfm-feed-processing-support.php' );

	// WooCommerce needs to be installed and active
	if ( ! wppfm_wc_installed_and_active() ) {
		wppfm_write_log_file( 'Tried to start the auto update process but failed because WooCommerce is not installed.' );
		exit;
	}

	// Feed Manager requires at least WooCommerce version 3.0.0
	if( ! wppfm_wc_min_version_required() ) {
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
	$background_process = new WPPFM_Feed_Processor_Class();

	// update the database if required
	$db_management = new WPPFM_Database();
	$db_management->verify_db_version();
	
	// start updating the active feeds
	$wppfm_schedules = new WPPFM_Schedules();
	$wppfm_schedules->update_active_feeds();
}