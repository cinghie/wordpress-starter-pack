<?php

/**
 * WPPPFM Google Merchant Promotions Feed Page Class.
 *
 * @package WP Google Merchant Promotions Feed Manager/Classes
 * @since 2.39.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPPFM_Google_Merchant_Promotions_Feed_Page' ) ) :

	/**
	 * WPPPFM Feed Form Class
	 */
	class WPPPFM_Google_Merchant_Promotions_Feed_Page extends WPPFM_Admin_Page {

		/**
		 * @var string|null contains the feed id, null for a new feed.
		 */
		private $_feed_id;

		/**
		 * @var array|null  container for the feed data.
		 */
		private $_feed_data;

		public function __construct() {

			parent::__construct();

			wppfm_check_db_version();

			$this->_feed_id = array_key_exists( 'id', $_GET ) && $_GET['id'] ? $_GET['id'] : null;

			// fill the _feed_data container.
			$this->set_feed_data();

			// load the language scripts.
			add_option( 'wp_enqueue_scripts', WPPFM_i18n_Scripts::wppfm_feed_settings_i18n() );
		}

		/**
		 * Collects the html code for the Google Merchant Promotions feed form page and displays it on the screen.
		 */
		public function show() {

			$tab_header_sub_title = $this->_feed_id ? __( 'Here you can edit the parameters of your Google Merchant Promotions feed.', 'wp-product-promotions-feed-manager' ) :
				__( 'Here you can setup your new promotions feed. Start by entering a Promotions ID and add the required data in the left column of this form.', 'wp-product-promotions-feed-manager' );

			echo $this->admin_page_header();

			echo $this->message_field();

			if ( wppfm_wc_installed_and_active() ) {
				if ( ! wppfm_wc_min_version_required() ) {
					echo wppfm_update_your_woocommerce_version_message();
					exit;
				}

				echo $this->tabs();

				echo $this->google_merchant_promotions_feed_page_data_holder();

				echo $this->tab_grid_container();

				echo $this->tab_header( __( 'Edit Google Merchant Promotions Feed', 'wp-product-promotions-feed-manager' ), $tab_header_sub_title );

				$this->main_input_table();

				echo $this->promotions_feed_top_buttons();

				echo $this->start_promotions_area();

				$this->promotion_template();

				echo $this->end_promotions_area();

				echo $this->promotions_feed_bottom_buttons();

				echo $this->feed_list_button();

				echo $this->end_tab_grid_container();

			} else {
				echo wppfm_you_have_no_woocommerce_installed_message();
			}
		}

		/**
		 * Shows the tabs and main page header.
		 *
		 * @param $stat
		 *
		 * @return void
		 */
		public function show_main_control_page( $stat ) {

			echo $this->admin_page_header();

			echo $this->tabs();

			echo $this->control_main_field( $stat, get_option( 'wppfm_lic_key' ), WPPFM_PLUGIN_NAME );
		}

		private function google_merchant_promotions_feed_page_data_holder() {
			$feed_data_holder  = WPPFM_Form_Element::feed_data_holder( $this->_feed_data );
			$feed_data_holder .= WPPPFM_Form_Element::ajax_to_db_conversion_data_holder();
			$feed_data_holder .= WPPFM_Form_Element::feed_url_holder();
			$feed_data_holder .= WPPFM_Form_Element::used_feed_names();

			return $feed_data_holder;
		}

		/**
		 * Fetches feed data from the database and stores it in the _feed_data variable. This data is required to build the edit feed page.
		 */
		private function set_feed_data() {
			$promotions_data_class    = new WPPPFM_Data();
			$promotions_queries_class = new WPPPFM_Queries();

			$feed_data                     = $promotions_queries_class->read_feed( $this->_feed_id )[0];
			$promotion_destination_options = $promotions_data_class->get_promotion_destination_options();
			$promotion_filter_options      = $promotions_data_class->get_merchant_promotion_filter_selector_options();
			$attribute_data                = $promotions_queries_class->get_meta_data( $this->_feed_id );

			$this->_feed_data = array(
				'feed_id'                       => $this->_feed_id ? $this->_feed_id : false,
				'feed_file_name'                => $feed_data ? $feed_data['title'] : '',
				'url'                           => $feed_data ? $feed_data['url'] : '',
				'status_id'                     => $feed_data ? $feed_data['status_id'] : '',
				'feed_type_id'                  => $feed_data ? $feed_data['feed_type_id'] : '',
				'promotion_destination_options' => $promotion_destination_options,
				'promotion_filter_options'      => $promotion_filter_options,
				'attribute_data'                => $attribute_data,
			);
		}

		/**
		 * Returns the html code for the main input table.
		 */
		private function main_input_table() {
			$main_input_wrapper = new WPPPFM_Google_Merchant_Promotions_Feed_Main_Input_Wrapper();
			$main_input_wrapper->display();
		}

		/**
		 * Returns the html code for the promotions buttons.
		 */
		private function promotions_feed_top_buttons() {
			return WPPFM_Form_Element::feed_generation_buttons( 'wppfm-top-buttons-wrapper', 'wpppfm-promotions-feed-buttons-section', 'wpppfm-generate-merchant-promotions-feed-button-bottom', 'wpppfm-save-merchant-promotions-feed-button-bottom', 'wppfm-view-feed-button-bottom' );
		}

		private function promotions_feed_bottom_buttons() {
			return WPPFM_Form_Element::feed_generation_buttons( 'wppfm-center-buttons-wrapper', 'wpppfm-promotions-feed-buttons-section', 'wpprfm-generate-merchant-promotions-feed-button-bottom', 'wpppfm-save-merchant-promotions-feed-button-bottom', 'wppfm-view-feed-button-bottom' );
		}

		/**
		 * Returns the html code for the Open Feed List button.
		 *
		 * @return string
		 */
		private function feed_list_button() {
			return WPPFM_Form_Element::open_feed_list_button();
		}

		private function start_promotions_area() {
			return '<section class="wpppfm-promotions-group-area">';
		}

		private function end_promotions_area() {
			return '</section>';
		}

		private function promotion_template() {
			$promotion_template = new WPPPFM_Google_Merchant_Promotion_Wrapper();
			$promotion_template->display();
		}
	}

	// end of WPPPFM_Google_Merchant_Promotions_Feed_Page class

endif;
