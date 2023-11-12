<?php

/**
 * WPPRFM Form Element Class.
 *
 * @package WP Product Review Feed Manager/Classes/Elements
 * @version 1.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPRFM_Form_Element' ) ) :

	class WPPRFM_Form_Element {

		public static function admin_buttons() {
			return WPPFM_Form_Element::open_feed_list_button();
		}

		public static function ajax_to_db_conversion_data_holder() {
			$feed_data_to_store = json_encode( self::ajax_feed_data_to_database_array() );
			return '<var id="wppfm-ajax-feed-data-to-database-conversion-array" style="display:none;">' . $feed_data_to_store . '</var>';
		}

		private static function ajax_feed_data_to_database_array() {
			return apply_filters(
				'wpprfm_feed_data_ajax_to_database_conversion_table',
				array(
					(object) array(
						'feed' => 'feedId',
						'db'   => 'product_feed_id',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'channel',
						'db'   => 'channel_id',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'language',
						'db'   => 'language',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'includeVariations',
						'db'   => 'include_variations',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'isAggregator',
						'db'   => 'is_aggregator',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'country',
						'db'   => 'country_id',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'dataSource',
						'db'   => 'source_id',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'title',
						'db'   => 'title',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'feedTitle',
						'db'   => 'feed_title',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'feedDescription',
						'db'   => 'feed_description',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'mainCategory',
						'db'   => 'main_category',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'url',
						'db'   => 'url',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'status',
						'db'   => 'status_id',
						'type' => '%d',
					),
					(object) array(
						'feed' => 'updateSchedule',
						'db'   => 'schedule',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'feedType',
						'db'   => 'feed_type_id',
						'type' => '%d',
					),
					// specific for the Product Review Feed
					(object) array(
						'feed' => 'aggregatorName',
						'db'   => 'aggregator_name',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'publisherName',
						'db'   => 'publisher_name',
						'type' => '%s',
					),
					(object) array(
						'feed' => 'publisherFavicon',
						'db'   => 'publisher_favicon_url',
						'type' => '%s',
					),
				)
			);
		}
	}

	// end of WPPRFM_Form_Element class

endif;
