<?php

if (!class_exists('WOOCCM_Fields_Register')) {

  class WOOCCM_Fields_Register {

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

    function add_checkout_field_filter($key, $fields, $custom_field) {

      $defaults = array(
          'address_1',
          'address_2',
          'city',
          'postcode',
          'state',
          'country'
      );

      if ($custom_field['cow'] == 'country') {
        // Country override
        $fields[$key]['type'] = 'wooccmcountry';
      } elseif ($custom_field['cow'] == 'state') {
        // State override
        $fields[$key]['type'] = 'wooccmstate';
      } else {
        $fields[$key]['type'] = $custom_field['type'];
      }

      if ($custom_field['cow'] !== 'country' || $custom_field['cow'] !== 'state') {
        $fields[$key]['placeholder'] = ( isset($custom_field['placeholder']) ? $custom_field['placeholder'] : '' );
      }

      // Default to Position wide
      $custom_field['position'] = ( isset($custom_field['position']) ? $custom_field['position'] : 'form-row-wide' );
      $fields[$key]['class'] = array($custom_field['position'] . ' ' . ( isset($custom_field['conditional_tie']) ? $custom_field['conditional_tie'] : '' ) . ' ' . ( isset($custom_field['extra_class']) ? $custom_field['extra_class'] : '' ));
      $fields[$key]['label'] = wooccm_wpml_string($custom_field['label']);
      $fields[$key]['clear'] = ( isset($custom_field['clear_row']) ? $custom_field['clear_row'] : '' );
      $fields[$key]['default'] = ( isset($custom_field['force_title2']) ? $custom_field['force_title2'] : '' );
      $fields[$key]['options'] = ( isset($custom_field['option_array']) ? $custom_field['option_array'] : '' );
      $fields[$key]['user_role'] = ( isset($custom_field['user_role']) ? $custom_field['user_role'] : '' );
      $fields[$key]['role_options'] = ( isset($custom_field['role_options']) ? $custom_field['role_options'] : '' );
      $fields[$key]['role_options2'] = ( isset($custom_field['role_options2']) ? $custom_field['role_options2'] : '' );
      $fields[$key]['required'] = ( isset($custom_field['checkbox']) ? $custom_field['checkbox'] : '' );
      $fields[$key]['wooccm_required'] = ( isset($custom_field['checkbox']) ? $custom_field['checkbox'] : '' );
      $fields[$key]['cow'] = ( isset($custom_field['cow']) ? $custom_field['cow'] : '' );
      $fields[$key]['color'] = ( isset($custom_field['colorpickerd']) ? $custom_field['colorpickerd'] : '' );
      $fields[$key]['colorpickertype'] = ( isset($custom_field['colorpickertype']) ? $custom_field['colorpickertype'] : '' );
      $fields[$key]['order'] = ( isset($custom_field['order']) ? $custom_field['order'] : '' );
      $fields[$key]['priority'] = ( isset($custom_field['priority']) ? $custom_field['priority'] : $fields[$key]['order'] );
      $fields[$key]['fancy'] = ( isset($custom_field['fancy']) ? $custom_field['fancy'] : '' );

      // Remove required for heading

      if ($custom_field['type'] == 'heading') {
        $fields[$key]['required'] = false;

        //error_log(json_encode($fields[$key]));
      }

      // Check if Multi-checkbox has options assigned to it
      if ($custom_field['type'] == 'multicheckbox' && empty($custom_field['option_array'])) {
        $custom_field['disabled'] = true;
      }

      // Bolt on address-field for address-based fields
      if (in_array($custom_field['cow'], $defaults)) {
        $fields[$key]['class'][] = 'address-field';
      }

      // Override for State fields
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

      return $fields[$key];
    }

    function add_checkout_fields_filter($fields, $name, $key, $prefix = '') {

      if ($options = get_option($name)) {

        if (array_key_exists($key, $options)) {

          if ($custom_fields = $options[$key]) {

            foreach ($custom_fields as $id => $custom_field) {

              if (!empty($custom_field['cow']) && empty($custom_field['deny_checkout'])) {

                $key = sprintf("%s%s", $prefix, $custom_field['cow']);

                $fields[$key] = $this->add_checkout_field_filter($key, $fields, $custom_field);

                // Remove disabled fields
                if (!empty($custom_field['disabled'])) {
                  unset($fields[$key]);
                }
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
