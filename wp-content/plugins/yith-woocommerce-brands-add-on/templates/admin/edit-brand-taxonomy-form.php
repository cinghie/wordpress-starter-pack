<?php
/**
 * Taxonomy edit form.
 *
 * @author  Your Inspiration Themes
 *
 * @package YITH WooCommerce Brands
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WCBR' ) ) {
	exit;
} // Exit if accessed directly
?>
<tr class="form-field">
	<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'yith-woocommerce-brands-add-on' ); ?></label></th>
	<td>
		<div id="product_brand_thumbnail" style="float:left;margin-right:10px;"><img alt="<?php esc_html_e( 'Product brand thumbnail', 'yith-woocommerce-brands-add-on-premium' ); ?>" src="<?php echo esc_html( $image ); ?>" width="60px" height="60px" /></div>
		<div style="line-height:60px;">
			<input type="hidden" id="product_brand_thumbnail_id" class="yith_wcbr_upload_image_id" name="product_brand_thumbnail_id" value="<?php echo esc_html( $thumbnail_id ); ?>" />
			<button id="product_brand_thumbnail_upload" type="submit" class="yith_wcbr_upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'yith-woocommerce-brands-add-on' ); ?></button>
			<button id="product_brand_thumbnail_remove" type="submit" class="yith_wcbr_remove_image_button button"><?php esc_html_e( 'Remove image', 'yith-woocommerce-brands-add-on' ); ?></button>
		</div>
		<div class="clear"></div>
	</td>
</tr>
