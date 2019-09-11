<?php

/*function wooccm_front_end_upload() {

  if (!empty($_REQUEST) && check_admin_referer('wooccm_checkout_attachment_upload', 'nonce')) {

    $name = ( isset($_REQUEST["name"]) ? $_REQUEST["name"] : false );

    // Check if a file has been uploaded
    if (empty($_FILES)) {
      wooccm_error_log('[' . $name . '] $_FILES is empty');
      return;
    }

    // Check if the $_REQUEST name attribute matches the $_FILES field name
    if (!isset($_FILES[$name])) {
      wooccm_error_log('[' . $name . '] $_REQUEST name does not match');
      return;
    }

    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $wp_upload_dir = wp_upload_dir();

    $number_of_files = 0;
    $attach_ids = array();

    $files = $_FILES[$name];
    foreach ($files['name'] as $key => $value) {
      if ($files['name'][$key]) {
        $file = array(
            'name' => $_FILES[$name]['name'][$key],
            'type' => $_FILES[$name]['type'][$key],
            'tmp_name' => $_FILES[$name]['tmp_name'][$key],
            'error' => $_FILES[$name]['error'][$key],
            'size' => $_FILES[$name]['size'][$key]
        );
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($file, $upload_overrides);

        // Check if upload was successful
        if (isset($movefile['error']) && $movefile['error'] > 0) {
          wooccm_error_log('[' . $name . '] upload failed: ' . print_r($movefile, true));
          return;
        }

        $post_title = basename($file['name']);
        if (isset($movefile['file']))
          $post_title = basename($movefile['file']);
        $attachment = array(
            'guid' => ( isset($movefile['url']) ? $movefile['url'] : false ),
            'post_mime_type' => ( isset($movefile['type']) ? $movefile['type'] : $file['type'] ),
            'post_title' => preg_replace('/\.[^.]+$/', '', $post_title),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        if (!empty($movefile['url'])) {
          $attach_id = wp_insert_attachment($attachment, $movefile['url']);
          $attach_ids[] = $attach_id;
          $number_of_files++;
          // echo json_encode( array( $number_of_files, $attach_id ) );
        }
      }
    }

    if (!empty($attach_ids)) {
      $output = implode(',', $attach_ids);
      $output = json_encode($output);
      echo $output;
    }

    die();
  }
}

add_action("wp_ajax_wooccm_front_end_upload", "wooccm_front_end_upload");
add_action("wp_ajax_nopriv_wooccm_front_end_upload", "wooccm_front_end_upload");
*/

/*function wooccm_front_end_upload_save() {

  if (!empty($_REQUEST) && check_admin_referer('wooccm_checkout_attachment_upload', 'nonce')) {

    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $name = ( isset($_REQUEST["name"]) ? $_REQUEST["name"] : false );
    $attachtoremove = ( isset($_REQUEST["remove"]) ? $_REQUEST["remove"] : false );

    if (!empty($attachtoremove)) {
      // Check the Attachment exists...
      if (get_post_status($attachtoremove) == false)
        die();

      // Check the Attachment is associated with an Order
      $post_parent = get_post_field('post_parent', $attachtoremove);
      if (empty($post_parent)) {
        die();
      } else {
        if (get_post_type($post_parent) <> 'shop_order')
          die();
      }

      // Delete the Attachment
      wp_delete_attachment($attachtoremove);
    }

    $file = array(
        'name' => $_FILES[$name]['name'],
        'type' => $_FILES[$name]['type'],
        'tmp_name' => $_FILES[$name]['tmp_name'],
        'error' => $_FILES[$name]['error'],
        'size' => $_FILES[$name]['size']
    );

    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($file, $upload_overrides);

    $attachment = array(
        'guid' => $movefile['url'],
        'post_mime_type' => $movefile['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $movefile['url']);

    echo json_encode($attach_id);

    die();
  }
}

//frontend handle
add_action("wp_ajax_wooccm_front_end_upload_save", "wooccm_front_end_upload_save");
add_action("wp_ajax_nopriv_wooccm_front_end_upload_save", "wooccm_front_end_upload_save");*/

