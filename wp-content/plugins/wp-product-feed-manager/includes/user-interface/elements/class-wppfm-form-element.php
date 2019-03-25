<?php

/**
 * WPPFM Form Element Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @since 2.4.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPFM_Form_Element' ) ) :

	/**
	 * WPPFM Category Selector Element Class
	 *
	 * Contains the html elements code for the forms
	 */
	class WPPFM_Form_Element {

		/**
		 * Returns the code for the tabs in all main forms
		 *
		 * @return string html code for the tabs
		 */
		public static function main_form_tabs() {

			// Get the WPPFM_Tab objects
			$tabs = $GLOBALS['wppfm_tab_data'];

			$html_code = '<h2 class="nav-tab-wrapper">';

			// Html for the tabs
			foreach ( $tabs as $tab ) {
				$html_code .= '<a href="admin.php?' . $tab->get_page_tab_url() . '"';
				$html_code .= 'class="nav-tab' . $tab->tab_selected_string() . '">' . $tab->get_tab_title() . '</a>';
			}

			$html_code .= '</h2>';

			return $html_code;
		}

		/**
		 * Returns the code for both Save & Generate and Save buttons.
		 *
		 * @param   string  $generate_button_id ID for the Save & Generate button
		 * @param   string  $save_button_id     ID for the Save button
		 *
		 * @return string
		 */
		public static function feed_generation_buttons( $generate_button_id, $save_button_id ) {
			return '<div class="button-wrapper" id="page-center-buttons" style="display:none;">
				<input class="button-primary" type="button" name="generate-top"
					value="' . __( 'Save & Generate Feed', 'wp-product-feed-manager' ) .
					'" id="' . $generate_button_id . '" disabled/>
				<input class="button-primary" type="button" name="save-top"
					value="' . __( 'Save Feed', 'wp-product-feed-manager' ) .
					'" id="' . $save_button_id . '" disabled/>
				</div>';
		}

		/**
		 * Returns the code for the Open Feed List button.
		 *
		 * @return string
		 */
		public static function open_feed_list_button() {
			return '<div class="button-wrapper" id="page-bottom-buttons" style="display:none;"><input class="button-primary" type="button" ' .
				'onclick="parent.location=\'admin.php?page=wp-product-feed-manager\'" name="new" value="' .
				__( 'Open Feed List', 'wp-product-feed-manager' ) . '" id="add-new-feed-button" /></div>';
		}
	}

	// end of WPPFM_Form_Element class

endif;
