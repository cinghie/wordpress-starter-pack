<?php
if (!class_exists('WOOCCM_Field_Admin')) {

  class WOOCCM_Field_Admin {

    protected static $instance;

    function enqueue_scripts() {

      global $current_section;

      //wp_register_style('woocommerce_admin_marketplace_styles', WC()->plugin_url() . '/assets/css/marketplace-suggestions.css', array(), WC_VERSION);

      wp_register_style('wooccm-admin', plugins_url('assets/css/wooccm-admin.css', WOOCCM_PLUGIN_FILE), array('media-views', /* 'woocommerce_admin_marketplace_styles' */), WOOCCM_PLUGIN_VERSION, 'all');

      wp_register_script('wooccm-admin', plugins_url('assets/js/wooccm-admin.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

      if (isset($_GET['tab']) && $_GET['tab'] === WOOCCM_PREFIX) {
        wp_enqueue_style('wooccm-admin');
        wp_enqueue_script('wooccm-admin');
        wp_enqueue_script('wooccm-modal');
      }
    }

    function add_beta_badge() {
      ?>
      <style>
        body #adminmenu #toplevel_page_woocommerce a[href="<?php echo admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX) . '&section=billing'); ?>"]:before {
          content: 'BETA';
          color: #fff;
          background-color: #21c2f8;
          padding: 1px 7px;
          font-size: 9px;
          font-weight: 700;
          border-radius: 10px;
          position: absolute;
          right: 15px;
          line-height: 16px;
          font-style: italic;
        }
      </style>
      <?php
    }

    function add_tab($settings_tabs) {
      $settings_tabs[WOOCCM_PREFIX] = esc_html__('Checkout', 'woocommerce-checkout-manager');
      return $settings_tabs;
    }

    function add_section_general() {

      global $current_section;

      if ('' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('pages/general.php');
        }
      }
    }

    function add_section_orders() {

      global $current_section;

      if ('shipping' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('pages/orders.php');
        }
      }
    }

    function add_section_advanced() {
      global $current_section;
      if ('advanced' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          require_once('pages/advanced.php');
        }
      }
    }

    function add_menu_page() {
      //add_submenu_page('woocommerce', esc_html__('Checkout', 'woocommerce-checkout-manager'), esc_html__('Checkout', 'woocommerce-checkout-manager'), 'manage_options', admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX)));
      add_submenu_page('woocommerce', esc_html__('Checkout', 'woocommerce-checkout-manager'), esc_html__('Checkout', 'woocommerce-checkout-manager'), 'manage_options', admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX) . '&section=billing'));
    }

    function init() {
      add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
      add_action('admin_head', array($this, 'add_beta_badge'));
      add_action('admin_menu', array($this, 'add_menu_page'));
      add_filter('woocommerce_settings_tabs_array', array($this, 'add_tab'), 50);
      //add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_general'), 99);
      //add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_orders'), 99);
      //add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_advanced'), 99);
      //add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_section_billing'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Field_Admin::instance();
}
