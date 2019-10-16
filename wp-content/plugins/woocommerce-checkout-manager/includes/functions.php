<?php

function wooccm_get_woo_version() {

	$version = false;
	if( defined( 'WC_VERSION' ) ) {
		$version = WC_VERSION;
	// Backwards compatibility
	} else if( defined( 'WOOCOMMERCE_VERSION' ) ) {
		$version = WOOCOMMERCE_VERSION;
	}
	return $version;

}