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

    function add_checkout_additional_required($fields) {

      if ($fields = WOOCCM()->field->additional->get_fields('old')) {

        foreach ($fields as $field_id => $field) {

          if (!empty($field['cow']) && empty($field['deny_checkout'])) {

            //$key = sprintf("%s_%s", $prefix, $field['cow']);

            $field = $this->add_checkout_field_filter($fields, $field, 'additional');

            if (!empty($field['required']) && !empty($field['cow']) && empty($field['deny_checkout']) && empty($field['disabled'])) {

              if (empty($_POST[$field['cow']])) {
                $message = sprintf(__('%s is a required field.', 'woocommerce-checkout-manager'), '<strong>' . wooccm_wpml_string($field['label']) . '</strong>');
                wc_add_notice($message, 'error');
              }
            }
          }
        }
      }
    }

    function add_checkout_additional_fields($checkout) {

      if ($fields = WOOCCM()->field->additional->get_fields('old')) {

        foreach ($fields as $field_id => $field) {

          $field = $this->add_checkout_field_filter($field, $field, 'additional');

          if (!empty($field['cow']) && empty($field['deny_checkout']) && empty($field['disabled'])) {

            woocommerce_form_field($field['cow'], $field, $checkout->get_value($field['cow']));
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
