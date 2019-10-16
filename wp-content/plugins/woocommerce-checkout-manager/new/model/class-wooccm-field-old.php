<?php

class WOOCCM_Field_Compatibility extends WOOCCM_Field {

  protected $fields = null;
  protected $prefix = '';
  protected $option_name = '';
  protected $defaults = array();
  private $old_to_old_types = array(
      'heading' => 'heading',
      'text' => 'wooccmtext',
      'textarea' => 'wooccmtextarea',
      'password' => 'wooccmpassword',
      'select' => 'wooccmselect',
      'radio' => 'wooccmradio',
      'checkbox' => 'checkbox_wccm',
      //'button' => __('Button', 'woocommerce-checkout-manager'),
      'country' => 'wooccmcountry',
      'state' => 'wooccmstate',
      'multiselect' => 'multiselect',
      'multicheckbox' => 'multicheckbox',
      'datepicker' => 'datepicker',
      'timepicker' => 'time',
      'colorpicker' => 'colorpicker',
      'file' => 'wooccmupload',
  );
  private $old_to_old_args = array(
      'disabled' => null,
      'order' => null,
      'priority' => null,
      'name' => 'cow',
      'type' => null,
      'label' => null,
      'placeholder' => null,
      'default' => 'force_title2',
      'position' => null,
      'clear' => 'clear_row',
      'options' => 'option_array',
      'required' => 'checkbox',
      // Display
      // -------------------------------------------------------------------
      'show_role' => 'role_option',
      'hide_role' => 'role_option2',
      'more_product' => 'more_content',
      'show_product' => 'single_px',
      'hide_product' => 'single_p',
      'show_product_cat' => 'single_px_cat',
      'hide_product_cat' => 'single_p_cat',
      // Timing
      // -------------------------------------------------------------------
      'time_limit_start' => 'start_hour',
      'time_limit_end' => 'end_hour',
      'time_limit_interval' => 'interval_min',
      'manual_min' => null,
      'date_limit' => 'date_limit',
      'date_limit_variable_min' => 'min_before',
      'date_limit_variable_max' => 'max_after',
      'date_limit_fixed_min' => null,
      'date_limit_fixed_max' => null,
      'date_limit_days' => null,
      'single_dd' => null,
      'single_mm' => null,
      'single_yy' => null,
      'single_max_dd' => null,
      'single_max_mm' => null,
      'single_max_yy' => null,
      // Amount
      // -------------------------------------------------------------------
      'add_amount' => null,
      'add_amount_name' => 'fee_name',
      'add_amount_total' => 'add_amount_field',
      'add_amount_type' => null,
      'add_amount_tax' => 'tax_remove',
      'extra_class' => null,
      // Conditional
      // -------------------------------------------------------------------
      'conditional' => 'conditional_parent_use',
      'conditional_parent_name' => 'conditional_tie',
      'conditional_parent_value' => 'chosen_valt',
      // Color
      // -------------------------------------------------------------------
      'pickertype' => 'colorpickertype',
      // State
      // -------------------------------------------------------------------
      'country' => null,
      // Upload
      // -------------------------------------------------------------------
      'file_limit' => null,
      'file_types' => null,
      // Listing
      // -------------------------------------------------------------------
      'listable' => null,
      'sortable' => null,
      'filterable' => null,
  );
  private $old_args = array(
      'disabled',
      'order',
      'priority',
      'cow',
      'type',
      'label',
      'placeholder',
      'force_title2',
      'position',
      'clear_row',
      'option_array',
      'checkbox',
      'role_option',
      'role_option2',
      'more_content',
      'single_p',
      'single_px',
      'single_p_cat',
      'single_px_cat',
      'start_hour',
      'end_hour',
      'interval_min',
      'manual_min',
      'min_before',
      'max_after',
      'single_dd',
      'single_mm',
      'single_yy',
      'single_max_dd',
      'single_max_mm',
      'single_max_yy',
      'days_disabler',
      'days_disabler0',
      'days_disabler1',
      'days_disabler2',
      'days_disabler3',
      'days_disabler4',
      'days_disabler5',
      'days_disabler6',
      'add_amount',
      'fee_name',
      'add_amount_field',
      'tax_remove',
      'conditional_parent_use',
      'conditional_tie',
      'chosen_valt',
      'extra_class',
      'colorpickertype',
      'colorpickerd',
      'role_options',
      'role_options2',
      'changenamep',
      'changename',
      // New
      // -----------------------------------------------------------------------
      'country',
      'file_limit',
      'file_types',
      'listable',
      'sortable',
      'filterable',
  );

