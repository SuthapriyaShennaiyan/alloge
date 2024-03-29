<?php

if ( ! function_exists( 'alloggio_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function alloggio_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'alloggio_filter_mobile_header_template', alloggio_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}
	
	add_action( 'alloggio_action_page_header_template', 'alloggio_load_page_mobile_header' );
}

if ( ! function_exists( 'alloggio_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function alloggio_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'alloggio_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'alloggio' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'alloggio_action_after_include_modules', 'alloggio_register_mobile_navigation_menus' );
}