<?php

/**
 * Adds a language selector to the feed setup page
 *
 * @since 2.36.0
 */
function add_transpress_language_selector_to_feed_form() {
	if ( ! class_exists( 'TRP_Translate_Press') ) {
		return '';
	}

	$transpress = TRP_Translate_Press::get_trp_instance();
	$transpress_settings = $transpress->get_component( 'settings' )->get_settings();
	$transpress_active_languages = $transpress_settings['translation-languages'];
	$languages = $transpress->get_component('languages')->get_languages();

	?>
	<tr class="wppfm-main-feed-input-row">
		<th id="wppfm-main-feed-input-label"><label for="wppfm-feed-language-selector">Feed Language</label> :</th>
		<td>
			<select class="wppfm-main-input-selector wppfm-feed-language-selector" id="wppfm-feed-language-selector">
				<option value="0"><?php _e('-- Select the language of the feed --', 'wppfm_wpml'); ?></option>
				<?php foreach ( $transpress_active_languages as $active_language ) : ?>
					<option value="<?php echo $active_language; ?>"><?php echo $languages[$active_language]; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<?php
}

add_action('wppfm_add_feed_attribute_selector', 'add_transpress_language_selector_to_feed_form' );

/**
 * Translates a product
 *
 * The object that is returned contains the id that points to the product translations and a
 * translated product title and product description string
 *
 * @param object $product
 * @param string $language
 *
 * @return    object
 * @since 2.36.0
 *
 */
function translate_transpress_product($product, $language) {
	$data_class = new WPPFM_TRANSPRESS_Product_Data();

	return $data_class->get_translated_product( $product, $language );
}

add_filter('wppfm_transpress_translation', 'translate_transpress_product', 10, 2);

/**
 * Returns the product permalink for the selected language
 *
 * @param $permalink
 * @param $language
 *
 * @return mixed|string|null
 * @since 2.36.0
 */
function get_transpress_product_permalink($permalink, $language) {
	if ( ! $language ) {
		return $permalink;
	}

	if( class_exists( 'TRP_Settings' ) && class_exists( 'TRP_Url_Converter' ) ) {
		$data_class = new WPPFM_TRANSPRESS_Product_Data();
		return esc_url( $data_class->add_language_to_url( $permalink, $language ) );
	} else {
		return $permalink;
	}
}

add_filter('wppfm_get_transpress_permalink', 'get_transpress_product_permalink', 10, 2);