  function replace_keys($array = array(), $replace = array()) {

    foreach ($array as $key => $value) {

      if (array_key_exists($key, $replace)) {

        $array[$replace[$key]] = $value;

        unset($array[$key]);
      }
    }

    return $array;
  }

  function replace_value($value = '', $replace = array()) {
    if (array_key_exists($value, $replace)) {
      return $replace[$value];
    }

    return $value;
  }

  function string_to_array($value) {

    if (!empty($value) && !is_array($value)) {
      if (strpos($value, '||') !== false) {
        $value = explode('||', $value);
      } elseif (strpos($value, ',') !== false) {
        $value = explode(',', $value);
      } else {
        $value = (array) $value;
      }
    }

    return $value;
  }

  function array_to_string($value) {

    if (is_array($value)) {
      if (count($value)) {
        $value = implode('||', $value);
      } else {

        //error_log(json_encode($value));

        $value = @$value[0];
      }
    }

    return $value;
  }

  function get_new_args($field = array()) {

    $replace = array_flip(array_filter($this->old_to_old_args));

    $field = $this->replace_keys($field, $replace);

    $field = wp_parse_args($field, $this->get_args());

    return $field;
  }

  function get_old_args($field = array()) {

    $replace = array_filter($this->old_to_old_args);

    $field = $this->replace_keys($field, $replace);

    return $field;
  }

  function get_new_type($type = '') {

    $replace = array_flip(array_filter($this->old_to_old_types));

    $type = $this->replace_value($type, $replace);

    return $type;
  }

  function get_old_type($type = '') {

    if (!$type) {
      return 'wooccmtext';
    }

    $replace = array_filter($this->old_to_old_types);

    if ($old = $this->replace_value($type, $replace)) {
      return $old;
    }

    return $type;
  }

  function register_wpml_string($value) {

    if (!empty($value) && function_exists('icl_register_string')) {

      if (is_array($value)) {

        foreach ($value as $key => $name) {
          icl_register_string(WOOCCM_PLUGIN_NAME, $name, $name);
        }

        return $value;
      }

      if (is_string($value)) {
        icl_register_string(WOOCCM_PLUGIN_NAME, $value, $value);
        return $value;
      }
    }

    return $value;
  }

  function get_wpml_string($value) {

    if (!empty($value) && function_exists('icl_t')) {

      if (is_array($value)) {

        foreach ($value as $key => $name) {
          $value[$key] = icl_t(WOOCCM_PLUGIN_NAME, $name, $name);
        }
      }

      if (is_string($value)) {
        $value = icl_t(WOOCCM_PLUGIN_NAME, $value, $value);
      }
    }
    
    return $value;
  }

