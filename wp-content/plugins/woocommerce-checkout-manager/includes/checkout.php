<?php

// Decides where the Additional Checkout fields appear on the Checkout page
/*
 * 1326
 * function wooccm_checkout_additional_positioning() {

  $options = get_option( 'wccs_settings' );
  // Defaults to after_order_notes
  $position = ( !empty( $options['checkness']['position'] ) ? sanitize_text_field( $options['checkness']['position'] ) : 'after_order_notes' );
  switch( $position ) {

  case 'before_shipping_form':
  case 'after_shipping_form':
  case 'before_billing_form':
  case 'after_billing_form':
  case 'after_order_notes':
  return $position;
  break;

  }

  } */

/*
 * 1326
 * break i18 address required field
 * function wooccm_checkout_default_address_fields( $fields = array() ) {


  // Billing fields
  $options = get_option( 'wccs_settings3' );
  $buttons = ( isset( $options['billing_buttons'] ) ? $options['billing_buttons'] : false );

  if( empty( $buttons ) )
  return $fields;

  foreach( $buttons as $btn ) {

  if( !empty( $btn['cow'] ) && empty( $btn['deny_checkout'] ) ) {
  $key = $btn['cow'];

  if( isset( $fields[$key] ) )
  $fields[$key]['required'] = ( isset( $btn['checkbox'] ) ? absint( $btn['checkbox'] ) : ( isset( $fields[$key]['required'] ) ? absint( $fields[$key]['required'] ) : false ) );

  }

  }

  return $fields;

  }
 */

function wooccm_autocreate_account($fields) {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['auto_create_wccm_account'])) {
    ?>
    <script type="text/javascript">

      jQuery(document).ready(function () {
        jQuery("input#createaccount").prop("checked", "checked");
      });

    </script>

    <style type="text/css">
      .create-account {
        display:none;
      }
    </style>

    <?php

  }
}

function wooccm_display_front() {

  global $woocommerce;

  if (!is_checkout())
    return;

  echo '
<script type="text/javascript">
var ajaxurl = "' . admin_url("admin-ajax.php") . '";
var ajaxnonce = "' . wp_create_nonce("wccs_ajax_nonce") . '";
</script>';

  $options = get_option('wccs_settings');

  // Hide Ship to a different address? heading
  if (!empty($options['checkness']['additional_info'])) {
    echo '
<style type="text/css">
.woocommerce-shipping-fields h3:first-child {
	display: none;
}
</style>
';
  }

  // Force show Billing fields
  if (!empty($options['checkness']['show_shipping_fields'])) {
    echo '
<style type="text/css">
.woocommerce-shipping-fields .shipping_address {
	display: block !important;
}
</style>
';
  }

  // Custom CSS
  echo '
<style type="text/css">';
  if (!empty($options['checkness']['custom_css_w'])) {
    echo esc_textarea($options['checkness']['custom_css_w']);
  }
  echo '

@media screen and (max-width: 685px) {
	.woocommerce .checkout .container .wooccm-btn {
		padding: 1% 6%;
	}
}

@media screen and (max-width: 685px) {
	.woocommerce .checkout .container .wooccm-btn {
		padding: 1% 8%;
	}
}

.container .wooccm-btn {
	padding: 1.7% 6.7%;
}

</style>
';
}

function wooccm_checkout_text_after() {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['text2'])) {
    if (( isset($options['checkness']['checkbox3']) && $options['checkness']['checkbox3'] == true ) || ( isset($options['checkness']['checkbox4']) && $options['checkness']['checkbox4'] == true )) {
      if (isset($options['checkness']['checkbox4']) && $options['checkness']['checkbox4'] == true) {
        echo $options['checkness']['text2'];
      }
    }
  }

  if (!empty($options['checkness']['text1'])) {
    if ($options['checkness']['checkbox1'] == true || $options['checkness']['checkbox2'] == true) {
      if (isset($options['checkness']['checkbox2']) && $options['checkness']['checkbox2'] == true) {
        echo $options['checkness']['text1'];
      }
    }
  }
}

function wooccm_checkout_text_before() {

  $options = get_option('wccs_settings');

  if (!empty($options['checkness']['text2'])) {
    if (( isset($options['checkness']['checkbox3']) && $options['checkness']['checkbox3'] == true ) || ( isset($options['checkness']['checkbox4']) && $options['checkness']['checkbox4'] == true )) {
      if (isset($options['checkness']['checkbox3']) && $options['checkness']['checkbox3'] == true) {
        echo $options['checkness']['text2'];
      }
    }
  }

  if (!empty($options['checkness']['text1'])) {
    if ($options['checkness']['checkbox1'] == true || $options['checkness']['checkbox2'] == true) {
      if (isset($options['checkness']['checkbox1']) && $options['checkness']['checkbox1'] == true) {
        echo $options['checkness']['text1'];
      }
    }
  }
}

