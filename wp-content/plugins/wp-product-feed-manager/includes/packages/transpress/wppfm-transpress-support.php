<?php

/**
 * Package that adds support for the Translatepress Multilingual plugin to the Feed Manager
 *
 * @package Transpress Support.
 * @since 2.36.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wppfm_transpress_setup();

/**
 * Includes all required classes and files for the translatepress-multilingual support package
 *
 * @since 2.36.0
 */
function wppfm_transpress_setup() {
	require_once __DIR__ . '/includes/wppfm-transpress-functions.php';

	// Include the required classes.
	if ( ! class_exists( 'WPPFM_Transpress_Product_Data' ) ) {
		require_once __DIR__ . '/includes/class-wppfm-transpress-product-data.php';
	}
}
