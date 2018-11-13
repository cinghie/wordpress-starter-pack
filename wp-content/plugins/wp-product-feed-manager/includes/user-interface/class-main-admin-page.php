<?php

/**
 * WPPFM Main Admin Page Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @version 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_Main_Admin_Page' ) ) :

	/**
	 * Main Admin Page Class
	 */
	class WPPFM_Main_Admin_Page extends WPPFM_Admin_Page {

		private $_list_table;

		function __construct() {
			parent::__construct();
			$this->prepare_feed_list();
		}

		/**
		 * Collects the html code for the main page and displays it.
		 */
		public function show() {
			// update the database if required
			$db_management = new WPPFM_Database();
			$db_management->verify_db_version();

			echo $this->admin_page_header();
			
			if ( wppfm_wc_installed_and_active() ) {
				if( ! wppfm_wc_min_version_required() ) {
					echo $this->update_woocommerce();
					exit;
				} else {
					echo $this->feedback_cta();
				}

				echo $this->tabs();

				echo $this->main_admin_page();

				echo $this->message_field();

				echo $this->main_admin_buttons();
			} else {
				echo $this->no_woocommerce();
			}

			echo $this->admin_page_footer();
		}

		/**
		 * Prepares the list table
		 */
		private function prepare_feed_list() {
			// prepare the table elements
			$this->_list_table = new WPPFM_List_Table ();

			$this->_list_table->set_table_id( "wppfm-feed-list" );

			// set the column names
			$this->_list_table->set_column_titles( array(
				'col_feed_name'        => esc_html__( 'Name', 'wp-product-feed-manager' ),
				'col_feed_url'         => esc_html__( 'Url', 'wp-product-feed-manager' ),
				'col_feed_last_change' => esc_html__( 'Updated', 'wp-product-feed-manager' ),
				'col_feed_products'    => esc_html__( 'Products', 'wp-product-feed-manager' ),
				'col_feed_status'      => esc_html__( 'Status', 'wp-product-feed-manager' ),
				'col_feed_actions'     => esc_html__( 'Actions', 'wp-product-feed-manager' )
			) );
		}

		/**
		 * Returns the tabs
		 * 
		 * @return html string
		 */
		private function tabs() {
			?>
			<h2 class="nav-tab-wrapper">
				<a href="admin.php?page=wp-product-feed-manager" class="nav-tab nav-tab-active"><?php esc_html_e( 'Feed List', 'wp-product-feed-manager' ); ?></a>
				<a href="admin.php?page=wp-product-feed-manager-add-new-feed" class="nav-tab"><?php esc_html_e( 'Add or Edit Feed', 'wp-product-feed-manager' ); ?></a>
			</h2>
			<?php
		}

		/**
		 * Returns a html string containing the main admin page body code
		 * 
		 * @return html string
		 */
		private function main_admin_page() {
			return $this->main_admin_body_top();
		}
		
		/**
		 * Returns a html string containing a message to the user that WooCommerce is not installed on the server
		 * 
		 * @return html string
		 */
		private function no_woocommerce() {
			$message_code = '<div class="full-screen-message-field">';
			$message_code .= '<p>*** ' . esc_html__( 'This plugin only works in conjunction with the WooCommerce Plugin! 
				It seems you have not installed the WooCommerce Plugin yet, so please do so before using this Plugin.', 'wp-product-feed-manager' ) . ' ***</p>';
			/* translators: %s: link to information about the WooCommerce plugin */
			$message_code .= '<p>' . sprintf( __( 'You can find more information about the Woocommerce Plugin %sby clicking here</a>.', 'wp-product-feed-manager' ), '<a href="https://wordpress.org/plugins/woocommerce/">' ) . '</p>';
			$message_code .= '</div>';
				
			return $message_code;
		}

		/**
		 * Returns an html string containing a message to inform the user that he has to update the WooCommerce plugin
		 * 
		 * @return html string
		 */
		private function update_woocommerce() {
			$wc_version = get_plugin_data( WPPFM_PLUGIN_DIR . '../woocommerce/woocommerce.php' )['Version'];
			$message_code = '<div class="full-screen-message-field">';
			$message_code .= '<p>*** ' . sprintf( esc_html__( 'This plugin requires WooCommerce version %s as a minimum! 
				It seems you have installed WooCommerce version %s which is a version that is not supported. 
				Please update to the latest version ***', 'wp-product-feed-manager' ), WPPFM_MIN_REQUIRED_WC_VERSION, $wc_version ) . '</p>';
			$message_code .= '</div>';
				
			return $message_code;
		}

		/**
		 * Returns the html for the main body top
		 * 
		 * @return html
		 */
		private function main_admin_body_top() {
			return $this->_list_table->display();
		}

		private function main_admin_buttons() {
			return '<div class="button-wrapper" id="page-bottom-buttons"><input class="button-primary" type="button" ' .
			'onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed\'" name="new" value="' .
			esc_html__( 'Add New Feed', 'wp-product-feed-manager' ) . '" id="add-new-feed-button" /></div>';
		}

	}

    // end of WPPFM_Main_Admin_Page class
endif;
