<?php

class WOOCCM_Notices {

  protected static $_instance;

  public function __construct() {
    $this->init();
  }

  public static function instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  private function init() {
    add_action('wp_ajax_wooccm_dismiss_notice', array($this, 'ajax_dismiss_notice'));
    add_action('admin_notices', array($this, 'add_notices'));
    add_filter('plugin_action_links_' . plugin_basename(WOOCCM_PLUGIN_FILE), array($this, 'add_action_links'));
  }

  public function ajax_dismiss_notice() {
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

  public function add_notices() {
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
    <?php } ?>
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

  public function add_action_links($links) {

    $links[] = '<a target="_blank" href="' . WOOCCM_SUPPORT_URL . '">' . esc_html__('Support', 'woocommerce-checkout-manager') . '</a>';
    $links[] = '<a href="' . admin_url('admin.php?page=woocommerce-checkout-manager">') . esc_html__('Settings', 'woocommerce-checkout-manager') . '</a>';

    return $links;
  }

}

WOOCCM_Notices::instance();
