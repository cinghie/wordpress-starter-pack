<?php
/**
 * Brand description.
 *
 * @author  Your Inspiration Themes
 *
 * @package YITH WooCommerce Brands
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WCBR' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<?php if ( apply_filters( 'yith_wcbr_print_brand_description', true, $p_term ) ) : ?>
<div class="yith-wcbr-archive-header term-description">
	<?php
	if ( ! empty( $term_description ) ) {
		echo wpautop( do_shortcode( $term_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	?>
</div>
<?php endif; ?>
