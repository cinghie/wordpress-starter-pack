<?php
/**
 * WooCommerce Checkout Manager 
 *
 */
 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<td style="display:none; text-align:center;" class="more_toggler1c">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][more_content]" type="checkbox" value="1" <?php if (  !empty ($field['more_content'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none;" class="more_toggler1c">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_p]" placeholder="<?php _e('Product ID(s) e.g 1674||1233','woocommerce-checkout-manager'); ?>" value="<?php echo (empty( $field['single_p'])) ? '' :  $field['single_p']; ?>" />
</td>

<td style="display:none;" class="more_toggler1c">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_px]" placeholder="<?php _e('Product ID(s) e.g 1674||1233','woocommerce-checkout-manager'); ?>" value="<?php echo (empty( $field['single_px'])) ? '' :  $field['single_px']; ?>" />
</td>

<td style="display:none;" class="more_toggler1c">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_p_cat]" placeholder="<?php _e('Category Slug(s) e.g my-cat||my-cat2','woocommerce-checkout-manager'); ?>" value="<?php echo (empty( $field['single_p_cat'])) ? '' :  $field['single_p_cat']; ?>" />
</td>

<td style="display:none;" class="more_toggler1c">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_px_cat]" placeholder="<?php _e('Category Slug(s) e.g my-cat||my-cat2','woocommerce-checkout-manager'); ?>" value="<?php echo (empty( $field['single_px_cat'])) ? '' :  $field['single_px_cat']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_time">
	<input type="text" placeholder="6" name="wccs_settings[buttons][<?php echo $i; ?>][start_hour]" value="<?php echo (empty($field['start_hour'])) ? '' : $field['start_hour']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_time">
	<input type="text" placeholder="9" name="wccs_settings[buttons][<?php echo $i; ?>][end_hour]" value="<?php echo (empty($field['end_hour'])) ? '' : $field['end_hour']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_time">
	<input type="text" placeholder="15" name="wccs_settings[buttons][<?php echo $i; ?>][interval_min]" value="<?php  echo (empty($field['interval_min'])) ? '' : $field['interval_min']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_time">
	<input type="text" placeholder="0, 10, 20, 30, 40" name="wccs_settings[buttons][<?php echo $i; ?>][manual_min]" value="<?php  echo (empty($field['manual_min'])) ? '' : $field['manual_min']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" placeholder="dd-mm-yy" name="wccs_settings[buttons][<?php echo $i; ?>][format_date]" value="<?php echo (empty($field['format_date'])) ? '' : $field['format_date']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" placeholder="+3" name="wccs_settings[buttons][<?php echo $i; ?>][min_before]" value="<?php echo (empty($field['min_before'])) ? '' : $field['min_before']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" placeholder="3" name="wccs_settings[buttons][<?php echo $i; ?>][max_after]" value="<?php echo (empty( $field['max_after'])) ? '' : $field['max_after']; ?>" />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_color daoo">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler]" type="checkbox" value="true" <?php if (  !empty ($field['days_disabler'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler0]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler0'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler1]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler1'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler2]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler2'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler3]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler3'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler4]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler4'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler5]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler5'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none; text-align:center;" class="hide_stuff_days">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][days_disabler6]" type="checkbox" value="1" <?php if (  !empty ($field['days_disabler6'])) echo "checked='checked'"; ?> />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<span class="spongagge"><?php _e( 'Min Date', 'woocommerce-checkout-manager' ); ?></span>
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_yy]" placeholder="<?php _e('2013','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'yy', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty($field['single_yy'])) ? '' : $field['single_yy']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_mm]" placeholder="<?php _e('10','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'mm', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty($field['single_mm'])) ? '' : $field['single_mm']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_dd]" placeholder="<?php _e('25','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'dd', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty($field['single_dd'])) ? '' : $field['single_dd']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<span class="spongagge"><?php _e( 'Max Date', 'woocommerce-checkout-manager' ); ?></span>
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_max_yy]" placeholder="<?php _e('2013','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'yy', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty( $field['single_max_yy'])) ? '' : $field['single_max_yy']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_max_mm]" placeholder="<?php _e('10','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'mm', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty( $field['single_max_mm'])) ? '' :  $field['single_max_mm']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_color hide_stuff_days">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][single_max_dd]" placeholder="<?php _e('25','woocommerce-checkout-manager'); ?>" title="<?php esc_attr_e( 'dd', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty( $field['single_max_dd'])) ? '' : $field['single_max_dd']; ?>" />
</td>

