<?php

if (!class_exists('WOOCCM_Fields_Register')) {

  class WOOCCM_Fields_Register {

    protected static $instance;

    function add_checkout_field_filter($fields, $custom_field, $prefix = '') {

      $key = sprintf("%s_%s", $prefix, $custom_field['cow']);

      $fields[$key] = wp_parse_args($custom_field, (array) @$fields[$key]);

      // Conditonal
      // -----------------------------------------------------------------------
      if (!empty($fields[$key]['conditional_parent_use']) && !empty($fields[$key]['conditional_tie']) && !empty($fields[$key]['chosen_valt']) && ($fields[$key]['conditional_tie'] != $fields[$key]['cow'])) {
        $fields[$key]['conditional_tie'] = sprintf("%s_%s", $prefix, @$fields[$key]['conditional_tie']);
      }
      // Class
      // -----------------------------------------------------------------------
      if (!is_array(@$fields[$key]['class'])) {
        $fields[$key]['class'] = array();
      }

      // Priority
      // -----------------------------------------------------------------------
      if (isset($custom_field['order'])) {
        $fields[$key]['priority'] = $fields[$key]['order'] * 10;
      }

      // Color
      // -----------------------------------------------------------------------
      if (isset($custom_field['colorpickerd'])) {
        $fields[$key]['color'] = $fields[$key]['colorpickerd'];
      }

      // Options
      // -----------------------------------------------------------------------
      if (!empty($custom_field['option_array'])) {

        $options = explode('||', @$custom_field['option_array']);

        $fields[$key]['options'] = array_combine($options, $options);
      }

      // Default
      // -----------------------------------------------------------------------
      //if (isset($custom_field['force_title2'])) {
      $fields[$key]['default'] = @$fields[$key]['force_title2'];
      //}
      // Clear
      // -----------------------------------------------------------------------
      if (isset($custom_field['clear_row'])) {
        $fields[$key]['clear'] = $fields[$key]['clear_row'];
      }

      // Remove placeholder
      // -----------------------------------------------------------------------
      if ($custom_field['cow'] !== 'country' || $custom_field['cow'] !== 'state') {
        $fields[$key]['placeholder'] = ( isset($custom_field['placeholder']) ? $custom_field['placeholder'] : '' );
      }

      // Scape wooccm field fielter
      // -----------------------------------------------------------------------
      if ($fields[$key]['type'] == 'wooccmtext') {
        $fields[$key]['type'] = 'text';
      }
      if ($fields[$key]['type'] == 'wooccmradio') {
        $fields[$key]['type'] = 'radio';
      }
      if ($fields[$key]['type'] == 'wooccmpassword') {
        $fields[$key]['type'] = 'password';
      }
      if ($fields[$key]['type'] == 'wooccmstate') {
        $fields[$key]['type'] = 'state';
      }
      if ($fields[$key]['type'] == 'wooccmcountry') {
        $fields[$key]['type'] = 'country';
      }
      if ($fields[$key]['type'] == 'wooccmselect') {
        $fields[$key]['type'] = 'select';
      }
      if ($fields[$key]['type'] == 'wooccmtextarea') {
        $fields[$key]['type'] = 'textarea';
      }
      if ($fields[$key]['type'] == 'checkbox_wccm') {
        $fields[$key]['type'] = 'checkbox';
      }
      if ($fields[$key]['type'] == 'time') {
        $fields[$key]['type'] = 'timepicker';
      }

      // Required
      // -----------------------------------------------------------------------
      if (!empty($custom_field['checkbox'])) {
        $fields[$key]['checkbox'] = true;
        $fields[$key]['required'] = true;
        $fields[$key]['wooccm_required'] = true;
      } else {
        $fields[$key]['checkbox'] = false;
        $fields[$key]['required'] = false;
        $fields[$key]['wooccm_required'] = false;
      }

      // Remove required for heading
      // -----------------------------------------------------------------------
      if ($custom_field['type'] == 'heading') {
        $fields[$key]['required'] = false;
      }

      // Fancy
      // -----------------------------------------------------------------------
      //if (!empty($custom_field['option_array'])) {
      $fields[$key]['fancy'] = @$custom_field['fancy'];
      //}
      // Check if Multi-checkbox has options assigned to it
      // -----------------------------------------------------------------------
      if ($custom_field['type'] == 'multicheckbox' && empty($custom_field['option_array'])) {
        $custom_field['disabled'] = true;
      }

      // Override for State fields
      // -----------------------------------------------------------------------
      if ($fields[$key]['type'] == 'state') {

        //$fields[$key]['country'] = $fields[$key]['default'];

        unset($fields[$key]['default']);

        $country_key = false;
        if ($key == 'billing_state') {
          $country_key = 'billing_country';
        }
        if ($key == 'shipping_state') {
          $country_key = 'shipping_country';
        }
        if (!empty($country_key)) {
          $current_cc = WC()->checkout->get_value($country_key);
          $states = WC()->countries->get_states($current_cc);
          if (empty($states)) {
            $fields[$key]['required'] = false;
            $fields[$key]['wooccm_required'] = false;
          }
        }
      }

      // ii18n
      // -----------------------------------------------------------------------

      $fields[$key]['label'] = esc_html__($fields[$key]['label'], WOOCCM_WC_DOMAIN);
      $fields[$key]['placeholder'] = esc_html__($fields[$key]['placeholder'], WOOCCM_WC_DOMAIN);

      return apply_filters('wooccm_checkout_field_filter', $fields[$key], $key);
    }

    function add_checkout_fields_filter($fields, $prefix = '') {

      $frontend_fields = array();

      if ($custom_fields = WOOCCM()->field->$prefix->get_fields('old')) {

        foreach ($custom_fields as $field_id => $custom_field) {

          if (!empty($custom_field['cow']) && empty($custom_field['disabled'])) {

            $key = sprintf("%s_%s", $prefix, $custom_field['cow']);

            $frontend_fields[$key] = $this->add_checkout_field_filter($fields, $custom_field, $prefix);
          }
        }

        return $frontend_fields;
      }

      return $fields;
    }

    function add_checkout_billing_fields($fields) {
      return $this->add_checkout_fields_filter($fields, 'billing');
    }

    function add_checkout_shipping_fields($fields) {
      return $this->add_checkout_fields_filter($fields, 'shipping');
    }

    function add_checkout_additional_fields($fields) {
      return $this->add_checkout_fields_filter($fields, 'additional');
    }

    function init() {

      // Billing fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_billing_fields', array($this, 'add_checkout_billing_fields'));

      // Shipping fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_shipping_fields', array($this, 'add_checkout_shipping_fields'));

      // Additional fields
      // -----------------------------------------------------------------------
      add_filter('wooccm_additional_fields', array($this, 'add_checkout_additional_fields'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Register::instance();
}
