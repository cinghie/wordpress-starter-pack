<?php

/**
 * Plugin Name: WooCommerce Checkout Manager
 * Description: Manages WooCommerce Checkout, the advanced way.
 * Version:     4.5.0
 * Author:      QuadLayers
 * Author URI:  https://www.quadlayers.com
 * Copyright:   2019 QuadLayers (https://www.quadlayers.com)
 * Text Domain: woocommerce-checkout-manager
 */
if (!defined('ABSPATH')) {
  die('-1');
}

if (!defined('WOOCCM_PLUGIN_NAME')) {
  define('WOOCCM_PLUGIN_NAME', 'WooCommerce Checkout Manager');
}
if (!defined('WOOCCM_PLUGIN_VERSION')) {
  define('WOOCCM_PLUGIN_VERSION', '4.5.0');
}
if (!defined('WOOCCM_PLUGIN_FILE')) {
  define('WOOCCM_PLUGIN_FILE', __FILE__);
}
if (!defined('WOOCCM_PLUGIN_DIR')) {
  define('WOOCCM_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('WOOCCM_PREFIX')) {
  define('WOOCCM_PREFIX', 'wooccm');
}
if (!defined('WOOCCM_WORDPRESS_URL')) {
  define('WOOCCM_WORDPRESS_URL', 'https://wordpress.org/plugins/woocommerce-checkout-manager/');
}
if (!defined('WOOCCM_REVIEW_URL')) {
  define('WOOCCM_REVIEW_URL', 'https://wordpress.org/support/plugin/woocommerce-checkout-manager/reviews/?filter=5#new-post');
}
if (!defined('WOOCCM_DOCUMENTATION_URL')) {
  define('WOOCCM_DOCUMENTATION_URL', 'https://quadlayers.com/documentation/woocommerce-checkout-manager/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_DEMO_URL')) {
  define('WOOCCM_DEMO_URL', 'https://quadlayers.com/portfolio/woocommerce-checkout-manager/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_PURCHASE_URL')) {
  define('WOOCCM_PURCHASE_URL', WOOCCM_DEMO_URL);
}
if (!defined('WOOCCM_SUPPORT_URL')) {
  define('WOOCCM_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_GROUP_URL')) {
  define('WOOCCM_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}

if (!class_exists('WOOCCM', false)) {
  include_once WOOCCM_PLUGIN_DIR . 'new/class-wooccm.php';
}

function WOOCCM() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
  return WOOCCM::instance();
}

// Global for backwards compatibility.
$GLOBALS['wooccm'] = WOOCCM();

add_action('woocommerce_before_checkout_form', 'wooccm_autocreate_account');
// E-mail - Order receipt
add_action('woocommerce_email_after_order_table', 'wooccm_order_receipt_checkout_details', 10, 3);
// Save the Order meta
add_action('woocommerce_checkout_update_order_meta', 'wooccm_custom_checkout_field_update_order_meta');
add_action('woocommerce_checkout_process', 'wooccm_custom_checkout_field_process');
add_action('woocommerce_checkout_update_user_meta', 'wooccm_custom_checkout_field_update_user_meta', 10, 2);
// Checkout - Order Received
add_action('woocommerce_order_details_after_customer_details', 'wooccm_order_received_checkout_details');
add_action('woocommerce_checkout_after_customer_details', 'wooccm_checkout_text_after');
add_action('woocommerce_checkout_before_customer_details', 'wooccm_checkout_text_before');
add_filter('woocommerce_checkout_fields', 'wooccm_remove_fields_filter_billing', 15);
add_filter('woocommerce_checkout_fields', 'wooccm_remove_fields_filter_shipping', 1);
add_action('wp_head', 'wooccm_display_front');

add_filter('wcdn_order_info_fields', 'wooccm_woocommerce_delivery_notes_compat', 10, 2);
add_filter('wc_customer_order_csv_export_order_row', 'wooccm_csv_export_modify_row_data', 10, 3);
add_filter('wc_customer_order_csv_export_order_headers', 'wooccm_csv_export_modify_column_headers');

add_filter('default_checkout_billing_state', 'wooccm_state_default_switch');

add_action('woocommerce_checkout_process', 'wooccm_custom_checkout_process');
add_action('woocommerce_checkout_process', 'wooccm_billing_custom_checkout_process');
add_action('woocommerce_checkout_process', 'wooccm_shipping_custom_checkout_process');

add_action('woocommerce_checkout_fields', 'wooccm_order_notes');
add_filter('parse_query', 'wooccm_query_list');
add_action('restrict_manage_posts', 'woooccm_restrict_manage_posts');

if (wooccm_validator_changename()) {

  add_action('woocommerce_before_cart', 'wooccm_before_checkout');
  add_action('woocommerce_admin_order_data_after_order_details', 'wooccm_before_checkout');
  add_action('woocommerce_before_my_account', 'wooccm_before_checkout');
  add_action('woocommerce_email_header', 'wooccm_before_checkout');
  add_action('woocommerce_before_checkout_form', 'wooccm_before_checkout');
  add_action('woocommerce_after_cart', 'wooccm_after_checkout');
  add_action('woocommerce_admin_order_data_after_shipping_address', 'wooccm_after_checkout');
  add_action('woocommerce_after_my_account', 'wooccm_after_checkout');
  add_action('woocommerce_email_footer', 'wooccm_after_checkout');
  add_action('woocommerce_after_checkout_form', 'wooccm_after_checkout');
}

if (wooccm_enable_auto_complete()) {
  add_action('woocommerce_before_checkout_form', 'wooccm_retain_field_values');
}