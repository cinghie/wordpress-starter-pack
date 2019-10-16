<?php
//
//global $wooccm_sections;
//
//var_dump($wooccm_sections);

$sections = array();

$sections[''] = esc_html__('Checkout', 'woocommerce-checkout-manager');
$sections['billing'] = esc_html__('Billing', 'woocommerce-checkout-manager');
$sections['shipping'] = esc_html__('Shipping', 'woocommerce-checkout-manager');
$sections['additional'] = esc_html__('Additional', 'woocommerce-checkout-manager');
$sections['order'] = esc_html__('Order', 'woocommerce-checkout-manager');
//$sections['email'] = esc_html__('Email', 'woocommerce-checkout-manager');
$sections['advanced'] = esc_html__('Advanced', 'woocommerce-checkout-manager');

echo '<ul class="subsubsub">';

$array_keys = array_keys($sections);

foreach ($sections as $id => $label) {
  echo '<li><a href="' . admin_url('admin.php?page=wc-settings&tab=wooccm&section=' . sanitize_title($id)) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> | </li>';
}

echo '<li><a target="_blank" href="' . WOOCCM_SUPPORT_URL . '">' . esc_html__('Report a bug', 'woocommerce-checkout-manager') . '</a> ' . ( end($array_keys) == $id ? '' : '|' ) . ' </li>';

echo '</ul><br class="clear" />';