/*function wooccm_update_attachment_ids($order_id = 0) {

  $has_uploads = false;
  $email_attachments = array();

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
    if (!empty($options[sprintf('%s_buttons', $name)])) {
      foreach ($options[sprintf('%s_buttons', $name)] as $btn) {

        if (!in_array($btn['cow'], $array)) {
          if ($btn['type'] == 'wooccmupload') {
            $attachments = get_post_meta($order_id, sprintf('_%s_%s', $name, $btn['cow']), true);
            if (!empty($attachments)) {

              // Check for delimiter
              if (strstr($attachments, '||') !== false)
                $attachments = explode('||', $attachments);
              else if (strstr($attachments, ',') !== false)
                $attachments = explode(',', $attachments);
              else
                $attachments = array($attachments);

              if (!empty($attachments)) {
                foreach ($attachments as $image_id) {

                  if (!empty($image_id)) {
                    $has_uploads = true;
                    wp_update_post(array('ID' => $image_id, 'post_parent' => $order_id));
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    wp_update_attachment_metadata($image_id, wp_generate_attachment_metadata($image_id, get_attached_file($image_id)));
                    $email_attachments[] = get_attached_file($image_id);
                  }
                }
              }
            }
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

      if ($btn['type'] == 'wooccmupload') {
        $attachments = get_post_meta($order_id, $btn['cow'], true);
        if (!empty($attachments)) {

          // Check for delimiter
          if (strstr($attachments, '||') !== false)
            $attachments = explode('||', $attachments);
          else if (strstr($attachments, ',') !== false)
            $attachments = explode(',', $attachments);
          else if (is_numeric($attachments))
            $attachments = array($attachments);

          if (!is_array($attachments))
            continue;

          foreach ($attachments as $image_id) {

            if (!empty($image_id)) {
              $has_uploads = true;
              wp_update_post(array('ID' => $image_id, 'post_parent' => $order_id));
              require_once( ABSPATH . 'wp-admin/includes/image.php' );
              wp_update_attachment_metadata($image_id, wp_generate_attachment_metadata($image_id, get_attached_file($image_id)));
              $email_attachments[] = get_attached_file($image_id);
            }
          }
        }
      }
    }
  }

  if ($has_uploads) {

    $order = new WC_Order($order_id);

    // send email
    $email_recipients = $options['checkness']['wooccm_notification_email'];
    if (empty($email_recipients))
      $email_recipients = get_option('admin_email');
    $email_heading = __('Files Uploaded at Checkout', 'woocommerce-checkout-manager');
    $subject = sprintf(__('WooCommerce Checkout Manager - %s', 'woocommerce-checkout-manager'), $email_heading);

    $mailer = WC()->mailer();

    // Buffer
    ob_start();
    ?>
    <p>This is an automatic message from WooCommerce Checkout Manager, reporting that files have been uploaded by <?php echo $order->billing_first_name; ?> <?php echo $order->billing_last_name; ?>.</p>
    <h3>Customer Details</h3>
    <ul>
      <li>Name: <?php echo $order->billing_first_name; ?> <?php $order->billing_last_name; ?></li>
      <li>E-mail: <?php echo $order->billing_email; ?></li>
      <li>Order Number: <?php echo $order_id; ?></li>
    </ul>
    <p>You can view the files and order details via back-end by following this <a href="<?php echo admin_url('/post.php?post=' . $order_id . '&action=edit'); ?>" target="_blank">link</a>.</p>
    <?php
    // Get contents
    $message = ob_get_clean();

    $message = $mailer->wrap_message($email_heading, $message);

    // add_filter( 'wp_mail_content_type', 'wooccm_set_html_content_type' );
    // wc_mail( $email_recipients, $message_subject, $message_content );
    $mailer->send($email_recipients, strip_tags($subject), $message, $email_attachments);
    // remove_filter( 'wp_mail_content_type', 'wooccm_set_html_content_type' );
  }
}

add_action('woocommerce_thankyou', 'wooccm_update_attachment_ids');*/

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