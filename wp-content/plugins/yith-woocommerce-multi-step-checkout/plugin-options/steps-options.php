<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$steps = array(
	'login'    => array(
		'label' => esc_html_x( 'Login', 'Frontend: Step title', 'yith-woocommerce-multi-step-checkout' ),
		'icon'  => 'icon'
	),
	'billing'  => array(
		'label' => esc_html_x( 'Billing', 'Frontend: Step title', 'yith-woocommerce-multi-step-checkout' ),
		'icon'  => 'icon'
	),
	'shipping' => array(
		'label' => esc_html_x( 'Shipping', 'Frontend: Step title', 'yith-woocommerce-multi-step-checkout' ),
		'icon'  => 'icon'
	),
	'order'    => array(
		'label' => esc_html_x( 'Order info', 'Frontend: Step title', 'yith-woocommerce-multi-step-checkout' ),
		'icon'  => 'icon'
	),
	'payment'  => array(
		'label' => esc_html_x( 'Payment info', 'Frontend: Step title', 'yith-woocommerce-multi-step-checkout' ),
		'icon'  => 'icon'
	)
);

$icon = esc_html_x( 'Icon', 'Admin: part of label string, i.e. Login Icon, Billing Icon', 'yith-woocommerce-multi-step-checkout' );

$step_styles_images = array(
	'text'   => array(
		'horizontal' => YITH_WCMS_ASSETS_URL . 'images/text-style.jpg',
		'vertical'   => YITH_WCMS_ASSETS_URL . 'images/text-style-vertical.jpg',
	),
	'style1' => array(
		'horizontal' => YITH_WCMS_ASSETS_URL . 'images/style1.jpg',
		'vertical'   => YITH_WCMS_ASSETS_URL . 'images/style1-vertical.jpg',
	),
	'style2' => array(
		'horizontal' => YITH_WCMS_ASSETS_URL . 'images/style2.jpg',
		'vertical'   => YITH_WCMS_ASSETS_URL . 'images/style2-vertical.jpg',
	),
	'style3' => array(
		'horizontal' => YITH_WCMS_ASSETS_URL . 'images/style3.jpg',
		'vertical'   => YITH_WCMS_ASSETS_URL . 'images/style3-vertical.jpg',
	),
	'style4' => array(
		'horizontal' => YITH_WCMS_ASSETS_URL . 'images/style4.jpg',
		'vertical'   => YITH_WCMS_ASSETS_URL . 'images/style4-vertical.jpg',
	),
);

