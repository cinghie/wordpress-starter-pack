<?php

if (!class_exists('WOOCCM_Order_Admin')) {

  class WOOCCM_Order_Admin {

    protected static $instance;

    function enqueue_scripts() {

      if ($screen = get_current_screen()) {
        
        if (in_array($screen->id, array(/* 'product', 'edit-product', */'shop_order', 'edit-shop_order'))) {

          WOOCCM()->register_scripts();

          // only for backend maybe orders
          wp_enqueue_media();
          wp_enqueue_script('wooccm-order-upload');
        }
      }
    }

    function order_uploads_metabox_content($post) {

      if ($order = wc_get_order($post->ID)) {

        $attachments = get_posts(array(
            'fields' => 'ids',
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $order->get_id()
        ));
        ?>

        <?php wp_enqueue_style('wccm_upload_file_style', plugins_url('assets/old/edit-order-uploads-file_editing_table.css', WOOCCM_PLUGIN_FILE)); ?>

        <?php include WOOCCM_PLUGIN_DIR . 'new/view/backend/meta-boxes/html-order-uploads.php'; ?>

        <?php

      }
    }

    function order_uploads_metabox() {
      add_meta_box('woocommerce-order-files', esc_html__('Order Uploaded Files', 'woocommerce-checkout-manager'), array($this, 'order_uploads_metabox_content'), 'shop_order', 'normal', 'default');
    }

    function init() {
      add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
      add_action('add_meta_boxes', array($this, 'order_uploads_metabox'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Order_Admin::instance();
}
