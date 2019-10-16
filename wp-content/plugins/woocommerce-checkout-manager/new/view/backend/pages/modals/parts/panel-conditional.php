<div id="tab_field_conditional" class="panel woocommerce_options_panel hidden" style="display: none;">
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Conditional', 'woocommerce-checkout-manager'); ?></label>
      <input <# if (data.conditional) { #>checked<# } #> type="checkbox" name="conditional" value="1">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Parent', 'woocommerce-checkout-manager'); ?></label>
      <select class="select short" name="conditional_parent_name">
        <?php foreach ($fields as $key => $field) : ?>
          <?php if (in_array($field['type'], $conditionals)): ?>
            <# if ( data.id != '<?php echo esc_attr($field['id']); ?>' ) { #>
            <option <# if ( data.conditional_parent_name == '<?php echo esc_attr($field['name']); ?>' ) { #>selected="selected"<# } #> value="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></option>
            <# } #>
          <?php endif; ?>
        <?php endforeach; ?>
      </select> 
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Value', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="conditional_parent_value" placeholder="<?php esc_html_e('Yes'); ?>" value="{{data.conditional_parent_value}}">
    </p>
  </div>
</div>