<?php
if (!class_exists('WOOCCM_Fields_Additional')) {

  class WOOCCM_Fields_Additional extends WOOCCM_Fields_Register {

    protected static $instance;

    function add_checkout_require_notice($fields) {

      if ($fields = WOOCCM()->field->additional->get_fields('old')) {

        foreach ($fields as $field_id => $field) {

          if (!empty($field['cow']) /* && empty($field['deny_checkout']) */) {

            //$key = sprintf("%s_%s", $prefix, $field['cow']);

            $field = $this->add_checkout_field_filter($fields, $field, 'additional');

            if (!empty($field['required']) && !empty($field['cow']) /* && empty($field['deny_checkout']) */ && empty($field['disabled'])) {

              if (empty($_POST[$field['cow']])) {
                $message = sprintf(__('%s is a required field.', 'woocommerce-checkout-manager'), '<strong>' . wooccm_wpml_string($field['label']) . '</strong>');
                wc_add_notice($message, 'error');
              }
            }
          }
        }
      }
    }

    function add_order_meta($order_id = 0) {

      $fields = WOOCCM()->field->additional->get_fields('old');

      if (count($fields)) {

        foreach ($fields as $id => $field) {

          $key = $name = $field['cow'];

          if (!empty($_POST[$key])) {

            $value = $_POST[$key];

            if ($field['type'] == 'wooccmtextarea') {
              update_post_meta($order_id, $name, wp_kses($value, false));
            } else if (is_array($value)) {
              update_post_meta($order_id, $name, maybe_serialize(array_map('sanitize_text_field', $value)));
            } else {
              update_post_meta($order_id, $name, sanitize_text_field($value));
            }
          }
        }
      }
    }

    function add_checkout_additional_fields($checkout) {
      ?>
      <div class="wooccm-clearfix"></div>
      <div class="wooccm-additional-fields">
        <?php
        if ($custom_fields = apply_filters('wooccm_additional_fields', WOOCCM()->field->additional->get_fields('old'))) {

          foreach ($custom_fields as $field_id => $custom_field) {

            if (!empty($custom_field['cow']) /* && empty($field['deny_checkout']) */ && empty($custom_field['disabled'])) {

              woocommerce_form_field($custom_field['cow'], $custom_field, $checkout->get_value($custom_field['cow']));
            }
          }
        }
        ?>
      </div>
      <?php
    }

    function position($position = 'after_order_notes') {

      $options = get_option('wccs_settings');

      if (!empty($options['checkness']['position'])) {
        return sanitize_text_field($options['checkness']['position']);
      }
    }

    function init() {
      add_action('woocommerce_checkout_process', array($this, 'add_checkout_require_notice'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'add_order_meta'));

      // Additional fields
      // -----------------------------------------------------------------------
      switch (get_option('wooccm_additional_position', 'after_order_notes')) {
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

        case 'before_order_notes':
          add_action('woocommerce_before_order_notes', array($this, 'add_checkout_additional_fields'));
          break;

        case 'after_order_notes':
          add_action('woocommerce_after_order_notes', array($this, 'add_checkout_additional_fields'));
          break;
      }
      // Compatibility
      // -----------------------------------------------------------------------

      add_filter('default_option_wooccm_additional_position', array($this, 'position'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Additional::instance();
}
