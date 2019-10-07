<table class="form-table">
  <tbody>
    <tr valign="top">
      <td class="<?php printf('wooccm_%s_wrapper', $current_section); ?> wc_payment_gateways_wrapper" colspan="2">
        <table id="<?php printf('wooccm_%s_fields', $current_section); ?>" class="wc_gateways widefat" cellspacing="0" aria-describedby="<?php printf('wooccm_%s_settings-description', $current_section); ?>">
          <thead>
            <tr>
              <th class="sort" style="width:1%"></th>
              <!--<th class="order"><?php esc_html_e('Order', 'woocommerce-checkout-manager'); ?></th>-->
              <th class="required" style="width:1%"><?php esc_html_e('Required', 'woocommerce-checkout-manager'); ?></th>
              <th class="position" style="width:1%;min-width: 100px;"><?php esc_html_e('Position', 'woocommerce-checkout-manager'); ?></th>
              <th class="clear" style="width:1%"><?php esc_html_e('Clear', 'woocommerce-checkout-manager'); ?></th>
              <th class="type" style="width:1%"><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></th>
              <th class="label" style="width:1%;min-width: 100px;"><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></th>
              <th class="placeholder"><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></th>
              <!--<th class="listable"><?php esc_html_e('Listable', 'woocommerce-checkout-manager'); ?></th>
              <th class="sortable"><?php esc_html_e('Sortable', 'woocommerce-checkout-manager'); ?></th>
              <th class="filterable"><?php esc_html_e('Filterable', 'woocommerce-checkout-manager'); ?></th>-->
              <th class="status" style="width:1%"><?php esc_html_e('Disabled', 'woocommerce-checkout-manager'); ?></th>
              <th class="edit" style="width:1%"><?php //esc_html_e('Edit', 'woocommerce-checkout-manager');        ?></th>
              <th class="delete" style="width:1%"><?php //esc_html_e('Delete', 'woocommerce-checkout-manager');        ?></th>
            </tr>
          </thead>
          <tbody class="ui-sortable">
            <?php if (count($fields)): ?>
              <?php foreach ($fields as $id => $field) : ?>
                <tr data-field_id="<?php echo esc_attr($id); ?>">
                  <td class="sort ui-sortable-handle">
                    <div class="wc-item-reorder-nav">
                      <button type="button" class="wc-move-up wc-move-disabled" tabindex="-1" aria-hidden="true" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method up', 'woocommerce-checkout-manager'), $field['label'])); ?>"><?php esc_html_e('Move up', 'woocommerce-checkout-manager'); ?></button>
                      <button type="button" class="wc-move-down" tabindex="0" aria-hidden="false" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method down', 'woocommerce-checkout-manager'), $field['label'])); ?>"><?php esc_html_e('Move down', 'woocommerce-checkout-manager'); ?></button>
                      <input type="hidden" name="field_order[]" value="<?php echo esc_attr($id); ?>">
                    </div>
                  </td>
                  <!--<td class="order"><strong><?php echo esc_html($field['order']); ?></strong></td>-->
                  <td class="required">
                    <a data-field_attr="required" class="wooccm-field-toggle-attribute" href="#">
                      <?php
                      if (!empty($field['required'])) {
                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--enabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently enabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('Yes', 'woocommerce-checkout-manager') . '</span>';
                      } else {
                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--disabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently disabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('No', 'woocommerce-checkout-manager') . '</span>';
                      }
                      ?>
                    </a>
                  </td>
                  <td class="position">
                    <select data-field_attr="position" class="wooccm-field-change-attribute" style="width: auto; border-radius: 3px; height: 28px; line-height: 28px;" name="position">
                      <option <?php selected($field['position'], 'form-row-wide'); ?> value="form-row-wide"><?php esc_html_e('Wide', 'woocommerce-checkout-manager'); ?></option>
                      <option <?php selected($field['position'], 'form-row-first'); ?> value="form-row-first"><?php esc_html_e('Left', 'woocommerce-checkout-manager'); ?></option>
                      <option <?php selected($field['position'], 'form-row-last'); ?> value="form-row-last"><?php esc_html_e('Right', 'woocommerce-checkout-manager'); ?></option>
                    </select>
                  </td>
                  <td class="clear">
                    <a data-field_attr="clear" class="wooccm-field-toggle-attribute" href="#">
                      <?php
                      if (!empty($field['clear'])) {
                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--enabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently enabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('Yes', 'woocommerce-checkout-manager') . '</span>';
                      } else {

                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--disabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently disabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('No', 'woocommerce-checkout-manager') . '</span>';
                      }
                      ?>
                    </a>
                  </td>
                  <td class="type">
                    <?php echo esc_html($field['type']); ?>
                  </td>
                  <td class="label">
                    <strong><?php echo esc_html($field['label']); ?></strong>
                  </td>
                  <td class="placeholder">
                    <?php echo esc_html($field['placeholder']); ?>
                  </td>                  
                  <!--<td class="listable">
                  <?php
                  if (!empty($field['listable'])) {
                    ?>
                                                    <span class="status-enabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } else { ?>
                                                    <span class="status-disabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } ?>
                  </td>                  
                  <td class="sortable">
                  <?php
                  if (!empty($field['sortable'])) {
                    ?>
                                                    <span class="status-enabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } else { ?>
                                                    <span class="status-disabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } ?>
                  </td>                  
                  <td class="filterable">
                  <?php
                  if (!empty($field['filterable'])) {
                    ?>
                                                    <span class="status-enabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } else { ?>
                                                    <span class="status-disabled"><?php esc_html_e('Yes'); ?></span>
                  <?php } ?>
                  </td>-->
                  <td class="status">
                    <a data-field_attr="disabled" class="wooccm-field-toggle-attribute" href="#">
                      <?php
                      if (!empty($field['disabled'])) {
                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--enabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently enabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('Yes', 'woocommerce-checkout-manager') . '</span>';
                      } else {

                        echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--disabled" aria-label="' . esc_attr(sprintf(__('The "%s" field currently disabled', 'woocommerce-checkout-manager'), $field['label'])) . '">' . esc_attr__('No', 'woocommerce-checkout-manager') . '</span>';
                      }
                      ?>
                    </a>
                  </td>
                  <td class="edit">
                    <a class="<?php printf('wooccm_%s_settings_edit', $current_section); ?> button" aria-label="<?php esc_html_e('Edit checkout field', 'woocommerce-checkout-manager'); ?>" href="javascript:;"><?php esc_html_e('Edit'); ?></a>
                  </td>
                  <td class="delete">
                    <?php if (is_array($defaults) && !in_array($field['name'], $defaults)): ?>
                      <a class="<?php printf('wooccm_%s_settings_delete', $current_section); ?>" aria-label="<?php esc_html_e('Edit checkout field', 'woocommerce-checkout-manager'); ?>" href="javascript:;"><?php esc_html_e('Delete'); ?></a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>