  function new_panel_compatibility($field_id, $field = array(), $fields = array()) {

    $field = $this->get_new_args($field);

    $field = wp_parse_args($field, $this->get_args());

    $field['id'] = $field_id;

    if (empty($field['name'])) {

      $field['name'] = $this->get_name($field_id);

      if ($this->duplicated_name($field['name'], $fields)) {
        $field['name'] .= 'b';
      }
    }

    if (empty($field['position']) && isset($field['class'])) {
      if ($position = $this->array_to_string(array_intersect((array) $field['class'], array('form-row-wide', 'form-row-first', 'form-row-last')))) {
        $field['position'] = $position;
      }
    }

    if (empty($field['order'])) {
      $field['order'] = $field_id + 1;
    }

    if (empty($field['key'])) {
      $field['key'] = $this->get_key($this->prefix, $field['name']);
    }

    if ($field['type'] == 'colorpicker' && !empty($field['colorpickerd'])) {
      $field['default'] = $field['colorpickerd'];
    }

    $field['type'] = $this->get_new_type($field['type']);

    $field['show_role'] = $this->string_to_array($field['show_role']);
    $field['hide_role'] = $this->string_to_array($field['hide_role']);
    //$field['options'] = $this->string_to_array($field['options']);
    $field['show_product'] = $this->string_to_array($field['show_product']);
    $field['hide_product'] = $this->string_to_array($field['hide_product']);
    $field['show_product_cat'] = $this->string_to_array($field['show_product_cat']);
    $field['hide_product_cat'] = $this->string_to_array($field['hide_product_cat']);
    $field['add_amount_tax'] = !$field['add_amount_tax'];

    // Days
    if (!empty($field['days_disabler'])) {

      $field['date_limit_days'] = array();

      for ($day_index = 0; $day_index <= 6; $day_index++) {

        if (!empty($field['days_disabler' . $day_index])) {
          $field['date_limit_days'][strval($day_index)] = strval($day_index);
          unset($field['days_disabler' . $day_index]);
        }
      }
    }

    // Dates
    if (!empty($field['single_yy']) && !empty($field['single_mm']) && !empty($field['single_dd'])) {
      $field['date_limit_fixed_min'] = $field['single_yy'] . '-' . $field['single_mm'] . '-' . $field['single_dd'];
      unset($field['single_yy']);
      unset($field['single_mm']);
      unset($field['single_dd']);
    } else {
      $field['date_limit_fixed_min'] = '';
    }
    if (!empty($field['single_max_yy']) && !empty($field['single_max_mm']) && !empty($field['single_max_dd'])) {
      $field['date_limit_fixed_max'] = $field['single_max_yy'] . '-' . $field['single_max_mm'] . '-' . $field['single_max_dd'];
      unset($field['single_max_yy']);
      unset($field['single_max_mm']);
      unset($field['single_max_dd']);
    } else {
      $field['date_limit_fixed_max'] = '';
    }

    //return $field;
    return $this->sanitize_field_data(array_intersect_key($field, array_flip(array_keys($this->get_args()))));
  }

  function old_panel_compatibility($field_id, $field = array()) {

    $field = $this->get_old_args($field);

    $field = wp_parse_args($field, array_fill_keys($this->old_args, null));

    if (!is_numeric($field['order'])) {
      $field['order'] = $field_id + 1;
    }

    $field['type'] = $this->get_old_type($field['type']);

    if (empty($field['position']) && isset($field['class'])) {
      if ($position = $this->array_to_string(array_intersect((array) $field['class'], array('form-row-wide', 'form-row-first', 'form-row-last')))) {
        $field['position'] = $position;
      }
    }

    $field['role_option'] = $this->array_to_string($field['role_option']);
    $field['role_option2'] = $this->array_to_string($field['role_option2']);
    //$field['option_array'] = $this->array_to_string($field['option_array']);
    $field['single_p'] = $this->array_to_string($field['single_p']);
    $field['single_px'] = $this->array_to_string($field['single_px']);
    $field['single_p_cat'] = $this->array_to_string($field['single_p_cat']);
    $field['single_px_cat'] = $this->array_to_string($field['single_px_cat']);
    $field['tax_remove'] = !$field['tax_remove'];

    // Days
    if (is_array($field['days_disabler'])) {
      foreach ($field['days_disabler'] as $day_index => $day) {
        $field['days_disabler' . strval($day_index)] = 1;
      }
      $field['days_disabler'] = 1;
      unset($field['date_limit_days']);
    }

    // Dates
    if (!empty($field['date_limit_fixed_min'])) {

      $min = explode('-', $field['date_limit_fixed_min']);

      $field['single_yy'] = $min[0];
      $field['single_mm'] = $min[1];
      $field['single_dd'] = $min[2];
    }

    if (!empty($field['date_limit_fixed_max'])) {

      $max = explode('-', $field['date_limit_fixed_max']);

      $field['single_max_yy'] = $max[0];
      $field['single_max_mm'] = $max[1];
      $field['single_max_dd'] = $max[2];
    }

    return array_intersect_key($field, array_flip($this->old_args));
  }

