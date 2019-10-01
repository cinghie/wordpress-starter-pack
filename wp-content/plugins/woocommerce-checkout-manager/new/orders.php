<?php

if (!class_exists('WOOCCM_Orders')) {

  class WOOCCM_Orders extends WOOCCM_Checkout {

    protected static $instance;

    static function is_frontend_ajax() {
      $script_filename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';

      //Try to figure out if frontend AJAX request... If we are DOING_AJAX; let's look closer
      if ((defined('DOING_AJAX') && DOING_AJAX)) {
        //From wp-includes/functions.php, wp_get_referer() function.
        //Required to fix: https://core.trac.wordpress.org/ticket/25294
        $ref = '';
        if (!empty($_REQUEST['_wp_http_referer']))
          $ref = wp_unslash($_REQUEST['_wp_http_referer']);
        elseif (!empty($_SERVER['HTTP_REFERER']))
          $ref = wp_unslash($_SERVER['HTTP_REFERER']);

        //If referer does not contain admin URL and we are using the admin-ajax.php endpoint, this is likely a frontend AJAX request
        if (((strpos($ref, admin_url()) === false) && (basename($script_filename) === 'admin-ajax.php')))
          return true;
      }

      //If no checks triggered, we end up here - not an AJAX request.
      return false;
    }

    function ajax_order_attachment_upload() {

      if (!empty($_REQUEST) && check_admin_referer('wooccm_admin', 'nonce')) {

        $files = ( isset($_FILES['wooccm_order_attachment_upload']) ? $_FILES['wooccm_order_attachment_upload'] : false );

        if (empty($files)) {
          //wc_add_notice(esc_html__('No uploads were recognised. Files were not uploaded.', 'woocommerce-checkout-manager'), 'error');
          wp_send_json_error(esc_html__('No uploads were recognised. Files were not uploaded.', 'woocommerce-checkout-manager'), 'error');
        }

        $order_id = ( isset($_REQUEST['order_id']) ? absint($_REQUEST['order_id']) : false );

        if (empty($order_id)) {
          wp_send_json_error(esc_html__('Empty order id.', 'woocommerce-checkout-manager'));
        }

        if (!$post = get_post($order_id)) {
          wp_send_json_error(esc_html__('Invalid order id.', 'woocommerce-checkout-manager'));
        }

        if (count($attachment_ids = $this->process_uploads($files, 'wooccm_order_attachment_upload', $order_id))) {

          ob_start();

          if (!self::is_frontend_ajax()) {
            $this->order_uploads_metabox_content($post);
          } else {
            $this->order_uploads($post->ID);
          }

          wp_send_json_success(ob_get_clean());
          /* send email
            $email_recipients = $options['checkness']['wooccm_notification_email'];
            if (empty($email_recipients))
            $email_recipients = get_option('admin_email');
            $email_heading = __('Files Uploaded by Customer', 'woocommerce-checkout-manager');
            $subject = sprintf(__('WooCommerce Checkout Manager - %s [%s]', 'woocommerce-checkout-manager'), $email_heading, $order->billing_first_name . ' ' . $order->billing_last_name);

            $mailer = WC()->mailer();

            // Buffer
            ob_start();
            ?>
            <p>This is an automatic message from WooCommerce Checkout Manager, reporting that files have been uploaded by <?php echo $order->billing_first_name; ?> <?php echo $order->billing_last_name; ?>.</p>
            <h3>Customer Details</h3>
            <ul>
            <li>Name: <?php echo $order->billing_first_name; ?> <?php $order->billing_last_name; ?></li>
            <li>E-mail: <?php echo $order->billing_email; ?></li>
            <li>Order Number: <?php echo $order_id; ?></li>
            </ul>
            <p>You can view the files and order details via back-end by following this <a href="<?php echo admin_url('/post.php?post=' . $order_id . '&action=edit'); ?>" target="_blank">link</a>.</p>
            <?php
            // Get contents
            $message = ob_get_clean();

            $message = $mailer->wrap_message($email_heading, $message);

            // add_filter( 'wp_mail_content_type', 'wooccm_set_html_content_type' );
            // wc_mail( $email_recipients, $subject, $message );
            $mailer->send($email_recipients, strip_tags($subject), $message);
            // remove_filter( 'wp_mail_content_type', 'wooccm_set_html_content_type' ); */
        }
        wp_send_json_error(esc_html__('Unknow error.', 'woocommerce-checkout-manager'));
      }
    }

    function ajax_order_attachment_update() {

      if (!empty($_REQUEST) && check_admin_referer('wooccm_admin', 'nonce')) {

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

        wp_send_json_success(esc_html__('Deleted successfully.', 'woocommerce-checkout-manager'));
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

        <?php include WOOCCM_PLUGIN_DIR . 'new/admin/meta-boxes/html-order-uploads.php'; ?>

        <?php

      }
    }

    function order_uploads($order_id) {
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

    function order_uploads_metabox() {
      add_meta_box('woocommerce-order-files', esc_html__('Order Uploaded Files', 'woocommerce-checkout-manager'), array($this, 'order_uploads_metabox_content'), 'shop_order', 'normal', 'default');
    }

    function init() {

      add_action('wp_ajax_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));
      add_action('wp_ajax_nopriv_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));
      add_action('wp_ajax_wooccm_order_attachment_update', array($this, 'ajax_order_attachment_update'));
      add_action('wp_ajax_nopriv_wooccm_order_attachment_update', array($this, 'ajax_order_attachment_update'));

      if ($options = get_option('wccs_settings')) {
        if (!empty($options['checkness']['enable_file_upload'])) {
          add_action('woocommerce_view_order', array($this, 'order_uploads'));
        }
      }

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

  WOOCCM_Orders::instance();
}
