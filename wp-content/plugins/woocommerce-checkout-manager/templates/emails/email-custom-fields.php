<?php $text_align = is_rtl() ? 'right' : 'left'; ?>

<h2 class="woocommerce-order-details__title"><?php echo ($title = get_option('wooccm_order_custom_fields_title', false)) ? esc_html($title) : esc_html__('Upload files', 'woocommerce-checkout-manager'); ?></h2>

<div style="margin-bottom: 40px;">
  <table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
    <tbody>
      <?php foreach (WOOCCM()->field->billing->get_fields() as $field_id => $field) : ?>
        <?php if (!in_array($field['name'], WOOCCM()->field->billing->get_defaults())) : ?>
          <?php if ($value = get_post_meta($order_id, sprintf('_%s_%s', 'billing', $field['name']), true)): ?>
            <tr id="tr-<?php echo esc_attr($field['key']); ?>" class="woocommerce-table__line-item order_item">
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
                <?php echo esc_html($field['label']); ?>
              </td>
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
                <?php echo esc_html($value); ?>
              </td>
            </tr>
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach (WOOCCM()->field->shipping->get_fields() as $field_id => $field) : ?>
        <?php if (!in_array($field['name'], WOOCCM()->field->billing->get_defaults())) : ?>
          <?php if ($value = get_post_meta($order_id, sprintf('_%s_%s', 'shipping', $field['name']), true)): ?>
            <tr id="tr-<?php echo esc_attr($field['key']); ?>">
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
                <?php echo esc_html($field['label']); ?>
              </td>
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
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
            <tr id="tr-<?php echo esc_attr($field['key']); ?>">
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
                <?php echo esc_html($field['label']); ?>
              </td>
              <td class="td" scope="col" style="text-align:<?php echo esc_attr($text_align); ?>;">
                <?php echo esc_html($value); ?>
              </td>
            </tr>
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>