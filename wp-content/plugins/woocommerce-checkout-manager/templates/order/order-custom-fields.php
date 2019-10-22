<h2 class="woocommerce-order-details__title"><?php echo ($title = get_option('wooccm_order_custom_fields_title', false)) ? esc_html($title) : esc_html__('Custom fields', 'woocommerce-checkout-manager'); ?></h2>

<?php $option = WOOCCM()->billing->get_option_types(); ?>
<table class="woocommerce-table shop_table order_details">
  <tbody>

    <?php foreach (WOOCCM()->billing->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->billing->get_defaults())) : ?>
        <?php if ($value = get_post_meta($order_id, sprintf('_%s', $field['key']), true)): ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>">
            <th>
              <?php echo esc_html($field['label']); ?>
            </th>
            <td>
              <?php echo esc_html($value); ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach (WOOCCM()->shipping->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->shipping->get_defaults())) : ?>
        <?php if ($value = get_post_meta($order_id, sprintf('_%s', 'shipping', $field['key']), true)): ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>">
            <th>
              <?php echo esc_html($field['label']); ?>
            </th>
            <td>
              <?php echo esc_html($value); ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach (WOOCCM()->additional->get_fields() as $field_id => $field) : ?>
      <?php if (!in_array($field['name'], WOOCCM()->billing->get_defaults())) : ?>
        <?php if (($value = get_post_meta($order_id, sprintf('_%s', $field['key']), true)) ? $value : get_post_meta($order_id, sprintf('%s', $field['name']), true)): ?>
          <tr id="tr-<?php echo esc_attr($field['key']); ?>">
            <th>
              <?php echo esc_html($field['label']); ?>
            </th>
            <td>
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