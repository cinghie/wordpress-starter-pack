<?php

/**
 * Add Aqua Resizer
 *
 * @see https://github.com/syamilmj/Aqua-Resizer
 */
require_once 'aq_resizer.php';

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Add JS and Styles to Theme
 */
function add_theme_scripts() {
	// Add FontAwesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . './../storefront-child/assets/css/fontawesome.min.css',false,'5.7.2');
	// Add custom.js
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . './../storefront-child/assets/js/custom.js', array ( 'jquery' ), '1.0', true);
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * Hide Wordpress Version
 *
 * @return string
 */
function hide_wordpress_version() {
	return '';
}

add_filter('the_generator', 'hide_wordpress_version');

/**
 * Prevent update notification for plugin
 *
 * @param $value
 *
 * @return mixed
 */
function disable_plugin_updates($value)
{
	if (is_object($value) && isset($value, $value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'])) {
		unset($value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] );
	}

	return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );
