<?php

/**
 * WPPPFM Google Merchant Promotions Feed Filters Wrapper.
 *
 * @package WP Google Merchant Promotions Feed Manager/Classes
 * @since 2.39.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPPFM_Google_Merchant_Promotions_Feed_Product_Filters_Wrapper' ) ) :

	class WPPPFM_Google_Merchant_Promotions_Feed_Product_Filters_Wrapper extends WPPFM_Filter_Wrapper {

		public function display( $promotion_nr ) {

			// Start with the section code.
			echo '<section class="wpppfm-edit-promotions-feed-form-element-wrapper wpppfm-product-filter-wrapper" id="wppfm-product-filter-map-' . $promotion_nr . '" style="display: none">';
			echo '<div id="wpppfm-filter-header" class="header"><h3>' . __( 'Product Filter Selector', 'wp-product-promotions-feed-manager' ) . ':</h3></div>';
			echo '<table class="wppfm-product-filter-table widefat" id="wppfm-product-filter-table-' . $promotion_nr . '">';

			echo $this->include_products_input( $promotion_nr );

			echo $this->exclude_products_input( $promotion_nr );

			// Closing the section.
			echo '</table></section>';

		}
	}

	// end of WPPPFM_Google_Merchant_Promotions_Feed_Product_Filters_Wrapper class

endif;