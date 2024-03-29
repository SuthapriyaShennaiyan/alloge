<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="qodef-woo-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'alloggio' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="qodef-search-form-field" placeholder="<?php esc_attr_e( 'Search', 'alloggio' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="qodef-search-form-button"><?php echo alloggio_get_icon( 'icon-basic-magnifier', 'linea-icons', '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><circle cx="21" cy="21" r="20"/><line x1="35" y1="35" x2="41" y2="41"/><rect x="46.257" y="37.065" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 121.9178 50.5)" width="8.485" height="26.87"/></g></svg>' ); ?></button>
	</div>
	<input type="hidden" name="post_type" value="product" />
</form>