<?php

if ( ! function_exists( 'alloggio_core_add_image_with_text_variation_text_below' ) ) {
	function alloggio_core_add_image_with_text_variation_text_below( $variations ) {
		
		$variations['text-below'] = esc_html__( 'Text Below', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_image_with_text_layouts', 'alloggio_core_add_image_with_text_variation_text_below' );
}
