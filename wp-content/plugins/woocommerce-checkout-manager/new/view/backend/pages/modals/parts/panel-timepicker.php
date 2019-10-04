<div id="tab_field_timepicker" class="panel woocommerce_options_panel hidden" style="display: none;">
  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Hour start', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="number" min="0" max="24" placeholder="6" name="time_limit_start" value="{{data.time_limit_start}}">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Hour end', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="number" min="0" max="24" placeholder="9" name="time_limit_end" value="{{data.time_limit_end}}">
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Minutes interval', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="number" min="0" max="60" <!--step="5"--> placeholder="15" name="time_limit_interval" value="{{data.time_limit_interval}}">
    </p>
    <!--<p class="form-field">
      <label><?php esc_html_e('Manual minutes', 'woocommerce-checkout-manager'); ?></label>
      <input class="short" type="text" placeholder="0, 10, 20, 30, 40" name="manual_min" value="{{data.manual_min}}">
    </p>-->
  </div>
</div>