<td class="more_toggler1" style="text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][checkbox]" type="checkbox" title="<?php _e( 'Whether or not the Checkout field is required', 'woocommerce-checkout-manager' ); ?>" value="true" <?php if (  !empty ($field['checkbox'])) echo "checked='checked'"; ?> />
</td>

<td class="more_toggler1" style="text-align:center;">
	<select name="wccs_settings[buttons][<?php echo $i; ?>][position]" title="<?php _e( 'Placement of the Checkout field', 'woocommerce-checkout-manager' ); ?>">  <!--Call run() function-->
		<option value="form-row-wide" <?php ( !isset( $field['position'] ) ) ? '' : selected( $field['position'], 'form-row-wide' ); ?>><?php _e( 'Wide','woocommerce-checkout-manager' ); ?></option>
		<option value="form-row-first" <?php ( !isset( $field['position'] ) ) ? '' : selected( $field['position'], 'form-row-first' ); ?>><?php _e( 'Left','woocommerce-checkout-manager' ); ?></option>
		<option value="form-row-last" <?php ( !isset( $field['position'] ) ) ? '' : selected( $field['position'], 'form-row-last' ); ?>><?php _e( 'Right','woocommerce-checkout-manager' ); ?></option>
	</select>
</td>

<td class="more_toggler1" style="text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][clear_row]" type="checkbox" title="<?php _e( 'Applies a clear fix to the Checkout field', 'woocommerce-checkout-manager' ); ?>" value="true" <?php if (  !empty ($field['clear_row'])) echo "checked='checked'"; ?> />
</td>

<td class="filter_field" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][deny_checkout]" type="checkbox" value="true" <?php if( !empty( $field['deny_checkout'] ) ) echo "checked='checked'"; ?> />
</td>

<td class="filter_field_tog add_amount_field condition_tick hide_stuff_time hide_stuff_change hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c" style="display:none;">
	<?php _e('Filter Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<td class="filter_field" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][tax_remove]" type="checkbox" value="true" <?php if (  !empty ($field['tax_remove'])) echo "checked='checked'"; ?> />
</td>

<td class="filter_field" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][deny_receipt]" type="checkbox" value="true" <?php if (  !empty ($field['deny_receipt'])) echo "checked='checked'"; ?> />
</td>
<!--
<td class="filter_field condition_tick hide_stuff_change hide_stuff_time hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][add_amount]" type="checkbox" value="true" <?php if (  !empty ($field['add_amount'])) echo "checked='checked'"; ?> />
</td>
-->
<td class="add_amount_field" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][fee_name]" type="text" value="<?php echo $field['fee_name']; ?>" placeholder="<?php _e('My Custom Charge','woocommerce-checkout-manager'); ?>" />
</td>

<td class="add_amount_field" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][add_amount_field]" type="text" value="<?php echo $field['add_amount_field']; ?>" placeholder="50" />
</td>

<td class="filter_field add_amount_field hide_stuff_change hide_stuff_opcheck hide_stuff_op hide_stuff_time hide_stuff_color more_toggler1 more_toggler1c" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][conditional_parent_use]" type="checkbox" value="true" <?php if (  !empty ($field['conditional_parent_use'])) echo "checked='checked'"; ?> />
</td>

<td class="condition_tick" style="display:none;text-align:center;">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][conditional_parent]" type="checkbox" value="true" <?php if (  !empty ($field['conditional_parent'])) echo "checked='checked'"; ?> />
</td>

<td class="more_toggler1">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][label]" title="<?php _e( 'Label text for the Checkout field', 'woocommerce-checkout-manager' ); ?>" placeholder="<?php _e('My Field Name','woocommerce-checkout-manager'); ?>" value="<?php echo esc_attr( $field['label'] ); ?>" />
</td>

