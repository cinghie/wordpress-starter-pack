<?php
/*
* Plugin Name: YITH WooCommerce Multi-step Checkout
* Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-multi-step-checkout/
* Description: Thanks to <code><strong>YITH WooCommerce Multi-step Checkout</strong></code> you can split your checkout process into steps. Assist your customers during the purchase and make them feel safe by showing them where in the process they are and what the next step is. <a href="https://yithemes.com/" target="_blank">Get more plugins for your e-commerce shop on <strong>YITH</strong></a>
* Author: YITH
* Text Domain: yith-woocommerce-multi-step-checkout
* Version: 1.7.4
* Author URI: https://yithemes.com/
*
* WC requires at least: 3.0
* WC tested up to: 3.7
*/

/*
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if( ! function_exists( 'install_premium_woocommerce_admin_notice' ) ) {
    /**
     * Print an admin notice if woocommerce is deactivated
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 1.0
     * @return void
     * @use admin_notices hooks
     */
    function install_premium_woocommerce_admin_notice() { ?>
        <div class="error">
            <p><?php _ex( 'YITH WooCommerce Multi-step Chekcout is enabled but not effective. It requires WooCommerce in order to work.', 'Alert Message: WooCommerce require', 'yith-woocommerce-multi-step-checkout' ); ?></p>
        </div>
        <?php
    }
}

! defined( 'YITH_WCMS_FREE_INIT' )          && define( 'YITH_WCMS_FREE_INIT', plugin_basename( __FILE__ ) );

if( defined( 'YITH_WCMS_VERSION' ) ){
	if( ! function_exists( 'yith_wcms_install_free_admin_notice' ) ){
		function yith_wcms_install_free_admin_notice() {
			?>
            <div class="error">
                <p><?php _e( 'You can\'t activate the free version of YITH WooCommerce Multi-step Checkout while you are using the premium one.', 'yith-woocommerce-product-vendors' ); ?></p>
            </div>
			<?php
		}
	}

	add_action( 'admin_notices', 'yith_wcms_install_free_admin_notice' );

	deactivate_plugins( YITH_WCMS_FREE_INIT );
	return;
}


/* === DEFINE === */
! defined( 'YITH_WCMS_VERSION' )            && define( 'YITH_WCMS_VERSION', '1.7.4' );
! defined( 'YITH_WCMS_SLUG' )               && define( 'YITH_WCMS_SLUG', 'yith-woocommerce-multi-step-checkout' );
! defined( 'YITH_WCMS_FILE' )               && define( 'YITH_WCMS_FILE', __FILE__ );
! defined( 'YITH_WCMS_PATH' )               && define( 'YITH_WCMS_PATH', plugin_dir_path( __FILE__ ) );
! defined( 'YITH_WCMS_URL' )                && define( 'YITH_WCMS_URL', plugins_url( '/', __FILE__ ) );
! defined( 'YITH_WCMS_ASSETS_URL' )         && define( 'YITH_WCMS_ASSETS_URL', YITH_WCMS_URL . 'assets/' );
! defined( 'YITH_WCMS_TEMPLATE_PATH' )      && define( 'YITH_WCMS_TEMPLATE_PATH', YITH_WCMS_PATH . 'templates/' );
! defined( 'YITH_WCMS_WC_TEMPLATE_PATH' )   && define( 'YITH_WCMS_WC_TEMPLATE_PATH', YITH_WCMS_PATH . 'templates/woocommerce/' );
! defined( 'YITH_WCMS_OPTIONS_PATH' )       && define( 'YITH_WCMS_OPTIONS_PATH', YITH_WCMS_PATH . 'plugin-options' );

/* Plugin Framework Version Check */
! function_exists( 'yit_maybe_plugin_fw_loader' ) && require_once( YITH_WCMS_PATH . 'plugin-fw/init.php' );
yit_maybe_plugin_fw_loader( YITH_WCMS_PATH  );

/* Load YWCM text domain */
load_plugin_textdomain( 'yith-woocommerce-multi-step-checkout', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

if ( ! function_exists( 'YITH_Multistep_Checkout' ) ) {
	/**
	 * Unique access to instance of YITH_Vendors class
	 *
	 * @return YITH_Multistep_Checkout|YITH_Multistep_Checkout_Premium
	 * @since 1.0.0
	 */
	function YITH_Multistep_Checkout() {
		// Load required classes and functions
		require_once( YITH_WCMS_PATH . 'includes/class.yith-multistep-checkout.php' );

		if ( defined( 'YITH_WCMS_PREMIUM' ) && file_exists( YITH_WCMS_PATH . 'includes/class.yith-multistep-checkout-premium.php' ) ) {
			require_once( YITH_WCMS_PATH . 'includes/class.yith-multistep-checkout-premium.php' );
			return YITH_Multistep_Checkout_Premium::instance();
		}

		return YITH_Multistep_Checkout::instance();
	}
}
if( ! function_exists( 'yith_wcms_install' ) ) {
	function yith_wcms_install() {

		if ( ! function_exists( 'WC' ) ) {
			add_action( 'admin_notices', 'install_premium_woocommerce_admin_notice' );
		}

		else {
			/**
			 * Instance main plugin class
			 */
			YITH_Multistep_Checkout();
		}
	}
}
add_action( 'plugins_loaded', 'yith_wcms_install', 11 );