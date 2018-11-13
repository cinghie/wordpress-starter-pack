<?php

/**
 * WPPFM Product Feed Manager Add Feed Page Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_Add_Feed_Page' ) ) :

	/**
	 * Add Feed Page Class
	 */
	class WPPFM_Add_Feed_Page extends WPPFM_Admin_Page {

		/**
		 * Holds the code for the feed page
		 * 
		 * @var string
		 */
		private $_feed_form;

		/**
		 * The constructor
		 */
		public function __construct() {
			parent::__construct();
			
			// update the database if required
			$db_management = new WPPFM_Database();
			$db_management->verify_db_version();

			add_option( 'wp_enqueue_scripts', WPPFM_i18n_Scripts::wppfm_feed_settings_i18n() );
			add_option( 'wp_enqueue_scripts', WPPFM_i18n_Scripts::wppfm_list_table_i18n() );
			
			$this->prepare_feed_form();
		}

		public function show() {
			echo $this->admin_page_header();

			echo $this->message_field();

			echo $this->main_page_body_top();

			echo $this->main_admin_buttons();

			echo $this->admin_page_footer();
		}

		private function prepare_feed_form() {
			$this->_feed_form = new WPPFM_Feed_Form ();
		}

		private function main_page_body_top() {
			$this->_feed_form->display();
		}

		private function main_admin_buttons() {
			return '<div class="button-wrapper" id="page-bottom-buttons"><input class="button-primary" type="button" ' .
			'onclick="parent.location=\'admin.php?page=wp-product-feed-manager\'" name="new" value="' .
			esc_html__( 'Open Feed List', 'wp-product-feed-manager' ) . '" id="add-new-feed-button" /></div>';
		}

	}

	

     // end of WPPFM_Add_Feed_Page class

endif;