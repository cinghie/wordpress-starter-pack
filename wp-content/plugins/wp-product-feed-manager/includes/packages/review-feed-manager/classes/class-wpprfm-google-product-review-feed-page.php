<?php

/**
 * WPPRFM Google Product Review Feed Page Class.
 *
 * @package WP Product Review Feed Manager/Classes
 * @version 1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPRFM_Google_Product_Review_Feed_Page' ) ) :

	/**
	 * WPPRFM Feed Form Class
	 */
	class WPPRFM_Google_Product_Review_Feed_Page extends WPPFM_Admin_Page {

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
		 * Collects the html code for the Google product review feed form page and displays it on the screen.
		 */
		public function show() {

			$tab_header_sub_title = $this->_feed_id ? __( 'Here you can edit the parameters of your Google Product Review feed.', 'wp-product-feed-manager' ) :
				__( 'Here you can setup your new review feed. Start by entering a name for your feed, add an Aggregator name and a Publisher name.', 'wp-product-feed-manager' );

			echo $this->admin_page_header();

			echo $this->message_field();

			if ( wppfm_wc_installed_and_active() ) {
				if ( ! wppfm_wc_min_version_required() ) {
					echo wppfm_update_your_woocommerce_version_message();
					exit;
				}

				echo $this->tabs();

				echo $this->google_product_review_feed_page_data_holder();

				echo $this->tab_grid_container();

				echo $this->tab_header( __( 'Edit Google Product Review Feed', 'wp-product-feed-manager' ), $tab_header_sub_title );

				$this->main_input_table();

				$this->category_selector_table();

				echo $this->review_feed_top_buttons();

				$this->attribute_mapping_table();

				echo $this->review_feed_bottom_buttons();

				echo $this->main_admin_buttons();

				echo $this->end_tab_grid_container();
			} else {
				echo wppfm_you_have_no_woocommerce_installed_message();
			}
		}

		public function show_main_control_page( $stat ) {

			echo $this->admin_page_header();

			echo $this->tabs();

			echo $this->control_main_field( $stat, get_option( 'wppfm_lic_key' ), WPPFM_PLUGIN_NAME );
		}

		/**
		 * Fills the $feed_data_holder with the correct data that then can be passed through to the edit feed page.
		 *
		 * @return  string  Containing the data that is required to build the edit feed page.
		 */
		private function google_product_review_feed_page_data_holder() {
			$feed_data_holder  = WPPFM_Form_Element::feed_data_holder( $this->_feed_data );
			$feed_data_holder .= WPPRFM_Form_Element::ajax_to_db_conversion_data_holder();
			$feed_data_holder .= WPPFM_Form_Element::feed_url_holder();
			$feed_data_holder .= WPPFM_Form_Element::used_feed_names();

			return $feed_data_holder;
		}

		/**
		 * Fetches feed data from the database and stores it in the _feed_data variable. This data is required to build the edit feed page. Stores empty
		 * data when the page is opened from a new feed.
		 */
		private function set_feed_data() {

			if ( $this->_feed_id ) {
				$review_queries_class = new WPPRFM_Queries();
				$queries_class        = new WPPFM_Queries();
				$review_data_class    = new WPPRFM_Data();
				$data_class           = new WPPFM_Data();

				$feed_data      = $review_queries_class->read_feed( $this->_feed_id )[0];
				$feed_filter    = $queries_class->get_product_filter_query( $this->_feed_id );
				$source_fields  = $data_class->get_source_fields();
				$attribute_data = $review_data_class->get_product_review_feed_attributes( $this->_feed_id );
			} else { // for a new feed
				$source_fields  = array();
				$attribute_data = array();
				$feed_filter    = '';
				$feed_data      = null; // a new feed
			}

			$this->_feed_data = array(
				'feed_id'               => $this->_feed_id ? $this->_feed_id : false,
				'feed_file_name'        => $feed_data ? $feed_data['title'] : '',
				'feed_description'      => $feed_data ? $feed_data['feed_description'] : '',
				'schedule'              => $feed_data ? $feed_data['schedule'] : '',
				'url'                   => $feed_data ? $feed_data['url'] : '',
				'category_mapping'      => $feed_data ? $feed_data['category_mapping'] : '',
				'status_id'             => $feed_data ? $feed_data['status_id'] : '',
				'feed_type_id'          => $feed_data ? $feed_data['feed_type_id'] : '',
				'aggregator_name'       => $feed_data ? $feed_data['aggregator_name'] : '',
				'publisher_name'        => $feed_data ? $feed_data['publisher_name'] : '',
				'publisher_favicon_url' => $feed_data ? $feed_data['publisher_favicon_url'] : '',
				'feed_filter'           => $feed_filter ? $feed_filter : null,
				'attribute_data'        => $attribute_data,
				'source_fields'         => $source_fields,
			);
		}

		/**
		 * Returns the html code for the main input table.
		 */
		private function main_input_table() {
			$main_input_wrapper = new WPPRFM_Google_Product_Review_Feed_Main_Input_Wrapper();
			$main_input_wrapper->display();
		}

		private function category_selector_table() {
			$category_table_wrapper = new WPPRFM_Google_Product_Review_Feed_Category_Wrapper();
			$category_table_wrapper->display();
		}

		private function attribute_mapping_table() {
			$attribute_mapping_wrapper = new WPPRFM_Google_Product_Review_Feed_Attribute_Mapping_Wrapper();
			$attribute_mapping_wrapper->display();
		}

		private function main_admin_buttons() {
			return WPPRFM_Form_Element::admin_buttons();
		}

		private function review_feed_top_buttons() {
			return WPPFM_Form_Element::feed_generation_buttons( 'wppfm-top-buttons-wrapper', 'page-center-buttons', 'wpprfm-generate-review-feed-button-top', 'wpprfm-save-review-feed-button-top', 'wppfm-view-feed-button-top' );
		}

		private function review_feed_bottom_buttons() {
			return WPPFM_Form_Element::feed_generation_buttons( 'wppfm-center-buttons-wrapper', 'page-center-buttons', 'wpprfm-generate-review-feed-button-bottom', 'wpprfm-save-review-feed-button-bottom', 'wppfm-view-feed-button-bottom' );
		}

	}

	// end of WPPRFM_Google_Product_Review_Feed_Page class

endif;
