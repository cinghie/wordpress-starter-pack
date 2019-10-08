<?php

if (!class_exists('WOOCCM_Fields_Handler')) {

  class WOOCCM_Fields_Handler {

    protected static $instance;
    protected static $i = 0;

    function add_field_classes($field, $key) {

      // Position
      // -----------------------------------------------------------------------
      if (!empty($field['position'])) {
        $field['class'] = array_diff($field['class'], array('form-row-wide', 'form-row-first', 'form-row-last'));
        $field['class'][] = $field['position'];
      }

      // WOOCCM
      // -----------------------------------------------------------------------

      $field['class'][] = 'wooccm-field';
      $field['class'][] = 'wooccm-field-' . $field['cow'];

      // Type
      // -----------------------------------------------------------------------
      if (!empty($field['type'])) {
        $field['class'][] = 'wooccm-type-' . $field['type'];
      }

      // Color
      // -----------------------------------------------------------------------
      if (!empty($field['type']) && $field['type'] == 'colorpicker') {
        $field['class'][] = 'wooccm-colorpicker-' . $field['colorpickertype'];
      }

      // Extra
      // -----------------------------------------------------------------------
      if (!empty($field['extra_class'])) {
        $field['class'][] = $field['extra_class'];
      }

      // Clearfix
      // -----------------------------------------------------------------------
      if (!empty($field['clear_row'])) {
        $field['class'][] = 'wooccm-clearfix';
      }

      // Required
      // -----------------------------------------------------------------------

      if (isset($field['required'])) {
        $field['custom_attributes']['data-required'] = (int) $field['required'];
      }

      return $field;
    }

    function remove_checkout_fields($fields) {

      foreach ($fields as $key => $type) {

        foreach ($type as $field_id => $field) {

          // Remove disabled
          // -------------------------------------------------------------------
          if (!empty($field['disabled'])) {
            unset($fields[$key][$field_id]);
          }
        }
      }

      // Fix for required address field
      if (get_option('woocommerce_ship_to_destination') == 'billing_only') {
        unset($fields['shipping']);
      }

      return $fields;
    }

    //function woocommerce_checkout_address_2_field($option) {
    //  return 'required';
    //}

    function remove_fields_priority($fields) {

      foreach ($fields as $key => $field) {
        unset($fields[$key]['label']);
        unset($fields[$key]['placeholder']);
        unset($fields[$key]['priority']);
        unset($fields[$key]['required']);
      }

      return $fields;
    }

    function remove_address_fields($data) {

      $remove = array(
          'shipping_country',
          'shipping_address_1',
          'shipping_city',
          'shipping_state',
          'shipping_postcode'
      );

      foreach ($remove as $key) {
        if (empty($data[$key])) {
          unset($data[$key]);
        }
      }

      return $data;
    }

    function init() {

      // Add field classes
      add_filter('wooccm_checkout_field_filter', array($this, 'add_field_classes'), 10, 2);

      // Remove fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_checkout_fields', array($this, 'remove_checkout_fields'));

      // Fix address_2 field
      // -----------------------------------------------------------------------
      //add_filter('default_option_woocommerce_checkout_address_2_field', array($this, 'woocommerce_checkout_address_2_field'));
      // Fix address fields priority
      add_filter('woocommerce_get_country_locale_default', array($this, 'remove_fields_priority'));
      add_filter('woocommerce_get_country_locale_base', array($this, 'remove_fields_priority'));

      // Fix required country notice when shipping address is activated
      // -----------------------------------------------------------------------
      add_filter('woocommerce_checkout_posted_data', array($this, 'remove_address_fields'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Handler::instance();
}
