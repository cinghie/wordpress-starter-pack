<?php

/**
 * WP Product Feed Manager Add Feed Page Class.
 *
 * @package WP Product Feed Manager/User Interface/Classes
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_Feed_Form' ) ) :

	/**
	 * WPPFM Feed Form Class
	 */
	class WPPFM_Feed_Form {

		public function display() {
			$html_code = '<div class="meta-box-sortable ui-sortable>';
			$html_code .= '<h3>' . esc_html__( 'Basic Feed Options', 'wp-product-feed-manager' ) . '</h3>';
			
			echo $this->tabs();

			echo $this->add_or_edit_feed_page_code();

			$html_code .= '</div>';

			echo $html_code;
		}

		private function tabs() {
			?>
			<h2 class="nav-tab-wrapper">
			<a href="admin.php?page=wp-product-feed-manager" class="nav-tab"><?php esc_html_e( 'Feed List', 'wp-product-feed-manager' ); ?></a>
			<a href="admin.php?page=wp-product-feed-manager-add-new-feed" class="nav-tab nav-tab-active"><?php esc_html_e( 'Add or Edit Feed', 'wp-product-feed-manager' ); ?></a>
			</h2>
			<?php
		}

		private function add_or_edit_feed_page_code() {
			?>
			<table class="feed-main-input-table form-table">
				<tbody id="feed-data">
					<tr><th id="main-feed-input-label"><label for="file-name"><?php esc_html_e( 'File Name', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::feed_name_selector(); ?></td></tr>
					<tr style="display:none;"><th id="main-feed-input-label"><label for="source-list"><?php esc_html_e( 'Products source', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::source_selector(); ?></td></tr>
					<tr><th id="main-feed-input-label"><label for="merchant-list"><?php esc_html_e( 'Channel', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::channel_selector(); ?></td></tr>
					<?php do_action( 'wppfm_add_feed_attribute_selector' ); ?>
					<tr id="country-list-row" style="display:none;"><th id="main-feed-input-label"><label for="country-list"><?php esc_html_e( 'Target Country', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::country_selector(); ?></td></tr>
					<tr id="category-list-row" style="display:none;"><th id="main-feed-input-label"><label for="categories-list"><?php esc_html_e( 'Default Category', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::category_selector( "lvl", "-1", true ); ?></td></tr>
					<tr id="aggregator-selector-row" style="display:none;"><th id="main-feed-input-label"><label for="aggregator-selector"><?php esc_html_e( 'Aggregator Shop', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::aggregation_selector(); ?></td></tr>
					<tr id="add-product-variations-row" style="display:none;"><th id="main-feed-input-label"><label for="product-variations-selector"><?php esc_html_e( 'Include Product Variations', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::product_variation_selector(); ?></td></tr>
					<tr id="google-feed-title-row" style="display:none;"><th id="main-feed-input-label"><label for="google-feed-title-selector"><?php esc_html_e( 'Feed Title', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::google_feed_title_selector(); ?></td></tr>
					<tr id="google-feed-description-row" style="display:none;"><th id="main-feed-input-label"><label for="google-feed-description-selector"><?php esc_html_e( 'Feed Description', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::google_feed_description_selector(); ?></td></tr>
					<tr id="update-schedule-row" style="display:none;"><th id="main-feed-input-label"><label for="update-schedule"><?php esc_html_e( 'Update Schedule', 'wp-product-feed-manager' ); ?></label> :</th>
					<td><?php echo WPPFM_Feed_Form_Control::schedule_selector(); ?></td></tr>
				</tbody>
			</table>	
			<?php echo WPPFM_Feed_Form_Control::category_mapping_table(); ?>
			<?php echo WPPFM_Feed_Form_Control::main_product_filter_wrapper(); ?>
			<section class=master-feed-filter-wrapper></section>
				<div class="button-wrapper" id="page-center-buttons">
					<input class="button-primary" type="button" name="generate-top" value="<?php esc_html_e( 'Save & Generate Feed', 'wp-product-feed-manager' ); ?>" id="wppfm-generate-feed-button-top" disabled />
					<input class="button-primary" type="button" name="save-top" value="<?php esc_html_e( 'Save Feed', 'wp-product-feed-manager' ); ?>" id="wppfm-save-feed-button-top" disabled />
				</div>

			<div class="widget-content" id="fields-form" style="display:none;">
				<section id="attribute-map">
					<div class="header" id="fields-form-header"><h3><?php esc_html_e( 'Attribute Mapping', 'wp-product-feed-manager' ); ?>:</h3></div>
					<div id="required-fields" style="display:initial;"><legend class="field-level"><h4><?php esc_html_e( 'Required', 'wp-product-feed-manager' ); ?>:</h4></legend>
						<?php echo $this->fieldFormTableTitles(); ?>
					<div class="field-table" id="required-field-table"></div></div>
					<div id="highly-recommended-fields" style="display:none;"><legend class="field-level"><h4><?php esc_html_e( 'Highly recommended', 'wp-product-feed-manager' ); ?>:</h4></legend>
						<?php echo $this->fieldFormTableTitles(); ?>
					<div class="field-table" id="highly-recommended-field-table"></div></div>
					<div id="recommended-fields" style="display:none;"><legend class="field-level"><h4><?php esc_html_e( 'Recommended', 'wp-product-feed-manager' ); ?>:</h4></legend>
						<?php echo $this->fieldFormTableTitles(); ?>
					<div class="field-table" id="recommended-field-table"></div></div>
					<div id="optional-fields" style="display:initial;"><legend class="field-level"><h4><?php esc_html_e( 'Optional', 'wp-product-feed-manager' ); ?>:</h4></legend>
						<?php echo $this->fieldFormTableTitles(); ?>
					<div class="field-table" id="optional-field-table"></div></div>
					<div id="custom-fields" style="display:initial;"><legend class="field-level"><h4><?php esc_html_e( 'Custom attributes', 'wp-product-feed-manager' ); ?>:</h4></legend>
						<?php echo $this->fieldFormTableTitles(); ?>
					<div class="field-table" id="custom-field-table"></div></div>
				</section>

				<div class="button-wrapper" id="page-center-buttons">
					<input class="button-primary" type="button" name="generate-bottom" value="<?php esc_html_e( 'Save & Generate Feed', 'wp-product-feed-manager' ); ?>" id="wppfm-generate-feed-button-bottom" disabled />
					<input class="button-primary" type="button" name="save-bottom" value="<?php esc_html_e( 'Save Feed', 'wp-product-feed-manager' ); ?>" id="wppfm-save-feed-button-bottom" disabled />
				</div>
			</div>

			<?php
		}

		private function fieldFormTableTitles() {
			?>
			<div class="field-header-wrapper">
			<div class="field-header col20w"><?php esc_html_e( 'Add to feed', 'wp-product-feed-manager' ); ?></div>
			<div class="field-header col30w"><?php esc_html_e( 'From WooCommerce source', 'wp-product-feed-manager' ); ?></div>
			<div class="field-header col40w"><?php esc_html_e( 'Condition', 'wp-product-feed-manager' ); ?></div>
			<div class="end-row">&nbsp;</div></div>
			<?php
		}

	}
	
// end of WPPFM_Feed_Form class

endif;