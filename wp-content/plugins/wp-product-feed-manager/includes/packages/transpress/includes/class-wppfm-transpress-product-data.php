<?php

/* * ******************************************************************
 * Version 1.0
 * Package: Transpress
 * Modified: 21-11-2022
 * Copyright 2022 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPPFM_Transpress_Product_Data' ) ) :

	/**
	 * The WPPFM_Transpress_Product_Data class contains all functions for database manipulations to support the Translatepress Language plugin.
	 *
	 * @class WPPFM_Transpress_Product_Data
	 * @version 1.0
	 * @category class
	 *
	 * @since 2.36.0
	 */

class WPPFM_Transpress_Product_Data {

	/**
	 * Gets the translated main product data.
	 *
	 * @param object $product
	 * @param string $language
	 *
	 * @return stdClass containing the translation element id, translated post title and post content
	 * @since 2.36.0
	 *
	 */
	public function get_translated_product( $product, $language ) {

		$title = trp_translate( $product->post_title, $language, false);
		$description = trp_translate( $product->post_content, $language, false );
		$excerpt = isset( $product->post_excerpt ) ? trp_translate( $product->post_excerpt, $language, false ) : '';

		if ( $title ) {
			$pointer = new stdClass();

			$pointer->ID           = $product->ID;
			$pointer->post_title   = $title;
			$pointer->post_content = $description;
			$pointer->post_excerpt = $excerpt;

			return $pointer;
		} else {
			return $product;
		}
	}

	/**
	 * This function is an abstract from the get_url_for_language function from the class-url-converter.php file from the translatepress plugin.
	 *
	 * @param $url
	 * @param $language
	 *
	 * @return string
	 * @since 2.36.0
	 */
	public function add_language_to_url( $url, $language ) {

		$settings = new TRP_Settings();
		$current_settings = $settings->get_settings();

		if( $current_settings['default-language'] === $language ) { // Keep the original url for the default language
			return $url;
		}

		$url_converter = new TRP_Url_Converter( $current_settings );

		$url_obj = trp_cache_get('url_obj_' . hash('md4', $url), 'trp');
		if( $url_obj === false ){
			$url_obj = new \TranslatePress\Uri($url);
			wp_cache_set('url_obj_' . hash('md4', $url), $url_obj, 'trp' );
		}

		$abs_home_url_obj = trp_cache_get('url_obj_' . hash('md4',  $url_converter->get_abs_home() ), 'trp');
		if( $abs_home_url_obj === false ){
			$abs_home_url_obj = new \TranslatePress\Uri( $url_converter->get_abs_home() );
			wp_cache_set('url_obj_' . hash('md4', $url_converter->get_abs_home()), $abs_home_url_obj, 'trp' );
		}

		$new_url_obj = $url_obj;
		if ($abs_home_url_obj->getPath() == "/") {
			$abs_home_url_obj->setPath('');
		}

		if ($url_converter->get_lang_from_url_string($url) === null) {
			// these are the custom url. They don't have language
			$abs_home_considered_path = trim(str_replace($abs_home_url_obj->getPath(), '', $url_obj->getPath()), '/');
			$new_url_obj->setPath(trailingslashit(trailingslashit($abs_home_url_obj->getPath()) . trailingslashit($url_converter->get_url_slug($language)) . $abs_home_considered_path));
			$new_url = $new_url_obj->getUri();
		} else {
			// these have language param in them, and we need to replace them with the new language
			$abs_home_considered_path = trim(str_replace($abs_home_url_obj->getPath(), '', $url_obj->getPath()), '/');
			$no_lang_orig_path = explode('/', $abs_home_considered_path);
			unset($no_lang_orig_path[0]);
			$no_lang_orig_path = implode('/', $no_lang_orig_path);

			if (!$url_converter->get_url_slug($language)) {
				$url_lang_slug = '';
			} else {
				$url_lang_slug = trailingslashit($url_converter->get_url_slug($language));
			}

			$new_url_obj->setPath(trailingslashit(trailingslashit($abs_home_url_obj->getPath()) . $url_lang_slug . ltrim($no_lang_orig_path, '/')));
			$new_url = $new_url_obj->getUri();
		}

		return $new_url;
	}

}

	// end of WPPFM_Transpress_Product_Data class
endif;
