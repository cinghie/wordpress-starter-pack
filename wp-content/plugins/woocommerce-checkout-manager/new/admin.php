<?php

if (!class_exists('WOOCCM_Admin')) {

  class WOOCCM_Admin {

    protected static $instance;

    function ajax_toggle_field_enabled() {

      if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_POST['field_id'])) {

        $field_id = wc_clean(wp_unslash($_POST['field_id']));

        if ($options = get_option('wccs_settings3')) {

          if (array_key_exists('billing_buttons', $options)) {

            $enabled = empty($options['billing_buttons'][$field_id]['enabled']);

            $options['billing_buttons'][$field_id]['enabled'] = $enabled;

            update_option('wccs_settings3', $options);

            wp_send_json_success($enabled);
          }
        }
      }

      wp_send_json_error('invalid_field_id');
      wp_die();
    }

    function add_sections($sections = array()) {

      global $current_section;

      $sections[''] = esc_html__('General', 'woocommerce-checkout-manager');
      $sections['orders'] = esc_html__('Orders', 'woocommerce-checkout-manager');
      $sections['billing'] = esc_html__('Billing', 'woocommerce-checkout-manager');
      $sections['shipping'] = esc_html__('Shipping', 'woocommerce-checkout-manager');
      $sections['additional'] = esc_html__('Additional', 'woocommerce-checkout-manager');
      $sections['advanced'] = esc_html__('Advanced', 'woocommerce-checkout-manager');

      echo '<ul class="subsubsub">';

      $array_keys = array_keys($sections);

      foreach ($sections as $id => $label) {
        echo '<li><a href="' . admin_url('admin.php?page=wc-settings&tab=wooccm&section=' . sanitize_title($id)) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end($array_keys) == $id ? '' : '|' ) . ' </li>';
      }

      echo '</ul><br class="clear" />';
    }

    function add_tab($settings_tabs) {
      $settings_tabs[WOOCCM_PREFIX] = esc_html__('Checkout', 'woocommerce-checkout-manager');
      return $settings_tabs;
    }

    function add_section_general() {

      global $current_section;

      if ('' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('admin/pages/general.php');
        }
      }
    }

    function add_section_orders() {

      global $current_section;

      if ('shipping' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('admin/pages/orders.php');
        }
      }
    }

    function add_section_billing() {

      global $current_section;

      if ('billing' == $current_section) {
        if ($options = get_option('wccs_settings3', array())) {
          include_once('admin/pages/billing.php');
        }
      }
    }

    function add_section_shipping() {

      global $current_section;

      if ('' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('admin/pages/shipping.php');
        }
      }
    }

    function add_section_additional() {

      global $current_section;

      if ('additional' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          include_once('admin/pages/additional.php');
        }
      }
    }

    function add_section_advanced() {
      global $current_section;
      if ('advanced' == $current_section) {
        if ($options = get_option('wccs_settings', array())) {
          require_once('admin/pages/advanced.php');
        }
      }
    }

    function save_section_billing() {

      global $current_section;

      if ('billing' == $current_section) {

        if (isset($_POST['gateway_order'])) {

          $gateway_order = wc_clean(wp_unslash($_POST['gateway_order']));

          if ($options = get_option('wccs_settings3')) {

            if (array_key_exists('billing_buttons', $options)) {

              foreach ($options['billing_buttons'] as $id => $custom_field) {

                if (isset($gateway_order[$id])) {
                  $options['billing_buttons'][$id]['order'] = $gateway_order[$id];
                }
              }

              update_option('wccs_settings3', $options);
            }
          }
        }
      }
    }

    function add_menu_page() {
      add_submenu_page('woocommerce', esc_html__('Checkout', 'woocommerce-checkout-manager'), esc_html__('Checkout', 'woocommerce-checkout-manager'), 'manage_options', admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX)));
    }

    function init() {
      add_action('admin_menu', array($this, 'add_menu_page'));
      add_filter('woocommerce_settings_tabs_array', array($this, 'add_tab'), 50);
      add_filter('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_sections'));
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_general'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_orders'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_billing'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_shipping'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_additional'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_advanced'), 99);
      add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_section_billing'));
      add_action('wp_ajax_wooccm_toggle_field_enabled', array($this, 'ajax_toggle_field_enabled'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Admin::instance();
}
