<?php
if (!class_exists('WOOCCM_Fields_Conditional')) {

  class WOOCCM_Fields_Conditional {

    protected static $instance;
    protected static $i = 0;

    function add_field_attributes($field, $key) {
      if (!empty($field['conditional_parent_use']) && !empty($field['conditional_tie']) && !empty($field['chosen_valt']) && ($field['conditional_tie'] != $field['cow'])) {
        $field['class'][] = 'wooccm-conditional-child';
        $field['custom_attributes']['data-conditional-parent'] = $field['conditional_tie'];
        $field['custom_attributes']['data-conditional-parent-value'] = $field['chosen_valt'];
      }
      return $field;
    }    

    function init() {
      // Add field attributes
      add_filter('wooccm_checkout_field_filter', array($this, 'add_field_attributes'), 10, 2);
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Conditional::instance();
}
