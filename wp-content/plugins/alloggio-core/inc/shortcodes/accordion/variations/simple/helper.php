<?php

if ( ! function_exists( 'alloggio_core_add_accordion_variation_simple' ) ) {
	function alloggio_core_add_accordion_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_accordion_layouts', 'alloggio_core_add_accordion_variation_simple' );
}
