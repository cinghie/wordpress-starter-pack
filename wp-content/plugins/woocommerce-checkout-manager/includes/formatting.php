<?php
function wooccm_mul_array( $val, $array ) {

	if( !empty( $array ) ) {
		if( is_array( $array ) ) {
			foreach( $array as $item ) {
				if( isset( $item['cow'] ) && $item['cow'] == $val ) {
					return true;
				}
			}
		}
	}

}

function wooccm_wpml_string( $input = '' ) {

	if( function_exists( 'icl_t' ) ) {
		return icl_t('WooCommerce Checkout Manager', $input, $input );
	} else {
		return $input;
	}

}