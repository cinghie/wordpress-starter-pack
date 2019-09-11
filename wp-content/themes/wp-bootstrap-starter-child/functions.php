<?php

/**
 * Add Aqua Resizer
 *
 * @see https://github.com/syamilmj/Aqua-Resizer
 */
require_once 'aq_resizer.php';

/**
 * Enqueue Child Styles
 */
function wp_bootstrap_starter_child_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_child_enqueue_styles');

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
 * http://www.thecreativedev.com/disable-updates-for-specific-plugin-in-wordpress/
 * Place in theme functions.php or at bottom of wp-config.php
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
