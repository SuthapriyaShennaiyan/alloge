<?php

if ( ! function_exists( 'alloggio_core_add_restaurant_menu_list_variation_info_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_restaurant_menu_list_variation_info_standard( $variations ) {
		$variations['info-standard'] = esc_html__( 'Info Standard', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_restaurant_menu_list_layouts', 'alloggio_core_add_restaurant_menu_list_variation_info_standard' );
}