$options = array(

	'steps' => array(

		'timeline_template_options_start' => array(
			'type' => 'sectionstart',
		),

		'timeline_template_options_title' => array(
			'title' => esc_html_x( 'Steps Style', 'Panel: section title', 'yith-woocommerce-multi-step-checkout' ),
			'type'  => 'title',
		),

		'timeline_style_options_type' => array(
			'type'      => 'yith-field',
			'yith-type' => 'radio',
			'title'     => esc_html_x( 'Step position', 'Option: Title', 'yith-woocommerce-multi-step-checkout' ),
			'desc'      => esc_html_x( 'Set if you want to display the steps horizontally or vertically', 'Option: description', 'yith-woocommerce-multi-step-checkout' ),
			'id'        => 'yith_wcms_timeline_display',
			'options'   => array(
				'horizontal' => esc_html_x( 'Horizontal', 'Option: timeline display', 'yith-woocommerce-multi-step-checkout' ),
				'vertical'   => esc_html_x( 'Vertical', 'Option: timeline display', 'yith-woocommerce-multi-step-checkout' ),
			),
			'default'   => 'horizontal',
		),

		'timeline_text_option_separator_onoff' => array(
			'title'     => esc_html_x( 'Show a graphic separator between steps', 'Panel: section title', 'yith-woocommerce-multi-step-checkout' ),
			'type'      => 'yith-field',
			'yith-type' => 'onoff',
			'id'        => 'yith_wcms_text_step_separator_onoff',
			'desc'      => esc_html_x( 'Enable to show a graphic separator between steps', 'Admin: option description', 'yith-woocommerce-multi-step-checkout' ),
			'default'   => 'yes',
		),


		'timeline_text_option_separator' => array(
			'title'     => esc_html_x( 'Separate step with', 'Panel: section title', 'yith-woocommerce-multi-step-checkout' ),
			'type'      => 'yith-field',
			'yith-type' => 'text',
			'id'        => 'yith_wcms_text_step_separator',
			'desc'      => esc_html_x( "Enter the separator element for steps. For example, you can use / or -.", 'Admin: option description', 'yith-woocommerce-multi-step-checkout' ),
			'default'   => '/',
			'deps'      => array(
				'id'    => 'yith_wcms_text_step_separator_onoff',
				'value' => 'yes',
			),
		),

		/* === TEXT STYLE === */

		'timeline_step_background_color_text' => array(
			'name'         => esc_html__( 'Step text color', 'yith-woocommerce-multi-step-checkout' ),
			'type'         => 'yith-field',
			'yith-type'    => 'multi-colorpicker',
			'desc'         => esc_html__( 'Set text color for past, current and future step', 'yith-woocommerce-multi-step-checkout' ),
			'id'           => 'yith_wcms_timeline_text_step_color',
			'colorpickers' => array(
				array(
					'name'    => esc_html__( 'Prev color', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'prev',
					'default' => '#43A08C'
				),
				array(
					'name'    => esc_html__( 'Current color', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'current',
					'default' => '#000000'
				),
				array(
					'name'    => esc_html__( 'Future color', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'future',
					'default' => '#9B9B9B'
				),
			),
		),

		'timeline_transition_options_type' => array(
			'type'      => 'yith-field',
			'yith-type' => 'slider',
			'title'     => esc_html_x( 'FadeIn and FadeOut Transition speed', 'Option: Title. Please, do not translate FadeIn/FadeOut', 'yith-woocommerce-multi-step-checkout' ),
			'desc'      => esc_html_x( 'Set the speed of fade animation during transition from one step to the next', 'Option: description', 'yith-woocommerce-multi-step-checkout' ),
			'id'        => 'yith_wcms_timeline_fade_duration',
			'option'    => array( 'min' => 0, 'max' => 1000 ),
			'default'   => '200',
			'step'      => 50,
		),

		'timeline_template_options_end' => array(
			'type' => 'sectionend',
		),

		'steps_options_start' => array(
			'type' => 'sectionstart',
		),

		'steps_options_title' => array(
			'title' => esc_html_x( 'Steps Customization', 'Panel: section title', 'yith-woocommerce-multi-step-checkout' ),
			'type'  => 'title',
		),

		'login_step'        => array(
			'title'               => esc_html__( 'Login', 'yith-woocommerce-multi-step-checkout' ),
			'type'                => 'yith-field',
			'yith-type'           => 'toggle-element-fixed',
			'yith-display-row'    => false,
			'id'                  => 'yith_wcmv_login_settings',
			'onoff_field'         => false,
			'save_single_options' => true,
			'elements'            => array(
				'settings_options_login_label'                    => array(
					'title'   => esc_html__( 'Login label', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enter a label for the login step', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'yith_wcms_timeline_options_login',
					'default' => esc_html__( 'Login', 'yith-woocommerce-multi-step-checkout' ),
					'type'    => 'text',
				),
				'settings_options_login_tab_guest_checkout'       => array(
					'title'   => esc_html__( 'Allow guest checkout', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enable this to allow a customer to place an order without an account', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'woocommerce_enable_guest_checkout',
					'default' => 'yes',
					'type'    => 'onoff',
				),
				'settings_options_login_tab_enable_login'         => array(
					'title'   => esc_html__( 'Allow customer login', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enable this to allow the customer to login during the checkout process', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'woocommerce_enable_checkout_login_reminder',
					'default' => 'no',
					'type'    => 'onoff',
				),
			)
		),
		'billing_step'      => array(
			'title'               => esc_html__( 'Billing', 'yith-woocommerce-multi-step-checkout' ),
			'type'                => 'yith-field',
			'yith-type'           => 'toggle-element-fixed',
			'yith-display-row'    => false,
			'id'                  => 'yith_wcmv_billing_settings',
			'onoff_field'         => false,
			'save_single_options' => true,
			'elements'            => array(
				'settings_options_billing_label'           => array(
					'title'   => esc_html__( 'Billing label', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enter a label for the billing step', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'yith_wcms_timeline_options_billing',
					'default' => esc_html__( 'Billing', 'yith-woocommerce-multi-step-checkout' ),
					'type'    => 'text',
				),
			)
		),
		'shipping_step'     => array(
			'title'               => esc_html__( 'Shipping', 'yith-woocommerce-multi-step-checkout' ),
			'type'                => 'yith-field',
			'yith-type'           => 'toggle-element-fixed',
			'yith-display-row'    => false,
			'id'                  => 'yith_wcmv_shipping_settings',
			'onoff_field'         => false,
			'save_single_options' => true,
			'elements'            => array(
				'settings_options_shipping_label'           => array(
					'title'   => esc_html__( 'Shipping label', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enter a label for the shipping step', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'yith_wcms_timeline_options_shipping',
					'default' => esc_html__( 'Shipping', 'yith-woocommerce-multi-step-checkout' ),
					'type'    => 'text',
				),
			)
		),
		'order_info_step'   => array(
			'title'               => esc_html__( 'Order Info', 'yith-woocommerce-multi-step-checkout' ),
			'type'                => 'yith-field',
			'yith-type'           => 'toggle-element-fixed',
			'yith-display-row'    => false,
			'id'                  => 'yith_wcmv_order_info_settings',
			'onoff_field'         => false,
			'save_single_options' => true,
			'elements'            => array(
				'settings_options_order_label'           => array(
					'title'   => esc_html__( 'Order Info label', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enter a label for the order info step', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'yith_wcms_timeline_options_order',
					'default' => esc_html__( 'Order Info', 'yith-woocommerce-multi-step-checkout' ),
					'type'    => 'text',
				),
			)
		),
		'payment_step'      => array(
			'title'               => esc_html__( 'Payment', 'yith-woocommerce-multi-step-checkout' ),
			'type'                => 'yith-field',
			'yith-type'           => 'toggle-element-fixed',
			'yith-display-row'    => false,
			'id'                  => 'yith_wcmv_payment_settings',
			'onoff_field'         => false,
			'save_single_options' => true,
			'elements'            => array(
				'settings_options_payment_label'           => array(
					'title'   => esc_html__( 'Payment label', 'yith-woocommerce-multi-step-checkout' ),
					'desc'    => esc_html__( 'Enter a label for the payment info step', 'yith-woocommerce-multi-step-checkout' ),
					'id'      => 'yith_wcms_timeline_options_payment',
					'default' => esc_html__( 'Payment', 'yith-woocommerce-multi-step-checkout' ),
					'type'    => 'text',
				),
			)
		),
		'steps_options_end' => array(
			'type' => 'sectionend',
		),
	)
);

return $options;