<td class="more_toggler1">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][placeholder]" title="<?php _e( 'Placeholder text for the Checkout field', 'woocommerce-checkout-manager' ); ?>" placeholder="<?php _e('Example red','woocommerce-checkout-manager'); ?>" value="<?php echo (empty($field['placeholder'])) ? '' : $field['placeholder']; ?>" <?php if ( $field['cow'] == 'country' || $field['cow'] == 'state' ) { echo 'readonly="readonly"'; } ?> />
</td>

<td style="display:none;" class="filter_field add_amount_field hide_stuff_time hide_stuff_change hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c condition_tick add_amount_field">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][chosen_valt]" placeholder="<?php _e('Yes','woocommerce-checkout-manager'); ?>" value="<?php echo $field['chosen_valt']; ?>" />
</td>

<td style="display:none;" class="condition_tick">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][conditional_tie]" placeholder="<?php _e('Parent Abbr. Name','woocommerce-checkout-manager'); ?>" value="<?php echo $field['conditional_tie']; ?>" />
</td>

<td style="display:none;" class="filter_field">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][colorpickerd]" id="billing-colorpic<?php echo $i; ?>" placeholder="<?php _e('#000000','woocommerce-checkout-manager'); ?>" value="<?php echo $field['colorpickerd']; ?>" />
</td>

<td style="display:none;" class="filter_field">
	<select name="wccs_settings[buttons][<?php echo $i; ?>][colorpickertype]">
		<option value="farbtastic" <?php (!isset($field['colorpickertype'])) ? '' : selected( $field['colorpickertype'], 'farbtastic' ); ?>><?php _e('Farbtastic','woocommerce-checkout-manager'); ?></option>
		<option value="iris" <?php (!isset($field['colorpickertype'])) ? '' :  selected( $field['colorpickertype'], 'iris' ); ?>><?php _e('Iris','woocommerce-checkout-manager'); ?></option>
	</select>
</td>

<td style="display:none;text-align:center;" class="filter_field">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][user_role]" type="checkbox" value="user_role" <?php if (  !empty ($field['user_role'])) echo "checked='checked'"; ?> />
</td>

<td class="filter_field" style="display:none;">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][role_options]" placeholder="Option 1||Option 2||Option 3" value="<?php echo $field['role_options']; ?>" />
</td>

<td class="filter_field" style="display:none;">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][role_options2]" placeholder="Option 1||Option 2||Option 3" value="<?php echo $field['role_options2']; ?>" />
</td>

<td style="display:none;" class="filter_field add_amount_field hide_stuff_time hide_stuff_change hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c condition_tick add_amount_field">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][extra_class]" value="<?php echo $field['extra_class']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_change">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][changenamep]" id="billing-colorpic<?php echo $i; ?>" placeholder="<?php _e( 'Billing Details', 'woocommerce-checkout-manager' ); ?>" value="<?php echo $field['changenamep']; ?>" />
</td>

<td style="display:none;" class="hide_stuff_change">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][changename]" id="billing-colorpic<?php echo $i; ?>" placeholder="<?php _e( 'Bill Form', 'woocommerce-checkout-manager' ); ?>" value="<?php echo $field['changename']; ?>" />
</td>

<td style="display:none;text-align:center;" class="hide_stuff_op wccm1">
	<input name="wccs_settings[buttons][<?php echo $i; ?>][fancy]" type="checkbox" value="country_select" <?php if (  !empty ($field['fancy'])) echo "checked='checked'"; ?> />
</td>

<td class="hide_stuff_op wccm1" style="display:none;">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][force_title2]" placeholder="<?php _e( 'Name Guide', 'woocommerce-checkout-manager' ); ?>" value="<?php echo (empty($field['force_title2'])) ? '' : $field['force_title2']; ?>" />
</td>

<td class="hide_stuff_op wccm1" style="display:none;">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][option_array]" placeholder="Option 1||Option 2||Option 3" value="<?php echo $field['option_array']; ?>" />
</td>

