<?php

if (!class_exists('WOOCCM_Order_Controller')) {

  class WOOCCM_Order_Controller extends WOOCCM_Upload {

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

      //include_once( WOOCCM_PLUGIN_DIR . 'new/view/backend/order.php' );
      //include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/order.php' );

      if (!empty($_REQUEST) && check_admin_referer('wooccm_upload', 'nonce')) {

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
            WOOCCM_Order_Admin::instance()->order_uploads_metabox_content($post);
          } else {
            WOOCCM_Order::instance()->add_order_uploads($post->ID);
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

    function includes() {
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/backend/order.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/order.php' );
    }

    function init() {
      add_action('wp_ajax_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));
      add_action('wp_ajax_nopriv_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));
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

  WOOCCM_Order_Controller::instance();
}