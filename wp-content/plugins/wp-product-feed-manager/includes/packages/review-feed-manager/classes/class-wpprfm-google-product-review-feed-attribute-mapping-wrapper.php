<?php

/**
 * WPPRFM Google Product Review Feed Attribute Mapping Wrapper.
 *
 * @package WP Product Review Feed Manager/Classes
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPRFM_Google_Product_Review_Feed_Attribute_Mapping_Wrapper' ) ) :

	class WPPRFM_Google_Product_Review_Feed_Attribute_Mapping_Wrapper extends WPPFM_Attribute_Mapping_Wrapper {

		public function display() {

			// return the code for the attribute mapping area
			echo $this->attribute_mapping_wrapper_table_start( 'none' );

			// Add the header.
			echo $this->attribute_mapping_wrapper_table_title();

			echo WPPFM_Attribute_Selector_Element::required_fields();

			echo WPPFM_Attribute_Selector_Element::optional_fields();

			echo $this->attribute_mapping_wrapper_table_end();
		}
	}

	// end of WPPRFM_Google_Product_Review_Feed_Attribute_Mapping_Wrapper class

endif;
