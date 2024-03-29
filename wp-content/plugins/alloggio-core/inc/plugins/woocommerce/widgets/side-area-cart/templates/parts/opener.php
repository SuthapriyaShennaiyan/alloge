<a itemprop="url" class="qodef-m-opener" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-m-opener-icon"><?php echo qode_framework_icons()->render_icon( 'icon-ecommerce-basket', 'linea-icons' ); ?></span>
	<?php if ( WC()->cart->cart_contents_count > 0 ) { ?>
		<span class="qodef-m-opener-count"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php } ?>
</a>