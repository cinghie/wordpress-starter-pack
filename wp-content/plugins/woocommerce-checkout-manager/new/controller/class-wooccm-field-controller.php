<?php

class WOOCCM_Field_Controller {

  protected static $_instance;
  public $billing;
  public $shipping;
  public $additional;

  public function __construct() {
    $this->includes();
    $this->init();
  }

  public static function instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  function enqueue_scripts() {

    global $current_section;

    wp_register_script('wooccm-field', plugins_url('assets/js/wooccm-field.js', WOOCCM_PLUGIN_FILE), array('jquery', 'jquery-ui-datepicker', 'backbone', 'wp-util'), WOOCCM_PLUGIN_VERSION, true);

    wp_localize_script('wooccm-field', 'wooccm_field', array(
        'ajax_url' => admin_url('admin-ajax.php?section=' . $current_section),
        'nonce' => wp_create_nonce('wooccm_field'),
        'args' => WOOCCM()->field->billing->get_args(),
        'message' => array(
            'remove' => esc_html__('Are you sure you want to remove this field?', 'woocommerce-checkout-manager'),
            'reset' => esc_html__('Are you sure you want to reset this fields?', 'woocommerce-checkout-manager')
        )
    ));

    if (isset($_GET['tab']) && $_GET['tab'] === WOOCCM_PREFIX) {
      wp_enqueue_script('wooccm-field');
    }
  }

  public function get_product_categories() {

    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'id',
        'order' => 'ASC',
        'hide_empty' => true,
        'fields' => 'all');

