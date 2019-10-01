<?php
/**
 * Plugin Name: WooCommerce Checkout Manager
 * Description: Manages WooCommerce Checkout, the advanced way.
 * Version:     4.4.9
 * Author:      QuadLayers
 * Author URI:  https://www.quadlayers.com
 * Copyright:   2019 QuadLayers (https://www.quadlayers.com)
 * Text Domain: woocommerce-checkout-manager
 */
if (!defined('ABSPATH')) {
  die('-1');
}

if (!defined('WOOCCM_PLUGIN_NAME')) {
  define('WOOCCM_PLUGIN_NAME', 'WooCommerce Checkout Manager');
}
if (!defined('WOOCCM_PLUGIN_VERSION')) {
  define('WOOCCM_PLUGIN_VERSION', '4.4.9');
}
if (!defined('WOOCCM_PLUGIN_FILE')) {
  define('WOOCCM_PLUGIN_FILE', __FILE__);
}
if (!defined('WOOCCM_PLUGIN_DIR')) {
  define('WOOCCM_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('WOOCCM_PREFIX')) {
  define('WOOCCM_PREFIX', 'wooccm');
}
if (!defined('WOOCCM_WORDPRESS_URL')) {
  define('WOOCCM_WORDPRESS_URL', 'https://wordpress.org/plugins/woocommerce-checkout-manager/');
}
if (!defined('WOOCCM_REVIEW_URL')) {
  define('WOOCCM_REVIEW_URL', 'https://wordpress.org/support/plugin/woocommerce-checkout-manager/reviews/?filter=5#new-post');
}
if (!defined('WOOCCM_DOCUMENTATION_URL')) {
  define('WOOCCM_DOCUMENTATION_URL', 'https://quadlayers.com/documentation/woocommerce-checkout-manager/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_DEMO_URL')) {
  define('WOOCCM_DEMO_URL', 'https://quadlayers.com/portfolio/woocommerce-checkout-manager/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_PURCHASE_URL')) {
  define('WOOCCM_PURCHASE_URL', WOOCCM_DEMO_URL);
}
if (!defined('WOOCCM_SUPPORT_URL')) {
  define('WOOCCM_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=wooccm_admin');
}
if (!defined('WOOCCM_GROUP_URL')) {
  define('WOOCCM_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}

if (!class_exists('WOOCCM')) {

  class WOOCCM {

    protected static $instance;

    function ajax_dismiss_notice() {
      if (current_user_can('manage_options')) {

        if (!empty($_REQUEST) && check_admin_referer('wooccm_dismiss_notice', 'nonce')) {

          if ($notice_id = ( isset($_REQUEST['notice_id']) ) ? sanitize_key($_REQUEST['notice_id']) : '') {

            update_user_meta(get_current_user_id(), $notice_id, true);

            wp_send_json($notice_id);
          }
        }
      }
      wp_die();
    }

    function add_notices() {
      if (!get_transient('wooccm-first-rating') && !get_user_meta(get_current_user_id(), 'wooccm-user-rating', true)) {
        ?>
        <div id="wooccm-admin-rating" class="wooccm-notice notice is-dismissible" data-notice_id="wooccm-user-rating">
          <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
            <div class="notice-image">
              <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/img/logo.jpg', WOOCCM_PLUGIN_FILE); ?>" alt="<?php echo esc_html(WOOCCM_PLUGIN_NAME); ?>>">
            </div>
            <div class="notice-content" style="margin-left: 15px;">
              <p>
                <?php printf(esc_html__('Hello! We\'ve recently acquired this plugin!', 'woocommerce-checkout-manager'), WOOCCM_PLUGIN_NAME); ?>
                <br/>
                <?php esc_html_e('We will do our best to improve it and include new features gradually. Please be patient and let us know about the issues and improvements that you want to see in this plugin.', 'woocommerce-checkout-manager'); ?>
              </p>
              <a href="<?php echo esc_url(WOOCCM_GROUP_URL); ?>" class="button-primary" target="_blank">
                <?php esc_html_e('Join Community!', 'woocommerce-checkout-manager'); ?>
              </a>
              <a href="<?php echo esc_url(WOOCCM_SUPPORT_URL); ?>" class="button-secondary" target="_blank">
                <?php esc_html_e('Report a bug', 'woocommerce-checkout-manager'); ?>
              </a>
              <a style="margin-left: 10px;" href="https://quadlayers.com/?utm_source=wooccm_admin" target="_blank">
                <?php esc_html_e('About us', 'woocommerce-checkout-manager'); ?>
              </a>
            </div>
          </div>
        </div>
      <?php }
      ?>
      <?php /* if (!get_user_meta(get_current_user_id(), 'wooccm-user-beta', true)) {
        ?>
        <div id="wooccm-admin-rating" class="wooccm-notice notice is-dismissible" data-notice_id="wooccm-user-beta">
        <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
        <div class="notice-image">
        <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/img/logo.jpg', WOOCCM_PLUGIN_FILE); ?>" alt="<?php echo esc_html(WOOCCM_PLUGIN_NAME); ?>>">
        </div>
        <div class="notice-content" style="margin-left: 15px;">
        <p>
        <?php printf(esc_html__('Hello! We\'ve launched a new beta version!', 'woocommerce-checkout-manager'), WOOCCM_PLUGIN_NAME); ?>
        <br/>
        <?php esc_html_e(' We urgently need developers, integrators and interested store owners to test this plugin release and provide feedback to help stabilise the 4.4+ version. We\'ve rebuilt the entire file picker field and the upload fields option inside user orders and admin backend. Can you help?', 'woocommerce-checkout-manager'); ?>
        </p>
        <a href="https://drive.google.com/uc?id=1THj7zm-2NOTURandd1IuiibZvP4XL-vw&export=download" class="button-primary" target="_blank">
        <?php esc_html_e('Download Now!', 'woocommerce-checkout-manager'); ?>
        </a>
        <a href="<?php echo esc_url(WOOCCM_SUPPORT_URL); ?>" class="button-secondary" target="_blank">
        <?php esc_html_e('Report a bug', 'woocommerce-checkout-manager'); ?>
        </a>
        <a style="margin-left: 10px;" href="https://quadlayers.com/documentation/woocommerce-checkout-manager/changelog/" target="_blank">
        <?php esc_html_e('Changelog', 'woocommerce-checkout-manager'); ?>
        </a>
        </div>
        </div>
        </div>
        <?php } */ ?>
      <script>
        (function ($) {
          $('.wooccm-notice').on('click', '.notice-dismiss', function (e) {
            e.preventDefault();
            var notice_id = $(e.delegateTarget).data('notice_id');
            $.ajax({
              type: 'POST',
              url: ajaxurl,
              data: {
                notice_id: notice_id,
                action: 'wooccm_dismiss_notice',
                nonce: '<?php echo wp_create_nonce('wooccm_dismiss_notice'); ?>'
              },
              success: function (response) {
                console.log(response);
              },
            });
          });
        })(jQuery);
      </script>
      <?php
    }

    protected function get_mime_types() {

      $extensions = $types = array();

      $allowed_types = get_allowed_mime_types();

      // break the allowed extensions into their respective types
      foreach ($allowed_types as $allowed_extensions => $type) {

        $type = substr($type, 0, strpos($type, '/'));

        $extensions[$type][] = str_replace('|', ',', $allowed_extensions);
      }

      // format the extensions for plupload
      foreach ($extensions as $type => $exts) {

        $types[] = array(
            'title' => $type,
            'extensions' => implode(',', $exts),
        );
      }

      return apply_filters('wooccm_mime_types', $types);
    }

    function add_action_links($links) {

      $links[] = '<a target="_blank" href="' . WOOCCM_SUPPORT_URL . '">' . esc_html__('Support', 'woocommerce-checkout-manager') . '</a>';
      $links[] = '<a href="' . admin_url('admin.php?page=woocommerce-checkout-manager">') . esc_html__('Settings', 'woocommerce-checkout-manager') . '</a>';

      return $links;
    }

    function register_scripts() {

      wp_register_style('woocommerce_admin_marketplace_styles', WC()->plugin_url() . '/assets/css/marketplace-suggestions.css', array(), WC_VERSION);

      wp_register_style('wooccm-admin', plugins_url('assets/css/wooccm-admin.css', WOOCCM_PLUGIN_FILE), array('woocommerce_admin_marketplace_styles'), WOOCCM_PLUGIN_VERSION, 'all');

      wp_register_script('wc-admin-meta-boxes', WC()->plugin_url() . '/assets/js/admin/meta-boxes.js', array('jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'accounting', 'round', 'wc-enhanced-select', 'plupload-all', 'stupidtable', 'jquery-tiptip'), WC_VERSION);

      wp_register_script('wooccm-modal', plugins_url('assets/js/wooccm-modal.js', WOOCCM_PLUGIN_FILE), array('jquery', 'wc-admin-meta-boxes', 'backbone'), WOOCCM_PLUGIN_VERSION, true);

      wp_register_script('wooccm-admin', plugins_url('assets/js/wooccm-admin.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

      wp_localize_script('wooccm-admin', 'wooccm', array(
          'ajaxurl' => admin_url('admin-ajax.php'),
          'nonce' => wp_create_nonce('wooccm_admin'),
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
          ),
          'fields' => array(
              'args' => WOOCCM_Fields::get_field_args(),
              'option' => WOOCCM_Fields::get_fields_option_types(),
          )
      ));

      wp_register_script('wooccm-order-upload', plugins_url('assets/js/wooccm-order-upload.js', WOOCCM_PLUGIN_FILE), array('wooccm-admin'), WOOCCM_PLUGIN_VERSION, true);

      wp_register_script('wooccm-checkout', plugins_url('assets/js/wooccm-checkout.js', WOOCCM_PLUGIN_FILE), array('jquery'), WOOCCM_PLUGIN_VERSION, true);

      wp_localize_script('wooccm-checkout', 'wooccm', array(
          'ajaxurl' => admin_url('admin-ajax.php'),
          'nonce' => wp_create_nonce('wooccm_checkout_attachment_upload'),
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
    }

    function add_admin_scripts() {

      $this->register_scripts();

      //1326
      // only for panel
      wp_enqueue_media();
      wp_enqueue_style('wooccm-admin');
      // 1326
      // only for orders
      wp_enqueue_script('wooccm-admin');
      wp_enqueue_script('wooccm-modal');
      // only for backend maybe orders
      wp_enqueue_script('wooccm-order-upload');
    }

    function admin_head() {
      ?>
      <style>
        body #adminmenu #toplevel_page_woocommerce a[href="<?php echo admin_url('admin.php?page=wc-settings&tab=wooccm'); ?>"]:before {
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

    function add_frontend_scripts() {

      $this->register_scripts();

      $i18n = substr(get_user_locale(), 0, 2);

      wp_enqueue_style('wooccm', plugins_url('assets/css/wooccm.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION, 'all');

      if (is_account_page()) {
        wp_enqueue_script('wooccm-order-upload');
        wp_enqueue_style('dashicons');
        wp_enqueue_style('wooccm-button-style', plugins_url('assets/old/edit-order-uploads-button_style.css', WOOCCM_PLUGIN_FILE), false, WOOCCM_PLUGIN_VERSION, 'all');
      }

      if (is_checkout()) {

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

    function languages() {
      load_plugin_textdomain('woocommerce-checkout-manager', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    function includes() {
      // Old
      // -----------------------------------------------------------------------
      include( WOOCCM_PLUGIN_DIR . 'includes/install.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/functions.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/checkout.php' );
      //1326
      //include( WOOCCM_PLUGIN_DIR . 'includes/checkout-billing.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/checkout-shipping.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/checkout-additional.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/email.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/formatting.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/admin.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/template.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/export.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/classes/main.php' );
      //1326
      //include( WOOCCM_PLUGIN_DIR . 'includes/classes/field_filters.php' );
      // @mod - We need to load the templates conditionally
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/add_functions.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/billing_functions.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/shipping_functions.php' );
      //1326
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/add_wooccmupload.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/billing_wooccmupload.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/shipping_wooccmupload.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/required/add_required.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/required/billing_required.php' );
      include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/required/shipping_required.php' );
      //include( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/wooccm_editing_wrapper.php' );
      // New
      // -----------------------------------------------------------------------
      //include( WOOCCM_PLUGIN_DIR . 'new/install.php' );
      //include( WOOCCM_PLUGIN_DIR . 'new/admin/ajax.php' );
      //include( WOOCCM_PLUGIN_DIR . 'new/admin/admin.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/checkout.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/orders.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_init.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_register.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_additional.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_display.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_conditional.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_handler.php' );
      include( WOOCCM_PLUGIN_DIR . 'new/fields_filters.php' );
      //include( WOOCCM_PLUGIN_DIR . 'new/premium/fields_datepicker.php' );
      //include( WOOCCM_PLUGIN_DIR . 'new/premium/fields_timepicker.php' );
      //include( WOOCCM_PLUGIN_DIR . 'new/premium/fields_amount.php' );
    }

    function init() {
      add_action('wp_ajax_wooccm_dismiss_notice', array($this, 'ajax_dismiss_notice'));
      add_action('wp_enqueue_scripts', array($this, 'add_frontend_scripts'));
      add_action('admin_enqueue_scripts', array($this, 'add_admin_scripts'));
      add_action('admin_notices', array($this, 'add_notices'));
      add_action('admin_head', array($this, 'admin_head'));
      add_filter('plugin_action_links_' . plugin_basename(WOOCCM_PLUGIN_FILE), array($this, 'add_action_links'));
    }

    public static function do_activation() {
      set_transient('wooccm-first-rating', true, MONTH_IN_SECONDS);

      if (class_exists('WOOCCM_Install')) {
        WOOCCM_Install::do_activation();
      } else {
        wooccm_install();
      }
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->includes();
        self::$instance->init();
        self::$instance->languages();
      }
      return self::$instance;
    }

  }

  //add_action('plugins_loaded', array('WOOCCM', 'instance'));

  WOOCCM::instance();


  register_activation_hook(WOOCCM_PLUGIN_FILE, array('WOOCCM', 'do_activation'));
}

add_action('woocommerce_before_checkout_form', 'wooccm_autocreate_account');
// E-mail - Order receipt
add_action('woocommerce_email_after_order_table', 'wooccm_order_receipt_checkout_details', 10, 3);
// Save the Order meta
add_action('woocommerce_checkout_update_order_meta', 'wooccm_custom_checkout_field_update_order_meta');
add_action('woocommerce_checkout_process', 'wooccm_custom_checkout_field_process');
add_action('woocommerce_checkout_update_user_meta', 'wooccm_custom_checkout_field_update_user_meta', 10, 2);
// Checkout - Order Received
add_action('woocommerce_order_details_after_customer_details', 'wooccm_order_received_checkout_details');
add_action('woocommerce_checkout_after_customer_details', 'wooccm_checkout_text_after');
add_action('woocommerce_checkout_before_customer_details', 'wooccm_checkout_text_before');
add_filter('woocommerce_checkout_fields', 'wooccm_remove_fields_filter_billing', 15);
add_filter('woocommerce_checkout_fields', 'wooccm_remove_fields_filter_shipping', 1);
add_action('wp_head', 'wooccm_display_front');
//add_action('wp_head', 'wooccm_billing_hide_required');
//add_action('wp_head', 'wooccm_shipping_hide_required');
// @mod - wooccm_run_color_inner does not exist
// add_action( 'wooccm_run_color_innerpicker', 'wooccm_run_color_inner' ); run color inside options page (proto)
//add_action('woocommerce_before_checkout_form', 'wooccm_override_this');
//add_filter('woocommerce_billing_fields', 'wooccm_checkout_billing_fields');
//add_filter('woocommerce_default_address_fields', 'wooccm_checkout_default_address_fields');
//add_filter('woocommerce_shipping_fields', 'wooccm_checkout_shipping_fields');
add_filter('wcdn_order_info_fields', 'wooccm_woocommerce_delivery_notes_compat', 10, 2);
add_filter('wc_customer_order_csv_export_order_row', 'wooccm_csv_export_modify_row_data', 10, 3);
add_filter('wc_customer_order_csv_export_order_headers', 'wooccm_csv_export_modify_column_headers');

add_filter('default_checkout_billing_state', 'wooccm_state_default_switch');

add_action('woocommerce_checkout_process', 'wooccm_custom_checkout_process');
add_action('woocommerce_checkout_process', 'wooccm_billing_custom_checkout_process');
add_action('woocommerce_checkout_process', 'wooccm_shipping_custom_checkout_process');

//1326
//add_action('woocommerce_before_checkout_form', 'wooccm_billing_scripts');
//add_action('woocommerce_before_checkout_form', 'wooccm_billing_override_this');
//add_action('woocommerce_before_checkout_form', 'wooccm_shipping_scripts');
//add_action('woocommerce_before_checkout_form', 'wooccm_shipping_override_this');
//add_action('woocommerce_before_checkout_form', 'wooccm_scripts');
//add_action('woocommerce_before_checkout_form', 'wooccm_upload_scripts');

add_action('woocommerce_checkout_fields', 'wooccm_order_notes');
add_filter('parse_query', 'wooccm_query_list');
add_action('restrict_manage_posts', 'woooccm_restrict_manage_posts');

/*
 * 1326
 * switch (wooccm_checkout_additional_positioning()) {

  case 'before_shipping_form':
  add_action('woocommerce_before_checkout_shipping_form', 'wooccm_checkout_additional_fields');
  break;

  case 'after_shipping_form':
  add_action('woocommerce_after_checkout_shipping_form', 'wooccm_checkout_additional_fields');
  break;

  case 'before_billing_form':
  add_action('woocommerce_before_checkout_billing_form', 'wooccm_checkout_additional_fields');
  break;

  case 'after_billing_form':
  add_action('woocommerce_after_checkout_billing_form', 'wooccm_checkout_additional_fields');
  break;

  case 'after_order_notes':
  add_action('woocommerce_after_order_notes', 'wooccm_checkout_additional_fields');
  break;
  } */

if (wooccm_validator_changename()) {

  add_action('woocommerce_before_cart', 'wooccm_before_checkout');
  add_action('woocommerce_admin_order_data_after_order_details', 'wooccm_before_checkout');
  add_action('woocommerce_before_my_account', 'wooccm_before_checkout');
  add_action('woocommerce_email_header', 'wooccm_before_checkout');
  add_action('woocommerce_before_checkout_form', 'wooccm_before_checkout');
  add_action('woocommerce_after_cart', 'wooccm_after_checkout');
  add_action('woocommerce_admin_order_data_after_shipping_address', 'wooccm_after_checkout');
  add_action('woocommerce_after_my_account', 'wooccm_after_checkout');
  add_action('woocommerce_email_footer', 'wooccm_after_checkout');
  add_action('woocommerce_after_checkout_form', 'wooccm_after_checkout');
}

if (wooccm_enable_auto_complete()) {
  add_action('woocommerce_before_checkout_form', 'wooccm_retain_field_values');
}

/* function wooccm_load_textdomain() {

  $options = get_option('wccs_settings');
  // @mod - We are loading translations unless they opt-out via the WordPress Filter
  $options['checkness']['admin_translation'] = apply_filters('wooccm_load_textdomain', true, ( isset($options['checkness']['admin_translation']) ? $options['checkness']['admin_translation'] : false));
  if (!empty($options['checkness']['admin_translation'])) {
  load_plugin_textdomain('woocommerce-checkout-manager', false, dirname(plugin_basename(__FILE__)) . '/languages/');
  }
  }

  add_action('plugins_loaded', 'wooccm_load_textdomain'); */