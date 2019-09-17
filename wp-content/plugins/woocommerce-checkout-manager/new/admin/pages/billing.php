<h1 class="screen-reader-text"><?php esc_html_e('Billing', 'woocommerce-checkout-manager'); ?></h1>
<h2><?php esc_html_e('Billing fields', 'woocommerce-checkout-manager'); ?></h2>
<div id="wooccm_billing_settings-description">
  <p>Email notifications sent from WooCommerce are listed below. Click on an email to configure it.</p>
</div>
<div id="wooccm_billing_settings-actions">
  <p>
    <a href="javascript:;" id="wooccm_billing_settings_add" class="button button-primary"><?php esc_html_e('+ Add New Field', 'woocommerce-checkout-manager') ?></a>
    <a href="javascript:;" id="wooccm_billing_settings_import" class="button button-secondary"><?php esc_html_e('Import', 'woocommerce-checkout-manager') ?></a>
    <a href="javascript:;" id="wooccm_billing_settings_reset" class="button button-secondary"><?php esc_html_e('Reset', 'woocommerce-checkout-manager') ?></a>
  </p>
</div>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <td class="wooccm_billing_wrapper wc_payment_gateways_wrapper" colspan="2">
        <table id="wooccm_billing_fields" class="wc_gateways widefat" cellspacing="0" aria-describedby="wooccm_billing_settings-description">
          <thead>
            <tr>
              <th class="sort" style="width:1%"></th>
              <th class="status" style="width:1%"><?php esc_html_e('Enabled', 'woocommerce-checkout-manager'); ?></th>
              <!--<th class="order"><?php esc_html_e('Order', 'woocommerce-checkout-manager'); ?></th>-->
              <th class="required" style="width:1%"><?php esc_html_e('Required', 'woocommerce-checkout-manager'); ?></th>
              <th class="type" style="width:1%"><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></th>
              <th class="position" style="width:1%;min-width: 100px;"><?php esc_html_e('Position', 'woocommerce-checkout-manager'); ?></th>
              <th class="clear" style="width:1%"><?php esc_html_e('Clear', 'woocommerce-checkout-manager'); ?></th>
              <th class="label" style="width:1%;min-width: 100px;"><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></th>
              <th class="placeholder"><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></th>
              <th class="actions"></th>
            </tr>
          </thead>
          <tbody class="ui-sortable">
            <?php
            if ($options) {

              if (array_key_exists('billing_buttons', $options)) {

                uasort($options['billing_buttons'], 'wooccm_sort_fields');

                if ($custom_fields = $options['billing_buttons']) {

                  foreach ($custom_fields as $id => $custom_field) {
                    ?>
                    <tr data-options_name="wccs_settings3" data-options_key="billing_buttons" data-field_id="<?php echo esc_attr($id); ?>">
                      <td class="sort ui-sortable-handle">
                        <div class="wc-item-reorder-nav">
                          <button type="button" class="wc-move-up wc-move-disabled" tabindex="-1" aria-hidden="true" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method up', 'woocommerce-checkout-manager'), @$custom_field['label'])); ?>"><?php esc_html_e('Move up', 'woocommerce-checkout-manager'); ?></button>
                          <button type="button" class="wc-move-down" tabindex="0" aria-hidden="false" aria-label="<?php echo esc_attr(sprintf(__('Move the "%s" payment method down', 'woocommerce-checkout-manager'), @$custom_field['label'])); ?>"><?php esc_html_e('Move down', 'woocommerce-checkout-manager'); ?></button>
                          <input type="hidden" name="gateway_order[]" value="<?php echo esc_attr(@$custom_field['order']); ?>">
                        </div>
                      </td>
                      <td class="status">
                        <a class="wooccm-field-toggle-enabled" href="#">
                          <?php
                          if (empty($custom_field['disabled'])) {
                            /* Translators: %s Payment gateway name. */
                            echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--enabled" aria-label="' . esc_attr(sprintf(__('The "%s" payment method is currently enabled', 'woocommerce-checkout-manager'), @$custom_field['label'])) . '">' . esc_attr__('Yes', 'woocommerce-checkout-manager') . '</span>';
                          } else {
                            /* Translators: %s Payment gateway name. */
                            echo '<span class="woocommerce-input-toggle woocommerce-input-toggle--disabled" aria-label="' . esc_attr(sprintf(__('The "%s" payment method is currently disabled', 'woocommerce-checkout-manager'), @$custom_field['label'])) . '">' . esc_attr__('No', 'woocommerce-checkout-manager') . '</span>';
                          }
                          ?>
                        </a>
                      </td>
                      <!--<td class="order"><strong><?php echo esc_html(@$custom_field['order']); ?></strong>-->
                      <td class="required">
                        <?php
                        if (!empty($custom_field['checkbox'])) {
                          ?>
                          <span class="status-enabled"><?php esc_html_e('Yes'); ?></span>
                        <?php } else { ?>
                          <span class="status-disabled"><?php esc_html_e('Yes'); ?></span>
                        <?php } ?>
                      </td>
                      <td class="type">
                        <?php echo esc_html(@$custom_field['type']); ?>
                      </td>
                      <td class="position">
                        <?php echo esc_html(@$custom_field['position']); ?>
                      </td>
                      <td class="clear">
                        <?php
                        if (!empty($custom_field['clear_row'])) {
                          ?>
                          <span class="status-enabled"><?php esc_html_e('Yes'); ?></span>
                        <?php } else { ?>
                          <span class="status-disabled"><?php esc_html_e('Yes'); ?></span>
                        <?php } ?>
                      </td>
                      <td class="label">
                        <strong><?php echo esc_html(@$custom_field['label']); ?></strong>
                      </td>
                      <td class="placeholder">
                        <?php echo esc_html(@$custom_field['placeholder']); ?>
                      </td>
                      <td class="action">
                        <a class="wooccm_billing_settings_edit button" aria-label="<?php esc_html_e('Edit checkout field', 'woocommerce-checkout-manager'); ?>" href="javascript:;"><?php esc_html_e('Edit'); ?></a>
                        <a class="wooccm_billing_settings_delete" aria-label="<?php esc_html_e('Edit checkout field', 'woocommerce-checkout-manager'); ?>" href="javascript:;"><?php esc_html_e('Delete'); ?></a>
                      </td>
                    </tr>
                    <?php
                  }
                }
              }
            }
            ?>
          </tbody>
        </table>

    </tr>
  </tbody>
