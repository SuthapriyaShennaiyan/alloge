<?php

if ( ! function_exists( 'alloggio_core_add_icon_with_text_variation_before_title' ) ) {
	function alloggio_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_icon_with_text_layouts', 'alloggio_core_add_icon_with_text_variation_before_title' );
}