// We are overriding the default Order Post meta values with our own secret sauce
function wooccm_custom_checkout_field_update_order_meta($order_id) {

  // Additional section
  $options = get_option('wccs_settings');
  $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[$btn['cow']])) {
          update_post_meta($order_id, $btn['cow'], wp_kses($_POST[$btn['cow']], false));
        }
      } else if ($btn['type'] !== 'multiselect' && $btn['type'] !== 'multicheckbox') {
        if (!empty($_POST[$btn['cow']])) {
          update_post_meta($order_id, $btn['cow'], sanitize_text_field($_POST[$btn['cow']]));
        }
      } elseif ($btn['type'] == 'multiselect' || $btn['type'] == 'multicheckbox') {
        if (!empty($_POST[$btn['cow']])) {
          update_post_meta($order_id, $btn['cow'], maybe_serialize(array_map('sanitize_text_field', $_POST[$btn['cow']])));
        }
      }
    }
  }

  // Shipping section
  $options = get_option('wccs_settings2');
  $buttons = ( isset($options['shipping_buttons']) ? $options['shipping_buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[sprintf('shipping_%s', $btn['cow'])])) {
          update_post_meta($order_id, sprintf('_shipping_%s', $btn['cow']), wp_kses($_POST[sprintf('shipping_%s', $btn['cow'])], false));
        }
      }
    }
  }

  // Billing section
  $options = get_option('wccs_settings3');
  $buttons = ( isset($options['billing_buttons']) ? $options['billing_buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[sprintf('billing_%s', $btn['cow'])])) {
          update_post_meta($order_id, sprintf('_billing_%s', $btn['cow']), wp_kses($_POST[sprintf('billing_%s', $btn['cow'])], false));
        }
      }
    }
  }
}

function wooccm_custom_checkout_field_update_user_meta($user_id = 0, $posted) {

  if (empty($user_id))
    return;

  // Additional section
  $options = get_option('wccs_settings');
  $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[$btn['cow']])) {
          update_user_meta($user_id, $btn['cow'], wp_kses($_POST[$btn['cow']], false));
        }
      }
    }
  }

  // Shipping section
  $options = get_option('wccs_settings2');
  $buttons = ( isset($options['shipping_buttons']) ? $options['shipping_buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[sprintf('shipping_%s', $btn['cow'])])) {
          update_user_meta($user_id, sprintf('shipping_%s', $btn['cow']), wp_kses($_POST[sprintf('shipping_%s', $btn['cow'])], false));
        }
      }
    }
  }

  // Billing section
  $options = get_option('wccs_settings3');
  $buttons = ( isset($options['billing_buttons']) ? $options['billing_buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if ($btn['type'] == 'wooccmtextarea') {
        if (!empty($_POST[sprintf('billing_%s', $btn['cow'])])) {
          update_user_meta($user_id, sprintf('billing_%s', $btn['cow']), wp_kses($_POST[sprintf('billing_%s', $btn['cow'])], false));
        }
      }
    }
  }
}

function wooccm_custom_checkout_field_process() {

  global $woocommerce;

  $options = get_option('wccs_settings');
  $buttons = ( isset($options['buttons']) ? $options['buttons'] : false );
  if (!empty($buttons)) {
    foreach ($buttons as $btn) {
      if (isset($btn['checkbox']) && $btn['checkbox'] === 'true') {
        // without checkbox
        if (
                empty($btn['single_px_cat']) &&
                empty($btn['single_p_cat']) &&
                empty($btn['single_px']) &&
                empty($btn['single_p']) &&
                !empty($btn['label']) &&
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'heading'
        ) {
          if (empty($_POST[$btn['cow']])) {
            $message = sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . wooccm_wpml_string($btn['label']) . '</strong>');
            wc_add_notice($message, 'error');
          }
        }
        // checkbox
        if (
                empty($btn['single_px_cat']) &&
                empty($btn['single_p_cat']) &&
                empty($btn['single_px']) &&
                empty($btn['single_p']) &&
                !empty($btn['label']) &&
                $btn['type'] == 'checkbox' &&
                $btn['type'] !== 'changename' &&
                $btn['type'] !== 'wooccmupload' &&
                $btn['type'] !== 'heading'
        ) {
          if (
                  ( sanitize_text_field($_POST[$btn['cow']]) == $btn['check_2'] ) &&
                  (!empty($btn['checkbox'])
                  )) {
            $message = sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . wooccm_wpml_string($btn['label']) . '</strong>');
            wc_add_notice($message, 'error');
          }
        }
      }
    }
  }
}

function wooccm_remove_fields_filter_billing($fields = array()) {

  global $woocommerce;

  // Check if the cart is not empty
  if (empty($woocommerce->cart->cart_contents))
    return $fields;

  $options = get_option('wccs_settings');

  foreach ($woocommerce->cart->cart_contents as $key => $values) {

    $multiCategoriesx = ( isset($options['checkness']['productssave']) ? $options['checkness']['productssave'] : '' );
    $multiCategoriesArrayx = explode(',', $multiCategoriesx);

    if (in_array($values['product_id'], $multiCategoriesArrayx) && ( $woocommerce->cart->cart_contents_count < 2 )) {
      unset($fields['billing']['billing_address_1']);
      unset($fields['billing']['billing_address_2']);
      unset($fields['billing']['billing_phone']);
      unset($fields['billing']['billing_country']);
      unset($fields['billing']['billing_city']);
      unset($fields['billing']['billing_postcode']);
      unset($fields['billing']['billing_state']);
      break;
    }
  }

  return $fields;
}

function wooccm_remove_fields_filter_shipping($fields = array()) {

  global $woocommerce;

  // Check if the cart is not empty
  if (empty($woocommerce->cart->cart_contents))
    return $fields;

  $options = get_option('wccs_settings');

  foreach ($woocommerce->cart->cart_contents as $key => $values) {

    $multiCategoriesx = ( isset($options['checkness']['productssave']) ? $options['checkness']['productssave'] : '' );
    $multiCategoriesArrayx = explode(',', $multiCategoriesx);
    $_product = $values['data'];

    if (
            ( $woocommerce->cart->cart_contents_count > 1 ) &&
            ( $_product->needs_shipping() )
    ) {
      remove_filter('woocommerce_checkout_fields', 'wooccm_remove_fields_filter', 15);
      break;
    }
  }

  return $fields;
}
?>