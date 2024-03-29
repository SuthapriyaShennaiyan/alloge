<?php

if ( ! function_exists( 'alloggio_core_add_room_reservation_filter_variation_horizontal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_reservation_filter_variation_horizontal( $variations ) {
		$variations['horizontal'] = esc_html__( 'Horizontal', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_reservation_filter_layouts', 'alloggio_core_add_room_reservation_filter_variation_horizontal' );
}