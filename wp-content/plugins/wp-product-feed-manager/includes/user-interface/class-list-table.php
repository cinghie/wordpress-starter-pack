<?php

/**
 * WPPFM List Table Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_List_Table' ) ) :

	/**
	 * List Table Class
	 */
	class WPPFM_List_Table {

		private $_column_titles = array();
		private $_table_id;
		private $_table_id_string;

		public function __construct() {
			$this->_table_id = '';
			$this->_table_id_string = '';
			
			add_option( 'wp_enqueue_scripts', WPPFM_i18n_Scripts::wppfm_list_table_i18n() );
		}

		/**
		 * Sets the column titles
		 * 
		 * @param array of strings containing the column titles
		 */
		public function set_column_titles( $titles ) {
			if ( ! empty( $titles ) ) {
				$this->_column_titles = $titles;
			}
		}

		public function set_table_id( $id ) {
			if ( $id !== $this->_table_id ) {
				$this->_table_id			 = $id;
				$this->_table_id_string	 = ' id="' . $id . '"';
			}
		}

		public function display() {
			echo '<table class="wp-list-table tablepress widefat fixed posts" id="feedlisttable">';

			echo $this->table_header();

			echo $this->table_footer();

			echo $this->table_body();

			echo '</table>';
		}

		private function table_header() {
			$html = '<thead><tr>';

			foreach ( $this->_column_titles as $title ) {
				$html .= '<th>' . __( $title ) . '</th>';
			}

			$html .= '</tr></thead>';

			return $html;
		}

		private function table_footer() {
			$html = '<tfoot><tr>';

			foreach ( $this->_column_titles as $title ) {
				$html .= '<th>' . __( $title ) . '</th>';
			}

			$html .= '</tr></tfoot>';

			return $html;
		}

		private function table_body() {
			$html = '<tbody' . $this->_table_id_string . '></tbody>';

			return $html;
		}
	}
    

     // end of WPPFM_List_Table class

endif;