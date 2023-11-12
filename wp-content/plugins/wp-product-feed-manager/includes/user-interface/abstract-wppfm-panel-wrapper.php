<?php

/**
 * WPPFM Panel Wrapper Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @since 2.39.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPFM_Panel_Wrapper' ) ) :

	abstract class WPPFM_Panel_Wrapper {

		abstract public function display();

	}

	// end of WPPFM_Panel_Wrapper class

endif;
