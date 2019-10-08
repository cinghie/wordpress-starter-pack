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
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-field-controller.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-upload-handler.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-order-controller.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/controller/class-wooccm-checkout-controller.php' );
  }

  function includes_old() {
    // Old
    // -----------------------------------------------------------------------
    include_once( WOOCCM_PLUGIN_DIR . 'includes/install.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/functions.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/checkout.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'includes/email.php' );
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

    // Common
    // -----------------------------------------------------------------------

    wp_register_script('wooccm-order-upload', plugins_url('assets/js/wooccm-order-upload.js', WOOCCM_PLUGIN_FILE), array(), WOOCCM_PLUGIN_VERSION, true);

    wp_localize_script('wooccm-order-upload', 'wooccm_upload', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
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
  }

}
