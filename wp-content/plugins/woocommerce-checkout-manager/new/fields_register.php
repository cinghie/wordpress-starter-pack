<?php

if (!class_exists('WOOCCM_Fields_Register')) {

  class WOOCCM_Fields_Register {

    protected static $instance;

    function add_checkout_field_filter($key, $fields, $custom_field) {


      $fields[$key] = wp_parse_args($custom_field, (array) @$fields[$key]);

      //$fields[$key]['key'] = $key;
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
      if ($fields[$key]['type'] == 'wooccmstate') {
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

      //error_log(json_encode($fields[$key]));

      return apply_filters('wooccm_checkout_field_filter', $fields[$key], $key);
    }

    function add_checkout_fields_filter($fields, $name, $key, $prefix = '') {

      if ($options = get_option($name)) {

        if (array_key_exists($key, $options)) {

          if ($custom_fields = $options[$key]) {

            foreach ($custom_fields as $id => $custom_field) {

              if (!empty($custom_field['cow']) && empty($custom_field['deny_checkout'])) {

                $key = sprintf("%s%s", $prefix, $custom_field['cow']);

                // Remove disabled fields
                //if (!empty($custom_field['disabled'])) {
                //unset($fields[$key]);
                //} else {
                $fields[$key] = $this->add_checkout_field_filter($key, $fields, $custom_field);
                //}
              }
            }
          }
        }

// Resort the fields by order
        $fields[] = uasort($fields, 'wooccm_sort_fields');

        if ($fields[0]) {
          unset($fields[0]);
        }
      }

      return $fields;
    }

    function add_checkout_shipping_fields($fields) {
      return $this->add_checkout_fields_filter($fields, 'wccs_settings2', 'shipping_buttons', 'shipping_');
    }

    function add_checkout_billing_fields($fields) {
      return $this->add_checkout_fields_filter($fields, 'wccs_settings3', 'billing_buttons', 'billing_');
    }

    function init() {

      // Billing fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_billing_fields', array($this, 'add_checkout_billing_fields'));

      // Shipping fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_shipping_fields', array($this, 'add_checkout_shipping_fields'));
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
