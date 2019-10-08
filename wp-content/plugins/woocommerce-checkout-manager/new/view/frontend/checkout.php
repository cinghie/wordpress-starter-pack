<?php

if (!class_exists('WOOCCM_Checkout')) {

  class WOOCCM_Checkout {

    protected static $instance;

    function enqueue_scripts() {

      if (is_checkout()) {

        WOOCCM()->register_scripts();

        $i18n = substr(get_user_locale(), 0, 2);

        wp_enqueue_style('wooccm');

        wp_enqueue_script('wooccm-checkout', plugins_url('assets/js/wooccm-checkout.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

        wp_localize_script('wooccm-checkout', 'wooccm_upload', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wooccm_upload'),
            'limit' => array(
                'max_file_size' => wp_max_upload_size(),
                'max_files' => 4,
            //'mime_types' => $this->get_mime_types(),
            ),
            'icons' => array(
                'interactive' => site_url('wp-includes/images/media/interactive.png'),
                'spreadsheet' => site_url('wp-includes/images/media/spreadsheet.png'),
                'archive' => site_url('wp-includes/images/media/archive.png'),
                'audio' => site_url('wp-includes/images/media/audio.png'),
                'text' => site_url('wp-includes/images/media/text.png'),
                'video' => site_url('wp-includes/images/media/video.png')
            ),
            'message' => array(
                'uploading' => esc_html__('Uploading, please wait...', 'woocommerce-checkout-manager'),
                'saving' => esc_html__('Saving, please wait...', 'woocommerce-checkout-manager'),
                'success' => esc_html__('Files uploaded successfully.', 'woocommerce-checkout-manager'),
                'deleted' => esc_html__('Deleted successfully.', 'woocommerce-checkout-manager'),
            )
        ));

        // UI
        // ---------------------------------------------------------------------
        wp_enqueue_style('jquery-ui-style', WC()->plugin_url() . '/assets/css/jquery-ui/jquery-ui.min.css', array(), WC_VERSION);

        // Datepicker
        // ---------------------------------------------------------------------
        wp_enqueue_script('jquery-ui-datepicker');

        // Timepicker
        // ---------------------------------------------------------------------
        wp_enqueue_style('jquery-ui-timepicker', plugins_url('assets/timepicker/jquery.ui.timepicker.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION);
        wp_enqueue_script('jquery-ui-timepicker', plugins_url('assets/timepicker/jquery.ui.timepicker.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION);

        if (is_file(WOOCCM_PLUGIN_DIR . 'assets/timepicker/i18n/jquery.ui.timepicker-' . $i18n . '.js')) {
          wp_enqueue_script('jquery-ui-timepicker-' . $i18n, plugins_url('assets/timepicker/i18n/jquery.ui.timepicker-' . $i18n . '.js', WOOCCM_PLUGIN_FILE), array('jquery-ui-timepicker'), WOOCCM_PLUGIN_VERSION);
        }

        // Colorpicker
        // ---------------------------------------------------------------------
        wp_enqueue_style('wp-color-picker');

        wp_enqueue_script('iris', admin_url('js/iris.min.js'), array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false);
        wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false);

        wp_localize_script('wp-color-picker', 'wpColorPickerL10n', array(
            'clear' => __('Clear'),
            'defaultString' => __('Default'),
            'pick' => __('Select Color'),
            'current' => __('Current Color'),
        ));

        // Farbtastic
        // ---------------------------------------------------------------------
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('farbtastic', admin_url('js/farbtastic.js'), array('jquery'), false);

        // Dashicons
        // ---------------------------------------------------------------------
        wp_enqueue_style('dashicons');

        wp_enqueue_script('wooccm-checkout');
      }
    }

    function add_thankyou_fields($order) {
      wc_get_template('templates/checkout/thankyou-fields.php', array('order' => $order), '', WOOCCM_PLUGIN_DIR);
    }

    function init() {
      add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
      add_action('woocommerce_order_details_after_order_table', array($this, 'add_thankyou_fields'), -10);
      //add_action('woocommerce_view_order', array($this, 'add_thankyou_fields'), 11);
      //add_action('woocommerce_thankyou', array($this, 'add_thankyou_fields'), 11);
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
    