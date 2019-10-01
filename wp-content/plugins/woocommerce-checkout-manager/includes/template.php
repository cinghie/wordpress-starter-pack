<?php
// @mod - Change to thank you page to catch all Order Status
// add_action( 'woocommerce_order_status_completed', 'wooccm_update_attachment_ids' );
// Checkout - Order Received
function wooccm_order_received_checkout_details($order) {

  if (version_compare(wooccm_get_woo_version(), '2.7', '>='))
    $order_id = ( method_exists($order, 'get_id') ? $order->get_id() : $order->id );
  else
    $order_id = ( isset($order->id) ? $order->id : 0 );

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

  $show_table = apply_filters('wooccm_order_received_checkout_show_table', ( defined('WOOCOMMERCE_VERSION') && version_compare(WOOCOMMERCE_VERSION, '2.3', '>=')));
  $print_table = apply_filters('wooccm_order_received_checkout_print_table', true);

  // Check if above WooCommerce 2.3+
  if ($show_table) {

    if ($print_table) {
      echo '<table class="wccs_custom_fields shop_table">';
    }

    foreach ($names as $name) {

      $array = ( $name == 'billing' ) ? $billing : $shipping;

      $options = get_option('wccs_settings' . $inc);
      if (!empty($options[sprintf('%s_buttons', $name)])) {
        foreach ($options[sprintf('%s_buttons', $name)] as $btn) {

          if (!in_array($btn['cow'], $array)) {
            if (
                    ( get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) !== '' ) &&
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'heading' &&
                    $btn['type'] !== 'wooccmupload' &&
                    $btn['type'] !== 'multiselect' &&
                    $btn['type'] !== 'multicheckbox'
            ) {
              echo '
<tr>
	<th>' . wooccm_wpml_string($btn['label']) . ':</th>
	<td>' . nl2br(get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true)) . '</td>
</tr>';
            } elseif (
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'multiselect' &&
                    $btn['type'] !== 'multicheckbox' &&
                    $btn['type'] == 'heading'
            ) {
              echo '
<tr>
	<th colspan="2">' . wooccm_wpml_string($btn['label']) . '</th>
</tr>';
            } elseif (
                    ( get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) !== '') &&
                    $btn['type'] !== 'wooccmupload' &&
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'heading' &&
                    (
                    ( $btn['type'] == 'multiselect' ) || ( $btn['type'] == 'multicheckbox' )
                    )
            ) {
              $value = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
              $strings = maybe_unserialize($value);
              echo '
<tr>
	<th>' . wooccm_wpml_string($btn['label']) . ':</th>
	<td data-title="' . wooccm_wpml_string($btn['label']) . '">';
              if (!empty($strings)) {
                if (is_array($strings)) {
                  foreach ($strings as $key) {
                    echo wooccm_wpml_string($key) . ', ';
                  }
                } else {
                  echo $strings;
                }
              } else {
                echo '-';
              }
              echo '
	</td>
</tr>';
            } elseif ($btn['type'] == 'wooccmupload') {
              $info = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
              if (!empty($info)) {
                // Check for delimiter
                if (strstr($info, '||') !== false)
                  $info = explode('||', $info);
                else if (strstr($info, ',') !== false)
                  $info = explode(',', $info);
                else if (is_numeric($info))
                  $info = array($info);
                if (is_array($info)) {
                  $num_files = count($info);
                  if (!empty($num_files))
                    $info = sprintf(_n('%s file', '%s files', $num_files, 'woocommerce-checkout-manager'), number_format_i18n($num_files));
                  else
                    $info = '-';
                } else {
                  $info = '-';
                }
              } else {
                $info = '-';
              }

              $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
              echo '
<tr>
	<th>' . wooccm_wpml_string(trim($btn['label'])) . ':</th>
	<td>' . $info . '</td>
</tr>';
            }
          }
        }
      }
      $inc--;
    }

    $options = get_option('wccs_settings');
    $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );
    if (!empty($buttons)) {
      foreach ($buttons as $btn) {

        if (
                ( get_post_meta($order_id, $btn['cow'], true) !== '' ) &&
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'heading' &&
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'multiselect' &&
                $btn['type'] !== 'multicheckbox'
        ) {
          $value = get_post_meta($order_id, $btn['cow'], true);
          if ($value == '1')
            $value = __('Yes', 'woocommerce-checkout-manager');
          else if ($value == '0')
            $value = __('No', 'woocommerce-checkout-manager');
          echo '
<tr>
	<th>' . wooccm_wpml_string($btn['label']) . ':</th>
	<td data-title="' . wooccm_wpml_string($btn['label']) . '">' . nl2br($value) . '</td>
</tr>';
        } elseif (
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'multiselect' &&
                $btn['type'] !== 'multicheckbox' &&
                $btn['type'] == 'heading'
        ) {
          echo '
<tr>
	<th colspan="2">' . wooccm_wpml_string($btn['label']) . '</th>
</tr>';
        } elseif (
                ( get_post_meta($order_id, $btn['cow'], true) !== '' ) &&
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'heading' &&
                $btn['type'] !== 'wooccmupload' &&
                (
                $btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox'
                )
        ) {
          $value = get_post_meta($order_id, $btn['cow'], true);
          $strings = maybe_unserialize($value);
          echo '
<tr>
	<th>' . wooccm_wpml_string($btn['label']) . ':</th>
	<td data-title="' . wooccm_wpml_string($btn['label']) . '">';
          if (!empty($strings)) {
            if (is_array($strings)) {
              foreach ($strings as $key) {
                echo wooccm_wpml_string($key) . ', ';
              }
            } else {
              echo $strings;
            }
          } else {
            echo '-';
          }
          echo '
	</td>
</tr>';
        } elseif ($btn['type'] == 'wooccmupload') {
          $info = get_post_meta($order_id, $btn['cow'], true);
          if (!empty($info)) {
            // Check for delimiter
            if (strstr($info, '||') !== false)
              $info = explode('||', $info);
            else if (strstr($info, ',') !== false)
              $info = explode(',', $info);
            else if (is_numeric($info))
              $info = array($info);
            if (is_array($info)) {
              $num_files = count($info);
              if (!empty($num_files))
                $info = sprintf(_n('%s file', '%s files', $num_files, 'woocommerce-checkout-manager'), number_format_i18n($num_files));
              else
                $info = '-';
            } else {
              $info = '-';
            }
          } else {
            $info = '-';
          }

          $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
          echo '
<tr>
	<th>' . wooccm_wpml_string(trim($btn['label'])) . ':</th>
	<td data-title="' . wooccm_wpml_string(trim($btn['label'])) . '">' . $info . '</td>
</tr>';
        }
      }
    }

    if ($print_table) {
      echo '</table>';
      echo '<!-- .wccs_custom_fields -->';
    }
  } else {

    // @mod - Legacy support below WooCommerce 2.3
    echo '<div class="wccs_custom_fields">';

    foreach ($names as $name) {

      $array = ( $name == 'billing' ) ? $billing : $shipping;

      $options = get_option('wccs_settings' . $inc);
      if (!empty($options[sprintf('%s_buttons', $name)])) {
        foreach ($options[sprintf('%s_buttons', $name)] as $btn) {

          if (!in_array($btn['cow'], $array)) {
            if (
                    ( get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) !== '' ) &&
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'heading' &&
                    $btn['type'] !== 'multiselect' &&
                    $btn['type'] !== 'wooccmupload' &&
                    $btn['type'] !== 'multicheckbox'
            ) {
              echo '
<dt>' . wooccm_wpml_string($btn['label']) . ':</dt>
<dd>' . nl2br(get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true)) . '</dd>';
            } elseif (
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'multiselect' &&
                    $btn['type'] !== 'multicheckbox' &&
                    $btn['type'] == 'heading'
            ) {
              echo '
<h2>' . wooccm_wpml_string($btn['label']) . '</h2>';
            } elseif (
                    ( get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true) !== '' ) &&
                    !empty($btn['label']) &&
                    empty($btn['deny_receipt']) &&
                    $btn['type'] !== 'heading' &&
                    (
                    $btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox'
                    )
            ) {
              $value = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
              $strings = maybe_unserialize($value);
              echo '
<dt>' . wooccm_wpml_string($btn['label']) . ':</dt>
<dd>';
              if (!empty($strings)) {
                if (is_array($strings)) {
                  foreach ($strings as $key) {
                    echo wooccm_wpml_string($key) . ', ';
                  }
                } else {
                  echo $strings;
                }
              } else {
                echo '-';
              }
              echo '
</dd>';
            } elseif ($btn['type'] == 'wooccmupload') {
              $info = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
              if (!empty($info)) {
                // Check for delimiter
                if (strstr($info, '||') !== false)
                  $info = explode('||', $info);
                else if (strstr($info, ',') !== false)
                  $info = explode(',', $info);
                else if (is_numeric($info))
                  $info = array($info);
                if (is_array($info)) {
                  $num_files = count($info);
                  if (!empty($num_files))
                    $info = sprintf(_n('%s file', '%s files', $num_files, 'woocommerce-checkout-manager'), number_format_i18n($num_files));
                  else
                    $info = '-';
                } else {
                  $info = '-';
                }
              } else {
                $info = '-';
              }

              $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
              echo '
<dt>' . wooccm_wpml_string(trim($btn['label'])) . ':</dt>
<dd>' . $info . '</dd>';
            }
          }
        }
      }
      $inc--;
    }

    $options = get_option('wccs_settings');
    $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );
    if (!empty($buttons)) {
      foreach ($buttons as $btn) {

        if (
                ( get_post_meta($order_id, $btn['cow'], true) !== '' ) &&
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'heading' &&
                $btn['type'] !== 'multicheckbox' &&
                (
                $btn['type'] !== 'wooccmupload' && $btn['type'] !== 'multiselect'
                )
        ) {
          echo '
<dt>' . wooccm_wpml_string($btn['label']) . ':</dt>
<dd>' . nl2br(get_post_meta($order_id, $btn['cow'], true)) . '</dd>';
        } elseif (
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'multiselect' &&
                $btn['type'] !== 'multicheckbox' &&
                $btn['type'] == 'heading'
        ) {
          echo '
<h2>' . wooccm_wpml_string($btn['label']) . '</h2>';
        } elseif (
                ( get_post_meta($order_id, $btn['cow'], true) !== '' ) &&
                !empty($btn['label']) &&
                empty($btn['deny_receipt']) &&
                $btn['type'] !== 'heading' &&
                $btn['type'] !== 'wooccmupload' &&
                (
                $btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox'
                )
        ) {
          $value = get_post_meta($order_id, $btn['cow'], true);
          $strings = maybe_unserialize($value);
          echo '
<dt>' . wooccm_wpml_string($btn['label']) . ':</dt>
<dd>';
          if (!empty($strings)) {
            if (is_array($strings)) {
              foreach ($strings as $key) {
                echo wooccm_wpml_string($key) . ', ';
              }
            } else {
              echo $strings;
            }
          } else {
            echo '-';
          }
          echo '
</dd>';
        } elseif ($btn['type'] == 'wooccmupload') {
          $info = get_post_meta($order_id, $btn['cow'], true);
          if (!empty($info)) {
            // Check for delimiter
            if (strstr($info, '||') !== false)
              $info = explode('||', $info);
            else if (strstr($info, ',') !== false)
              $info = explode(',', $info);
            else if (is_numeric($info))
              $info = array($info);
            if (is_array($info)) {
              $num_files = count($info);
              if (!empty($num_files))
                $info = sprintf(_n('%s file', '%s files', $num_files, 'woocommerce-checkout-manager'), number_format_i18n($num_files));
              else
                $info = '-';
            } else {
              $info = '-';
            }
          } else {
            $info = '-';
          }

          $btn['label'] = (!empty($btn['force_title2']) ? $btn['force_title2'] : $btn['label'] );
          echo '
<dt>' . wooccm_wpml_string(trim($btn['label'])) . ':</dt>
<dd>' . $info . '</dd>';
        }
      }
    }
    echo '</div>';
    echo '<!-- .wccs_custom_fields -->';
  }
}
?>