  // Get
  // ---------------------------------------------------------------------------

  public function get_fields($old = false) {

    if (!is_null($this->fields)) {
      return $this->fields;
    }

    if ($old) {
      $this->fields = $this->get_fields_old();
    } else {
      $this->fields = $this->get_fields_new();
    }
    // Resort the fields by order
    uasort($this->fields, array(__CLASS__, 'order_fields'));

    return $this->fields;
  }

  protected function get_fields_old() {

    $defaults = $this->get_default_fields();

    if ($fields = $this->get_option($defaults)) {

      foreach ($fields as $field_id => $field) {

        $fields[$field_id] = $this->old_panel_compatibility($field_id, $field);
      }
    }

    return $fields;
  }

  protected function get_fields_new() {

    $defaults = $this->get_default_fields();

    if ($fields = $this->get_option($defaults)) {

      foreach ($fields as $field_id => $field) {

        //error_log(json_encode($fields[$field_id]));

        $fields[$field_id] = $this->new_panel_compatibility($field_id, $field, $fields);

        //error_log(json_encode($fields[$field_id]));
      }
    }

    return $fields;
  }

  public function get_field($field_id) {

    if ($fields = $this->get_fields()) {

      if (array_key_exists($field_id, $fields)) {

        $field = $fields[$field_id];

        return $this->new_panel_compatibility($field_id, $field, $fields);
      }
    }
  }

  // Save
  // ---------------------------------------------------------------------------

  public function update_fields($fields) {

    if (is_array($fields)) {

      // save in old format
      foreach ($fields as $field_id => $field) {

        if (!array_key_exists('name', $field)) {
          return false;
        }

        //error_log(json_encode($fields[$field_id]));

        $fields[$field_id] = $this->old_panel_compatibility($field_id, $field);

        //error_log(json_encode($fields[$field_id]));
      }

      if ($this->update_option($fields)) {
        return $fields;
      }
    }

    return false;
  }

  public function update_field($field_id, $field_data) {

    $fields = $this->get_fields_new();

    if (array_key_exists($field_id, $fields)) {

      //error_log(json_encode($field_data));

      $field_data = $this->sanitize_field_data($field_data);

      /// error_log(json_encode($field_data));

      $fields[$field_id] = array_replace($fields[$field_id], $field_data);

      //error_log(json_encode($fields[$field_id]));

      if ($this->update_fields($fields)) {
        return $fields[$field_id];
      }
    }

    return false;
  }

  public function add_field($field_data) {

    $fields = $this->get_fields_new();

    $field_id = $this->get_id($fields);

    $field_data = $this->sanitize_field_data($field_data);

    $field_data = $this->new_panel_compatibility($field_id, $field_data, $fields);

    $fields[] = $field_data;

    if ($this->update_fields($fields)) {
      return $field_data;
    }

    return false;
  }

  public function delete_field($field_id) {

    $fields = $this->get_fields_new();

    unset($fields[$field_id]);

    if ($this->update_fields($fields)) {
      return true;
    }

    return false;
  }

  // Core
  // -------------------------------------------------------------------------

  protected function get_option($defaults = array()) {

    error_log('get_option');

    if ($fields = get_option($this->option_name, $defaults)) {

      // Compatibility with 4.x
      // ---------------------------------------------------------------------
      if (array_key_exists("{$this->prefix}_buttons", $fields)) {
        $fields = $fields["{$this->prefix}_buttons"];
      }

      // Additional compatibility with 4.x
      // ---------------------------------------------------------------------
      if ('wccs_settings' == $this->option_name) {
        $fields = (array) @$fields['buttons'];
      }
    }

    return $fields;
  }

  protected function update_option($fields) {

    $options = get_option($this->option_name, array());

    // Additional compatibility with 4.x
    // ---------------------------------------------------------------------
    if ($this->option_name == 'wccs_settings') {
      $options['buttons'] = $fields;
    } else {
      $options[$this->prefix . '_buttons'] = $fields;
    }

    update_option($this->option_name, $options);

    return true;
  }

}
