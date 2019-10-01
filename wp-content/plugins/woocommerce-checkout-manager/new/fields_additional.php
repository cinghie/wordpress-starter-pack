<?php

if (!class_exists('WOOCCM_Fields_Additional')) {

  class WOOCCM_Fields_Additional extends WOOCCM_Fields_Register {

    protected static $instance;

    function get_positioning($position = 'after_order_notes') {

      if ($options = get_option('wccs_settings')) {

        if (!empty($options['checkness']['position'])) {
          $position = sanitize_text_field($options['checkness']['position']);
        }

        return $position;
      }

      return false;
    }

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

    function add_checkout_additional_fields($checkout) {

      if ($options = get_option('wccs_settings')) {

        if (array_key_exists('buttons', $options)) {

          if ($buttons = $options['buttons']) {

            foreach ($buttons as $key => $custom_field) {
              woocommerce_form_field($custom_field['cow'], $this->add_checkout_field_filter($key, $custom_field, $custom_field), $checkout->get_value($custom_field['cow']));
            }
          }
        }
      }
    }

    function init() {
      add_action('woocommerce_checkout_process', array($this, 'add_checkout_additional_required'));

      // Additional fields
      // -----------------------------------------------------------------------
      switch ($this->get_positioning()) {
        case 'before_shipping_form':
          add_action('woocommerce_before_checkout_shipping_form', array($this, 'add_checkout_additional_fields'));
          break;

        case 'after_shipping_form':
          add_action('woocommerce_after_checkout_shipping_form', array($this, 'add_checkout_additional_fields'));
          break;

        case 'before_billing_form':
          add_action('woocommerce_before_checkout_billing_form', array($this, 'add_checkout_additional_fields'));
          break;

        case 'after_billing_form':
          add_action('woocommerce_after_checkout_billing_form', array($this, 'add_checkout_additional_fields'));
          break;

        case 'after_order_notes':
          add_action('woocommerce_after_order_notes', array($this, 'add_checkout_additional_fields'));
          break;
      }
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Additional::instance();
}
