<?php

final class WOOCCM {

  protected static $_instance;

  public function __construct() {
    $this->includes_old();
    $this->includes();
    $this->init();
  }

  public static function instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  function init() {

    register_activation_hook(WOOCCM_PLUGIN_FILE, array('WOOCCM_Install', 'install'));

    load_plugin_textdomain('woocommerce-checkout-manager', false, dirname(plugin_basename(__FILE__)) . '/languages/');

    $this->field = WOOCCM_Field_Controller::instance();
  }

  function includes() {

    // New
    // -----------------------------------------------------------------------
    include_once( WOOCCM_PLUGIN_DIR . 'new/class-wooccm-install.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/class-wooccm-notices.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/class-wooccm-admin.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-checkout-controller.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-field-controller.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-field-upload.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-order-controller.php' );
    //include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-order-email-controller.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-checkout-advanced-controller.php' );
  }

  function includes_old() {
    // Old
    // -----------------------------------------------------------------------
    include_once( WOOCCM_PLUGIN_DIR . 'includes/install.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/functions.php' );
    //include_once( WOOCCM_PLUGIN_DIR . 'includes/checkout.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/formatting.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/admin.php' );
    //include_once( WOOCCM_PLUGIN_DIR . 'includes/template.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/export.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/classes/main.php' );
  }

  public function register_scripts() {

    // Frontend
    // -----------------------------------------------------------------------
    wp_register_style('wooccm', plugins_url('assets/css/wooccm.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION, 'all');

    wp_register_script('wooccm-checkout', plugins_url('assets/js/wooccm-checkout.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

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
    wp_register_style('jquery-ui-style', WC()->plugin_url() . '/assets/css/jquery-ui/jquery-ui.min.css', array(), WC_VERSION);

    // Timepicker
    // ---------------------------------------------------------------------
    wp_register_style('jquery-ui-timepicker', plugins_url('assets/timepicker/jquery.ui.timepicker.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION);
    wp_register_script('jquery-ui-timepicker', plugins_url('assets/timepicker/jquery.ui.timepicker.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION);

    // Colorpicker
    // ---------------------------------------------------------------------
    wp_register_script('iris', admin_url('js/iris.min.js'), array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false);

    wp_register_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false);

    wp_localize_script('wp-color-picker', 'wpColorPickerL10n', array(
        'clear' => __('Clear'),
        'defaultString' => __('Default'),
        'pick' => __('Select Color'),
        'current' => __('Current Color'),
    ));

    wp_register_script('farbtastic', admin_url('js/farbtastic.js'), array('jquery'), false);
  }

}
