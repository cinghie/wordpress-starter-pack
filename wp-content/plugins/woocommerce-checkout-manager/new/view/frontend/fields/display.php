<?php

if (!class_exists('WOOCCM_Fields_Display')) {

  class WOOCCM_Fields_Display {

    protected static $instance;

    function disable_by_role($field, $key) {

      global $current_user;

      $user_roles = $current_user->roles;

      $user_role = array_shift($user_roles);

      if (/* !empty($field['user_role']) && */(!empty($field['role_options']) || !empty($field['role_options2']))) {

        $rolekeys = explode('||', $field['role_options']);

        $rolekeys2 = explode('||', $field['role_options2']);
        
        //error_log(json_encode($rolekeys));

        if (!empty($field['role_options']) && !in_array($user_role, $rolekeys)) {
          $field['disabled'] = true;
        }

        if (!empty($field['role_options2']) && in_array($user_role, $rolekeys2)) {
          $field['disabled'] = true;
        }
      }

      return $field;
    }

    function disable_by_category($field, $key) {

      if (empty($field['disabled']) && (!empty($field['single_p_cat']) || !empty($field['single_px_cat']))) {

        if (count($cart_contents = WC()->cart->get_cart_contents())) {

          $hide_cats_array = (array) explode(',', @$field['single_p_cat']);

          $show_cats_array = (array) explode('||', @$field['single_px_cat']);

          $product_cats = array();

          foreach ($cart_contents as $key => $values) {
            if ($cats = wp_get_post_terms($values['product_id'], 'product_cat', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'slugs'))) {
              $product_cats += $cats;
            }
          }

          // field without more
          // -------------------------------------------------------------------
          if (empty($field['more_content']) && count($cart_contents) < 2) {
            // hide field
            // -----------------------------------------------------------------
            if (!empty($field['single_p_cat'])) {
              if (array_intersect($product_cats, $hide_cats_array)) {
                $field['disabled'] = true;
              }
            }

            // show field
            // -----------------------------------------------------------------
            if (!empty($field['single_px_cat'])) {
              if (array_intersect($product_cats, $show_cats_array)) {
                $field['disabled'] = false;
              } else {
                $field['disabled'] = true;
              }
            }
          }

          // field with more
          // -------------------------------------------------------------------
          if (!empty($field['more_content'])) {

            // hide field
            // -------------------------------------------------------------
            if (!empty($field['single_p_cat'])) {
              if (array_intersect($product_cats, $hide_cats_array)) {
                $field['disabled'] = true;
              }
            }

            // show field
            // ---------------------------------------------------------------
            if (!empty($field['single_px_cat'])) {
              if (array_intersect($product_cats, $show_cats_array)) {
                $field['disabled'] = false;
              } else {
                //error_log('disabled 4');
                $field['disabled'] = true;
              }
            }
          }
        }
      }

      return $field;
    }

    function disable_by_product($field, $key) {

      if (empty($field['disabled']) && (!empty($field['single_p']) || !empty($field['single_px']))) {

        if (count($cart_contents = WC()->cart->get_cart_contents())) {

          $hide_ids_array = (array) explode(',', @$field['single_p']);

          $show_ids_array = (array) explode('||', @$field['single_px']);

          $product_ids = array_column($cart_contents, 'product_id');

          // field without more
          // -------------------------------------------------------------------
          if (empty($field['more_content']) && count($cart_contents) < 2) {
            // hide field
            // -----------------------------------------------------------------
            if (!empty($field['single_p'])) {
              if (array_intersect($product_ids, $hide_ids_array)) {
                $field['disabled'] = true;
              }
            }

            // show field
            // -----------------------------------------------------------------
            if (!empty($field['single_px'])) {
              if (array_intersect($product_ids, $show_ids_array)) {
                $field['disabled'] = false;
              } else {
                $field['disabled'] = true;
              }
            }
          }

          // field with more
          // -------------------------------------------------------------------
          if (!empty($field['more_content'])) {

            // hide field
            // -------------------------------------------------------------
            if (!empty($field['single_p'])) {
              if (array_intersect($product_ids, $hide_ids_array)) {
                $field['disabled'] = true;
              }
            }

            // show field
            // ---------------------------------------------------------------
            if (!empty($field['single_px'])) {
              if (array_intersect($product_ids, $show_ids_array)) {
                $field['disabled'] = false;
              } else {
                //error_log('disabled 4');
                $field['disabled'] = true;
              }
            }
          }
        }
      }

      return $field;
    }

    function init() {

      // Remove by product
      add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_product'), 10, 2);

      // Remove by category
      add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_category'), 10, 2);

      // Remove by role
      add_filter('wooccm_checkout_field_filter', array($this, 'disable_by_role'), 10, 2);
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  WOOCCM_Fields_Display::instance();
}
