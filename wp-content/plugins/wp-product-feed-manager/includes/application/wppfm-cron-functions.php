<?php

/**
 * Initiates the Cron functions required for the automatic feed updates.
 *
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
	// Include the required WordPress files.
	require_once ABSPATH . 'wp-load.php';
	require_once ABSPATH . 'wp-admin/includes/admin.php';
	require_once ABSPATH . 'wp-admin/includes/file.php'; // Required for using the file system.
	require_once ABSPATH . 'wp-admin/includes/plugin.php'; // Required to prevent a fatal error about not finding the is_plugin_active function.

	// Include all product feed manager files.
	require_once __DIR__ . '/../wppfm-wpincludes.php';
	require_once __DIR__ . '/../data/wppfm-admin-functions.php';
	require_once __DIR__ . '/../user-interface/wppfm-messaging-functions.php';
	require_once __DIR__ . '/../user-interface/wppfm-url-functions.php';
	require_once __DIR__ . '/../application/wppfm-feed-processing-support.php';
	require_once __DIR__ . '/../application/wppfm-feed-processor-functions.php';

	// WooCommerce needs to be installed and active.
	if ( ! wppfm_wc_installed_and_active() ) {
		wppfm_write_log_file( 'Tried to start the auto update process but failed because WooCommerce is not installed.' );
		exit;
	}

	// Feed Manager requires at least WooCommerce version 3.0.0.
	if ( ! wppfm_wc_min_version_required() ) {
		wppfm_write_log_file( sprintf( 'Tried to start the auto update process but failed because WooCommerce is older than version %s', WPPFM_MIN_REQUIRED_WC_VERSION ) );
		exit;
	}

	if ( is_plugin_active( 'wp-product-review-feed-manager/wp-product-review-feed-manager.php' ) ) {
		wppfm_include_files_for_feed_review_manager();
	}

	WC_Post_types::register_taxonomies(); // Make sure the woocommerce taxonomies are loaded.
	WC_Post_types::register_post_types(); // Make sure the woocommerce post types are loaded.

	// Include all required classes.
	include_classes();
	include_channels();

	do_action( 'wppfm_automatic_feed_processing_triggered' );

	// Update the database if required.
	wppfm_check_db_version();

	// Start updating the active feeds.
	$wppfm_schedules = new WPPFM_Schedules();
	$wppfm_schedules->update_active_feeds();
}

/**
 * Includes the files required for automatic feed updates for Google Review Feeds made by the WP Google Review Feed Manager.
 *
 * @since 2.33.0.
 */
function wppfm_include_files_for_feed_review_manager() {
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/wpprfm-review-feed-form-functions.php';
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/wpprfm-setup-feed-manager.php';
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/wpprfm-include-classes-functions.php';
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/wpprfm-feed-generation-functions.php';

	// Include the traits.
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/traits/wpprfm-processing-support.php';
	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/traits/wpprfm-xml-element-functions.php';

	require_once __DIR__ . '/../../../wp-product-review-feed-manager/includes/wpprfm-include-classes-functions.php';

	// Include the required classes.
	wpprfm_include_classes();
}
