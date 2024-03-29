<?php

if ( ! function_exists( 'alloggio_core_add_pricing_table_variation_standard' ) ) {
	function alloggio_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_pricing_table_layouts', 'alloggio_core_add_pricing_table_variation_standard' );
}
