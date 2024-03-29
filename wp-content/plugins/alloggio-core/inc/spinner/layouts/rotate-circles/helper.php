<?php

if ( ! function_exists( 'alloggio_core_add_rotate_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function alloggio_core_add_rotate_circles_spinner_layout_option( $layouts ) {
		$layouts['rotate-circles'] = esc_html__( 'Rotate Circles', 'alloggio-core' );
		
		return $layouts;
	}
	
	add_filter( 'alloggio_core_filter_page_spinner_layout_options', 'alloggio_core_add_rotate_circles_spinner_layout_option' );
}