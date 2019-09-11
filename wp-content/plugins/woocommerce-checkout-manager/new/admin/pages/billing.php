<h1 class="screen-reader-text"><?php esc_html_e('Billing', 'woocommerce-checkout-manager'); ?></h1>
<h2><?php esc_html_e('Billing fields', 'woocommerce-checkout-manager'); ?></h2>
<div id="wooccm_billing_settings-description">
  <p>Email notifications sent from WooCommerce are listed below. Click on an email to configure it.</p>
</div>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <td class="wooccm_billing_wrapper wc_payment_gateways_wrapper" colspan="2">
        <table class="wooccm_billing_fields wc_gateways widefat" cellspacing="0" aria-describedby="wooccm_billing_settings-description">
          <thead>
            <tr>
              <th class="sort"></th>
              <th class="status"><?php esc_html_e('Enabled', 'woocommerce-checkout-manager'); ?></th>
              <th class="label"><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></th>
              <th class="placeholder"><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></th>
              <!--<th class="order"><?php esc_html_e('Order', 'woocommerce-checkout-manager'); ?></th>-->
              <th class="required"><?php esc_html_e('Required', 'woocommerce-checkout-manager'); ?></th>
              <th class="position"><?php esc_html_e('Position', 'woocommerce-checkout-manager'); ?></th>
              <th class="clear"><?php esc_html_e('Clear', 'woocommerce-checkout-manager'); ?></th>
              <th class="type"><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></th>
              <th class="action"></th>
              <th class="delete"></th>
            </tr>
          </thead>
          <tbody class="ui-sortable">
            <?php
            if ($options) {

              if (array_key_exists('billing_buttons', $options)) {

                uasort($options['billing_buttons'], 'wooccm_sort_fields');

                if ($custom_fields = $options['billing_buttons']) {

                  foreach ($custom_fields as $id => $custom_field) {
                    ?>
                    <tr data-field_id="<?php echo esc_attr($id); ?>" class="">
                      <td class="sort ui-sortable-handle" width="1%" style="width: 72px;">
                        <div class="wc-item-reorder-nav">
                          <button type="button" class="wc-move-up wc-move-disabled" tabindex="-1" aria-hidden="true" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method up', 'woocommerce-checkout-manager'), $custom_field['label'])); ?>"><?php esc_html_e('Move up', 'woocommerce-checkout-manager'); ?></button>
                          <button type="button" class="wc-move-down" tabindex="0" aria-hidden="false" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method down', 'woocommerce-checkout-manager'), $custom_field['label'])); ?>"><?php esc_html_e('Move down', 'woocommerce-checkout-manager'); ?></button>
                          <input type="hidden" name="gateway_order[]" value="<?php echo esc_attr($custom_field['order']); ?>">
                        </div>
                      </td>
                      <td class="status" width="1%" style="width: 51px;">
                        <a class="wooccm-field-toggle-enabled" href="#">
                          <?php
                          if (!empty($custom_field['enabled'])) {
                            /* Translators: %s Payment gateway name. */
                            echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--enabled" aria-label="' . esc_attr(sprintf(__('The "%s" payment method is currently enabled', 'woocommerce-checkout-manager'), $custom_field['label'])) . '">' . esc_attr__('Yes', 'woocommerce-checkout-manager') . '</span>';
                          } else {
                            /* Translators: %s Payment gateway name. */
                            echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--disabled" aria-label="' . esc_attr(sprintf(__('The "%s" payment method is currently disabled', 'woocommerce-checkout-manager'), $custom_field['label'])) . '">' . esc_attr__('No', 'woocommerce-checkout-manager') . '</span>';
                          }
                          ?>
                        </a>
                      </td>
                      <td class="label">
                        <strong><?php echo esc_html(@$custom_field['label']); ?></strong>
                      </td>
                      <td class="placeholder" width="" style="max-width: 152px;">
                        <?php echo esc_html(@$custom_field['placeholder']); ?>
                      </td>
                      <!--<td class="order">
                        <strong><?php echo esc_html(@$custom_field['order']); ?></strong>
                      </td>-->
                      <td class="required">
                        <?php echo esc_html(@$custom_field['checkbox']); ?>
                      </td>
                      <td class="position">
                        <?php echo esc_html(@$custom_field['position']); ?>
                      </td>
                      <td class="clear">
                        <?php //var_dump($custom_field);  ?>
                        <?php echo esc_html(@$custom_field['clear_row']); ?>
                      </td>
                      <td class="type">
                        <?php echo esc_html(@$custom_field['type']); ?>
                      </td>
                      <td class="action" width="1%" style="width: 69px;">
                        <a class="button alignright" aria-label="Set up the &quot;Direct bank transfer&quot; payment method" href="http://localhost/woocommerce-checkout/wp-admin/admin.php?page=wc-settings&amp;tab=checkout&amp;section=bacs">Manage</a>
                      </td>
                      <td class="delete" width="1%">
                        <a class="" aria-label="Set up the &quot;Direct bank transfer&quot; payment method" href="http://localhost/woocommerce-checkout/wp-admin/admin.php?page=wc-settings&amp;tab=checkout&amp;section=bacs">Delete</a>
                      </td>
                    </tr>
                    <?php
                  }
                }
              }
            }
            ?>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>