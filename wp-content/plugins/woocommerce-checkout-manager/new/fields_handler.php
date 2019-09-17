<?php

if (!class_exists('WOOCCM_Fields_Handler')) {

  class WOOCCM_Fields_Handler {

    protected static $instance;
    protected static $i = 0;

    function remove_by_category($field, $key) {

      if (empty($field['disabled'])) {

        if (count($cart_contents = WC()->cart->get_cart_contents())) {

          $categoryarraycm = array();

          $multiproductsx_cat = ( isset($field['single_p_cat']) ? $field['single_p_cat'] : '' );
          $show_field_single_cat = ( isset($field['single_px_cat']) ? $field['single_px_cat'] : '' );

          $show_field_array_cat = explode('||', $show_field_single_cat);

          $multiarrayproductsx_cat = explode(',', $multiproductsx_cat);

          foreach ($cart_contents as $key => $values) {

            // hide field
            // -----------------------------------------------------------------
            if (!empty($terms = get_the_terms($values['product_id'], 'product_cat'))) {

              foreach ($terms as $term) {

                $categoryarraycm[] = $term->slug;

                // hide field without more
                // -------------------------------------------------------------
                if (!empty($field['single_p_cat']) && empty($field['more_content'])) {

                  if (in_array($term->slug, $multiarrayproductsx_cat) && ( count($cart_contents) < 2 )) {
                    $field['disabled'] = true;
                  }
                }

                // show field without more
                // -------------------------------------------------------------
                if (!empty($field['single_px_cat']) && empty($field['more_content'])) {

                  if (in_array($term->slug, $show_field_array_cat) && ( count($cart_contents) < 2 )) {
                    $field['disabled'] = false;
                  }

                  if (!in_array($term->slug, $show_field_array_cat) && ( count($cart_contents) < 2 )) {
                    $field['disabled'] = true;
                  }
                }
              }

              // hide field with more
              // ---------------------------------------------------------------
              if (!empty($btn['single_p_cat']) && !empty($btn['more_content'])) {

                //$multiarrayproductsx_cat = explode(',', $multiproductsx_cat);

                if (array_intersect($categoryarraycm, $multiarrayproductsx_cat)) {
                  $field['disabled'] = true;
                }
              }

              // show field with more
              // ---------------------------------------------------------------
              if (!empty($btn['single_px_cat']) && !empty($btn['more_content'])) {

                //$show_field_array_cat = explode('||', $show_field_single_cat);

                if (array_intersect($categoryarraycm, $show_field_array_cat)) {
                  $field['disabled'] = false;
                }

                if (!array_intersect($categoryarraycm, $show_field_array_cat)) {
                  $field['disabled'] = true;
                }
              }
            }
          }
        }
      }

      return $field;
    }

    function remove_checkout_fields($fields) {

      global $current_user;

      $user_roles = $current_user->roles;

      $user_role = array_shift($user_roles);

      foreach ($fields as $key => $type) {

        foreach ($type as $id => $field) {

          //var_dump($field);
          // Remove disabled
          // -------------------------------------------------------------------
          if (!empty($field['disabled'])) {
            unset($fields[$key][$id]);
          }
          // Remove based on roles
          // -------------------------------------------------------------------

          if (!empty($field['user_role']) && (!empty($field['role_options']) || !empty($field['role_options2']))) {

            $rolekeys = explode('||', $field['role_options']);

            $rolekeys2 = explode('||', $field['role_options2']);

            if (!empty($field['role_options']) && !in_array($user_role, $rolekeys)) {
              unset($fields[$key][$id]);
            }

            if (!empty($field['role_options2']) && in_array($user_role, $rolekeys2)) {
              unset($fields[$key][$id]);
            }
          }
        }
      }

      // Fix for required address field
      if (get_option('woocommerce_ship_to_destination') == 'billing_only') {
        unset($fields['shipping']);
      }

      return $fields;
    }

    function woocommerce_checkout_address_2_field($option) {
      return 'required';
    }

    function remove_fields_priority($fields) {

      foreach ($fields as $key => $field) {
        unset($fields[$key]['priority']);
      }

      return $fields;
    }

    function remove_address_fields($data) {

      $remove = array(
          'shipping_country',
          'shipping_address_1',
          'shipping_city',
          'shipping_state',
          'shipping_postcode'
      );

      foreach ($remove as $key) {
        if (empty($data[$key])) {
          unset($data[$key]);
        }
      }

      return $data;
    }

    function init() {

      // Remove by category
      add_filter('wooccm_checkout_field_filter', array($this, 'remove_by_category'), 10, 2);

      // Remove fields
      // -----------------------------------------------------------------------
      add_filter('woocommerce_checkout_fields', array($this, 'remove_checkout_fields'));

      // Fix address_2 field
      // -----------------------------------------------------------------------
      add_filter('default_option_woocommerce_checkout_address_2_field', array($this, 'woocommerce_checkout_address_2_field'));

      // Fix address fields priority
      add_filter('woocommerce_get_country_locale_default', array($this, 'remove_fields_priority'));

      // Fix required country notice when shipping address is activated
      // -----------------------------------------------------------------------
      add_filter('woocommerce_checkout_posted_data', array($this, 'remove_address_fields'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Handler::instance();
}
