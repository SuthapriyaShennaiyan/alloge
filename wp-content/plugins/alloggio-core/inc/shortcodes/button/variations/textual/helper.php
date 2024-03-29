<?php

if ( ! function_exists( 'alloggio_core_add_button_variation_textual' ) ) {
	function alloggio_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_button_layouts', 'alloggio_core_add_button_variation_textual' );
}
