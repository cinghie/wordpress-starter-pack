<div id="tab_field_amount" class="panel woocommerce_options_panel hidden" style="display: none;">

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Add Amount', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.add_amount == 'true' ) { #>checked<# } #> type="checkbox" name="add_amount" value="true">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Amount Name', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" name="add_amount_name" type="text" value="{{data.add_amount_name}}" placeholder="<?php esc_html_e('My Custom Charge', 'woocommerce-checkout-manager'); ?>">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Amount Total', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" name="add_amount_total" type="text" value="{{data.add_amount_total}}" placeholder="50">
      <select style="margin:0 0 0 10px;line-height: 30px; height: 30px;" class="select" name="add_amount_type">
        <option value="fixed" selected="selected">$</option>
        <option value="percent">%</option>
      </select>
    </p>
  </div>

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Amount Tax', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.add_amount_tax == 'true' ) { #>checked<# } #> type="checkbox" name="add_amount_tax" value="true">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Deny Checkout', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.deny_checkout == 'true' ) { #>checked<# } #> type="checkbox" name="deny_checkout" value="true">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Deny Receipt', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.deny_receipt == 'true' ) { #>checked<# } #> type="checkbox" name="deny_receipt" value="true">
    </p>

  </div>

</div>