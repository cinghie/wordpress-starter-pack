<h2 class="woocommerce-order-details__title"><?php echo ($title = get_option('wooccm_order_custom_fields_title', false)) ? esc_html($title) : esc_html__('Upload files', 'woocommerce-checkout-manager'); ?></h2>

<?php //if ($fields =   WOOCCM()->field->shipping->get_fields() + WOOCCM()->field->additional->get_fields()): ?>
<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
  <tbody>
    <?php foreach (WOOCCM()->field->billing->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->field->billing->get_defaults())) : ?>
        <?php if ($value = get_post_meta($order_id, sprintf('_%s_%s', 'billing', $field['name']), true)): ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>" class="woocommerce-table__line-item order_item">
            <th class="woocommerce-table__product-name product-name">
              <?php echo esc_html($field['label']); ?>
            </th>
            <td class="woocommerce-table__product-total product-total">
              <?php echo esc_html($value); ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach (WOOCCM()->field->shipping->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->field->billing->get_defaults())) : ?>
        <?php if ($value = get_post_meta($order_id, sprintf('_%s_%s', 'shipping', $field['name']), true)): ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>" class="woocommerce-table__line-item order_item">
            <th class="woocommerce-table__product-name product-name">
              <?php echo esc_html($field['label']); ?>
            </th>
            <td class="woocommerce-table__product-total product-total">
              <?php echo esc_html($value); ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach (WOOCCM()->field->additional->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->field->billing->get_defaults())) : ?>
        <?php
        $value = get_post_meta($order_id, sprintf('_%s_%s', 'additional', $field['name']), true) ? $value : get_post_meta($order_id, sprintf('%s', $field['name']), true);
        if ($value):
          ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>" class="woocommerce-table__line-item order_item">
            <th class="woocommerce-table__product-name product-name">
              <?php echo esc_html($field['label']); ?>
            </th>
            <td class="woocommerce-table__product-total product-total">
              <?php echo esc_html($value); ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
//endif; ?>