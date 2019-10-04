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
    <span class="name"><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></span>
    <# if ( _.contains(<?php echo json_encode($defaults); ?>, data.name)) { #>
    <input type="text" name="type" value="{{data.type}}" disabled="disabled">
    <# } else { #>
    <select class="media-modal-change" name="type">
      <?php if ($types): ?>
        <?php foreach ($types as $type => $name) : ?>
          <option <# if ( data.type == '<?php echo esc_attr($type); ?>' ) { #>selected="selected"<# } #> value="<?php echo esc_attr($type); ?>"><?php echo esc_html($name); ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
    <# } #>
  </label>
  <# if ( _.contains(<?php echo json_encode($defaults); ?>, data.name)) { #>
  <p class="description"><?php esc_html_e('You can\'t change the type of default fields.', 'woocommerce-checkout-manager'); ?></p>
  <# } else { #>
  <p class="description"><?php esc_html_e('Type of the checkout field', 'woocommerce-checkout-manager'); ?></p>
  <# } #>

  <label class="setting" data-setting="label">
    <span class="name"><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></span>
    <input type="text" name="label" placeholder="<?php esc_html_e('My Field Name', 'woocommerce-checkout-manager'); ?>" value="{{data.label}}">
  </label>
  <p class="description"><?php esc_html_e('Label text for the checkout field.', 'woocommerce-checkout-manager'); ?></p>

  <label class="setting" data-setting="placeholder">
    <span class="name"><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></span>
    <input type="text" name="placeholder" placeholder="<?php esc_html_e('Example red', 'woocommerce-checkout-manager'); ?>" value="{{data.placeholder}}">
  </label>
  <p class="description"><?php esc_html_e('Placeholder text for the checkout field.', 'woocommerce-checkout-manager'); ?></p>

  <label class="setting" data-setting="extra_class">
    <span class="name"><?php esc_html_e('Extra class', 'woocommerce-checkout-manager'); ?></span>
    <input class="short" type="text" name="extra_class" value="{{data.extra_class}}">
  </label>
</div>

<div class="settings">
  <label class="setting" data-setting="default">
    <span class="name"><?php esc_html_e('Default', 'woocommerce-checkout-manager'); ?></span>
    <input type="text" name="default" placeholder="<?php esc_html_e('Enter a default value (optional)', 'woocommerce-checkout-manager'); ?>" value="{{data.default}}">
  </label>
</div>

<# if ( _.contains(<?php echo json_encode($multiple); ?>, data.type)) { #>
<div class="settings">
  <label class="setting" data-setting="options">
    <span class="name"><?php esc_html_e('Options', 'woocommerce-checkout-manager'); ?></span>
    <input type="text" name="options" placeholder="Option 1||Option 2||Option 3" value="{{data.options}}">
  </label>
</div>
<# } #>

<div class="actions">
  <a target="_blank" class="view-attachment" href="<?php echo wc_get_page_permalink('checkout'); ?>"><?php esc_html_e('View checkout page', 'woocommerce-checkout-manager'); ?></a> |
  <a target="_blank" href="<?php echo WOOCCM_PURCHASE_URL; ?>"><?php esc_html_e('Get premium version', 'woocommerce-checkout-manager'); ?></a> |
  <a target="_blank" href="<?php echo WOOCCM_DOCUMENTATION_URL; ?>"><?php esc_html_e('View documentation', 'woocommerce-checkout-manager'); ?></a>
</div>