<?php

if (!class_exists('WOOCCM_Order_Controller')) {

  class WOOCCM_Order_Controller extends WOOCCM_Upload {

    protected static $instance;

    public function enqueue_scripts() {

      WOOCCM()->register_scripts();

      wp_register_script('wooccm-order-upload', plugins_url('assets/js/wooccm-order-upload.js', WOOCCM_PLUGIN_FILE), array(), WOOCCM_PLUGIN_VERSION, true);

      wp_localize_script('wooccm-order-upload', 'wooccm_upload', array(
          'ajax_url' => admin_url('admin-ajax.php?metabox=' . is_admin()),
          'nonce' => wp_create_nonce('wooccm_upload'),
          'message' => array(
              'uploading' => esc_html__('Uploading, please wait...', 'woocommerce-checkout-manager'),
              'saving' => esc_html__('Saving, please wait...', 'woocommerce-checkout-manager'),
              'success' => esc_html__('Files uploaded successfully.', 'woocommerce-checkout-manager'),
              'deleted' => esc_html__('Deleted successfully.', 'woocommerce-checkout-manager'),
          ),
          'icons' => array(
              'interactive' => site_url('wp-includes/images/media/interactive.png'),
              'spreadsheet' => site_url('wp-includes/images/media/spreadsheet.png'),
              'archive' => site_url('wp-includes/images/media/archive.png'),
              'audio' => site_url('wp-includes/images/media/audio.png'),
              'text' => site_url('wp-includes/images/media/text.png'),
              'video' => site_url('wp-includes/images/media/video.png')
          )
      ));

      if (is_admin() && $screen = get_current_screen()) {
        if (in_array($screen->id, array(/* 'product', 'edit-product', */'shop_order', 'edit-shop_order'))) {
          wp_enqueue_script('wooccm-order-upload');
        }
      }

      if (is_account_page()) {
        wp_enqueue_style('wooccm');
        wp_enqueue_style('dashicons');
        wp_enqueue_script('wooccm-order-upload');
      }
    }

    public function ajax_order_attachment_upload() {

      if (!empty($_REQUEST) && check_admin_referer('wooccm_upload', 'nonce')) {

        $files = ( isset($_FILES['wooccm_order_attachment_upload']) ? $_FILES['wooccm_order_attachment_upload'] : false );

        if (empty($files)) {
          //wc_order_notice(esc_html__('No uploads were recognised. Files were not uploaded.', 'woocommerce-checkout-manager'), 'error');
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

          if (!empty($_REQUEST['metabox'])) {
            $this->add_metabox_content($post);
          } else {
            $this->add_upload_files($post->ID);
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

    public function add_upload_files($order_id) {

      if (get_option('wooccm_order_upload_files', 'no') === 'yes') {

        if ($order = wc_get_order($order_id)) {

          if (in_array("wc-{$order->get_status()}", array_values(get_option('wooccm_order_upload_files_order_status', array())))) {

            $attachments = get_posts(array(
                'fields' => 'ids',
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $order->get_id())
            );

            wc_get_template('templates/order/order-upload-files.php', array('order' => $order, 'attachments' => $attachments), '', WOOCCM_PLUGIN_DIR);
          }
        }
      }
    }

    public function add_custom_fields($order_id) {

      if (get_option('wooccm_order_custom_fields', 'no') === 'yes') {

        if ($order = wc_get_order($order_id)) {

          if (in_array("wc-{$order->get_status()}", array_values(get_option('wooccm_order_custom_fields_status', array())))) {

            wc_get_template('templates/order/order-custom-fields.php', array('order_id' => $order_id), '', WOOCCM_PLUGIN_DIR);
          }
        }
      }
    }

    public function add_metabox_content($post) {

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

    // Admin
    // -------------------------------------------------------------------------

    public function add_metabox() {
      add_meta_box('woocommerce-order-files', esc_html__('Order Uploaded Files', 'woocommerce-checkout-manager'), array($this, 'add_metabox_content'), 'shop_order', 'normal', 'default');
    }

    public function get_settings() {
      return array(
          array(
              'type' => 'title',
              'id' => 'section_title'
          ),
          array(
              'name' => esc_html__('Add upload files', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Allow customers to upload files in the order.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_upload_files',
              'type' => 'select',
              'class' => 'chosen_select',
              'options' => array(
                  'yes' => esc_html__('Yes', 'woocommerce-checkout-manager'),
                  'no' => esc_html__('No', 'woocommerce-checkout-manager'),
              ),
              'default' => 'no',
          ),
          array(
              'name' => esc_html__('Add for this order status', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Allow customers to upload files in the order.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_upload_files_order_status',
              'type' => 'multiselect',
              'class' => 'chosen_select',
              'options' => wc_get_order_statuses(),
          ),
          array(
              'name' => esc_html__('Add upload files title', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Add custom title for the uploads files table.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_upload_files_title',
              'type' => 'text',
              'placeholder' => esc_html__('Upload files', 'woocommerce-checkout-manager')
          ),
          array(
              'name' => esc_html__('Add custom fields', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Show the selected fields in the order.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_custom_fields',
              'type' => 'select',
              'class' => 'chosen_select',
              'options' => array(
                  'yes' => esc_html__('Yes', 'woocommerce-checkout-manager'),
                  'no' => esc_html__('No', 'woocommerce-checkout-manager'),
              ),
              'default' => 'no',
          ),
          array(
              'name' => esc_html__('Add for this order status', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Allow customers to upload files in the order.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_custom_fields_status',
              'type' => 'multiselect',
              'class' => 'chosen_select',
              'options' => wc_get_order_statuses(),
          ),
          array(
              'name' => esc_html__('Add custom fields title', 'woocommerce-checkout-manager'),
              'desc_tip' => esc_html__('Add custom title for the uploads files table.', 'woocommerce-checkout-manager'),
              'id' => 'wooccm_order_custom_fields_title',
              'type' => 'text',
              'placeholder' => esc_html__('Order extra', 'woocommerce-checkout-manager')
          ),
          array(
              'type' => 'sectionend',
              'id' => 'section_end'
          )
      );
    }

    public function add_section() {

      global $current_section;

      if ('order' == $current_section) {

        $settings = $this->get_settings();

        include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/order.php');
      }
    }

    public function save_settings() {
      woocommerce_update_options($this->get_settings());
    }

    // Compatibility
    // -------------------------------------------------------------------------

    public function enable_file_upload($value) {

      $options = get_option('wccs_settings');

      if (!empty($options['checkness']['enable_file_upload'])) {
        return 'yes';
      }

      return $value;
    }

    public function upload_os($value) {

      $options = get_option('wccs_settings');

      if (!empty($options['checkness']['upload_os'])) {
        return (array) implode(',', $options['checkness']['upload_os']);
      }

      return $value;
    }

    public function upload_title($value) {

      $options = get_option('wccs_settings');

      if (!empty($options['checkness']['upload_title'])) {
        return $options['checkness']['upload_title'];
      }

      return $value;
    }

    function init() {
//
//      global $wooccm_sections;
//
//      $wooccm_sections['order'] = esc_html__('Order', 'woocommerce-checkout-manager');

      add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

      add_action('wp_ajax_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));
      add_action('wp_ajax_nopriv_wooccm_order_attachment_upload', array($this, 'ajax_order_attachment_upload'));

      add_action('add_meta_boxes', array($this, 'add_metabox'));

      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section'), 99);
      add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_settings'));

      // Frontend
      // -----------------------------------------------------------------------

      add_action('woocommerce_thankyou', array($this, 'add_upload_files'));
      add_action('woocommerce_view_order', array($this, 'add_upload_files'));

      add_action('woocommerce_thankyou', array($this, 'add_custom_fields'));
      add_action('woocommerce_view_order', array($this, 'add_custom_fields'));

      // Compatibility
      // -----------------------------------------------------------------------

      add_filter('default_option_wooccm_order_upload_files', array($this, 'enable_file_upload'));
      add_filter('default_option_wooccm_order_upload_files_order_status', array($this, 'upload_os'));
      add_filter('default_option_wooccm_order_upload_files_title', array($this, 'upload_title'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Order_Controller::instance();
}