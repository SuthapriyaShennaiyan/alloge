<?php

if ( ! function_exists( 'alloggio_core_add_room_single_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_single_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_single_layout_options', 'alloggio_core_add_room_single_variation_standard' );
}

if ( ! function_exists( 'alloggio_core_set_default_room_single_variation_standard' ) ) {
	/**
	 * Function that set default variation layout for this module
	 *
	 * @return string
	 */
	function alloggio_core_set_default_room_single_variation_standard() {
		return 'standard';
	}
	
	add_filter( 'alloggio_core_filter_room_single_layout_default_value', 'alloggio_core_set_default_room_single_variation_standard' );
}