</table>
<script type="text/html" id='tmpl-wpmi-modal-backdrop'>
</script>
<script type="text/html" id='tmpl-wpmi-modal-window'>
  <div class="media-modal-backdrop">&nbsp;</div>
  <div tabindex="0" id="<?php echo esc_attr(WOOCCM_PREFIX . '_modal'); ?>" class="media-modal wp-core-ui upload-php" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">
    <div class="media-modal-content" role="document">
      <div class="edit-attachment-frame mode-select hide-menu hide-router">
        <div class="edit-media-header">
          <button data-field_id="{{ data.prev_id}}" class="media-modal-prev left dashicons <# if ( data.prev_id < 0 ) { #>disabled<# } #>"><span class="screen-reader-text">Edit previous media item</span></button>
          <button data-field_id="{{ data.next_id}}" class="media-modal-next right dashicons <# if ( data.next_id == data.id ) { #>disabled<# } #>"><span class="screen-reader-text">Edit next media item</span></button>
          <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text">Close dialog</span></span>
          </button>
        </div>
        <div class="media-frame-title">
          <h1>Edit field #{{ data.id }}</h1>
        </div>
        <div class="media-frame-content" style="bottom:61px;">

          <div class="attachment-details save-ready">
            <div class="attachment-media-view landscape">

              <div id="woocommerce-product-data">
                <div class="panel-wrap product_data">
                  <ul class="product_data_tabs wc-tabs">
                    <li class="general_options active">
                      <a href="#general_product_data"><span><?php esc_html_e('General', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="inventory_options">
                      <a href="#inventory_product_data"><span><?php esc_html_e('Options', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="shipping_options">
                      <a href="#shipping_product_data"><span><?php esc_html_e('Conditional', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="linked_product_options">
                      <a href="#linked_product_data"><span><?php esc_html_e('Amount', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="attribute_options">
                      <a href="#product_attributes"><span><?php esc_html_e('Taxes', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="variations_options">
                      <a href="#variable_product_options"><span><?php esc_html_e('Display', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="advanced_options">
                      <a href="#advanced_product_data"><span><?php esc_html_e('Timing', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                    <li class="marketplace-suggestions_options">
                      <a href="#marketplace_suggestions"><span><?php esc_html_e('Advanced', 'woocommerce-checkout-manager'); ?></span></a>
                    </li>
                  </ul>

                  <div id="general_product_data" class="panel woocommerce_options_panel" style="display: none;">
                    <div class="options_group">
                      <!--<p>
                      <td class="billing-wccs-order-hidden">
                        <input type="hidden" name="wccs_settings3[billing_buttons][{{data.id}}][order]" value="{{data.order}}">
                      </p>-->
                      <!--<p>
                        <label><?php esc_html_e('Disabled', 'woocommerce-checkout-manager'); ?></label>
                          <input name="wccs_settings3[billing_buttons][{{data.id}}][disabled]" type="checkbox" value="{{data.disabled}}">
                      </p>-->
                      <!--<p>
                        <label><?php esc_html_e('Required', 'woocommerce-checkout-manager'); ?></label>
                          <input name="wccs_settings3[billing_buttons][{{data.id}}][checkbox]" type="checkbox" title="Whether or not the checkout field is required" value="{{data.checkbox}}" checked="checked">
                      </p>-->
                      <p class="form-field">
                        <label><?php esc_html_e('Name', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][cow]" placeholder="<?php esc_html_e('MyField', 'woocommerce-checkout-managert'); ?>" value="{{data.cow}}" readonly="readonly">
                        <span class="description"><?php esc_html_e('To edit Abbreviations open General > Switches > Editing Of Abbreviation Fields.', 'woocommerce-checkout-managert'); ?></span>
                      </p>
                    </div>
                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Position', 'woocommerce-checkout-manager'); ?></label>
                        <select class="select short" name="wccs_settings3[billing_buttons][{{data.id}}][position]">
                          <option <# if ( data.position == 'form-row-wide' ) { #>selected<# } #> value="form-row-wide"><?php esc_html_e('Wide', 'woocommerce-checkout-managert'); ?></option>
                          <option <# if ( data.position == 'form-row-first' ) { #>selected<# } #> value="form-row-first"><?php esc_html_e('Left', 'woocommerce-checkout-managert'); ?></option>
                          <option <# if ( data.position == 'form-row-last' ) { #>selected<# } #> value="form-row-last"><?php esc_html_e('Right', 'woocommerce-checkout-managert'); ?></option>
                        </select>
                        <span class="description"><?php esc_html_e('Placement of the checkout field.', 'woocommerce-checkout-managert'); ?></span>
                      </p>  
                      <p class="form-field">
                        <label><?php esc_html_e('Clear', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.clear_row == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][clear_row]" value="true">
                          <span class="description"><?php esc_html_e('Applies a clear fix to the checkout field.', 'woocommerce-checkout-managert'); ?></span>
                      </p>   
                      <p class="form-field">
                        <label><?php esc_html_e('Extra class', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][extra_class]" value="{{data.extra_class}}">
                      </p>   
                    </div>
                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][label]" placeholder="<?php esc_html_e('My Field Name', 'woocommerce-checkout-managert'); ?>" value="{{data.label}}">
                        <span class="description"><?php esc_html_e('Placeholder text for the checkout field.', 'woocommerce-checkout-managert'); ?></span>
                      </p>  
                      <p class="form-field">
                        <label><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][placeholder]" title="" placeholder="<?php esc_html_e('Example red', 'woocommerce-checkout-managert'); ?>" value="{{data.placeholder}}">
                        <span class="description"><?php esc_html_e('Placeholder text for the checkout field.', 'woocommerce-checkout-managert'); ?></span>
                      </p>
                    </div>
                  </div>
                  <div id="inventory_product_data" class="panel woocommerce_options_panel hidden" style="display: none;">

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Type', 'woocommerce-checkout-manager'); ?></label>
                        <select class="select short" name="wccs_settings3[billing_buttons][{{data.id}}][type]">
                          <option <# if ( data.type == 'wooccmtext' ) { #>selected<# } #> value="wooccmtext">Text Input</option>
                          <option <# if ( data.type == 'wooccmtextarea' ) { #>selected<# } #> value="wooccmtextarea">Textarea</option>
                          <option <# if ( data.type == 'wooccmpassword' ) { #>selected<# } #> value="wooccmpassword">Password</option>
                          <option <# if ( data.type == 'wooccmradio' ) { #>selected<# } #> value="wooccmradio">Radio Buttons</option>
                          <option <# if ( data.type == 'checkbox_wccm' ) { #>selected<# } #> value="checkbox_wccm">Check Box</option>
                          <option <# if ( data.type == 'wooccmselect' ) { #>selected<# } #> value="wooccmselect">Select Options</option>
                          <option <# if ( data.type == 'datepicker' ) { #>selected<# } #> value="datepicker">Date Picker</option>
                          <option <# if ( data.type == 'time' ) { #>selected<# } #> value="time">Time Picker</option>
                          <option <# if ( data.type == 'colorpicker' ) { #>selected<# } #> value="colorpicker">Color Picker</option>
                          <option <# if ( data.type == 'heading' ) { #>selected<# } #> value="heading">Heading</option>
                          <option <# if ( data.type == 'multiselect' ) { #>selected<# } #> value="multiselect">Multi-Select</option>
                          <option <# if ( data.type == 'multicheckbox' ) { #>selected<# } #> value="multicheckbox">Multi-Checkbox</option>
                          <option <# if ( data.type == 'wooccmcountry' ) { #>selected<# } #> value="wooccmcountry">Country</option>
                          <option <# if ( data.type == 'wooccmstate' ) { #>selected<# } #> value="wooccmstate">State</option>
                          <option <# if ( data.type == 'wooccmupload' ) { #>selected<# } #> value="wooccmupload">File Picker</option> 
                        </select>
                        <span class="description"><?php esc_html_e('Type of the checkout field', 'woocommerce-checkout-managert'); ?></span>
                      </p>
                    </div>
                    <div class="options_group">
                      <!--
                      1326
                      <p class="form-field">
                        <label><?php esc_html_e('Adapt', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.fancy == 'country_select' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][fancy]" value="country_select">
                      </p>
                      -->
                      <p class="form-field">
                        <label><?php esc_html_e('Title', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][force_title2]" placeholder="<?php esc_html_e('Name Guide', 'woocommerce-checkout-manager'); ?>" value="{{data.force_title2}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Options', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][option_array]" placeholder="Option 1||Option 2||Option 3" value="{{data.option_array}}">
                      </p>
                    </div>
                  </div>

                  <div id="shipping_product_data" class="panel woocommerce_options_panel hidden" style="display: none;">
                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Conditional', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.conditional_parent_use == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][conditional_parent_use]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Conditional Parent', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.conditional_parent == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][conditional_parent]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Conditional Tie', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][conditional_tie]" placeholder="<?php esc_html_e('Parent Abbr. Name', 'woocommerce-checkout-manager'); ?>" value="{{data.conditional_tie}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Chosen Value', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][chosen_valt]" placeholder="Yes" value="{{data.chosen_valt}}">
                      </p>
                    </div>
                  </div>

                  <div id="linked_product_data" class="panel woocommerce_options_panel hidden" style="display: none;">

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Add Amount', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.add_amount == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][add_amount]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Amount Name', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" name="wccs_settings3[billing_buttons][{{data.id}}][fee_name]" type="text" value="{{data.fee_name}}" placeholder="<?php esc_html_e('My Custom Charge', 'woocommerce-checkout-manager'); ?>">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Amount Total', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" name="wccs_settings3[billing_buttons][{{data.id}}][add_amount_field]" type="text" value="{{data.add_amount_field}}" placeholder="50">
                      </p>
                    </div>

                  </div>

                  <div id="product_attributes" class="panel woocommerce_options_panel hidden" style="display: none;">
                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Deny Checkout', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.deny_checkout == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][deny_checkout]" value="true">
                          <span class="description"><?php esc_html_e('1326.', 'woocommerce-checkout-managert'); ?></span>
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Tax Remove', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.tax_remove == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][tax_remove]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Deny Receipt', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.deny_receipt == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][deny_receipt]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Default Color', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][colorpickerd]" id="billing-colorpic0" placeholder="#000000" value="{{data.colorpickerd}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Picker Type', 'woocommerce-checkout-manager'); ?></label>
                        <select class="select short" name="wccs_settings3[billing_buttons][{{data.id}}][colorpickertype]">
                          <option <# if ( data.colorpickertype == 'farbtastic' ) { #>selected<# } #> value="farbtastic" >Farbtastic</option>
                          <option <# if ( data.colorpickertype == 'iris' ) { #>selected<# } #> value="iris">Iris</option>
                        </select>
                      </p>
                    </div>
                  </div>

                  <div id="variable_product_options" class="panel woocommerce_options_panel hidden" style="display: none;">

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('User Role', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.user_role == 'user_role' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][user_role]" value="user_role">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Show for Roles', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][role_options]" placeholder="Option 1||Option 2||Option 3" value="{{data.role_options}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Hide for Roles', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][role_options2]" placeholder="Option 1||Option 2||Option 3" value="{{data.role_options2}}">
                      </p>
                    </div>

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('More', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.more_content == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][more_content]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Hide Field from Product', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_p]" placeholder="Product ID(s) e.g 1674||1233" value="{{data.single_p}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Show Field for Product', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_px]" placeholder="Product ID(s) e.g 1674||1233" value="{{data.single_px}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Hide Field from Category', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_p_cat]" placeholder="Category Slug(s) e.g my-cat||my-cat2" value="{{data.single_p_cat}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Show Field for Category', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_px_cat]" placeholder="Category Slug(s) e.g my-cat||my-cat2" value="{{data.sigle_px_cat}}">
                      </p>
                    </div>
                  </div>

                  <div id="advanced_product_data" class="panel woocommerce_options_panel hidden" style="display: none;">

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Start Hour', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="6" name="wccs_settings3[billing_buttons][{{data.id}}][start_hour]" value="{{data.start_hour}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('End Hour', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="9" name="wccs_settings3[billing_buttons][{{data.id}}][end_hour]" value="{{data.end_hour}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Interval Min.', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="15" name="wccs_settings3[billing_buttons][{{data.id}}][interval_min]" value="{{data.interval_min}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Manual Min.', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="0, 10, 20, 30, 40" name="wccs_settings3[billing_buttons][{{data.id}}][manual_min]" value="{{data.manual_min}}">
                      </p>
                    </div>

                    <div class="options_group">
                      <p class="form-field">
                        <label><?php esc_html_e('Date Format', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="dd-mm-yy" name="wccs_settings3[billing_buttons][{{data.id}}][format_date]" value="{{data.format_date}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Days Before', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="+3" name="wccs_settings3[billing_buttons][{{data.id}}][min_before]" value="{{data.min_before}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Days After', 'woocommerce-checkout-manager'); ?></label>
                        <input class="short" type="text" placeholder="3" name="wccs_settings3[billing_buttons][{{data.id}}][max_after]" value="{{data.max_after}}">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Days Enabler', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler]" value="true">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Sundays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler0 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler0]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Mondays	Mondays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler1 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler1]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Tuesdays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler2 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler2]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Wednesdays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler3 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler3]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Thursdays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler4 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler4]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Fridays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler5 == '1' ) { #>checked<# } #> type="checkbox"  name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler5]" value="1">
                      </p>
                      <p class="form-field">
                        <label><?php esc_html_e('Satudays', 'woocommerce-checkout-manager'); ?></label>
                        <input <# if ( data.days_disabler6 == '1' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][days_disabler6]" value="1">
                      </p>
                    </div>

                    <div class="options_group">
                      <span class="spongagge">Min Date</span>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_yy]" placeholder="2013" title="yy" value="{{data.single_yy}}">
                      </p>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_mm]" placeholder="10" title="mm" value="{{data.single_mm}}">
                      </p>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_dd]" placeholder="25" title="dd" value="{{data.single_dd}}">
                      </p>
                    </div>
                    <div class="options_group">
                      <span class="spongagge">Max Date</span>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_max_yy]" placeholder="2013" title="yy" value="{{data.single_max_yy}}">
                      </p>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_max_mm]" placeholder="10" title="mm" value="{{data.single_max_mm}}">
                      </p>
                      <p class="form-field">
                        <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][single_max_dd]" placeholder="25" title="dd" value="{{data.single_max_dd}}">
                      </p>
                    </div>

                  </div>

                  <div id="marketplace_suggestions" class="panel woocommerce_options_panel hidden" style="display: none;">
                    <div class="marketplace-suggestions-container showing-suggestion" data-marketplace-suggestions-context="product-edit-meta-tab-header">
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-meta-tab-header">
                        <div class="marketplace-suggestion-container-content">
                          <h4>Recommended extensions</h4></div>
                        <div class="marketplace-suggestion-container-cta"></div>
                      </div>
                    </div>
                    <div class="marketplace-suggestions-container showing-suggestion" data-marketplace-suggestions-context="product-edit-meta-tab-body">
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-name-your-price"><img src="https://woocommerce.com/wp-content/plugins/wccom-plugins//marketplace-suggestions/icons/name-your-price.svg" class="marketplace-suggestion-icon">
                        <div class="marketplace-suggestion-container-content">
                          <h4>Name Your Price</h4>
                          <p>Let customers pay what they want - useful for donations, tips and more</p>
                        </div>
                        <div class="marketplace-suggestion-container-cta"><a href="https://woocommerce.com/products/name-your-price/?wccom-site=http%3A%2F%2Flocalhost%2Fwoocommerce-checkout&amp;wccom-back=%2Fwoocommerce-checkout%2Fwp-admin%2Fpost.php%3Fpost%3D6%26%23038%3Baction%3Dedit&amp;wccom-woo-version=3.7.0&amp;utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="button">Learn More</a>
                          <a class="suggestion-dismiss" title="Dismiss this suggestion" href="#"></a>
                        </div>
                      </div>
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-variation-images"><img src="https://woocommerce.com/wp-content/plugins/wccom-plugins//marketplace-suggestions/icons/additional-variation-images.svg" class="marketplace-suggestion-icon">
                        <div class="marketplace-suggestion-container-content">
                          <h4>Additional Variation Images</h4>
                          <p>Showcase your products in the best light with a image for each variation</p>
                        </div>
                        <div class="marketplace-suggestion-container-cta"><a href="https://woocommerce.com/products/woocommerce-additional-variation-images/?wccom-site=http%3A%2F%2Flocalhost%2Fwoocommerce-checkout&amp;wccom-back=%2Fwoocommerce-checkout%2Fwp-admin%2Fpost.php%3Fpost%3D6%26%23038%3Baction%3Dedit&amp;wccom-woo-version=3.7.0&amp;utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="button">Learn More</a>
                          <a class="suggestion-dismiss" title="Dismiss this suggestion" href="#"></a>
                        </div>
                      </div>
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-woocommerce-one-page-checkout"><img src="https://woocommerce.com/wp-content/plugins/wccom-plugins//marketplace-suggestions/icons/one-page-checkout.svg" class="marketplace-suggestion-icon">
                        <div class="marketplace-suggestion-container-content">
                          <h4>One Page Checkout</h4>
                          <p>Don't make customers click around - let them choose products, checkout &amp; pay all on one page</p>
                        </div>
                        <div class="marketplace-suggestion-container-cta"><a href="https://woocommerce.com/products/woocommerce-one-page-checkout/?wccom-site=http%3A%2F%2Flocalhost%2Fwoocommerce-checkout&amp;wccom-back=%2Fwoocommerce-checkout%2Fwp-admin%2Fpost.php%3Fpost%3D6%26%23038%3Baction%3Dedit&amp;wccom-woo-version=3.7.0&amp;utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="button">Learn More</a>
                          <a class="suggestion-dismiss" title="Dismiss this suggestion" href="#"></a>
                        </div>
                      </div>
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-min-max-quantities"><img src="https://woocommerce.com/wp-content/plugins/wccom-plugins//marketplace-suggestions/icons/min-max-quantities.svg" class="marketplace-suggestion-icon">
                        <div class="marketplace-suggestion-container-content">
                          <h4>Min/Max Quantities</h4>
                          <p>Specify minimum and maximum allowed product quantities for orders to be completed</p>
                        </div>
                        <div class="marketplace-suggestion-container-cta"><a href="https://woocommerce.com/products/min-max-quantities/?wccom-site=http%3A%2F%2Flocalhost%2Fwoocommerce-checkout&amp;wccom-back=%2Fwoocommerce-checkout%2Fwp-admin%2Fpost.php%3Fpost%3D6%26%23038%3Baction%3Dedit&amp;wccom-woo-version=3.7.0&amp;utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="button">Learn More</a>
                          <a class="suggestion-dismiss" title="Dismiss this suggestion" href="#"></a>
                        </div>
                      </div>
                    </div>
                    <div class="marketplace-suggestions-container showing-suggestion" data-marketplace-suggestions-context="product-edit-meta-tab-footer">
                      <div class="marketplace-suggestion-container" data-suggestion-slug="product-edit-meta-tab-footer-browse-all">
                        <div class="marketplace-suggestion-container-content has-manage-link"><a class="marketplace-suggestion-manage-link linkout" href="http://localhost/woocommerce-checkout/wp-admin/admin.php?page=wc-settings&amp;tab=advanced&amp;section=woocommerce_com">Manage suggestions</a></div>
                        <div class="marketplace-suggestion-container-cta"><a href="https://woocommerce.com/product-category/woocommerce-extensions/?wccom-site=http%3A%2F%2Flocalhost%2Fwoocommerce-checkout&amp;wccom-back=%2Fwoocommerce-checkout%2Fwp-admin%2Fpost.php%3Fpost%3D6%26%23038%3Baction%3Dedit&amp;wccom-woo-version=3.7.0&amp;utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="linkout">Browse all extensions<span class="dashicons dashicons-external"></span></a></div>
                      </div>
                    </div>
                    <div class="marketplace-suggestions-metabox-nosuggestions-placeholder hidden">
                      <img src="https://woocommerce.com/wp-content/plugins/wccom-plugins/marketplace-suggestions/icons/get_more_options.svg" class="marketplace-suggestion-icon">
                      <div class="marketplace-suggestion-placeholder-content">
                        <h4>Enhance your products</h4>
                        <p>Extensions can add new functionality to your product pages that make your store stand out</p>
                      </div>
                      <a href="https://woocommerce.com/product-category/woocommerce-extensions/?utm_source=editproduct&amp;utm_campaign=marketplacesuggestions&amp;utm_medium=product" target="blank" class="button">Browse the Marketplace</a>
                      <br>
                      <a class="marketplace-suggestion-manage-link" href="http://localhost/woocommerce-checkout/wp-admin/admin.php?page=wc-settings&amp;tab=advanced&amp;section=woocommerce_com">Manage suggestions</a>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>

            </div>
            <div class="attachment-info">
              <span class="settings-save-status">
                <span class="spinner"></span>
                <span class="saved">Saved.</span>
              </span>
              <div class="details">
                <div class="filename"><strong>Field id:</strong> #{{data.id}}</div>
                <div class="filename"><strong>Filed slug:</strong> {{data.cow}}</div>
              </div>

              <div class="settings">
                <label class="setting" data-setting="alt">
                  <span class="name"><?php esc_html_e('Label', 'woocommerce-checkout-manager'); ?></span>
                  <input type="text" name="wccs_settings3[billing_buttons][{{data.id}}][label]" placeholder="<?php esc_html_e('My Field Name', 'woocommerce-checkout-managert'); ?>" value="{{data.label}}">
                </label>
                <p class="description"><?php esc_html_e('Label text for the checkout field.', 'woocommerce-checkout-managert'); ?></p>
                <label class="setting" data-setting="title">
                  <span class="name"><?php esc_html_e('Placeholder', 'woocommerce-checkout-manager'); ?></span>
                  <input type="text" name="wccs_settings3[billing_buttons][{{data.id}}][placeholder]" title="" placeholder="<?php esc_html_e('Example red', 'woocommerce-checkout-managert'); ?>" value="{{data.placeholder}}">
                </label>
                <p class="description"><?php esc_html_e('Placeholder text for the checkout field.', 'woocommerce-checkout-managert'); ?></p>
                <label class="setting">
                  <span class="name"><?php esc_html_e('Position', 'woocommerce-checkout-manager'); ?></span>
                  <select class="select short" name="wccs_settings3[billing_buttons][{{data.id}}][position]">
                    <option <# if ( data.position == 'form-row-wide' ) { #>selected<# } #> value="form-row-wide"><?php esc_html_e('Wide', 'woocommerce-checkout-managert'); ?></option>
                    <option <# if ( data.position == 'form-row-first' ) { #>selected<# } #> value="form-row-first"><?php esc_html_e('Left', 'woocommerce-checkout-managert'); ?></option>
                    <option <# if ( data.position == 'form-row-last' ) { #>selected<# } #> value="form-row-last"><?php esc_html_e('Right', 'woocommerce-checkout-managert'); ?></option>
                  </select>
                </label>
                <p class="description"><?php esc_html_e('Placement of the checkout field.', 'woocommerce-checkout-managert'); ?></p>
                <label class="setting">
                  <span class="name"><?php esc_html_e('Clear', 'woocommerce-checkout-manager'); ?></span>
                  <input <# if ( data.clear_row == 'true' ) { #>checked<# } #> type="checkbox" name="wccs_settings3[billing_buttons][{{data.id}}][clear_row]" value="true">
                </label>
                <p class="description"><?php esc_html_e('Applies a clear fix to the checkout field.', 'woocommerce-checkout-managert'); ?></p>
                <label class="setting">
                  <span class="name"><?php esc_html_e('Extra class', 'woocommerce-checkout-manager'); ?></span>
                  <input class="short" type="text" name="wccs_settings3[billing_buttons][{{data.id}}][extra_class]" value="{{data.extra_class}}">
                </label>

                <div class="attachment-compat">
                  <form class="compat-item"></form>
                </div>
              </div>

              <div class="actions">
                <a target="_blank" class="view-attachment" href="<?php echo wc_get_page_permalink('checkout'); ?>"><?php esc_html_e('View checkout page', 'woocommerce-checkout-managert'); ?></a> |
                <a target="_blank" href="<?php echo WOOCCM_PURCHASE_URL; ?>"><?php esc_html_e('Get premium version', 'woocommerce-checkout-managert'); ?></a> |
                <a target="_blank" href="<?php echo WOOCCM_PURCHASE_URL; ?>"><?php esc_html_e('Get premium version', 'woocommerce-checkout-managert'); ?></a>
              </div>

            </div>
          </div>

        </div>
        <div class="media-frame-toolbar" style="left:0;">
          <div class="media-toolbar">
            <div class="media-toolbar-secondary"></div>
            <div class="media-toolbar-primary search-form">
              <button type="button" class="media-modal-save button button-primary media-button button-large"><?php esc_html_e('Save'); ?></button>
              <button type="button" class="media-modal-delete button button-secondary media-button button-large"><?php esc_html_e('Delete'); ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</script>