<?php

class WOOCCM_Field {

  protected $fields = null;
  protected $prefix = '';
  protected $option_name = '';
  protected $defaults = array();

  protected function order_fields($a, $b) {

    if (!isset($a['order']) || !isset($b['order']))
      return 0;

    if ($a['order'] == $b['order'])
      return 0;

    return ( $a['order'] < $b['order'] ) ? -1 : 1;
  }

  protected function duplicated_name($name, $fields) {

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

  public function get_id($fields) {
    return absint(key(array_slice($fields, -1, 1, true))) + 1;
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

  public function get_template_types() {

    return array(
        'heading',
        'button',
        'message',
        'file',
        'country',
        'state'
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
        'key' => '',
        'name' => '',
        'type' => 'text',
        'disabled' => false,
        'order' => null,
        'priority' => null,
        'label' => '',
        'placeholder' => '',
        'default' => '',
        'position' => 'form-row-wide',
        'clear' => false,
        'options' => '',
        'required' => false,
        'class' => array(),
        // Display
        // -------------------------------------------------------------------
        'show_role' => array(),
        'hide_role' => array(),
        'more_product' => false,
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
        'add_amount' => false,
        'add_amount_name' => '',
        'add_amount_total' => null,
        'add_amount_type' => '',
        'add_amount_tax' => false,
        'extra_class' => '',
        // Conditional
        // -------------------------------------------------------------------
        'conditional' => false,
        'conditional_parent_name' => '',
        'conditional_parent_value' => '',
        // State
        // -------------------------------------------------------------------
        'country' => '',
        // Upload
        // -------------------------------------------------------------------
        'file_limit' => 1,
        'file_types' => array(),
        // Listing
        // -------------------------------------------------------------------
        'listable' => false,
        'sortable' => false,
        'filterable' => false,
    );
  }

  public function sanitize_field_data($field_data) {

    $args = $this->get_args();

    foreach ($field_data as $key => $value) {

      if (array_key_exists($key, $args)) {

        $type = $args[$key];

        if (is_null($type) && !is_numeric($value)) {
          $field_data[$key] = (int) $value;
        } elseif (is_bool($type) && !is_bool($value)) {
          $field_data[$key] = ($value === 'true' || $value === '1' || $value === 1);
        } elseif (is_string($type) && !is_string($value)) {
          $field_data[$key] = strval($value);
        } elseif (is_array($type) && !is_array($value)) {
          $field_data[$key] = (array) $type;
        }
      } else {
        unset($field_data[$key]);
      }
    }

    return $field_data;
  }

  public function get_default_fields() {

    $fields = array();

    if ($this->prefix) {

      $prefix = sprintf('%s_', $this->prefix);

      $filters = WOOCCM_Fields_Register::instance();

      //fix nesting level
      remove_filter('woocommerce_' . $prefix . 'fields', array($filters, 'add_checkout_' . $prefix . 'fields'));

      foreach (WC()->countries->get_address_fields('', $prefix) as $key => $field) {

        $field['name'] = str_replace($prefix, '', $key);

        $fields[] = $field;
      }
    }

    //error_log(json_encode($fields));

    return $fields;
  }

  public function get_defaults() {
    return $this->defaults;
  }

  public function delete_fields() {

    delete_option($this->option_name);

    return false;
  }

}
