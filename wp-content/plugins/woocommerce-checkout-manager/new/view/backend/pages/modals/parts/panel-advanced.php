<div id="tab_field_advanced" class="panel woocommerce_options_panel hidden" style="display: none;">
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Listable', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.clear == 'true' ) { #>checked<# } #> type="checkbox" name="listable" value="listable">
        <span class="description"><?php esc_html_e('Display in View Orders screen	', 'woocommerce-checkout-manager'); ?></span>
    </p>                     
    <p class="form-field">
      <label><?php esc_html_e('Sortable', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.clear == 'true' ) { #>checked<# } #> type="checkbox" name="sortable" value="sortable">
        <span class="description"><?php esc_html_e('Allow Sorting on View Orders screen', 'woocommerce-checkout-manager'); ?></span>
    </p>                   
    <p class="form-field">
      <label><?php esc_html_e('Filterable', 'woocommerce-checkout-manager'); ?></label>
      <input <# if ( data.clear == 'true' ) { #>checked<# } #> type="checkbox" name="filterable" value="filterable">
        <span class="description"><?php esc_html_e('Allow Filtering on View Orders screen', 'woocommerce-checkout-manager'); ?></span>
    </p>
  </div>
</div>