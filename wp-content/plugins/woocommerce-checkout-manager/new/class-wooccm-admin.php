<?php
if (!class_exists('WOOCCM_Field_Admin')) {

  class WOOCCM_Field_Admin {

    protected static $instance;

    public function ajax_select_search_products() {

      if (current_user_can('manage_woocommerce') && check_ajax_referer('search-products', 'security') && isset($_REQUEST['term'])) {

        if (empty($term) && isset($_GET['term'])) {
          $term = (string) wc_clean(wp_unslash($_GET['term']));
        }

        if (empty($term)) {
          wp_die();
        }

        if (!empty($_GET['limit'])) {
          $limit = absint($_GET['limit']);
        } else {
          $limit = absint(apply_filters('woocommerce_json_search_limit', 30));
        }

        $include_ids = !empty($_GET['include']) ? array_map('absint', (array) wp_unslash($_GET['include'])) : array();
        $exclude_ids = !empty($_GET['exclude']) ? array_map('absint', (array) wp_unslash($_GET['exclude'])) : array();
        $selected_ids = !empty($_GET['selected']) ? array_map('absint', (array) wp_unslash($_GET['selected'])) : array();

        $include_variations = false;

        $data_store = WC_Data_Store::load('product');
        $ids = $data_store->search_products($term, '', (bool) $include_variations, false, $limit, $include_ids, $exclude_ids + $selected_ids);

        $product_objects = array_filter(array_map('wc_get_product', $ids), 'wc_products_array_filter_readable');
        $products = array();

        foreach ($product_objects as $product_object) {
          $formatted_name = $product_object->get_formatted_name();
          $managing_stock = $product_object->managing_stock();

          if ($managing_stock && !empty($_GET['display_stock'])) {
            $stock_amount = $product_object->get_stock_quantity();
            /* Translators: %d stock amount */
            $formatted_name .= ' &ndash; ' . sprintf(__('Stock: %d', 'woocommerce'), wc_format_stock_quantity_for_display($stock_amount, $product_object));
          }

          $products[$product_object->get_id()] = rawurldecode($formatted_name);
        }

        wp_send_json(apply_filters('woocommerce_json_search_found_products', $products));
      }
    }

//    public function ajax_select_search_states() {
//
//      if (current_user_can('manage_woocommerce') && check_ajax_referer('search-states', 'security') && isset($_REQUEST['country'])) {
//
//        if ($states = WC()->countries->get_states($_REQUEST['country'])) {
//          wp_send_json($states);
//        }
//      }
//    }

    function enqueue_scripts() {

      wp_register_style('wooccm-admin', plugins_url('assets/css/wooccm-admin.css', WOOCCM_PLUGIN_FILE), array('media-views', /* 'woocommerce_admin_marketplace_styles' */), WOOCCM_PLUGIN_VERSION, 'all');

      wp_register_script('wooccm-admin', plugins_url('assets/js/wooccm-admin.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

      if (isset($_GET['tab']) && $_GET['tab'] === WOOCCM_PREFIX) {
        wp_enqueue_style('wooccm-admin');
        wp_enqueue_script('wooccm-admin');
      }
    }

    function add_beta_badge() {
      ?>
      <style>
        body #adminmenu #toplevel_page_woocommerce a[href="<?php echo admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX)); ?>"]:before {
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

    function add_menu_page() {
      add_submenu_page('woocommerce', esc_html__('Checkout', 'woocommerce-checkout-manager'), esc_html__('Checkout', 'woocommerce-checkout-manager'), 'manage_woocommerce', admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(WOOCCM_PREFIX)));
    }

    function init() {
      add_action('wp_ajax_wooccm_select_search_products', array($this, 'ajax_select_search_products'));
      //add_action('wp_ajax_wooccm_select_search_states', array($this, 'ajax_select_search_states'));

      add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
      add_action('admin_head', array($this, 'add_beta_badge'));
      add_action('admin_menu', array($this, 'add_menu_page'));
      add_filter('woocommerce_settings_tabs_array', array($this, 'add_tab'), 50);
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
