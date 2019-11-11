<?php

/**
 * WP Data Class.
 *
 * @package WP Product Feed Manager/Data/Classes
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPFM_Data' ) ) :

	/**
	 * Data Class
	 */
	class WPPFM_Data {

		private $_queries;
		private $_files;

		public function __construct() {
			$this->_queries = new WPPFM_Queries();
			$this->_files   = new WPPFM_File();
		}

		public function get_countries() {
			return $this->_queries->read_countries();
		}

		public function get_channel_id_from_short_name( $channel_short_name ) {
			return $this->_queries->get_channel_id( $channel_short_name );
		}

		public function get_channels() {
			return $this->_queries->read_channels();
		}

		public function delete_channel( $channel_short ) {
			$result = $this->_queries->remove_channel_from_db( $channel_short );

			if ( ! $result || 0 == $result ) {
				$result = $this->_queries->clean_channel_table();
			}

			return $result;
		}

		public function delete_channel_feeds( $channel_id ) {
			$feeds = $this->_queries->get_feeds_from_specific_channel( $channel_id );

			foreach ( $feeds as $feed_id ) {
				$this->_queries->delete_meta( $feed_id['product_feed_id'] );
				$this->_queries->delete_feed( $feed_id['product_feed_id'] );
			}
		}

		public function get_sources() {
			return $this->_queries->read_sources();
		}

		public function get_country_id_from_short_code( $country_code ) {
			if ( '0' !== $country_code && 0 !== $country_code ) {
				return $this->_queries->get_country_id( $country_code );
			} else {
				$id             = new stdClass();
				$id->country_id = '233';

				return $id;
			}
		}

		public function get_schedule_data() {
			return $this->_queries->read_active_schedule_data();
		}

		public function get_failed_feeds() {
			return $this->_queries->read_failed_feeds();
		}

		public function get_feed_status( $feed_id ) {
			$feed_status = $this->_queries->get_current_feed_status( $feed_id );

			return $feed_status[0]->status_id;
		}

		public function set_nr_of_feed_products( $feed_id, $nr ) {
			return $this->_queries->set_nr_feed_products( $feed_id, $nr );
		}

		public function get_nr_of_feed_products( $feed_id ) {
			return $this->_queries->get_nr_feed_products( $feed_id );
		}

		public function update_feed_data( $feed_id, $feed_url, $nr_products ) {
			return $this->_queries->update_feed_update_data( $feed_id, $feed_url, $nr_products );
		}

		/**
		 * Sets the status id of a feed
		 *
		 * 0 = unknown
		 * 1 = OK (will be updated automatically)
		 * 2 = On hold (will not be updated automatically)
		 * 3 = Processing
		 * 4 = In processing queue
		 * 5 = Has errors
		 * 6 = Failed processing
		 *
		 * @param string $feed_id
		 * @param int $status
		 *
		 * @return bool
		 */
		public function update_feed_status( $feed_id, $status ) {

			$message_level = 'MESSAGE';

			switch ( $status ) {
				case '1':
					$message = sprintf( 'The feed status of feed %s has been set to OK (1)', $feed_id );
					break;

				case '2':
					$message = sprintf( 'The feed status of feed %s has been set to On Hold (2)', $feed_id );
					break;

				case '3':
					$message = sprintf( 'The feed status of feed %s has been set to Processing (3)', $feed_id );
					break;

				case '4':
					$message = sprintf( 'The feed status of feed %s has been set to In processing queue (4)', $feed_id );
					break;

				case '5':
					$message       = sprintf( 'The feed status of feed %s has been set to Has errors (5)', $feed_id );
					$message_level = 'ERROR';
					break;

				case '6':
					$message       = sprintf( 'The feed status of feed %s has been set to Failed processing (6)', $feed_id );
					$message_level = 'ERROR';
					break;

				default:
					$message       = sprintf( 'Tried to update the status of feed %s but the status is unknown!', $feed_id );
					$message_level = 'ERROR';
			}

			do_action( 'wppfm_feed_generation_message', $feed_id, $message, $message_level );

			return $this->_queries->update_feed_file_status( $feed_id, $status );
		}

		/**
		 * Fills output fields with stored meta data
		 *
		 * @access public
		 *
		 * @param string $feed_id
		 * @param array $outputs
		 *
		 * @return array
		 */
		public function fill_output_fields_with_metadata( $feed_id, $outputs ) {
			// read the meta data from the database
			$metadata = $this->_queries->read_metadata( $feed_id );

			// loop through the output rows
			for ( $i = 0; $i < count( $outputs ); $i ++ ) {
				// check if there is specific meta data for this output row
				if ( count( $metadata ) > 0 ) {
					foreach ( $metadata as $meta ) {
						// look for a match
						if ( $meta['meta_key'] === $outputs[ $i ]->field_label ) {
							// put the meta data in the value variable of the output row
							$outputs[ $i ]->value = $meta['meta_value'];
							break; // break is required to stop the foreach loop and prevent the following loop from clearing the value
						} else {
							// as long as there is no match, leave the value empty
							$outputs[ $i ]->value = '';
						}
					}
				} else {
					$outputs[ $i ]->value = '';
				}
			}

			return $outputs;
		}

		public function get_filter_query( $feed_id ) {
			return $this->_queries->get_product_filter_query( $feed_id );
		}

		public function get_own_variation_data( $variation_id ) {
			return $this->_queries->get_own_variable_product_attributes( $variation_id );
		}

		public function add_parent_data( &$product_data, $parent_id, $post_columns_query_string ) {
			$parent_product_data                 = (array) $this->_queries->read_post_data( $parent_id, $post_columns_query_string );
			$sources_that_always_use_parent_data = apply_filters( 'sources_that_always_use_data_from_parent', array( 'post_excerpt' ) );

			$columns = explode( ', ', $post_columns_query_string );

			foreach ( $columns as $column ) {
				if ( ( '' === $product_data[ $column ] && array_key_exists( $column, $parent_product_data ) && '' !== $parent_product_data[ $column ] )
					|| in_array( $column, $sources_that_always_use_parent_data ) ) {
					$product_data[ $column ] = $parent_product_data[ $column ];
				}
			}
		}

		public function get_custom_fields_with_metadata( $feed_id ) {
			// read the meta data from the database
			$metadata = $this->_queries->read_metadata( $feed_id );
			$outputs  = array();

			// loop through the output rows
			for ( $i = 0; $i < count( $metadata ); $i ++ ) {
				$object = new stdClass();

				$object->field_id    = $i + 1;
				$object->category_id = '5';
				$object->field_label = $metadata[ $i ]['meta_key'];
				$object->value       = $metadata[ $i ]['meta_value'];

				array_push( $outputs, $object );
			}

			return $outputs;
		}

		public function get_third_party_custom_fields() {
			$custom_fields = array();

			// YITH Brands plugin
			$yith_brand_label = get_option( 'yith_wcbr_brands_label' );
			if ( $yith_brand_label ) {
				array_push( $custom_fields, $yith_brand_label );
			}

			// WooCommerce Brands
			if ( in_array(
				'woocommerce-brands/woocommerce-brands.php',
				apply_filters(
					'active_plugins',
					get_option( 'active_plugins' )
				)
			) ) {
				array_push( $custom_fields, 'Brand' );
			}

			return $custom_fields;
		}

		/**
		 * Checks if other feeds than the active feed are still on processing status. If so, set these feeds to error
		 *
		 * @param string $active_feed_id
		 *
		 * @since 1.10.0
		 *
		 */
		public function check_for_failed_feeds( $active_feed_id ) {
			$processing_feeds = $this->_queries->get_feed_ids_with_specific_status( '3' );
			$failed_feed_ids  = '';

			foreach ( $processing_feeds as $feed ) {
				if ( $active_feed_id !== $feed->product_feed_id ) {
					$this->update_feed_status( $feed->product_feed_id, '6' );
					$failed_feed_ids .= ', ' . $feed->product_feed_id;
				}
			}

			if ( $failed_feed_ids ) {
				$message = sprintf( 'Starting the update of feed %s, the following feeds where still registered as being active: %s and are now set to the status FAIL.', $active_feed_id, $failed_feed_ids );
				do_action( 'wppfm_feed_generation_message', $active_feed_id, $message, 'ERROR' );
			}
		}

		/**
		 * Converts feed data items that are send through an ajax call to the corresponding database names.
		 *
		 * @param $feed_data
		 *
		 * @return array
		 * @since 2.5.0
		 *
		 */
		public function convert_ajax_feed_data_to_database_format( $feed_data ) {
			$result = array();

			foreach ( $feed_data as $data_item ) {
				if ( 'product_feed_id' !== $data_item->name ) {

					if ( 'url' === $data_item->name ) {
						$data_item->value = $this->verify_url( $data_item->value );
					}

					$result[ $data_item->name ] = $data_item->value;
				}
			}

			return $result;
		}

		/**
		 * Gets the correct data types from the feed data and puts them into an array in the correct order.
		 *
		 * @param $feed_data
		 * @param $ajax_feed_data
		 *
		 * @return array
		 * @since 2.5.0
		 *
		 */
		public function get_types_from_feed_data( $feed_data, $ajax_feed_data ) {
			$result = array();

			foreach ( $feed_data as $data_key => $value ) {
				$feed_item = array_filter(
					$ajax_feed_data,
					function ( $item ) use ( $data_key ) {
						return $item->name == $data_key;
					}
				);

				array_push( $result, reset( $feed_item )->type );
			}

			return $result;
		}

		public function get_feed_data( $feed_id ) {
			// get the main data
			$main_feed_data = $this->_queries->read_feed( $feed_id );
			$main_data      = $this->convert_data_to_feed_data( $main_feed_data[0] );

			if ( false === $main_data ) {
				return $main_data;
			}

			$main_data->attributes = array();

			$channel   = trim( $this->_queries->get_channel_short_name_from_db( $main_feed_data[0]['channel'] ) );
			$is_custom = function_exists( 'channel_is_custom_channel' ) ? channel_is_custom_channel( $channel ) : false;

			// read the output fields
			if ( ! $is_custom ) {
				$outputs = apply_filters( 'wppfm_get_feed_attributes', $this->_files->get_output_fields_for_specific_channel( $channel ), $feed_id, $main_feed_data[0]['feed_type_id'] );
			} else {
				$outputs = $this->get_custom_fields_with_metadata( $feed_id );
			}

			// add meta data to the feeds output fields
			$output_fields = $this->fill_output_fields_with_metadata( $feed_id, $outputs );
			$inputs        = $this->get_advised_inputs( $main_data->channel, $main_feed_data[0]['feed_type_id'] );

			for ( $i = 0; $i < count( $output_fields ); $i ++ ) {
				$output_title = $output_fields[ $i ]->field_label;
				$is_active    = false;

				if ( $output_fields[ $i ]->category_id > 0 && $output_fields[ $i ]->category_id < 3 ) {
					$is_active = true;
				}
				if ( ! empty( $output_fields[ $i ]->value ) && 'undefined' !== $output_fields[ $i ]->value ) {
					$is_active = true;
				}

				$advised_source = property_exists( $inputs, $output_title ) ? $advised_source = $inputs->{$output_title} : '';
				$this->add_attribute( $main_data->attributes, $i, $output_title, $advised_source, $output_fields[ $i ]->value, $output_fields[ $i ]->category_id, $is_active, 0, 0, 0 );
			}

			$this->set_output_attribute_levels( $main_data );

			return $main_data;
		}

		// ALERT has a relation with the wppfm_setOutputAttributeLevels() function in the logic.js file
		private function set_output_attribute_levels( &$main_data ) {
			$channel_base_class = new WPPFM_Channel();
			$channel_short_name = $channel_base_class->get_channel_short_name( $main_data->channel );

			if ( class_exists( 'WPPFM_' . ucfirst( $channel_short_name ) . '_Feed_Class' ) ) {
				$class_name = 'WPPFM_' . ucfirst( $channel_short_name ) . '_Feed_Class';
				$feed_class = new $class_name();

				if ( method_exists( $feed_class, 'set_feed_output_attribute_levels' ) ) {
					$feed_class->set_feed_output_attribute_levels( $main_data );
				}
			}
		}

		private function add_attribute(
			&$attribute, $id, $title, $advised_source, $value, $field_level, $is_active,
			$nr_queries, $nr_value_edits, $nr_value_conditions
		) {

			$attribute_object = new stdClass();

			$attribute_object->rowId             = $id;
			$attribute_object->fieldName         = $title;
			$attribute_object->advisedSource     = $advised_source;
			$attribute_object->value             = $value;
			$attribute_object->fieldLevel        = $field_level;
			$attribute_object->isActive          = $is_active;
			$attribute_object->nrQueries         = $nr_queries;
			$attribute_object->nrValueEdits      = $nr_value_edits;
			$attribute_object->nrValueConditions = $nr_value_conditions;

			array_push( $attribute, $attribute_object );
		}

		private function convert_data_to_feed_data( $data ) {

			if ( ! key_exists( 'product_feed_id', $data ) ) {
				return false;
			}

			$feed = new stdClass();

			$feed->feedId            = $data['product_feed_id'];
			$feed->title             = $data['title'];
			$feed->mainCategory      = $data['main_category'];
			$feed->categoryMapping   = $data['category_mapping'];
			$feed->isAggregator      = $data['is_aggregator'];
			$feed->includeVariations = $data['include_variations'];
			$feed->feedTitle         = $data['feed_title'] !== null ? $data['feed_title'] : '';
			$feed->feedDescription   = $data['feed_description'] !== null ? $data['feed_description'] : '';
			$feed->url               = $data['url'];
			$feed->dataSource        = $data['source'];
			$feed->channel           = $data['channel'];
			$feed->country           = $data['country'];
			$feed->status            = $data['status_id'];
			$feed->baseStatusId      = $data['base_status_id'];
			$feed->feedTypeId        = $data['feed_type_id'];
			$feed->updateSchedule    = $data['schedule'];
			$feed->language          = $data['language'] !== null ? $data['language'] : '';

			return $feed;
		}

		// WPPFM_CHANNEL_RELATED
		private function get_advised_inputs( $channel_id, $feed_type_id ) {
			$feed_class = new WPPFM_Google_Feed_Class();
			// as long as only WooCommerce is supported, I can get away with only switching on a specific channel
			$advised_inputs = $feed_class->woocommerce_to_feed_fields();
			return apply_filters( 'wppfm_advised_inputs', $advised_inputs, $feed_type_id );
		}

		/**
		 * Makes sure that the url is correct and has no forbidden characters before it's being stored in the database
		 *
		 * @param $url string complete url
		 *
		 * @return string verified url
		 */
		private function verify_url( $url ) {
			$forbidden_name_chars = wppfm_forbidden_file_name_characters();
			$last_slash           = strrpos( $url, '/' );
			$url_string           = substr( $url, 0, $last_slash + 1 );
			$feed_name            = substr( $url, $last_slash + 1 );
			$correct_feed_name    = str_replace( $forbidden_name_chars, '-', $feed_name );
			return $url_string . $correct_feed_name;
		}

		public function register_channel( $channel_short_name, $channel_data ) {
			if ( ! $this->_queries->get_channel_id( $channel_short_name ) ) { // make sure the channel is not yet registered
				$this->_queries->register_a_channel( $channel_short_name, $channel_data->channel_id, $channel_data->channel_name );
			}
		}

	}

	// end of WPPFM_Data_Class

endif;

$dataclass = new WPPFM_Data();