    return get_terms($args);
  }

  // Ajax
  // ---------------------------------------------------------------------------

  public function ajax_toggle_field_attribute() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce') && isset($_REQUEST['field_id']) && isset($_REQUEST['field_attr'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));
      $attr = wc_clean(wp_unslash($_REQUEST['field_attr']));

      $status = $this->toggle_field_attribute($field_id, $attr);

      wp_send_json_success($status);
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_change_field_attribute() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce') && isset($_REQUEST['field_id']) && isset($_REQUEST['field_attr']) && isset($_REQUEST['field_value'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));
      $attr = wc_clean(wp_unslash($_REQUEST['field_attr']));
      $value = wc_clean(wp_unslash($_REQUEST['field_value']));

      $field_data = array($attr => $value);

      $field = $this->save_modal_field($field_id, $field_data);

      wp_send_json_success($field);
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_save_field() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce') && isset($_REQUEST['field_data'])) {

      $field_data = $_REQUEST['field_data'];

      if (array_key_exists('field_id', $_REQUEST)) {

        $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));

        if ($field = $this->save_modal_field($field_id, $field_data)) {

          wp_send_json_success($field);
        }
      } else {

        if ($field = $this->add_modal_field($field_data)) {

          wp_send_json_success($field);
        }
      }
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_delete_field() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce') && isset($_REQUEST['field_id'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));

      if ($this->delete_field($field_id)) {

        wp_send_json_success($field_id);
      }
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_reset_fields() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce')) {

      if (array_key_exists('section', $_REQUEST)) {

        $section = wc_clean(wp_unslash($_REQUEST['section']));

        if (isset(WOOCCM()->field->$section)) {

          WOOCCM()->field->$section->delete_fields();

          wp_send_json_success();
        }
      }
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_load_field() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_field', 'nonce') && isset($_REQUEST['field_id'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));

      if ($field = $this->get_modal_field($field_id)) {
        wp_send_json_success($field);
      }

      wp_send_json_error(esc_html__('Undefined field id', 'woocommerce-checkout-manager'));
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  // Modal
  // ---------------------------------------------------------------------------

  public function get_modal_field($field_id) {

    if (array_key_exists('section', $_REQUEST)) {

      $section = wc_clean(wp_unslash($_REQUEST['section']));

      if (isset(WOOCCM()->field->$section)) {

        if ($field = WOOCCM()->field->$section->get_field($field_id)) {

          if (!empty($field['show_product'])) {
            $field['show_product_selected'] = array_filter(array_combine((array) $field['show_product'], array_map('get_the_title', (array) $field['show_product'])));
          }
          if (!empty($field['hide_product'])) {
            $field['hide_product_selected'] = array_filter(array_combine((array) $field['hide_product'], array_map('get_the_title', (array) $field['hide_product'])));
          }
          //don't remove empty attr because previus data remain
          //$field = array_filter($field);

          return $field;
        }
      }
    }
  }

  // Save
  // ---------------------------------------------------------------------------

  public function toggle_field_attribute($field_id, $attr) {

    if (array_key_exists('section', $_REQUEST)) {

      $section = wc_clean(wp_unslash($_REQUEST['section']));

      if (isset(WOOCCM()->field->$section)) {

        if ($field = WOOCCM()->field->$section->get_field($field_id)) {

          $field_data = array($attr => !(bool) @$field[$attr]);

          $field = WOOCCM()->field->$section->update_field($field_id, $field_data);

          return $field_data[$attr];
        }
      }
    }
  }

  public function save_modal_field($field_id, $field_data) {

    if (array_key_exists('section', $_REQUEST)) {

      $section = wc_clean(wp_unslash($_REQUEST['section']));

      if (isset(WOOCCM()->field->$section)) {
        return WOOCCM()->field->$section->update_field($field_id, $field_data);
      }
    }
  }

  public function add_modal_field($field_data) {

    if (array_key_exists('section', $_REQUEST)) {

      $section = wc_clean(wp_unslash($_REQUEST['section']));

      if (isset(WOOCCM()->field->$section)) {

        return WOOCCM()->field->$section->add_field($field_data);
      }
    }
  }

  public function delete_field($field_id) {

    if (array_key_exists('section', $_REQUEST)) {

      $section = wc_clean(wp_unslash($_REQUEST['section']));

      if (isset(WOOCCM()->field->$section)) {

        return WOOCCM()->field->$section->delete_field($field_id);
      }
    }
  }

  function save_field_order() {

    global $current_section;

    if ($current_section) {

      $section = wc_clean(wp_unslash($current_section));

      if (array_key_exists('field_order', $_POST)) {

        $field_order = wc_clean(wp_unslash($_POST['field_order']));

        if (is_array($field_order) && count($field_order) > 0) {

          if (isset(WOOCCM()->field->$section)) {

            $fields = WOOCCM()->field->$section->get_fields();

            $loop = 1;

            foreach ($field_order as $field_id) {

              if (isset($fields[$field_id])) {

                $fields[$field_id]['order'] = $loop;

                $loop++;
              }
            }

            WOOCCM()->field->$section->update_fields($fields);
          }
        }
      }
    }
  }

  function get_additional_settings() {

    return array(
        array(
            'desc_tip' => esc_html__('Select the position of the additional fields.', 'woocommerce-checkout-manager'),
            'id' => 'wooccm_additional_position',
            'type' => 'select',
            //'class' => 'chosen_select',
            'options' => array(
                'before_shipping_form' => esc_html__('Before shipping form', 'woocommerce-checkout-manager'),
                'after_shipping_form' => esc_html__('After shipping form', 'woocommerce-checkout-manager'),
                'before_billing_form' => esc_html__('Before billing form', 'woocommerce-checkout-manager'),
                'after_billing_form' => esc_html__('After billing form', 'woocommerce-checkout-manager'),
                'before_order_notes' => esc_html__('Before order notes', 'woocommerce-checkout-manager'),
                'after_order_notes' => esc_html__('After order notes', 'woocommerce-checkout-manager'),
            ),
            'default' => 'before_shipping_form',
    ));
  }

  function save_additional_settings() {
    woocommerce_update_options($this->get_additional_settings());
  }

  // Admin Order
  // ---------------------------------------------------------------------------

  function add_order_billing_data($order) {

    if ($fields = WOOCCM()->field->billing->get_fields('old')) {

      $defaults = WOOCCM()->field->billing->get_defaults();

      foreach ($fields as $field_id => $field) {

        if (!in_array($field['cow'], $defaults)) {

          if ($value = get_post_meta($order->get_id(), sprintf('_billing_%s', $field['cow']), true)) {
            ?>
            <p id="billing_<?php echo esc_attr($field['cow']); ?>" class="form-field form-field-wide form-field-type-<?php echo esc_attr($field['type']); ?>">
              <strong title="<?php echo esc_attr(sprintf(__('ID: %s | Field Type: %s', 'woocommerce-checkout-manager'), sprintf('_billing_%s', $field['cow']), __('Generic', 'woocommerce-checkout-manager'))); ?>">
            <?php echo esc_attr(wooccm_wpml_string(trim($field['label']))); ?>:
              </strong>
              <br />
            <?php echo esc_html($value); ?>
            </p>
              <?php
            }
          }
        }
      }
    }

    function add_order_shipping_data($order) {

      if ($fields = WOOCCM()->field->shipping->get_fields('old')) {

        $defaults = WOOCCM()->field->shipping->get_defaults();

        foreach ($fields as $field_id => $field) {

          if (!in_array($field['cow'], $defaults)) {

            if ($value = get_post_meta($order->get_id(), sprintf('_shipping_%s', $field['cow']), true)) {
              ?>
            <p id="shipping_<?php echo esc_attr($field['cow']); ?>" class="form-field form-field-wide form-field-type-<?php echo esc_attr($field['type']); ?>">
              <strong title="<?php echo esc_attr(sprintf(__('ID: %s | Field Type: %s', 'woocommerce-checkout-manager'), sprintf('_shipping_%s', $field['cow']), __('Generic', 'woocommerce-checkout-manager'))); ?>">
            <?php echo esc_attr(wooccm_wpml_string(trim($field['label']))); ?>:
              </strong>
              <br/>
            <?php echo esc_html($value); ?>
            </p>
              <?php
            }
          }
        }
      }
    }

    function add_order_additional_data($order) {

      if ($fields = WOOCCM()->field->additional->get_fields('old')) {

        $defaults = WOOCCM()->field->additional->get_defaults();

        foreach ($fields as $field_id => $field) {

          if (!in_array($field['cow'], $defaults)) {

            $value = get_post_meta($order->get_id(), sprintf('_%s_%s', 'additional', $field['cow']), true) ? $value : get_post_meta($order->get_id(), sprintf('%s', $field['cow']), true);
            if ($value) {
              ?>
            <p id="additional_<?php echo esc_attr($field['cow']); ?>" class="form-field form-field-wide form-field-type-<?php echo esc_attr($field['type']); ?>">
              <strong title="<?php echo esc_attr(sprintf(__('ID: %s | Field Type: %s', 'woocommerce-checkout-manager'), sprintf('_%s', $field['cow']), __('Generic', 'woocommerce-checkout-manager'))); ?>">
            <?php echo esc_attr(wooccm_wpml_string(trim($field['label']))); ?>:
              </strong>
              <br/>
            <?php echo esc_html($value); ?>
            </p>
              <?php
            }
          }
        }
      }
    }

    // Admin
    // ---------------------------------------------------------------------------

    public function add_section_billing() {

      global $current_section, $wp_roles, $wp_locale;

      if ('billing' == $current_section) {

        $fields = WOOCCM()->field->billing->get_fields();
        $defaults = WOOCCM()->field->billing->get_defaults();
        $types = WOOCCM()->field->billing->get_types();
        $conditionals = WOOCCM()->field->billing->get_conditional_types();
        $multiple = WOOCCM()->field->billing->get_multiple_types();
        $template = WOOCCM()->field->billing->get_template_types();
        $product_categories = $this->get_product_categories();

        include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/billing.php');
      }
    }

    public function add_section_shipping() {

      global $current_section, $wp_roles, $wp_locale;

      if ('shipping' == $current_section) {

        $fields = WOOCCM()->field->shipping->get_fields();
        $defaults = WOOCCM()->field->shipping->get_defaults();
        $types = WOOCCM()->field->shipping->get_types();
        $conditionals = WOOCCM()->field->shipping->get_conditional_types();
        $multiple = WOOCCM()->field->shipping->get_multiple_types();
        $template = WOOCCM()->field->billing->get_template_types();
        $product_categories = $this->get_product_categories();

        include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/shipping.php');
      }
    }

    public function add_section_additional() {

      global $current_section, $wp_roles, $wp_locale;

      if ('additional' == $current_section) {

        $fields = WOOCCM()->field->additional->get_fields();
        $defaults = WOOCCM()->field->additional->get_defaults();
        $types = WOOCCM()->field->additional->get_types();
        $conditionals = WOOCCM()->field->additional->get_conditional_types();
        $multiple = WOOCCM()->field->additional->get_multiple_types();
        $template = WOOCCM()->field->billing->get_template_types();
        $product_categories = $this->get_product_categories();
        $settings = $this->get_additional_settings();

        include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/additional.php');
      }
    }

    function includes() {

      include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-old.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-billing.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-shipping.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-additional.php' );

      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/class-wooccm-fields-register.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/class-wooccm-fields-additional.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/class-wooccm-fields-display.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/class-wooccm-fields-conditional.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/class-wooccm-fields-handler.php' );
      include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/filters.php' );

      $this->billing = WOOCCM_Field_Billing::instance();
      $this->shipping = WOOCCM_Field_Shipping::instance();
      $this->additional = WOOCCM_Field_Additional::instance();
    }

    function init() {

//    global $wooccm_sections;
//
//    $wooccm_sections['billing'] = esc_html__('Billing', 'woocommerce-checkout-manager');
//    $wooccm_sections['shipping'] = esc_html__('Shipping', 'woocommerce-checkout-manager');
//    $wooccm_sections['additional'] = esc_html__('Additional', 'woocommerce-checkout-manager');

      add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
      add_action('wp_ajax_wooccm_load_field', array($this, 'ajax_load_field'));
      add_action('wp_ajax_wooccm_save_field', array($this, 'ajax_save_field'));
      add_action('wp_ajax_wooccm_delete_field', array($this, 'ajax_delete_field'));
      add_action('wp_ajax_wooccm_reset_fields', array($this, 'ajax_reset_fields'));
      add_action('wp_ajax_wooccm_change_field_attribute', array($this, 'ajax_change_field_attribute'));
      add_action('wp_ajax_wooccm_toggle_field_attribute', array($this, 'ajax_toggle_field_attribute'));

      add_action('woocommerce_admin_order_data_after_billing_address', array($this, 'add_order_billing_data'));
      add_action('woocommerce_admin_order_data_after_shipping_address', array($this, 'add_order_shipping_data'));
      add_action('woocommerce_admin_order_data_after_order_details', array($this, 'add_order_additional_data'));

      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_billing'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_shipping'), 99);
      add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_additional'), 99);
      add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_field_order'));
      add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_additional_settings'));
    }

  }
  