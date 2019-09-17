<?php

if (!class_exists('WOOCCM_Fields_Register')) {

  class WOOCCM_Fields_Register {

    protected static $instance;
    protected static $i = 0;

    function get_positioning($position = 'after_order_notes') {

      if ($options = get_option('wccs_settings')) {

        if (!empty($options['checkness']['position'])) {
          $position = sanitize_text_field($options['checkness']['position']);
        }

        return $position;
      }

      return false;
    }

    function add_checkout_field_filter($key, $fields, $custom_field) {

      $defaults = array(
          'address_1',
          'address_2',
          'city',
          'postcode',
          'state',
          'country'
      );

      //var_dump($fields[$key]);

      $fields[$key] = wp_parse_args($custom_field, (array) @$fields[$key]);

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
      //if (!empty($custom_field['option_array'])) {
      $fields[$key]['options'] = @$custom_field['option_array'];
      //}
      // Default
      // -----------------------------------------------------------------------
      if (isset($custom_field['force_title2'])) {
        $fields[$key]['default'] = $fields[$key]['force_title2'];
      }

      // Clear
      // -----------------------------------------------------------------------
      if (isset($custom_field['clear_row'])) {
        $fields[$key]['clear'] = $fields[$key]['clear_row'];
      }

      // Class
      // -----------------------------------------------------------------------

      if (isset($fields[$key]['class'])) {
        if (isset($custom_field['position'])) {
          $fields[$key]['class'] = array_diff($fields[$key]['class'], array('form-row-wide', 'form-row-first', 'form-row-last'));
          $fields[$key]['class'][] = $custom_field['position'];
        }
        if (isset($custom_field['conditional_tie'])) {
          $fields[$key]['class'][] = $custom_field['conditional_tie'];
        }
        if (isset($custom_field['extra_class'])) {
          $fields[$key]['class'][] = $custom_field['extra_class'];
        }
      } else {
        $fields[$key]['class'] = array('form-row-wide');
      }

      if (!empty($custom_field['clear_row'])) {
        $fields[$key]['class'][] = 'wooccm-clearfix';
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

      if ($fields[$key]['type'] == 'wooccmstate') {
        $fields[$key]['type'] = 'state';
      }
      if ($fields[$key]['type'] == 'wooccmcountry') {
        $fields[$key]['type'] = 'country';
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

      // Bolt on address-field for address-based fields
      // -----------------------------------------------------------------------
      if (in_array($custom_field['cow'], $defaults)) {
        $fields[$key]['class'][] = 'address-field';
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

  WOOCCM_Fields_Register::instance();
}
