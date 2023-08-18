<?php

/**
 * @package WP Product Feed Manager/User Interface/Functions
 * @version 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wppfm_feed_manager_main_page() {

	global $wppfm_tab_data;

	$active_tab          = $_GET['tab'] ?? 'feed-list';
	$page_start_function = 'wppfm_main_admin_page'; // default

	$list_tab = new WPPFM_Tab(
		'feed-list',
		'feed-list' === $active_tab,
		__( 'Feed List', 'wp-product-feed-manager' ),
		'wppfm_main_admin_page'
	);

	$product_feed_tab = new WPPFM_Tab(
		'product-feed',
		'product-feed' === $active_tab,
		__( 'Product Feed', 'wp-product-feed-manager' ),
		'wppfm_add_product_feed_page'
	);

	$wppfm_tab_data = apply_filters( 'wppfm_main_form_tabs', array( $list_tab, $product_feed_tab ), $active_tab );

	foreach ( $wppfm_tab_data as $tab ) {
		if ( $tab->get_page_identifier() === $active_tab ) {
			$page_start_function = $tab->get_class_identifier();
			break;
		}
	}

	$page_start_function();
}

/**
 * starts the main admin page
 */
/** @noinspection PhpUnused */
function wppfm_main_admin_page() {
	$start = new WPPFM_Main_Admin_Page();
	$start->show();
}

/**
 * starts the product feed page
 */
/** @noinspection PhpUnused */
function wppfm_add_product_feed_page() {
	$add_new_feed_page = new WPPFM_Product_Feed_Page();
	$add_new_feed_page->show();
}

/**
 * starts the options page
 */
function wppfm_options_page() {
	$add_options_page = new WPPFM_Add_Options_Page();
	$add_options_page->show();
}

/**
 * Returns an array of possible feed types that can be altered using the wppfm_feed_types filter.
 *
 * @return array with possible feed types
 */
function wppfm_list_feed_type_text() {

	return apply_filters(
		'wppfm_feed_types',
		array(
			'1'  => 'Product Feed',
			'10' => 'API Product Feed',
		)
	);
}

/**
 * Returns a string containing the footer for the plugin pages. This footer contains links to the About Us and
 * Contact Us pages and the Terms and Conditions and Documentation.
 *
 * @return  string  Html code containing the footer for the plugin pages.
 */
function wppfm_page_footer() {
	return '<a href="' . WPPFM_EDD_SL_STORE_URL . '" target="_blank">' . esc_html__( 'About Us', 'wp-product-feed-manager' ) . '</a>
			 | <a href="' . WPPFM_EDD_SL_STORE_URL . 'support/" target="_blank">' . esc_html__( 'Contact Us', 'wp-product-feed-manager' ) . '</a>
			 | <a href="' . WPPFM_EDD_SL_STORE_URL . 'terms/" target="_blank">' . esc_html__( 'Terms and Conditions', 'wp-product-feed-manager' ) . '</a>
			 | <a href="' . WPPFM_EDD_SL_STORE_URL . 'support/documentation/create-product-feed/" target="_blank">' . esc_html__( 'Documentation', 'wp-product-feed-manager' ) . '</a>
			 | '
	. sprintf(
		/* translators: %s: five stars link */
		__( 'If you like working with our Feed Manager please leave us a %s rating. A huge thanks in advance!', 'wp-product-feed-manager' ),
		'<a href="https://wordpress.org/support/plugin/wp-product-feed-manager/reviews?rate=5#new-post" target="_blank" class="wppfm-rating-request">' . '&#9733;&#9733;&#9733;&#9733;&#9733;' . '</a>'
	);
}

/** @noinspection PhpUnused */
function wppfm_sanitize_license( $new ) {
	$old = get_option( 'wppfm_lic_key' );

	if ( $old && $old !== $new ) {
		delete_option( 'wppfm_lic_status' ); // new license has been entered, so must reactivate
	}

	return $new;
}

function wppfm_check_license( $license ) {
	// return false if no license is given
	if ( ! $license ) {
		return false;
	}

	$tab                  = $_GET['tab'] ?? '';
	$edd_sl_plugin_name   = apply_filters( 'wppfm_edd_plugin_item_name', urlencode( WPPFM_EDD_SL_ITEM_NAME ), $tab );
	$edd_sl_plugin_prefix = apply_filters( 'wppfm_edd_plugin_prefix', 'wppfm', $tab );

	$api_params = array(
		'edd_action' => 'check_license',
		'license'    => $license,
		'item_name'  => $edd_sl_plugin_name,
	);

	$response = wp_remote_get(
		add_query_arg(
			$api_params,
			WPPFM_EDD_SL_STORE_URL
		),
		array(
			'timeout' => 5,
		)
	);

	if ( is_wp_error( $response ) ) {
		if ( '0' === get_option( $edd_sl_plugin_prefix . '_lic_failed_server_response', '0' ) ) {
			update_option( $edd_sl_plugin_prefix . '_lic_failed_server_response', '1' );
			return 'valid';
		}

		echo wppfm_handle_wp_errors_response(
			$response,
			sprintf(
				/* translators: %s: link to the support page */
				esc_html__(
					'2122 - Checking your license failed. Please open a support ticket at %s for support on this issue.',
					'wp-product-feed-manager'
				),
				WPPFM_SUPPORT_PAGE_URL
			)
		);

		return false;
	}

	update_option( $edd_sl_plugin_prefix . '_lic_failed_server_response', '0' );

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	update_option( $edd_sl_plugin_prefix . '_lic_expires', property_exists( $license_data, 'expires' ) ? $license_data->expires : '' );

	if ( $license_data && 'valid' === $license_data->license ) {
		return 'valid'; // this license is still valid
	} else {
		delete_option( $edd_sl_plugin_prefix . '_check_license_expiration' ); // reset the expiration messages

		return $license_data->license; // this license is no longer valid
	}
}
