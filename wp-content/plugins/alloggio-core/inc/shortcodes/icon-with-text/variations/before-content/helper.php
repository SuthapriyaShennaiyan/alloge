<?php

if ( ! function_exists( 'alloggio_core_add_icon_with_text_variation_before_content' ) ) {
	function alloggio_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_icon_with_text_layouts', 'alloggio_core_add_icon_with_text_variation_before_content' );
}
