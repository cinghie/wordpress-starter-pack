<?php

if (!class_exists('WOOCCM_Fields_Required')) {

  class WOOCCM_Fields_Required extends WOOCCM_Fields_Register {

    protected static $instance;

    function add_checkout_fields_required($fields, $name, $key, $prefix = '') {

      if ($options = get_option($name)) {

        if (array_key_exists($key, $options)) {

          if ($custom_fields = $options[$key]) {

            foreach ($custom_fields as $id => $custom_field) {

              $key = sprintf("%s%s", $prefix, $custom_field['cow']);

              $custom_field = $this->add_checkout_field_filter($key, $custom_fields, $custom_field);

              if (!empty($custom_field['required']) && !empty($custom_field['cow']) && empty($custom_field['deny_checkout'])) {

                if (empty($_POST[$custom_field['cow']])) {
                  $message = sprintf(__('%s is a required field.', 'woocommerce-checkout-manager'), '<strong>' . wooccm_wpml_string($custom_field['label']) . '</strong>');
                  wc_add_notice($message, 'error');
                }
              }
            }
          }
        }
      }

      return $fields;
    }

    function add_checkout_additional_required($fields) {
      return $this->add_checkout_fields_required($fields, 'wccs_settings', 'buttons');
    }

    //function add_checkout_shipping_required($fields) {
    //  return $this->add_checkout_fields_required($fields, 'wccs_settings2', 'shipping_buttons', 'shipping_');
    //}
    //function add_checkout_billing_required($fields) {
    //  return $this->add_checkout_fields_required($fields, 'wccs_settings3', 'billing_buttons', 'billing_');
    //}

    function init() {
      add_action('woocommerce_checkout_process', array($this, 'add_checkout_additional_required'));
      //add_action('woocommerce_checkout_process', array($this, 'add_checkout_billing_required'));
      //add_action('woocommerce_checkout_process', array($this, 'add_checkout_shipping_required'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Required::instance();
}
