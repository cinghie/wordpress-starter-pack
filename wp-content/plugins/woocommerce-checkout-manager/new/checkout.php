<?php
if (!class_exists('WOOCCM_Checkout')) {

  class WOOCCM_Checkout {

    protected static $instance;

    function ajax_checkout_attachment_upload() {

      if (!empty($_REQUEST) && check_admin_referer('wooccm_checkout_attachment_upload', 'nonce')) {

        $upload_files = ( isset($_FILES['wooccm_checkout_attachment_upload']) ? $_FILES['wooccm_checkout_attachment_upload'] : false );

        if (empty($upload_files)) {
          wp_send_json_error(esc_html__('No uploads were recognised. Files were not uploaded.', 'woocommerce-checkout-manager'));
        }

        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        //require_once( ABSPATH . 'wp-admin/includes/image.php' );

        $attachment_ids = array();

        add_filter('upload_dir', function( $param ) {
          $param['path'] = sprintf('%s/wooccm_uploads', $param['basedir']);
          $param['url'] = sprintf('%s/wooccm_uploads', $param['baseurl']);
          return $param;
        }, 10);

        foreach ($upload_files['name'] as $key => $value) {
          if ($upload_files['name'][$key]) {
            $file = array(
                'name' => $upload_files['name'][$key],
                'type' => $upload_files['type'][$key],
                'tmp_name' => $upload_files['tmp_name'][$key],
                'error' => $upload_files['error'][$key],
                'size' => $upload_files['size'][$key]
            );

            $upload = wp_handle_upload($file, array(
                'test_form' => false,
                'action' => 'wooccm_checkout_attachment_upload')
            );

            if (!isset($upload['error'])) {
              $attachment_ids[] = wc_rest_set_uploaded_image_as_attachment($upload);
            }
          }
        }

        if (count($attachment_ids)) {
          wp_send_json_success($attachment_ids);
        }
      }
    }

    function ajax_checkout_attachment_update() {

      if (!empty($_REQUEST) && check_admin_referer('wooccm_checkout_attachment_upload', 'nonce')) {

        $array1 = explode(',', sanitize_text_field(isset($_POST['all_attachments_ids']) ? $_POST['all_attachments_ids'] : '' ));
        $array2 = explode(',', sanitize_text_field(isset($_POST['delete_attachments_ids']) ? $_POST['delete_attachments_ids'] : '' ));

        if (empty($array1) || empty($array2)) {
          wp_send_json_error(esc_html__('No attachment selected.', 'woocommerce-checkout-manager'));
        }

        $attachment_ids = array_diff($array1, $array2);

        if (!empty($attachment_ids)) {

          foreach ($attachment_ids as $key => $attachtoremove) {

            // Check the Attachment exists...
            if (get_post_status($attachtoremove) == false)
              continue;

            // Check the Attachment is associated with an Order
            $post_parent = get_post_field('post_parent', $attachtoremove);

            if (empty($post_parent)) {
              continue;
            } else {
              if (get_post_type($post_parent) <> 'shop_order')
                continue;
            }
            wp_delete_attachment($attachtoremove);
          }
        }

        wp_send_json_success('Deleted successfully.', 'woocommerce-checkout-manager');
      }
    }

    function checkout_billing_attachment_update_ids($order_id = 0) {      
      $this->checkout_attachment_update_ids($order_id, 'wccs_settings3', 'billing_buttons', 'billing_');
    }

    function checkout_shipping_attachment_update_ids($order_id = 0) {
      $this->checkout_attachment_update_ids($order_id, 'wccs_settings2', 'shipping_buttons', 'shipping_');
    }

    function checkout_additional_attachment_update_ids($order_id = 0) {
      $this->checkout_attachment_update_ids($order_id, 'wccs_settings', 'buttons');
    }

    function checkout_attachment_update_ids($order_id = 0, $name, $key, $prefix = '') {

      require_once( ABSPATH . 'wp-admin/includes/image.php' );

      if ($options = get_option($name)) {

        if (array_key_exists($key, $options)) {

          if ($custom_fields = $options[$key]) {

            foreach ($custom_fields as $id => $custom_field) {

              if ($custom_field['type'] == 'wooccmupload') {

                if ($prefix) {
                  $key = sprintf("_%s%s", $prefix, $custom_field['cow']);
                } else {
                  $key = $custom_field['cow'];
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
      }
    }

    function checkout_attachment_results() {
      ?>
      <div class="clear"></div>
      <div style="margin: 16px 0 0 0; display: none;" id="wooccm_checkout_attachment_results" class="woocommerce-message"></div>
      <?php
    }

    function init() {
      add_action('wp_ajax_wooccm_checkout_attachment_upload', array($this, 'ajax_checkout_attachment_upload'));
      add_action('wp_ajax_nopriv_wooccm_checkout_attachment_upload', array($this, 'ajax_checkout_attachment_upload'));
      add_action('wp_ajax_wooccm_checkout_attachment_update', array($this, 'ajax_checkout_attachment_update'));
      add_action('wp_ajax_nopriv_wooccm_checkout_attachment_update', array($this, 'ajax_checkout_attachment_update'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_billing_attachment_update_ids'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_shipping_attachment_update_ids'));
      add_action('woocommerce_checkout_update_order_meta', array($this, 'checkout_additional_attachment_update_ids'));
      add_action('woocommerce_review_order_after_submit', array($this, 'checkout_attachment_results'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Checkout::instance();
}
    