<div id="tab_field_datepicker" class="panel woocommerce_options_panel hidden" style="display: none;">
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Date format', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" placeholder="dd-mm-yy" name="format_date" value="{{data.format_date}}">
      <span class="description"><a href="https://codex.wordpress.org/Formatting_Date_and_Time">Documentation on date and time formatting</a>.</span>
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Date limit', 'woocommerce-checkout-manager'); ?></label>
      <select class="select short media-modal-change" name="date_limit">
        <option <# if ( data.date_limit == 'variable' ) { #>selected="selected"<# } #> value="variable"><?php esc_html_e('Since current date', 'woocommerce-checkout-manager'); ?></option>
        <option <# if ( data.date_limit == 'fixed' ) { #>selected="selected"<# } #> value="fixed"><?php esc_html_e('Between fixed dates', 'woocommerce-checkout-manager'); ?></option>
      </select>
    </p>
  </div>
  <# if ( data.date_limit == 'variable' ) { #>
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Days before', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="number" placeholder="3" min="0" max="365" name="date_limit_variable_min" value="{{data.date_limit_variable_min}}">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Days after', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="number" placeholder="3" min="0" max="365" name="date_limit_variable_max" value="{{data.date_limit_variable_max}}">
    </p>
  </div>                  
  <# } #>
  <# if ( data.date_limit == 'fixed' ) { #>
  <div class="options_group wooccm-enhanced-between-dates">
    <p class="form-field dimensions_field">
      <label for="product_length"><?php esc_html_e('Between dates', 'woocommerce-checkout-manager'); ?></label>
      <span class="wrap">
        <input style="width:48.1%" type="text" class="short " name="date_limit_fixed_min" value="{{data.date_limit_fixed_min}}" placeholder="<?php esc_html_e('From… YYYY-MM-DD', 'woocommerce-checkout-manager'); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
        <input style="width:48.1%;margin: 0;" type="text" class="short" name="date_limit_fixed_max" value="{{data.date_limit_fixed_max}}" placeholder="<?php esc_html_e('From… YYYY-MM-DD', 'woocommerce-checkout-manager'); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
      </span>
      <span class="woocommerce-help-tip"></span>			
    </p>
  </div>
  <# } #>
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Days disable', 'woocommerce-checkout-manager'); ?></label>
      <select class="wooccm-enhanced-select" name="date_limit_days" data-placeholder="<?php esc_attr_e('Disable week days', 'woocommerce-checkout-manager'); ?>" data-allow_clear="true" multiple="multiple">
        <?php for ($day_index = 0; $day_index <= 6; $day_index++) : ?>
          <option <# if ( _.contains(data.date_limit_days, '<?php echo esc_attr($day_index); ?>') ) { #>selected="selected"<# } #> value="<?php echo esc_attr($day_index); ?>"><?php echo $wp_locale->get_weekday($day_index); ?></option>
        <?php endfor; ?>
      </select>
    </p>
  </div>
</div>