<?php

/**
 * @package WP Product Feed Manager/User Interface/Functions
 * @version 1.1.0
 */

if ( ! defined('ABSPATH') ) { exit; }

/**
 * Add the feed manager menu in the Admin page
 */
function wppfm_add_feed_manager_menu( $channel_updated = false ) {
	// defines the feed manager menu
	add_menu_page(
		__( 'WP Feed Manager', 'wp-product-feed-manager' ), 
		__( 'Feed Manager', 'wp-product-feed-manager' ), 
		'manage_woocommerce', 'wp-product-feed-manager', 
		'wppfm_main_admin_page', 
		esc_url( WPPFM_PLUGIN_URL . '/images/app-rss-plus-xml-icon.png' ) 
	);

	add_submenu_page(
		'wp-product-feed-manager',
		__( 'Add Feed', 'wp-product-feed-manager' ), 
		__( 'Add Feed', 'wp-product-feed-manager' ), 
		'manage_woocommerce', 
		'wp-product-feed-manager-add-new-feed', 
		'wppfm_add_feed_page' 
	);
	
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
 * Adds links to the started guide and premium site
 * 
 * @since 2.6.0
 * 
 * @param array $actions associative array of action names to anchor tags
 * @param string $plugin_file plugin file name
 * @param array $plugin_data array of plugin data from the plugin file
 * @param string $context plugin status context
 * @return string
 */
function wppfm_plugins_action_links( $actions, $plugin_file, $plugin_data, $context ) {
	$actions[ 'starter_guide' ] = '<a href="' . WPPFM_EDD_SL_STORE_URL . '/support/documentation" target="_blank">' . __( 'Starter Guide', 'wp-product-feed-manager' ) . '</a>';
	
	if( 'WP Product Feed Manager' === WPPFM_EDD_SL_ITEM_NAME ) {
		$actions[ 'go_premium' ] = '<a style="color:green;" href="' . WPPFM_EDD_SL_STORE_URL . '" target="_blank"><b>' . __( 'Go Premium', 'wp-product-feed-manager' ) . '</b></a>';
	} else {
		$actions[ 'support' ] = '<a href="' . WPPFM_EDD_SL_STORE_URL . '/support" target="_blank">' . __( 'Get Support', 'wp-product-feed-manager' ) . '</a>';
	}
	
	return $actions;
}

add_filter( 'plugin_action_links_' . WPPFM_PLUGIN_CONSTRUCTOR, 'wppfm_plugins_action_links', 10, 4 );

/**
 * starts the main admin page
 */
function wppfm_main_admin_page() {
	$start = new WPPFM_Main_Admin_Page ();

	// now let's get things going
	$start->show();
}

function wppfm_add_feed_page() {
	$add_new_feed_page = new WPPFM_Add_Feed_Page ();
	$add_new_feed_page->show();
}

/**
 * options page
 */
function wppfm_options_page() {
	$add_options_page = new WPPFM_Add_Options_Page ();
	$add_options_page->show();
}

/**
 * Checks if the backups are valid for the current database version and warns the user if not
 * 
 * @since 1.9.6
 */
function wppfm_check_backups() {
	if( ! wppfm_check_backup_status() ) {
		$msg = __( 'Due to the latest update your Feed Manager backups are no longer valid! Please open the Feed Manager Settings page, remove all your backups in and make a new one.', 'wp-product-feed-manager' )
			?><div class="notice notice-warning is-dismissible">
			<p><?php echo $msg; ?></p>
		</div><?php
	}
}

add_action( 'admin_notices', 'wppfm_check_backups' );