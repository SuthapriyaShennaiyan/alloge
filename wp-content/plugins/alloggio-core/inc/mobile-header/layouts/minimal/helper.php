<?php

if ( ! function_exists( 'alloggio_core_add_minimal_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function alloggio_core_add_minimal_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => ALLOGGIO_CORE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'alloggio-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'alloggio_core_filter_mobile_header_layout_option', 'alloggio_core_add_minimal_mobile_header_global_option' );
}

if ( ! function_exists( 'alloggio_core_register_minimal_mobile_header_layout' ) ) {
	function alloggio_core_register_minimal_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layout = array(
			'minimal' => 'MinimalMobileHeader'
		);

		$mobile_header_layouts = array_merge( $mobile_header_layouts, $mobile_header_layout );

		return $mobile_header_layouts;
	}

	add_filter( 'alloggio_core_filter_register_mobile_header_layouts', 'alloggio_core_register_minimal_mobile_header_layout');
}

if ( ! function_exists( 'alloggio_core_minimal_mobile_header_hide_menu_typography' ) ) {
	function alloggio_core_minimal_mobile_header_hide_menu_typography( $options ) {
		$options[] = 'minimal';
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_mobile_menu_typography_hide_option', 'alloggio_core_minimal_mobile_header_hide_menu_typography' );
}