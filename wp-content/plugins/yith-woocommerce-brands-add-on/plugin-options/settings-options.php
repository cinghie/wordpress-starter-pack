<?php
/**
 * General options tab
 *
 * @author  YITH
 * @package YITH\Brands\PluginOptions
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WCBR' ) ) {
	exit;
} // Exit if accessed directly

$general_options = array(
	'settings' => array(
		'general-options'     => array(
			'title' => __( 'General Options', 'yith-woocommerce-brands-add-on' ),
			'type'  => 'title',
			'desc'  => '',
			'id'    => 'yith_wcbr_general_options',
		),
		'general-brand-label' => array(
			'id'        => 'yith_wcbr_brands_label',
			'name'      => __( 'Brand label', 'yith-woocommerce-brands-add-on' ),
			'type'      => 'yith-field',
			'yith-type' => 'text',
			'desc'      => __( 'Set the text for the brand label.', 'yith-woocommerce-brands-add-on' ),
			'default'   => __( 'Brand:', 'yith-woocommerce-brands-add-on' ),
		),
		'general-options-end' => array(
			'type' => 'sectionend',
			'id'   => 'yith_wcbr_general_options',
		),
	),
);

return apply_filters( 'yith_wcbr_general_settings', $general_options );
