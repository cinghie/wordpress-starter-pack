<?php

if (!class_exists('WOOCCM_Order')) {

  class WOOCCM_Order {

    protected static $instance;

    function enqueue_scripts() {

      if (is_account_page()) {

        WOOCCM()->register_scripts();

        wp_enqueue_style('wooccm');
        wp_enqueue_style('dashicons');
        wp_enqueue_script('wooccm-order-upload');
        //wp_enqueue_style('wooccm-button-style', plugins_url('assets/old/edit-order-uploads-button_style.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION, 'all');
      }
    }

    function add_order_uploads($order_id) {

      if ($order = wc_get_order($order_id)) {

        $options = get_option('wccs_settings');

        if (empty($options['checkness']['upload_os']) || ( $order->get_status() == "wc-{$options['checkness']['upload_os']}" )) {


          $attachments = get_posts(array(
              'fields' => 'ids',
              'post_type' => 'attachment',
              'numberposts' => -1,
              'post_status' => null,
              'post_parent' => $order->get_id())
          );

          wc_get_template('templates/order/order-uploads.php', array('order' => $order, 'attachments' => $attachments), '', WOOCCM_PLUGIN_DIR);
        }
      }
    }

    function init() {

      add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

      if ($options = get_option('wccs_settings')) {
        if (!empty($options['checkness']['enable_file_upload'])) {
          add_action('woocommerce_view_order', array($this, 'add_order_uploads'));
        }
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

  WOOCCM_Order::instance();
}
