<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Add JS and Styles to Theme
 */
function add_theme_scripts() {
	// Add FontAwesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . './../storefront-child/assets/css/fontawesome.min.css',false,'5.15.1');
	// Add custom.js
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . './../storefront-child/assets/js/custom.js', array ( 'jquery' ), '1.0', true);
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * Hide Wordpress Version
 *
 * @return string
 */
function hide_wordpress_version() {
	return '';
}

add_filter('the_generator', 'hide_wordpress_version');

/**
 * Prevent update notification for plugin
 * http://www.thecreativedev.com/disable-updates-for-specific-plugin-in-wordpress/
 * Place in theme functions.php or at bottom of wp-config.php
 *
 * @param $value
 *
 * @return mixed
 */
function disable_plugin_updates($value)
{
	if ( is_object($value) ) {
		unset($value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] );
	}

	return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

/**
 * Register Footer Credits Widget
 */
function footer_credits_widgets_init()
{
	register_sidebar( array(
		'name' => 'Footer Credits',
		'id' => 'footer-credits',
		'before_widget' => '<div class="credits">',
		'after_widget' => '</div>',
	) );
}

add_action( 'widgets_init', 'footer_credits_widgets_init' );

/**
 * Theme Credits
 */
function storefront_credit()
{
	?>
	<div class="site-info">
		<?php if ( is_active_sidebar( 'footer-credits' ) ) : ?>
			<?php dynamic_sidebar( 'footer-credits' ); ?>
		<?php else: ?>
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
				<br />
				<?php
				if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<?php echo '<a href="https://woocommerce.com" target="_blank" title="' . esc_attr__( 'WooCommerce - The Best eCommerce Platform for WordPress', 'storefront' ) . '" rel="author">' . esc_html__( 'Built with Storefront &amp; WooCommerce', 'storefront' ) . '</a>.'; ?>
			<?php } ?>
		<?php endif ?>
	</div><!-- .site-info -->
	<?php
}
