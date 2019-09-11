<h1 class="screen-reader-text"><?php esc_html_e('General', 'woocommerce-checkout-manager'); ?></h1>
<h2><?php esc_html_e('General', 'woocommerce-checkout-manager'); ?></h2>
<div id="wooccm_billing_settings-description">
  <p>Email notifications sent from WooCommerce are listed below. Click on an email to configure it.</p>
</div>
<table class="form-table" cellspacing="0">
  <tbody>
    <tr valign="top" class="">
      <th scope="row" class="titledesc">
        <?php esc_html_e('Hide shipping fields', 'woocommerce-checkout-manager'); ?>
      </th>
      <td class="forminp forminp-checkbox">
        <fieldset>
          <legend class="screen-reader-text">
            <span>
              <?php printf(__('Hide %s heading', 'woocommerce-checkout-manager'), __('Ship to a different address?', 'woocommerce-checkout-manager')); ?>
            </span>
          </legend>
          <label for="woocommerce_allow_bulk_remove_personal_data">
            <input type="checkbox" name="wccs_settings[checkness][additional_info]" value="true"<?php checked(!empty($options['checkness']['additional_info']), true); ?> />
            <?php printf(__('Hide %s heading', 'woocommerce-checkout-manager'), __('Ship to a different address?', 'woocommerce-checkout-manager')); ?>
          </label>
          <!--<p class="description"><?php printf(__('Hide %s heading', 'woocommerce-checkout-manager'), __('Ship to a different address?', 'woocommerce-checkout-manager')); ?></p>-->
        </fieldset>
      </td>
    </tr>

    <tr valign="top" class="">
      <th scope="row" class="titledesc">
        <?php esc_html_e('Show shipping checkout fields', 'woocommerce-checkout-manager'); ?>
      </th>
      <td class="forminp forminp-checkbox">
        <fieldset>
          <legend class="screen-reader-text">
            <span>
              <?php esc_html_e('Show shipping checkout fields', 'woocommerce-checkout-manager'); ?>
            </span>
          </legend>
          <label for="show_shipping_fields">
            <input type="checkbox" name="wccs_settings[checkness][show_shipping_fields]" value="true"<?php checked(!empty($options['checkness']['show_shipping_fields']), true); ?> />
            <?php printf(__(' Force show Shipping Checkout fields', 'woocommerce-checkout-manager'), sprintf(__('Hide %s heading', 'woocommerce-checkout-manager'), __('Ship to a different address?', 'woocommerce-checkout-manager'))); ?>
          </label>
          <p class="description"><?php printf(__('To be used in conjunction with %s', 'woocommerce-checkout-manager'), __('Ship to a different address?', 'woocommerce-checkout-manager')); ?></p>
        </fieldset>
      </td>
    </tr>
    <tr valign="top" class="">
      <th scope="row" class="titledesc">
        <?php esc_html_e('Hide create an account', 'woocommerce-checkout-manager'); ?>
      </th>
      <td class="forminp forminp-checkbox">
        <fieldset>
          <legend class="screen-reader-text">
            <span>
              <?php esc_html_e('Hide create an account', 'woocommerce-checkout-manager'); ?>
            </span>
          </legend>
          <label for="auto_create_wccm_account">
            <input type="checkbox" name="wccs_settings[checkness][auto_create_wccm_account]" value="true"<?php checked(!empty($options['checkness']['auto_create_wccm_account']), true); ?> />
            <?php printf(__('Hide %s checkbox on Checkout page for guests', 'woocommerce-checkout-manager'), __('Create an account?', 'woocommerce-checkout-manager')); ?>
          </label>
          <p class="description"><?php printf(__('Hide %s checkbox on Checkout page for guests', 'woocommerce-checkout-manager'), __('Create an account?', 'woocommerce-checkout-manager')); ?></p>
        </fieldset>
      </td>
    </tr>
    <tr valign="top" class="">
      <th scope="row" class="titledesc">
        <?php _e('Retain Fields Information', 'woocommerce-checkout-manager'); ?>
      </th>
      <td class="forminp forminp-checkbox">
        <fieldset>
          <legend class="screen-reader-text">
            <span>
              <?php _e('Retain Fields Information', 'woocommerce-checkout-manager'); ?>
            </span>
          </legend>
          <label for="retainval">
            <input type="checkbox" name="wccs_settings[checkness][retainval]" value="true"<?php checked(!empty($options['checkness']['retainval']), true); ?> />
            <?php _e('Retain Fields Information', 'woocommerce-checkout-manager'); ?>
          </label>
          <p class="description"><?php _e('Retain Fields Information', 'woocommerce-checkout-manager'); ?></p>
        </fieldset>
      </td>
    </tr>
    <tr valign="top" class="">
      <th scope="row" class="titledesc">
        <?php _e('Editing Of Abbreviation Fields', 'woocommerce-checkout-manager'); ?>
      </th>
      <td class="forminp forminp-checkbox">
        <fieldset>
          <legend class="screen-reader-text">
            <span>
              <?php _e('Editing Of Abbreviation Fields', 'woocommerce-checkout-manager'); ?>
            </span>
          </legend>
          <label for="abbreviation">
            <input type="checkbox" name="wccs_settings[checkness][abbreviation]" value="true"<?php checked(!empty($options['checkness']['abbreviation']), true); ?> />
            <?php _e('Editing Of Abbreviation Fields', 'woocommerce-checkout-manager'); ?>
          </label>
          <p class="description"><?php _e('Editing Of Abbreviation Fields', 'woocommerce-checkout-manager'); ?></p>
        </fieldset>
      </td>
    </tr>
    <tr valign="top">
      <th scope="row" class="titledesc">
        <label for="position">
          <?php _e('Additional fields position', 'woocommerce-checkout-manager'); ?>
          <span class="woocommerce-help-tip"></span>
        </label>
      </th>
      <td class="forminp forminp-select">
        <select name="position" id="position" style="min-width:300px;" class="wc-enhanced-select enhanced" tabindex="-1" aria-hidden="true">
          <option value="before_billing_form" <?php selected($options['checkness']['position'], 'before_billing_form'); ?>><?php _e('Before Billing fields', 'woocommerce-checkout-manager'); ?></option>
          <option value="after_billing_form" <?php selected($options['checkness']['position'], 'after_billing_form'); ?>><?php _e('After Billing fields', 'woocommerce-checkout-manager'); ?></option>
          <option value="before_shipping_form" <?php selected($options['checkness']['position'], 'before_shipping_form'); ?>><?php _e('Before Shipping fields', 'woocommerce-checkout-manager'); ?></option>
          <option value="after_shipping_form" <?php selected($options['checkness']['position'], 'after_shipping_form'); ?>><?php _e('After Shipping fields', 'woocommerce-checkout-manager'); ?></option>
          <option value="after_order_notes" <?php selected($options['checkness']['position'], 'after_order_notes'); ?>><?php _e('After Order Notes', 'woocommerce-checkout-manager'); ?></option>
        </select> 							
      </td>
    </tr>
  </tbody>
</table>
<!--<div class="section">
  <h3 class="heading checkbox">
    <div class="option">
      <label>
        <input type="checkbox" name="wccs_settings[checkness][admin_translation]" value="true"<?php checked(!empty($options['checkness']['admin_translation']), true); ?> />
        <div class="info-of"><?php _e('Translate WooCommerce Checkout Manager Options Panel', 'woocommerce-checkout-manager'); ?></div>
      </label>
    </div>
  </h3>
</div>-->
<!-- section -->