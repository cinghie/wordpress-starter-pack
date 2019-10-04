<div id="tab_field_general" class="panel woocommerce_options_panel" style="display: none;">
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Name', 'woocommerce-checkout-manager'); ?></label>
      <# if ( _.contains(<?php echo json_encode($defaults); ?>, data.name)) { #>
      <span class="woocommerce-help-tip" data-tip="<?php esc_html_e('You can\'t change the slug of default fields.', 'woocommerce-checkout-manager'); ?>"></span>
      <input class="short" type="text" name="name" placeholder="<?php esc_html_e('myfield', 'woocommerce-checkout-manager'); ?>" value="{{data.name}}" readonly="readonly">
      <# } else { #>
      <span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Currently is not possible to change the name of the fields.', 'woocommerce-checkout-manager'); ?><?php //esc_html_e('To edit Abbreviations open General > Switches > Editing Of Abbreviation Fields.', 'woocommerce-checkout-manager');          ?>"></span>
      <input class="short" type="text" name="name" placeholder="<?php esc_html_e('myfield', 'woocommerce-checkout-manager'); ?>" value="{{data.name}}" readonly="readonly" <?php /* if (empty($options['checkness']['abbreviation'])) { ?>readonly="readonly"<?php } */ ?>>
      <# } #>
    </p>                   
  </div>

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></label>
      <# if ( _.contains(<?php echo json_encode($defaults); ?>, data.name)) { #>
      <input class="short" type="text" name="type" value="{{data.type}}" disabled="disabled">
      <# } else { #>
      <select class="media-modal-change wooccm-enhanced-select" name="type">
        <?php if ($types): ?>
          <?php foreach ($types as $type => $name) : ?>
            <option <# if ( data.type == '<?php echo esc_attr($type); ?>' ) { #>selected="selected"<# } #> value="<?php echo esc_attr($type); ?>"><?php echo esc_html($name); ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <# } #>
      <span span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Type of the checkout field.', 'woocommerce-checkout-manager'); ?>"></span>
    </p>
    <# if (data.type == 'colorpicker') { #>
    <p class="form-field">
      <label><?php esc_html_e('Picker Type', 'woocommerce-checkout-manager'); ?></label>
      <select class="select short" name="pickertype">
        <option <# if ( data.pickertype == 'farbtastic' ) { #>selected="selected"<# } #> value="farbtastic"><?php esc_html_e('Farbtastic', 'woocommerce-checkout-manager'); ?></option>
        <option <# if ( data.pickertype == 'iris' ) { #>selected="selected"<# } #> value="iris"><?php esc_html_e('Iris', 'woocommerce-checkout-manager'); ?></option>
      </select>
    </p>
    <# } #>
  </div>
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="label" placeholder="<?php esc_html_e('My Field Name', 'woocommerce-checkout-manager'); ?>" value="{{data.label}}">
      <span span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Label text of the checkout field.', 'woocommerce-checkout-manager'); ?>"></span>
    </p>  
    <p class="form-field">
      <label><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="placeholder" placeholder="<?php esc_html_e('Example red', 'woocommerce-checkout-manager'); ?>" value="{{data.placeholder}}">
      <span span class="woocommerce-help-tip" data-tip="<?php esc_html_e('Placeholder text of the checkout field.', 'woocommerce-checkout-manager'); ?>"></span>
    </p>
  </div>
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Default', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="default" placeholder="<?php esc_html_e('Enter a default value (optional)', 'woocommerce-checkout-manager'); ?>" value="{{data.default}}">
    </p>
    <# if ( _.contains(<?php echo json_encode($multiple); ?>, data.type)) { #>
    <p class="form-field">
      <label><?php esc_html_e('Options', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="options" placeholder="Option 1||Option 2||Option 3" value="{{data.options}}">
    </p>
    <# } #>
  </div>
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Extra class', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" name="extra_class" value="{{data.extra_class}}">
    </p>   
  </div>
</div>