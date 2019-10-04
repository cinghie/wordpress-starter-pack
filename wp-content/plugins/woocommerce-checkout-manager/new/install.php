<?php

if (!class_exists('WOOCCM_Install')) {

  class WOOCCM_Install {

    protected static $instance;

    static function add_field_defaults($field, $key) {

      $defaults = array(
          'order' => '',
          'cow' => '',
          'type' => '',
          'default' => '',
          'label' => '',
          'placeholder' => '',
          'force_title2' => '',
          'position' => '',
          'class' => '',
          'extra_class' => '',
          'clear' => '',
          'clear_row' => '',
          'options' => '',
          'options_array' => '',
          //'user_role' => '',
          'role_options' => '',
          'role_options2' => '',
          'required' => '',
          'checkbox' => '',
          'wooccm_required' => '',
          'color' => '',
          'colorpickerd' => '',
          'colorpickertype' => '',
          'priority' => '',
          'fancy' => '',
          'conditional_tie' => ''
      );

      $field = wp_parse_args($field, $defaults);

      if (in_array('form-row-first', $field['class'])) {
        $field['position'] = 'form-row-first';
      } elseif (in_array('form-row-last', $field['class'])) {
        $field['position'] = 'form-row-last';
        $field['clear'] = true;
        $field['clear_fow'] = true;
      } else {
        $field['position'] = 'form-row-wide';
      }

      $field['cow'] = $key;
      $field['checkbox'] = $field['required'];
      $field['wooccm_required'] = $field['required'];

      $field['type'] = ($field['type'] == 'checkbox' ) ? 'checkbox_wccm' : $field['type'];
      $field['type'] = ($field['type'] == 'text' ) ? 'wooccmtext' : $field['type'];
      $field['type'] = ($field['type'] == 'select' ) ? 'wooccmselect' : $field['type'];
      $field['type'] = ($field['type'] == 'country' ) ? 'wooccmcountry' : $field['type'];
      $field['type'] = ($field['type'] == 'state' ) ? 'wooccmstate' : $field['type'];
      $field['type'] = ($field['type'] == 'date' ) ? 'datepicker' : $field['type'];

      return $field;
    }

    static function add_fields_defaults($fields) {

      $fields_defaults = array();

      $i = 0;
      foreach ($fields as $key => $field) {
        $fields_defaults[$i] = self::add_field_defaults($field, $key);
        $i++;
      }

      return $fields_defaults;
    }

    static function field_defaults() {

      add_filter('option_woocommerce_checkout_company_field', '__return_null');
      add_filter('option_woocommerce_checkout_address_2_field', '__return_null');

      // Billing fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_billing_fields', array('WOOCCM_Install', 'add_fields_defaults'));

      // Shipping fields
      // -----------------------------------------------------------------------

      add_filter('woocommerce_shipping_fields', array('WOOCCM_Install', 'add_fields_defaults'));
    }

    static function wccs_settings() {
      if (!get_option('wccs_settings')) {
        update_option('wccs_settings', array('checkness' => array(
                'position' => 'after_order_notes',
                'wooccm_notification_email' => get_option('admin_email'),
                'payment_method_d' => 'Payment Method',
                'time_stamp_title' => 'Order Time',
                'payment_method_t' => '1',
                'shipping_method_d' => 'Shipping Method',
                'shipping_method_t' => '1',
        )));
      }
    }

    static function wccs_settings2() {
      if (!get_option('wccs_settings2')) {
        update_option('wccs_settings2', array('shipping_buttons' => apply_filters('woocommerce_shipping_fields', WC()->countries->get_default_address_fields())));
      }
    }

    static function wccs_settings3() {
      if (!get_option('wccs_settings3')) {
        update_option('wccs_settings3', array('billing_buttons' => apply_filters('woocommerce_billing_fields', WC()->countries->get_default_address_fields())));
      }
    }

    static function do_activation() {
      self::field_defaults();
      self::wccs_settings();
      self::wccs_settings2();
      self::wccs_settings3();
    }

    function woocommerce() {
      self::field_defaults();
    }

    function init() {

      add_action('woocommerce_init', array($this, 'woocommerce'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        ///self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Install::instance();
}
