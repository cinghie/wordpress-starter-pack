<?php

/**
 * WP Email Class.
 *
 * @package WP Product Feed Manager/Application/Classes
 * @version 1.1.0
 * @since 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_Email_Class' ) ) :

	/**
	 * Email Class
	 */
	class WPPFM_Email_Class {
	
		public static function send_feed_failed_message() {
			$to = get_option( 'wppfm_notice_mailaddress' ) ? get_option( 'wppfm_notice_mailaddress' ) : get_bloginfo( 'admin_email' );

			if ( ! $to ) {
				return false;
			}
			
			$header = self::feed_failed_header();
			$message = self::feed_failed_message();
			
			return self::send( $to, $header, $message );
		}
		
		private static function feed_failed_header() {
			return sprintf( 'Feed generation failure on your %s shop', get_bloginfo( 'name' ) );
		}
		
		private static function feed_failed_message() {
			$message = sprintf( 'This is an automatic message from your %s plugin. One or more product feeds on your %s shop failed to generate. Please check the status of your feeds and try to manually regenerate them again.

Should this problem persist, please open a support ticket.', WPPFM_EDD_SL_ITEM_NAME, get_bloginfo( 'name' ) );
			return $message;
		}
		
		/**
		 * Sends the email
		 * 
		 * @param string $to to address
		 * @param string $subject the subject
		 * @param string $message the message
		 */
		private static function send( $to, $subject, $message ) {
			return wp_mail( $to, $subject, $message );
		}
	}

	// end of WPPFM_Email_Class

endif;
	

