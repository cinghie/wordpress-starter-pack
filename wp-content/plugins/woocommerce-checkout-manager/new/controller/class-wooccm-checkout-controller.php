<?php

if (!class_exists('WOOCCM_Checkout_Controller')) {

  class WOOCCM_Checkout_Controller extends WOOCCM_Upload {

    protected static $instance;

    function ajax_checkout_attachment_upload() {

      if (check_admin_referer('wooccm_upload', 'nonce') && isset($_FILES['wooccm_checkout_attachment_upload'])) {

        $files = $_FILES['wooccm_checkout_attachment_upload'];

        if (empty($files)) {
          wc_add_notice(esc_html__('No uploads were recognised. Files were not uploaded.', 'woocommerce-checkout-manager'), 'error');
          wp_send_json_error();
        }

        if (count($attachment_ids = $this->process_uploads($files, 'wooccm_checkout_attachment_upload'))) {
          wp_send_json_success($attachment_ids);
        }
        wc_add_notice(esc_html__('Unknow error.', 'woocommerce-checkout-manager'), 'error');
        wp_send_json_error();
      }
    }

    function checkout_billing_attachment_update_ids($order_id = 0) {

      $fields = WOOCCM()->field->billing->get_fields('old');

      $this->checkout_attachment_update_ids($order_id, 'billing_', $fields);
    }

    function checkout_shipping_attachment_update_ids($order_id = 0) {

      $fields = WOOCCM()->field->shipping->get_fields('old');

      $this->checkout_attachment_update_ids($order_id, 'shipping_', $fields);
    }

    function checkout_additional_attachment_update_ids($order_id = 0) {

      $fields = WOOCCM()->field->additional->get_fields('old');

      $this->checkout_attachment_update_ids($order_id, '', $fields);
    }

    function checkout_attachment_update_ids($order_id = 0, $prefix = '', $fields = array()) {

      require_once( ABSPATH . 'wp-admin/includes/image.php' );

      if (count($fields)) {

        foreach ($fields as $id => $field) {

          if ($field['type'] == 'wooccmupload') {

            if ($prefix) {
              $key = sprintf("_%s%s", $prefix, $field['cow']);
            } else {
              $key = $field['cow'];
            }

            if ($attachments = get_post_meta($order_id, $key, true)) {

              if ($attachments = (array) explode(',', $attachments)) {

                foreach ($attachments as $image_id) {

                  wp_update_post(array('ID' => $image_id, 'post_parent' => $order_id));

                  wp_update_attachment_metadata($image_id, wp_generate_attachment_metadata($image_id, get_attached_file($image_id)));
                }
              }
            }
          }
        }
      }
    }

    function includes() {
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/checkout.php' );
    }

    function init() {
      add_action('wp_ajax_wooccm_checkout_attachment_upload', array($this, 'ajax_checkout_attachment_upload'));
      add_action('wp_ajax_nopriv_wooccm_checkout_attachment_upload', array($this, 'ajax_checkout_attachment_upload'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_billing_attachment_update_ids'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_shipping_attachment_update_ids'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_additional_attachment_update_ids'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->includes();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Checkout_Controller::instance();
}
    