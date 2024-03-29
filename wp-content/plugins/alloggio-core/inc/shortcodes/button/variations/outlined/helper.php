<?php

if ( ! function_exists( 'alloggio_core_add_button_variation_outlined' ) ) {
	function alloggio_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_button_layouts', 'alloggio_core_add_button_variation_outlined' );
}
