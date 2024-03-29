<?php

if ( ! function_exists( 'alloggio_core_add_button_variation_filled' ) ) {
	function alloggio_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_button_layouts', 'alloggio_core_add_button_variation_filled' );
}
