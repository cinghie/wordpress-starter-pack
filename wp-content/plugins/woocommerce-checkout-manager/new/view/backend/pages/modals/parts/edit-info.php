<span class="settings-save-status">
  <span class="spinner"></span>
  <span class="saved"><?php esc_html_e('Saved.'); ?></span>
</span>

<div class="details">
  <div class="filename"><strong><?php esc_html_e('Field id', 'woocommerce-checkout-manager'); ?>:</strong> {{data.id}}</div>
  <div class="filename"><strong><?php esc_html_e('Field name', 'woocommerce-checkout-manager'); ?>:</strong> {{data.name}}</div>
  <!--
  <div class="filename"><strong><?php esc_html_e('Field type', 'woocommerce-checkout-manager'); ?>:</strong> {{data.type}}</div>
  -->
  <div class="filename"><strong><?php esc_html_e('Field key', 'woocommerce-checkout-manager'); ?>:</strong> #{{data.key}}</div>
</div>

<div class="settings">
  <label class="setting" data-setting="label">
    <span class="name"><?php esc_html_e('Conditional', 'woocommerce-checkout-manager'); ?></span>
    <input <# if (data.conditional) { #>checked<# } #> type="checkbox" name="conditional" value="1">
  </label>
  <p class="description"><?php esc_html_e('Activate conditional field requirement.', 'woocommerce-checkout-manager'); ?></p>
  <label class="setting" data-setting="label">
    <span class="name"><?php esc_html_e('Conditional parent', 'woocommerce-checkout-manager'); ?></span>
    <select class="select short" name="conditional_parent_name">
      <?php foreach ($fields as $key => $field) : ?>
        <?php if (in_array($field['type'], $conditionals)): ?>
          <# if ( data.id != '<?php echo esc_attr($field['id']); ?>' ) { #>
          <option <# if ( data.conditional_parent_name == '<?php echo esc_attr($field['name']); ?>' ) { #>selected="selected"<# } #> value="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></option>
          <# } #>
        <?php endif; ?>
      <?php endforeach; ?>
    </select> 
  </label>
  <p class="description"><?php esc_html_e('Select conditional parent field.', 'woocommerce-checkout-manager'); ?></p>
  <label class="setting" data-setting="label">
    <span class="name"><?php esc_html_e('Coditional value', 'woocommerce-checkout-manager'); ?></span>
    <input type="text" name="conditional_parent_value" placeholder="<?php esc_html_e('Yes'); ?>" value="{{data.conditional_parent_value}}">
  </label>
  <p class="description"><?php esc_html_e('Show field if parent has this value.', 'woocommerce-checkout-manager'); ?></p>
</div>

<div class="actions">
  <a target="_blank" class="view-attachment" href="<?php echo wc_get_page_permalink('checkout'); ?>"><?php esc_html_e('View checkout page', 'woocommerce-checkout-manager'); ?></a> |
  <a target="_blank" href="<?php echo WOOCCM_PURCHASE_URL; ?>"><?php esc_html_e('Get premium version', 'woocommerce-checkout-manager'); ?></a> |
  <a target="_blank" href="<?php echo WOOCCM_DOCUMENTATION_URL; ?>"><?php esc_html_e('View documentation', 'woocommerce-checkout-manager'); ?></a>
</div>