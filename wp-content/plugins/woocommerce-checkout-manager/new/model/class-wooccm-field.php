<?php

class WOOCCM_Field {

  const PREFIX = '';
  const OPTION_NAME = '';

  function __construct() {
    $this->prefix = static::PREFIX;
    $this->option_name = static::OPTION_NAME;
  }

  protected function order_fields($a, $b) {

    if (!isset($a['order']) || !isset($b['order']))
      return 0;

    if ($a['order'] == $b['order'])
      return 0;

    return ( $a['order'] < $b['order'] ) ? -1 : 1;
  }

  function duplicated_name($name, $fields) {

    if (!empty($fields)) {
      if (is_array($fields)) {
        foreach ($fields as $item) {
          if (isset($item['name']) && $item['name'] == $name) {
            return true;
          }
        }
      }
    }
  }

  public function get_name($field_id) {
    return WOOCCM_PREFIX . $field_id;
  }

  public function get_key($prefix = '', $name) {
    return sprintf("%s_%s", $prefix, $name);
  }

  public function get_conditional_types() {

    $fields = self::get_types();

    unset($fields['heading']);
    unset($fields['button']);

    return array_keys($fields);
  }

  public function get_multiple_types() {

    return array(
        'multicheckbox',
        'multiselect',
        'wooccmselect',
        'select',
        'radio'
    );
  }

  public function get_types() {

    return apply_filters('wooccm_fields_fields_types', array(
        'heading' => __('Heading', 'woocommerce-checkout-manager'),
        'text' => __('Text', 'woocommerce-checkout-manager'),
        'textarea' => __('Textarea', 'woocommerce-checkout-manager'),
        'password' => __('Password', 'woocommerce-checkout-manager'),
        'select' => __('Select', 'woocommerce-checkout-manager'),
        'radio' => __('Radio', 'woocommerce-checkout-manager'),
        'checkbox' => __('Checkbox', 'woocommerce-checkout-manager'),
        'country' => __('Country', 'woocommerce-checkout-manager'),
        'state' => __('State', 'woocommerce-checkout-manager'),
        'multiselect' => __('Multiselect', 'woocommerce-checkout-manager'),
        'multicheckbox' => __('Multicheckbox', 'woocommerce-checkout-manager'),
        'colorpicker' => __('Colorpicker', 'woocommerce-checkout-manager'),
        'file' => __('File', 'woocommerce-checkout-manager'),
            //'button' => __('Button', 'woocommerce-checkout-manager'),
            //'datepicker' => __('Datepicker', 'woocommerce-checkout-manager'),
            //'timepicker' => __('Timepicker', 'woocommerce-checkout-manager'),
    ));
  }

  function get_args() {

    return array(
        'id' => null,
        'key' => null,
        'name' => '',
        'type' => 'text',
        'disabled' => null,
        'order' => null,
        'priority' => null,
        'label' => null,
        'placeholder' => null,
        'default' => null,
        'position' => null,
        'clear' => null,
        'options' => null,
        'required' => null,
        // Display
        // -------------------------------------------------------------------
        'show_role' => null,
        'hide_role' => null,
        'more_product' => null,
        'show_product' => array(),
        'hide_product' => array(),
        'show_product_cat' => array(),
        'hide_product_cat' => array(),
        // Timing
        // -------------------------------------------------------------------
        'time_limit_start' => null,
        'time_limit_end' => null,
        'time_limit_interval' => null,
        'date_limit' => 'fixed',
        'date_limit_variable_min' => 1,
        'date_limit_variable_max' => 1,
        'date_limit_fixed_min' => date('Y-m-d'),
        'date_limit_fixed_max' => date('Y-m-d'),
        // Amount
        // -------------------------------------------------------------------
        'add_amount' => null,
        'add_amount_name' => null,
        'add_amount_total' => null,
        'add_amount_type' => null,
        'add_amount_tax' => null,
        'extra_class' => null,
        // Conditional
        // -------------------------------------------------------------------
        'conditional' => null,
        'conditional_parent_name' => null,
        'conditional_parent_value' => null,
        // Listing
        // -------------------------------------------------------------------
        'listable' => null,
        'sortable' => null,
        'filterable' => null,
    );
  }

}
