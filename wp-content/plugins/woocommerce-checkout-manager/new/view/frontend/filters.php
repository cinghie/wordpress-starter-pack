<?php
/**
 * WooCommerce Checkout Manager
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
  exit;

// File Picker
// -----------------------------------------------------------------------------

function wooccm_checkout_field_upload_handler($field = '', $key, $args, $value) {

  $upload_name = (!empty($args['placeholder']) ? esc_attr($args['placeholder']) : __('Upload Files', 'woocommerce-checkout-manager') );

  if ($args['wooccm_required']) {
    $args['class'][] = 'validate-required';
    $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
  } else {
    $required = '';
  }

  $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint($args['maxlength']) . '"' : '';

  if (is_string($args['label_class'])) {
    $args['label_class'] = array($args['label_class']);
  }

  if (is_null($value)) {
    $value = $args['default'];
  }

  // Custom attribute handling
  $custom_attributes = array();

  if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
    foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
      $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
    }
  }

  if (!empty($args['validate'])) {
    foreach ($args['validate'] as $validate) {
      $args['class'][] = 'validate-' . $validate;
    }
  }

  if (!empty($args['type'])) {
    $args['class'][] = $args['type'] . '-field';
  }

  ob_start();
  ?>
  <p class="form-row <?php echo esc_attr(implode(' ', $args['class'])); ?>" id="<?php echo esc_attr($args['id']); ?>_field" data-cow="<?php echo esc_attr($args['cow']); ?>">
    <?php if ($args['label']) : ?>
      <label for="<?php echo esc_attr($args['id']); ?>" class="<?php echo esc_attr(implode(' ', $args['label_class'])); ?>">
        <?php echo esc_html($args['label']) . $required; ?>
      </label>
    <?php endif; ?>
    <button style="width:100%" class="wooccmupload_button button alt" type="button" class="button alt" id="<?php echo esc_attr($key); ?>_button"><?php echo esc_html($upload_name); ?></button>
    <input style="display:none;" class="wooccmupload_field" type="hidden" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>" value="" />
    <input style="display:none;" class="fileinput-button" type="file" name="<?php echo esc_attr($key); ?>_file" id="<?php echo esc_attr($key); ?>_file" multiple="multiple" />
    <span style="display:none;" class="wooccmupload_list"></span>
  </p>
  <?php if (!empty($args['clear'])) : ?>
    <div class="clear"></div>
    <?php
  endif;
  return ob_get_clean();
}

add_filter('woocommerce_form_field_wooccmupload', 'wooccm_checkout_field_upload_handler', 10, 4);

// Radio Buttons
function wooccm_checkout_field_radio_handler($field = '', $key, $args, $value) {

  if (!empty($args['clear']))
    $after = '<div class="clear"></div>';
  else
    $after = '';

  if ($args['wooccm_required']) {
    $args['class'][] = 'validate-required';
    $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
  } else {
    $required = '';
  }

  $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint($args['maxlength']) . '"' : '';

  $field = '<div class="form-row ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

  $field .= '<fieldset><legend>' . $args['label'] . $required . '</legend>';

  if (!empty($args['options'])) {
    foreach ($args['options'] as $option_key => $option_text) {
      $field .= '<label style="display:block;"><input type="radio" ' . checked($value, wooccm_wpml_string(esc_attr($option_text)), false) . ' name="' . esc_attr($key) . '" value="' . wooccm_wpml_string(esc_attr($option_text)) . '" /> ' . wooccm_wpml_string(esc_html($option_text)) . '</label>';
    }
  }

  $field .= '</fieldset></div>' . $after;

  return $field;
}

add_filter('woocommerce_form_field_radio', 'wooccm_checkout_field_radio_handler', 10, 4);

// Multi-Checkbox
function wooccm_checkout_field_multicheckbox_handler($field = '', $key, $args, $value) {

  if (!empty($args['clear']))
    $after = '<div class="clear"></div>';
  else
    $after = '';

  if ($args['wooccm_required']) {
    $args['class'][] = 'validate-required';
    $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
  } else {
    $required = '';
  }

  $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint($args['maxlength']) . '"' : '';

  $options = '';

  if (!empty($args['options'])) {
    foreach ($args['options'] as $option_key => $option_text) {
      $options .= '<label><input type="checkbox" name="' . esc_attr($key) . '[]" value="' . wooccm_wpml_string(esc_attr($option_text)) . '"' . selected($value, $option_key, false) . ' /> ' . wooccm_wpml_string(esc_attr($option_text)) . '</label>';
    }
  }

  $field = '<p class="form-row ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

  if ($args['label'])
    $field .= '<label class="' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

  $field .= $options . '
</p>' . $after;

  return $field;
}

add_filter('woocommerce_form_field_multicheckbox', 'wooccm_checkout_field_multicheckbox_handler', 10, 4);

// Multiselect
// -----------------------------------------------------------------------------
function wooccm_checkout_field_multiselect_handler($field = '', $key, $args, $value) {

  $args['type'] = 'select';

  ob_start();

  woocommerce_form_field($key, $args, $value);

  $field = str_replace('<select ', ' <select multiple="multiple" ', ob_get_clean());
  $field = str_replace('name="' . esc_attr($key) . '"', 'name="' . esc_attr($key) . '[]"', $field);

  return $field;
}

add_filter('woocommerce_form_field_multiselect', 'wooccm_checkout_field_multiselect_handler', 10, 4);

// Colorpicker
// -----------------------------------------------------------------------------
function wooccm_checkout_field_colorpicker_handler($field = '', $key, $args, $value) {

  $args['type'] = 'text';
  $args['maxlength'] = 7;

  ob_start();

  woocommerce_form_field($key, $args, $value);

  return str_replace('</p>', ' <span class="wooccmcolorpicker_container" class="spec_shootd"></span></p>', ob_get_clean());
}

add_filter('woocommerce_form_field_colorpicker', 'wooccm_checkout_field_colorpicker_handler', 10, 4);

// Datepicker
// -----------------------------------------------------------------------------
function wooccm_checkout_field_datepicker_handler($field = '', $key, $args, $value) {

  $args['type'] = 'text';

  ob_start();

  woocommerce_form_field($key, $args, $value);

  return ob_get_clean();
}

add_filter('woocommerce_form_field_datepicker', 'wooccm_checkout_field_datepicker_handler', 10, 4);

// Timepicker
// -----------------------------------------------------------------------------
function wooccm_checkout_field_timepicker_handler($field = '', $key, $args, $value) {

  $args['type'] = 'text';

  ob_start();

  woocommerce_form_field($key, $args, $value);

  return ob_get_clean();
}

add_filter('woocommerce_form_field_timepicker', 'wooccm_checkout_field_timepicker_handler', 10, 4);

// Heading
// -----------------------------------------------------------------------------
function wooccm_checkout_field_heading_handler($field = '', $key, $args, $value) {

  $field = '<h3 class="form-row ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">' . $args['label'] . '</h3>';

  return $field;
}

add_filter('woocommerce_form_field_heading', 'wooccm_checkout_field_heading_handler', 10, 4);

// Country 
// -----------------------------------------------------------------------------
function wooccm_checkout_field_country_handler($field = '', $key, $args, $value) {

  static $instance = 0;
  
  if ($instance) {
    return $field;
  }

  $instance++;
  
  ob_start();

  if (!empty($args['default'])) {
    $value = $args['default'];
  }

  woocommerce_form_field($key, $args, $value);

  return ob_get_clean();
}

add_filter('woocommerce_form_field_country', 'wooccm_checkout_field_country_handler', 10, 4);

// State
// -----------------------------------------------------------------------------
function wooccm_checkout_field_state_handler($field = '', $key, $args, $value) {

  static $instance = 0;
  
  if ($instance) {
    return $field;
  }

  $instance++;
  
  ob_start();

  if (!empty($args['default'])) {
    $value = $args['default'];
  }

  woocommerce_form_field($key, $args, $value);

  return ob_get_clean();
}

add_filter('woocommerce_form_field_state', 'wooccm_checkout_field_state_handler', 10, 4);
