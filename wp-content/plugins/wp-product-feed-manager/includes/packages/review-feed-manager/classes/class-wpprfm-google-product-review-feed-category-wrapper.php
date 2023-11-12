<?php

/**
 * WPPRFM Google Product Review Feed Category Wrapper.
 *
 * @package WP Product Review Feed Manager/Classes
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPRFM_Google_Product_Review_Feed_Category_Wrapper' ) ) :

	class WPPRFM_Google_Product_Review_Feed_Category_Wrapper extends WPPFM_Category_Wrapper {

		public function display() {

			// Start with the section code.
			echo '<section class="wppfm-category-mapping-and-filter-wrapper">';
			echo '<section class="wpprfm-edit-review-feed-form-element-wrapper wppfm-category-mapping-wrapper" id="wppfm-category-map" style="display:none;">';
			echo '<div id="category-mapping-header" class="header"><h3>' . __( 'Category Selector', 'wp-product-review-feed-manager' ) . ':</h3></div>';
			echo '<table class="fm-category-mapping-table widefat" id="category-mapping-table">';

			// The category mapping table header.
			echo WPPFM_Category_Selector_Element::category_selector_table_head();

			echo '<tbody id="wppfm-category-selector-body">';

			// The content of the table.
			echo $this->category_table_content();

			echo '</tbody>';

			// Closing the section.
			echo '</table></section>';

			// Add the product filter element.
			echo $this->product_filter();

			echo '</section>';
		}
	}

	// end of WPPRFM_Google_Product_Review_Feed_Category_Wrapper class

endif;
