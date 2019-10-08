<?php
/**
 * WooCommerce Checkout Manager
 *
 * MAIN
 *
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
  exit;

if (wooccm_enable_auto_complete()) {

  function wooccm_retain_field_values() {

    $options = get_option('wccs_settings');
    $options2 = get_option('wccs_settings2');
    $options3 = get_option('wccs_settings3');

    if (is_checkout() == false)
      return;

    $saved = WC()->session->get('wooccm_retain', array());
    ?>

    <script type="text/javascript">

      jQuery(document).ready(function () {
        window.onload = function () {

    <?php
    if (!empty($options['buttons'])) {
      foreach ($options['buttons'] as $btn) {
        if (
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading' &&
                $btn['disabled'] !== 'true' &&
                empty($btn['tax_remove']) &&
                empty($btn['add_amount'])
        ) {
          ?>
                document.forms['checkout'].elements['<?php echo $btn['cow']; ?>'].value = "<?php echo $saved[$btn['cow']]; ?>";
          <?php
        }
      }
    }

    if (!is_user_logged_in()) {

      if (WC()->cart->needs_shipping_address() === true && sanitize_text_field($_POST['ship_to_different_address']) == 1) {

        if (!empty($options2['shipping_buttons'])) {
          foreach ($options2['shipping_buttons'] as $btn) {
            if (
                    $btn['type'] !== 'wooccmupload' &&
                    $btn['type'] !== 'changename' &&
                    $btn['type'] !== 'heading' &&
                    $btn['disabled'] !== 'true' &&
                    empty($btn['tax_remove']) &&
                    empty($btn['add_amount'])
            ) {
              ?>
                    document.forms['checkout'].elements['shipping_<?php echo $btn['cow']; ?>'].value = "<?php echo $saved[sprintf('shipping_%s', $btn['cow'])]; ?>";
              <?php
            }
          }
        }
      }

      if (!empty($options3['billing_buttons'])) {
        foreach ($options3['billing_buttons'] as $btn) {
          if (
                  $btn['type'] !== 'wooccmupload' &&
                  $btn['type'] !== 'changename' &&
                  $btn['type'] !== 'heading' &&
                  $btn['disabled'] !== 'true' &&
                  empty($btn['tax_remove']) &&
                  empty($btn['add_amount'])
          ) {
            ?>
                  document.forms['checkout'].elements['billing_<?php echo $btn['cow']; ?>'].value = "<?php echo $saved[sprintf('billing_%s', $btn['cow'])]; ?>";
            <?php
          }
        }
      }
    }
    ?>

        }
      });
    </script>

    <script type="text/javascript">

      jQuery(document).ready(function() {
      jQuery('body').change(function() {

      var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
              data = { action: 'retain_val_wccs',
    <?php
    if (!empty($options['buttons'])) {
      foreach ($options['buttons'] as $btn) {
        if (
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading' &&
                empty($btn['tax_remove']) &&
                empty($btn['add_amount'])
        ) {
          ?>
          <?php echo $btn['cow']; ?>: jQuery("#<?php echo $btn['cow']; ?>").val(),
          <?php
        }
      }
    }

    if (!is_user_logged_in()) {

      if (WC()->cart->needs_shipping_address() === true && sanitize_text_field($_POST['ship_to_different_address']) == 1) {

        if (!empty($options2['shipping_buttons'])) {
          foreach ($options2['shipping_buttons'] as $btn) {
            if (
                    $btn['type'] !== 'wooccmupload' &&
                    $btn['type'] !== 'changename' &&
                    $btn['type'] !== 'heading' &&
                    empty($btn['tax_remove']) &&
                    empty($btn['add_amount'])
            ) {
              ?>
                        shipping_<?php echo $btn['cow']; ?>: jQuery("shipping_<?php echo $btn['cow']; ?>").val(),
              <?php
            }
          }
        }
      }

      if (!empty($options3['billing_buttons'])) {
        foreach ($options3['billing_buttons'] as $btn) {
          if (
                  $btn['type'] !== 'wooccmupload' &&
                  $btn['type'] !== 'changename' &&
                  $btn['type'] !== 'heading' &&
                  empty($btn['tax_remove']) &&
                  empty($btn['add_amount'])
          ) {
            ?>
                      billing_<?php echo $btn['cow']; ?>: jQuery("#billing_<?php echo $btn['cow']; ?>").val(),
            <?php
          }
        }
      }
    }
    ?>
              };
              jQuery.post(ajaxurl, data, function(response) { });
              return false;
      });
      });

    </script>

    <?php
  }

  function wooccm_retain_val_callback() {

    global $wpdb;

    $options = get_option('wccs_settings');
    $options2 = get_option('wccs_settings2');
    $options3 = get_option('wccs_settings3');

    if (!empty($options['buttons'])) {
      foreach ($options['buttons'] as $btn) {
        if (
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading' &&
                empty($btn['tax_remove']) &&
                empty($btn['add_amount'])
        ) {
          if (!empty($_POST[$btn['cow']])) {
            $saved[$btn['cow']] = sanitize_text_field($_POST[$btn['cow']]);
          }
        }
      }
    }

    if (WC()->cart->needs_shipping_address() === true && sanitize_text_field($_POST['ship_to_different_address']) == 1) {
      if (!empty($options2['shipping_buttons'])) {
        foreach ($options2['shipping_buttons'] as $btn) {
          if (
                  $btn['type'] !== 'wooccmupload' &&
                  $btn['type'] !== 'changename' &&
                  $btn['type'] !== 'heading' &&
                  empty($btn['tax_remove']) &&
                  empty($btn['add_amount'])
          ) {
            if (!empty($_POST[sprintf('shipping_%s', $btn['cow'])])) {
              $saved[sprintf('shipping_%s', $btn['cow'])] = sanitize_text_field($_POST[sprintf('shipping_%s', $btn['cow'])]);
            }
          }
        }
      }
    }

    if (!empty($options3['billing_buttons'])) {
      foreach ($options3['billing_buttons'] as $btn) {
        if (
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading' &&
                empty($btn['tax_remove']) &&
                empty($btn['add_amount'])
        ) {
          if (!empty($_POST[sprintf('billing_%s', $btn['cow'])])) {
            $saved[sprintf('billing_%s', $btn['cow'])] = sanitize_text_field($_POST[sprintf('billing_%s', $btn['cow'])]);
          }
        }
      }
    }

    WC()->session->set('wooccm_retain', $saved);

    die();
  }

  add_action('wp_ajax_retain_val_wccs', 'wooccm_retain_val_callback');
  add_action('wp_ajax_nopriv_retain_val_wccs', 'wooccm_retain_val_callback');
}

function wooccm_enable_auto_complete() {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['retainval'])) {
    return true;
  } else {
    return false;
  }
}

function wooccm_state_default_switch() {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['per_state']) && !empty($options['checkness']['per_state_check'])) {
    return $options['checkness']['per_state'];
  }
}

function wooccm_woocommerce_delivery_notes_compat($fields, $order) {

  if (version_compare(wooccm_get_woo_version(), '2.7', '>=')) {
    $order_id = ( method_exists($order, 'get_id') ? $order->get_id() : $order->id );
  } else {
    $order_id = ( isset($order->id) ? $order->id : 0 );
  }

  $new_fields = array();

  $shipping = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode'
  );
  $billing = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode',
      'email',
      'phone'
  );

  $names = array(
      'billing',
      'shipping'
  );
  $inc = 3;
  foreach ($names as $name) {

    $array = ( $name == 'billing' ) ? $billing : $shipping;

    $options = get_option('wccs_settings' . $inc);
    if (!empty($options[$name . '_buttons'])) {
      foreach ($options[$name . '_buttons'] as $btn) {

        if (!in_array($btn['cow'], $array)) {

          if (
                  get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) &&
                  $btn['type'] !== 'wooccmupload' &&
                  $btn['type'] !== 'heading' &&
                  (
                  $btn['type'] !== 'multiselect' || $btn['type'] !== 'multicheckbox'
                  )
          ) {
            $new_fields[sprintf('_%s_%s', $name, $btn['cow'])] = array(
                'label' => wooccm_wpml_string($btn['label']),
                'value' => get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true)
            );
          }

          if (
                  get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) &&
                  $btn['type'] !== 'wooccmupload' &&
                  $btn['type'] !== 'heading' &&
                  (
                  $btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox'
                  )
          ) {
            $new_fields[sprintf('_%s_%s', $name, $btn['cow'])]['label'] = wooccm_wpml_string($btn['label']);
            $new_fields[sprintf('_%s_%s', $name, $btn['cow'])]['value'] = '';
            $value = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
            $strings = maybe_unserialize($value);
            if (!empty($strings)) {
              if (is_array($strings)) {
                $iww = 0;
                $len = count($strings);
                foreach ($strings as $key) {
                  if ($iww == $len - 1) {
                    $new_fields[sprintf('_%s_%s', $name, $btn['cow'])]['value'] .= $key;
                  } else {
                    $new_fields[sprintf('_%s_%s', $name, $btn['cow'])]['value'] .= $key . ', ';
                  }
                  $iww++;
                }
              } else {
                echo $strings;
              }
            } else {
              echo '-';
            }
          } elseif ($btn['type'] == 'wooccmupload') {
            $info = explode("||", get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true));
            $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
            $new_fields[sprintf('_%s_%s', $name, $btn['cow'])] = array(
                'label' => wooccm_wpml_string(trim($btn['label'])),
                'value' => $info[0]
            );
          }
        }
      }
    }
    $inc--;
  }

  $options = get_option('wccs_settings');
  if (!empty($options['buttons'])) {
    foreach ($options['buttons'] as $btn) {

      if (
              get_post_meta($order_id, $btn['cow'], true) &&
              $btn['type'] !== 'wooccmupload' &&
              $btn['type'] !== 'heading' &&
              (
              $btn['type'] !== 'multiselect' || $btn['type'] !== 'multicheckbox'
              )
      ) {
        $new_fields[$btn['cow']] = array(
            'label' => wooccm_wpml_string($btn['label']),
            'value' => get_post_meta($order_id, $btn['cow'], true)
        );
      }

      if (
              get_post_meta($order_id, $btn['cow'], true) &&
              $btn['type'] !== 'wooccmupload' &&
              $btn['type'] !== 'heading' &&
              (
              $btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox'
              )
      ) {
        $new_fields[$btn['cow']]['label'] = wooccm_wpml_string($btn['label']);
        $new_fields[$btn['cow']]['value'] = '';
        $value = get_post_meta($order_id, $btn['cow'], true);
        $strings = maybe_unserialize($value);
        if (!empty($strings)) {
          if (is_array($strings)) {
            $iww = 0;
            $len = count($strings);
            foreach ($strings as $key) {
              if ($iww == $len - 1) {
                $new_fields[$btn['cow']]['value'] .= $key;
              } else {
                $new_fields[$btn['cow']]['value'] .= $key . ', ';
              }
              $iww++;
            }
          } else {
            echo $strings;
          }
        } else {
          echo '-';
        }
      }

      if ($btn['type'] == 'wooccmupload') {
        $info = get_post_meta($order_id, $btn['cow'], true);
        $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
        $new_fields[$btn['cow']] = array(
            'label' => wooccm_wpml_string(trim($btn['label'])),
            'value' => $info[0]
        );
      }
    }
  }

  return array_merge($fields, $new_fields);
}

function wooccm_order_notes($fields = array()) {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['noteslabel'])) {
    $fields['order']['order_comments']['label'] = $options['checkness']['noteslabel'];
  }
  if (!empty($options['checkness']['notesplaceholder'])) {
    $fields['order']['order_comments']['placeholder'] = $options['checkness']['notesplaceholder'];
  }
  if (!empty($options['checkness']['notesenable'])) {
    unset($fields['order']['order_comments']);
  }

  return $fields;
}

function woooccm_restrict_manage_posts() {

  $options = get_option('wccs_settings');
  $options2 = get_option('wccs_settings2');
  $options3 = get_option('wccs_settings3');

  $billing = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode',
      'email',
      'phone'
  );
  $shipping = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode'
  );

  $post_type = 'shop_order';
  if (get_current_screen()->post_type == $post_type) {

    $values = array();
    if (!empty($options['buttons'])) {
      foreach ($options['buttons'] as $name) {
        $values[$name['label']] = $name['cow'];
      }
    }
    if (!empty($values)) {
      array_unique($values);
    }

    $values2 = array();
    if (!empty($options2['shipping_buttons'])) {
      foreach ($options2['shipping_buttons'] as $name) {
        if (!in_array($name['cow'], $shipping)) {
          $values2['Shipping ' . $name['label']] = sprintf('_shipping_%s', $name['cow']);
        }
      }
    }
    if (!empty($values2)) {
      array_unique($values2);
    }

    $values3 = array();
    if (!empty($options3['billing_buttons'])) {
      foreach ($options3['billing_buttons'] as $name) {
        if (!in_array($name['cow'], $billing)) {
          $values3['Billing ' . $name['label']] = sprintf('_billing_%s', $name['cow']);
        }
      }
    }
    if (!empty($values3)) {
      array_unique($values3);
    }

    if (!empty($values) && !empty($values2) && !empty($values3)) {
      $values = array_merge($values, $values2);
      $values = array_merge($values, $values3);
    } elseif (!empty($values) && !empty($values2) && empty($values3)) {
      $values = array_merge($values, $values2);
    } elseif (!empty($values) && empty($values2) && !empty($values3)) {
      $values = array_merge($values, $values3);
    } elseif (empty($values) && !empty($values2) && !empty($values3)) {
      $values = array_merge($values2, $values3);
    } elseif (empty($values) && empty($values2) && !empty($values3)) {
      $values = $values3;
    } elseif (empty($values) && !empty($values2) && empty($values3)) {
      $values = $values2;
    } elseif (!empty($values) && empty($values2) && empty($values3)) {
      $values = $values;
    }
    ?>
    <select name="wooccm_abbreviation">
      <?php if (empty($values) && empty($values2) && empty($values3)) { ?>
        <option value=""><?php _e('No Added Fields', 'woocommerce-checkout-manager'); ?></option>
      <?php } else { ?>
        <option value=""><?php _e('Field Name', 'woocommerce-checkout-manager'); ?></option>
      <?php } ?>
      <?php
      $current_v = ( isset($_GET['wooccm_abbreviation']) ? sanitize_text_field($_GET['wooccm_abbreviation']) : '' );
      if (!empty($values)) {
        foreach ($values as $label => $value) {
          printf(
                  '<option value="%s"%s>%s</option>', $value, $value == $current_v ? ' selected="selected"' : '', $label
          );
        }
      }
      ?>
    </select>
    <?php
  }
}

function wooccm_query_list($query) {

  global $pagenow;

  $wooccm_abbreviation = ( isset($_GET['wooccm_abbreviation']) ? sanitize_text_field($_GET['wooccm_abbreviation']) : '' );
  if (is_admin() && $pagenow == 'edit.php' && $wooccm_abbreviation != '') {
    $query->query_vars['meta_key'] = $wooccm_abbreviation;
  }
}

// ========================================
// Remove conditional notices
// ========================================

function wooccm_remove_notices_conditional($posted) {

  $notice = WC()->session->get('wc_notices');

  $shipping = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode'
  );
  $billing = array(
      'country',
      'first_name',
      'last_name',
      'company',
      'address_1',
      'address_2',
      'city',
      'state',
      'postcode',
      'email',
      'phone'
  );

  $options = get_option('wccs_settings');
  $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );

  $names = array(
      'billing',
      'shipping'
  );
  $inc = 3;
  foreach ($names as $name) {

    $array = ( $name == 'billing' ) ? $billing : $shipping;

    $options2 = get_option('wccs_settings' . $inc);
    if (!empty($options2[$name . '_buttons'])) {
      foreach ($options2[$name . '_buttons'] as $btn) {

        if (
                !empty($btn['chosen_valt']) &&
                !empty($btn['conditional_parent_use']) &&
                !empty($btn['conditional_tie']) &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading' &&
                !empty($btn['conditional_parent'])
        ) {
          if (!empty($_POST[$btn['cow']])) {
            foreach ($buttons as $btn2) {

              if (
                      !empty($btn2['chosen_valt']) &&
                      !empty($btn2['conditional_parent_use']) &&
                      !empty($btn2['conditional_tie']) &&
                      $btn2['type'] !== 'changename' &&
                      $btn2['type'] !== 'heading' &&
                      empty($btn2['conditional_parent'])
              ) {
                if (sanitize_text_field($_POST[$btn['cow']]) != $btn2['chosen_valt']) {
                  if (empty($_POST[$btn2['cow']])) {
                    foreach ($notice['error'] as $position => $value) {

                      if (strip_tags($value) == sprintf(__('%s is a required field.', 'woocommerce'), wooccm_wpml_string($btn2['label']))) {
                        unset($notice['error'][$position]);
                      }
                    }
                  }
                }
              }
            }
          } else {
            foreach ($notice['error'] as $position => $value) {

              if (strip_tags($value) == sprintf(__('%s is a required field.', 'woocommerce'), wooccm_wpml_string($btn2['label']))) {
                unset($notice['error'][$position]);
              }
            }
          }
        }
      }
    }
    $inc--;
  }

  $options = get_option('wccs_settings');

  global $woocommerce;

  if (!empty($options['buttons'])) {
    foreach ($options['buttons'] as $btn) {

      if (!empty($btn['chosen_valt']) && !empty($btn['conditional_parent_use']) && !empty($btn['conditional_tie']) && $btn['type'] !== 'changename' && ($btn['type'] !== 'heading') && !empty($btn['conditional_parent'])) {

        if (!empty($_POST[$btn['cow']])) {

          foreach ($options['buttons'] as $btn2) {

            if (!empty($btn2['chosen_valt']) && !empty($btn2['conditional_parent_use']) && !empty($btn2['conditional_tie']) && $btn2['type'] !== 'changename' && ($btn2['type'] !== 'heading') && empty($btn2['conditional_parent'])) {
              if (sanitize_text_field($_POST[$btn['cow']]) != $btn2['chosen_valt']) {
                if (empty($_POST[$btn2['cow']])) {
                  foreach ($notice['error'] as $position => $value) {

                    if (strip_tags($value) == sprintf(__('%s is a required field.', 'woocommerce'), wooccm_wpml_string($btn2['label']))) {
                      unset($notice['error'][$position]);
                    }
                  }
                }
              }
            }
          }
        } else {

          foreach ($notice['error'] as $position => $value) {

            if (strip_tags($value) == sprintf(__('%s is a required field.', 'woocommerce'), wooccm_wpml_string($btn2['label']))) {
              unset($notice['error'][$position]);
            }
          }
        }
      }
    }
  }

  WC()->session->set('wc_notices', $notice);
}

add_action('woocommerce_after_checkout_validation', 'wooccm_remove_notices_conditional');