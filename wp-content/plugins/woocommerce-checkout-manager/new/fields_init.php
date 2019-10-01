<?php

if (!class_exists('WOOCCM_Fields')) {

  class WOOCCM_Fields {

    protected static $instance;

    public static function get_default_address_fields() {

      $defaults = array(
          'country',
          'first_name',
          'last_name',
          'company',
          'address_1',
          'address_2',
          'city',
          'state',
          'postcode',
          'email',
          'phone'
      );

      return array_merge(array_keys(WC()->countries->get_default_address_fields()), $defaults);
    }

    public static function get_fields_conditional_types() {

      $fields = self::get_fields_types();

      unset($fields['heading']);
      unset($fields['button']);

      return array_keys($fields);
    }

    public static function get_fields_option_types() {

      return array(
          'multicheckbox',
          'multiselect',
          'wooccmselect',
          'select'
      );
    }

    public static function get_fields_types() {

      return apply_filters('wooccm_fields_fields_types', array(
          'text' => __('Text', 'woocommerce-checkout-manager'),
          'textarea' => __('Text Area', 'woocommerce-checkout-manager'),
          'password' => __('Text Area', 'woocommerce-checkout-manager'),
          'select' => __('Select', 'woocommerce-checkout-manager'),
          'multiselect' => __('Multiselect', 'woocommerce-checkout-manager'),
          'radio' => __('Radio', 'woocommerce-checkout-manager'),
          'checkbox' => __('Checkbox', 'woocommerce-checkout-manager'),
          'multicheckbox' => __('Multi-checkbox', 'woocommerce-checkout-manager'),
          'datepicker' => __('Datepicker', 'woocommerce-checkout-manager'),
          'timepicker' => __('Timepicker', 'woocommerce-checkout-manager'),
          'colorpicker' => __('Colorpicker', 'woocommerce-checkout-manager'),
          'country' => __('Countru', 'woocommerce-checkout-manager'),
          'state' => __('State', 'woocommerce-checkout-manager'),
          'heading' => __('Heading', 'woocommerce-checkout-manager'),
          //'button' => __('Button', 'woocommerce-checkout-manager'),
          'file' => __('File', 'woocommerce-checkout-manager'),
      ));
    }

    static function get_field_args() {

      $args = array(
          'id' => null,
          'cow' => null,
          // Defaults
          // -------------------------------------------------------------------
          'disabled' => false,
          'order' => null,
          'priority' => null,
          'slug' => null,
          'type' => null,
          'label' => null,
          'placeholder' => null,
          //'force_title2' => null,
          'default' => null,
          //'color' => null,
          //'colorpickerd' => null,
          'position' => null,
          //'clear_row' => null,
          'clear' => null,
          //'options_array' => null,
          'options' => null,
          'required' => null,
          //'checkbox' => null,
          //'wooccm_required' => null,
          'class' => null,
          'extra_class' => null,
          // Display
          // -------------------------------------------------------------------
          //'user_role' => null,
          'role_options' => array(),
          'role_options2' => array(),
          'more_content' => null,
          'single_p' => array(),
          'single_p_cat' => array(),
          'single_px' => array(),
          'single_px_cat' => array(),
          // Timing
          // -------------------------------------------------------------------
          'start_hour' => null,
          'end_hour' => null,
          'interval_min' => null,
          'manual_min' => null,
          'min_before' => null,
          'max_after' => null,
          'format_date' => null,
          'date_limit' => null,
          'single_dd' => null,
          'single_max_dd' => null,
          'single_max_mm' => null,
          'single_max_yy' => null,
          'single_mm' => null,
          'single_yy' => null,
          // Amount
          // -------------------------------------------------------------------
          'add_amount' => null,
          //'fee_name' => null,
          'add_admoun_name' => null,
          'add_amount_type' => null,
          'add_amount_tax' => null,
          //'tax_remove' => null,
          // Conditional
          // -------------------------------------------------------------------
          'conditional' => null,
          //'conditional_parent_use' => null,
          //'conditional_tie' => null,
          'conditional_parent_slug' => null,
          'conditional_parent_value' => null,
          //'conditional_parent' => null,
          //'chosen_valt' => null,
          // Display
          // -------------------------------------------------------------------
          'listable' => null,
          'sortable' => null,
          'filterable' => null,
          'single_min_date' => null,
          'single_max_date' => null,
              // 
              // Email
              // -------------------------------------------------------------------
              //deny_receipt
              //'colorpickertype' => null,
              //'fancy' => null,
      );

      return $args;
    }

    public static function get_billing_fields($new = false) {
      return self::get_fields('wccs_settings3', 'billing', self::get_default_address_fields(), $new);
    }

    public static function get_shipping_fields($new = false) {
      return self::get_fields('wccs_settings2', 'shipping', self::get_default_address_fields(), $new);
    }

    public static function get_additional_fields($new = false) {
      return self::get_fields('wccs_settings', '', self::get_default_address_fields(), $new);
    }

    protected static function get_fields($name, $prefix = 'additional', $defaults = array(), $new) {

      if ($fields = get_option($name, $prefix, $defaults)) {

        // Compatibility with 4.x
        // ---------------------------------------------------------------------
        if (array_key_exists("{$prefix}_buttons", $fields)) {
          $fields = $fields["{$prefix}_buttons"];
        }

        // Additional compatibility with 4.x
        // ---------------------------------------------------------------------
        if ($name == 'wccs_settings') {
          $fields = (array) @$fields['buttons'];
        }

        foreach ($fields as $id => $field) {

          $key = sprintf("%s_%s", $prefix, $field['cow']);

          if ($new === 'new') {
            $fields[$id] = self::new_panel_compatibility($field, $key, $id);
          } else {
            $fields[$id] = self::old_panel_compatibility($field, $key, $id);
          }
        }

        // Resort the fields by order
        // ---------------------------------------------------------------------
        //$fields[] = uasort($fields, 'wooccm_sort_fields');
        //if ($fields[0]) {
        //  unset($fields[0]);
        //}
      }

      return $fields;
    }

    protected static function new_panel_compatibility($field, $key, $id) {

      $field = wp_parse_args($field, self::get_field_args());

      $field['id'] = $id;
      $field['key'] = $key;
      $field['name'] = @$field['cow'];

      // General
      $field['placeholder'] = @$field['placeholder'];
      $field['clear'] = @$field['clear_row'];
      $field['required'] = @$field['checkbox'];
      $field['conditional'] = @$field['conditional_parent_use'];
      $field['conditional_tie'] = @$field['conditional_parent_slug'];
      $field['conditional_value'] = @$field['chosen_valt'];
      $field['add_amount_name'] = @$field['fee_name'];
      $field['add_amount_tax'] = !@$field['tax_remove'];

      if ($field['type'] == 'wooccmtext') {
        $field['type'] = 'text';
      }
      if ($field['type'] == 'wooccmstate') {
        $field['type'] = 'state';
      }
      if ($field['type'] == 'wooccmcountry') {
        $field['type'] = 'country';
      }
      if ($field['type'] == 'wooccmselect') {
        $field['type'] = 'select';
      }
      if ($field['type'] == 'wooccmtextarea') {
        $field['type'] = 'textarea';
      }
      if ($field['type'] == 'checkbox_wccm') {
        $field['type'] = 'checkbox';
      }
      if ($field['type'] == 'time') {
        $field['type'] = 'timepicker';
      }
      if ($field['type'] == 'colorpicker') {
        $field['default'] = @$field['colorpickerd'];
      } else {
        $field['default'] = @$field['force_title2'];
      }

      // Roles
      if (!empty($field['role_options']) && !is_array($field['role_options'])) {
        if (strpos($field['role_options'], '||') !== false) {
          $field['role_options'] = explode('||', $field['role_options']);
        } else {
          $field['role_options'] = (array) $field['role_options'];
        }
      }

      if (!empty($field['role_options2']) && !is_array($field['role_options2'])) {
        if (strpos($field['role_options2'], '||') !== false) {
          $field['role_options2'] = explode('||', $field['role_options2']);
        } else {
          $field['role_options2'] = (array) $field['role_options2'];
        }
      }

      // Days
      if (!empty($field['days_disabler'])) {

        $field['days_disabler'] = array();

        for ($day_index = 0; $day_index <= 6; $day_index++) {

          if (!empty($field['days_disabler' . $day_index])) {
            $field['days_disabler'][strval($day_index)] = strval($day_index);
          }
        }
      }

      // Dates
      if (!empty($field['single_yy']) && !empty($field['single_mm']) && !empty($field['single_dd'])) {
        $field['single_min_date'] = $field['single_yy'] . '-' . $field['single_mm'] . '-' . $field['single_dd'];
      } else {
        $field['single_min_date'] = '';
      }
      if (!empty($field['single_max_yy']) && !empty($field['single_max_mm']) && !empty($field['single_max_dd'])) {
        $field['single_max_date'] = $field['single_max_yy'] . '-' . $field['single_max_mm'] . '-' . $field['single_max_dd'];
      } else {
        $field['single_max_date'] = '';
      }

      return $field;
    }

    protected static function old_panel_compatibility($field) {

      // Display
      foreach ($field as $i => $key) {
        if (is_array($field[$i]) && in_array('key', array('single_p', 'single_p_cat', 'single_px', 'single_px_cat'))) {
          $field[$i] = implode('||', $field[$i]);
        }
      }

      // Days
      if (is_array(@$field['days_disabler'])) {
        foreach ($field['days_disabler'] as $day_index => $day) {
          $field['days_disabler' . strval($day_index)] = 1;
        }
        $field['days_disabler'] = 1;
      }

      // Dates
      if (!empty($field['single_min_date'])) {

        $min = explode('-', $field['single_min_date']);

        $field['single_yy'] = $min[0];
        $field['single_mm'] = $min[1];
        $field['single_dd'] = $min[2];
      }

      if (!empty($field['single_max_date'])) {

        $max = explode('-', $field['single_max_date']);

        $field['single_max_yy'] = $max[0];
        $field['single_max_mm'] = $max[1];
        $field['single_max_dd'] = $max[2];
      }


      return $field;
    }

    function init() {
      
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        //self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields::instance();
}
