<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

return array(

    'buttons' => array(
	    'prev_next_buttons_section_start' => array(
		    'type' => 'sectionstart',
	    ),

	    'prev_next_buttons_section_title' => array(
		    'type' => 'title',
		    'title'     => esc_html_x( 'Prev/Next buttons options', 'Admin: section title', 'yith-woocommerce-multi-step-checkout' ),
	    ),
	    'prev_button_label' => array(
		    'title'     => esc_html_x( 'Label for prev button', 'Admin option title', 'yith-woocommerce-multi-step-checkout' ),
		    'type'      => 'yith-field',
		    'yith-type' => 'text',
		    'id'        => 'yith_wcms_timeline_options_prev',
		    'default'   => esc_html_x( 'Previous', 'Short text: Navigation Button label', 'yith-woocommerce-multi-step-checkout' ),
		    'desc'      => esc_html_x( 'Enter a text for prev button', 'Admin option description', 'yith-woocommerce-multi-step-checkout' ),
	    ),
	    'next_button_label' => array(
		    'title'     => esc_html_x( 'Label for next button', 'Admin option title', 'yith-woocommerce-multi-step-checkout' ),
		    'type'      => 'yith-field',
		    'yith-type' => 'text',
		    'id'        => 'yith_wcms_timeline_options_next',
		    'default'   => esc_html_x( 'Next', 'Short text: Navigation Button label', 'yith-woocommerce-multi-step-checkout' ),
		    'desc'      => esc_html_x( 'Enter a text for next button', 'Admin option description', 'yith-woocommerce-multi-step-checkout' ),
	    ),

	    'prev_next_buttons_section_end' => array(
		    'type' => 'sectionend',
	    ),

	    'back_to_cart_button_section_start' => array(
		    'type' => 'sectionstart',
	    ),

	    'back_to_cart_button_section_title' => array(
		    'type' => 'title',
		    'title'     => esc_html_x( 'Back to cart button options', 'Admin: section title', 'yith-woocommerce-multi-step-checkout' ),
	    ),

	    'back_to_cart_button_show' => array(
		    'title'     => esc_html_x( 'Show Back to cart button', 'Panel: section title', 'yith-woocommerce-multi-step-checkout' ),
		    'type'      => 'yith-field',
		    'yith-type' => 'onoff',
		    'id'        => 'yith_wcms_nav_enable_back_to_cart_button',
		    'desc'      => esc_html_x( "Enable to display the 'back to cart' button in the checkout page", 'Admin: option description', 'yith-woocommerce-multi-step-checkout' ),
		    'default'   => 'no',
	    ),

	    'back_to_cart_button_label' => array(
		    'title'     => esc_html_x( 'Label for Back to cart button', 'Frontend: button label', 'yith-woocommerce-multi-step-checkout' ),
		    'type'      => 'yith-field',
		    'yith-type' => 'text',
		    'id'        => 'yith_wcms_timeline_options_back_to_cart',
		    'desc'      => esc_html_x( 'Enter a text for back to cart button', 'Admin: option description', 'yith-woocommerce-multi-step-checkout' ),
		    'default'   => esc_html_x( 'Back to cart', 'Frontend: button label', 'yith-woocommerce-multi-step-checkout' ),
		    'deps'      => array(
			    'id'    => 'yith_wcms_nav_enable_back_to_cart_button',
			    'value' => 'yes',
			    'type'  => 'hide'
		    ),
	    ),

	    'back_to_cart_button_section_end' => array(
		    'type' => 'sectionend',
	    ),
    )
);
