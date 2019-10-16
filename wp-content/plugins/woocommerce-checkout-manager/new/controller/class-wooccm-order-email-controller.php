<?php

class WOOCCM_Order_Email_Controller extends WOOCCM_Upload {

  protected static $instance;

  // Admin    
  // -------------------------------------------------------------------------

  public function get_settings() {
    return array(
        array(
            'type' => 'title',
            'id' => 'section_title'
        ),
        array(
            'name' => esc_html__('Add custom fields', 'woocommerce-checkout-manager'),
            'desc_tip' => esc_html__('Show the selected fields in the order.', 'woocommerce-checkout-manager'),
            'id' => 'wooccm_email_custom_fields',
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
            'id' => 'wooccm_email_custom_fields_status',
            'type' => 'multiselect',
            'class' => 'chosen_select',
            'options' => wc_get_order_statuses(),
        ),
        array(
            'name' => esc_html__('Add custom fields title', 'woocommerce-checkout-manager'),
            'desc_tip' => esc_html__('Add custom title for the uploads files table.', 'woocommerce-checkout-manager'),
            'id' => 'wooccm_email_custom_fields_title',
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

    if ('email' == $current_section) {

      $settings = $this->get_settings();

      include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/email.php');
    }
  }

  public function save_settings() {
    woocommerce_update_options($this->get_settings());
  }

  // Frontend
  // ---------------------------------------------------------------------------

  public function add_custom_fields($order, $sent_to_admin, $plain_text, $email) {

    if (get_option('wooccm_email_custom_fields', 'no') === 'yes') {

      $order_id = $order->get_id();

      if (in_array("wc-{$order->get_status()}", array_values(get_option('wooccm_email_custom_fields_status', array())))) {

        wc_get_template('templates/emails/email-custom-fields.php', array('order_id' => $order_id), '', WOOCCM_PLUGIN_DIR);
      }
    }
  }

  public function init() {

//    global $wooccm_sections;
//
//    $wooccm_sections['email'] = esc_html__('Email', 'woocommerce-checkout-manager');

    add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section'));
    add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_settings'));

    add_action('woocommerce_email_after_order_table', array($this, 'add_custom_fields'), 10, 4);
  }

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

}

WOOCCM_Order_Email_Controller::instance();
