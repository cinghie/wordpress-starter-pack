<?php

/**
 * Hook functions.
 *
 * @package WP Product Review Feed Manager/Functions
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Uses the wppfm_get_feed_attributes filter to set the attributes required for the review feed.
 *
 * @param array  $original_attributes   Array with the output fields from the Product Feed.
 * @param string $feed_id               The feed id.
 * @param string $feed_type_id          The feed type id.
 *
 * @return array    Array with the feed attributes.
 */
function wppfm_get_review_feed_attributes( $original_attributes, $feed_id, $feed_type_id ) {
	if ( '2' === $feed_type_id ) {
		return WPPRFM_Attributes_List::wpprfm_get_review_feed_attributes();
	} elseif ( '3' === $feed_type_id ) {
		return WPPPFM_Attributes_List::wpppfm_get_promotions_feed_attributes();
	} else {
		return $original_attributes;
	}
}

add_filter( 'wppfm_get_feed_attributes', 'wppfm_get_review_feed_attributes', 10, 3 );

/**
 * Uses the wppfm_advised_inputs filter to set the advised inputs for the review feed.
 *
 * @param array  $advised_inputs    Array with the advices inputs.
 * @param string $feed_type_id      The feed type id.
 *
 * @return array|stdClass   Array or stdClass with the advised inputs.
 */
function wppfm_get_review_feed_advised_inputs( $advised_inputs, $feed_type_id ) {
	if ( '2' === $feed_type_id ) {
		return WPPRFM_Attributes_List::wpprfm_get_woocommerce_to_review_feed_inputs();
	} elseif ( '3' === $feed_type_id ) {
		return WPPPFM_Attributes_List::wpppfm_get_woocommerce_to_promotions_feed_inputs();
	} else {
		return $advised_inputs;
	}
}

add_filter( 'wppfm_advised_inputs', 'wppfm_get_review_feed_advised_inputs', 10, 3 );

/**
 * Uses the wppfm_background_class filter to set the correct background class.
 *
 * @param string $background_class  The current background class.
 * @param string $feed_type_id      The feed type id.
 *
 * @return string       String with the new background class.
 */
function wppfm_set_background_class( $background_class, $feed_type_id ) {
	if ( '2' === $feed_type_id ) {
		return 'WPPRFM_Review_Feed_Processor';
	} elseif ( '3' === $feed_type_id ) {
		return 'WPPPFM_Promotions_Feed_Processor';
	} else {
		return $background_class;
	}
}

add_filter( 'wppfm_background_class', 'wppfm_set_background_class', 10, 2 );