<td class="filter_field add_amount_field hide_stuff_time condition_tick hide_stuff_change hide_stuff_opcheck hide_stuff_color more_toggler1 more_toggler1c" style="display:none;">
	<?php _e('Options Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<td class="filter_field add_amount_field hide_stuff_time condition_tick hide_stuff_change_tog hide_stuff_timef hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c" style="display:none;">
	<?php _e('Swapper Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<!--<td class="filter_field add_amount_field condition_tick hide_stuff_change hide_stuff_timef hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1 more_toggler1c" style="display:none;">
	<?php _e('Time Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<td class="filter_field add_amount_field hide_stuff_time condition_tick hide_stuff_change hide_stuff_opcheck hide_stuff_op more_toggler1 more_toggler1c hide_stuff_days" style="display:none;">
	<?php _e('Date Toggler', 'woocommerce-checkout-manager' ); ?>
</td>-->

<td style="display:none;" class="filter_field add_amount_field hide_stuff_time condition_tick hide_stuff_change hide_stuff_opcheck hide_stuff_op hide_stuff_color more_toggler1">
	<?php _e('Hidden Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<td class="filter_field add_amount_field condition_tick hide_stuff_time hide_stuff_change hide_stuff_opcheck hide_stuff_color hide_stuff_op more_toggler more_toggler1c" title="<?php _e( 'Open additional options for this Checkout field', 'woocommerce-checkout-manager' ); ?>">
	<?php _e('More Toggler', 'woocommerce-checkout-manager' ); ?>
</td>

<td class="more_toggler1">
	<select name="wccs_settings[buttons][<?php echo $i; ?>][type]" title="<?php _e( 'Type of the Checkout field', 'woocommerce-checkout-manager' ); ?>">
		<option value="wooccmtext" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'wooccmtext' ); ?>><?php _e('Text Input','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmtextarea" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'wooccmtextarea' ); ?>><?php _e('Textarea','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmpassword" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'wooccmpassword' ); ?>><?php _e('Password','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmradio" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'wooccmradio' ); ?>><?php _e('Radio Buttons','woocommerce-checkout-manager'); ?></option>
		<option value="checkbox_wccm" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'checkbox_wccm' ); ?>><?php _e('Check Box','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmselect" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'wooccmselect' ); ?>><?php _e('Select Options','woocommerce-checkout-manager'); ?></option>
		<!--<option value="datepicker" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'datepicker' ); ?>><?php _e('Date Picker','woocommerce-checkout-manager'); ?></option>
		<option value="changename" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'changename' ); ?>><?php _e('Text/ Html Swapper','woocommerce-checkout-manager'); ?></option>-->
		<option value="time" <?php (!isset($field['type'])) ? '' :  selected( $field['type'], 'time' ); ?>><?php _e('Time Picker','woocommerce-checkout-manager'); ?></option>
		<option value="colorpicker" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'colorpicker' ); ?>><?php _e('Color Picker','woocommerce-checkout-manager'); ?></option>
		<option value="heading" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'heading' ); ?>><?php _e('Heading','woocommerce-checkout-manager'); ?></option>
		<option value="multiselect" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'multiselect' ); ?>><?php _e('Multi-Select','woocommerce-checkout-manager'); ?></option>
		<option value="multicheckbox" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'multicheckbox' ); ?>><?php _e('Multi-Checkbox','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmcountry" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'wooccmcountry' ); ?>><?php _e('Country','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmstate" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'wooccmstate' ); ?>><?php _e('State','woocommerce-checkout-manager'); ?></option>
		<option value="wooccmupload" <?php (!isset($field['type'])) ? '' : selected( $field['type'], 'wooccmupload' ); ?>><?php _e('File Picker','woocommerce-checkout-manager'); ?></option> 
	</select>
</td>

<td class="more_toggler1">
	<input type="text" name="wccs_settings[buttons][<?php echo $i; ?>][cow]" placeholder="MyField" title="<?php _e( 'To edit Abbreviations open General > Switches > Editing Of Abbreviation Fields.', 'woocommerce-checkout-manager' ); ?>" value="<?php echo $field['cow']; ?>" <?php if ( empty($options['checkness']['abbreviation'])) { echo 'readonly="readonly"'; } ?> />
</td>