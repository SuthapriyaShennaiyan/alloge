<div class="qodef-m-content">
	<?php
	do_action( 'alloggio_core_action_woocommerce_before_side_area_cart_content' );
	
	if ( ! WC()->cart->is_empty() ) {
		alloggio_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/loop' );
		
		alloggio_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/order-details' );
		
		alloggio_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/button' );
	} else {
		// Include posts not found
		alloggio_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/posts-not-found' );
	}
	
	alloggio_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/close' );
	?>
</div>