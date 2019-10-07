<?php

class WOOCCM_Field_Controller {

  public $billing;
  public $shipping;
  public $additional;

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

  public function ajax_toggle_field_attribute() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_REQUEST['field_id']) && isset($_REQUEST['field_attr'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));
      $attr = wc_clean(wp_unslash($_REQUEST['field_attr']));

      $status = $this->toggle_field_attribute($field_id, $attr);

      wp_send_json_success($status);
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_change_field_attribute() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_REQUEST['field_id']) && isset($_REQUEST['field_attr']) && isset($_REQUEST['field_value'])) {

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

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_REQUEST['field_data'])) {

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

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_REQUEST['field_id'])) {

      $field_id = wc_clean(wp_unslash($_REQUEST['field_id']));

      if ($this->delete_field($field_id)) {

        wp_send_json_success($field_id);
      }
    }

    wp_send_json_error(esc_html__('Unknow error', 'woocommerce-checkout-manager'));
  }

  public function ajax_load_field() {

    if (current_user_can('manage_woocommerce') && check_ajax_referer('wooccm_admin', 'nonce') && isset($_REQUEST['field_id'])) {

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

          $field_data = array($attr => !@$field[$attr]);

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

  function save_section_billing() {

    global $current_section;

    if ($current_section) {

      $section = wc_clean(wp_unslash($current_section));

      //error_log($current_section);

      if (array_key_exists('field_order', $_POST)) {

        $field_order = wc_clean(wp_unslash($_POST['field_order']));

        if (is_array($field_order) && count($field_order) > 0) {

          if (isset(WOOCCM()->field->$section)) {

            $fields = WOOCCM()->field->$section->get_fields();

            $loop = 1;

            foreach ($field_order as $gateway_id) {

              if (isset($fields[$gateway_id])) {

                $fields[$gateway_id]['order'] = $loop;

                $loop++;
              }
            }

            WOOCCM()->field->$section->update_fields($fields);
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
      $product_categories = $this->get_product_categories();

      include_once(WOOCCM_PLUGIN_DIR . 'new/view/backend/pages/additional.php');
    }
  }

  function includes() {

    include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-old.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-billing.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-shipping.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/model/class-wooccm-field-additional.php' );

    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/register.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/additional.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/display.php' );
    //include_once( WOOCCM_PLUGIN_DIR . 'includes/templates/functions/additional_display.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/conditional.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/handler.php' );
    include_once( WOOCCM_PLUGIN_DIR . 'new/view/frontend/fields/filters.php' );

    //$this->field = new WOOCCM_Field();
    $this->billing = new WOOCCM_Field_Billing();
    $this->shipping = new WOOCCM_Field_Shipping();
    $this->additional = new WOOCCM_Field_Additional();
  }

  function init() {
    add_action('wp_ajax_wooccm_select_search_products', array($this, 'ajax_select_search_products'));
    add_action('wp_ajax_wooccm_load_field', array($this, 'ajax_load_field'));
    add_action('wp_ajax_wooccm_save_field', array($this, 'ajax_save_field'));
    add_action('wp_ajax_wooccm_delete_field', array($this, 'ajax_delete_field'));
    add_action('wp_ajax_wooccm_change_field_attribute', array($this, 'ajax_change_field_attribute'));
    add_action('wp_ajax_wooccm_toggle_field_attribute', array($this, 'ajax_toggle_field_attribute'));

    add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_billing'), 99);
    add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_shipping'), 99);
    add_action('woocommerce_sections_' . WOOCCM_PREFIX, array($this, 'add_section_additional'), 99);
    add_action('woocommerce_settings_save_' . WOOCCM_PREFIX, array($this, 'save_section_billing'));
  }

  public function __construct() {
    $this->includes();
    $this->init();
  }

}
