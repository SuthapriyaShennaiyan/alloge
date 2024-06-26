<?php

if ( ! function_exists( 'alloggio_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add mobile header options for this module
	 */
	function alloggio_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {
			
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'alloggio-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'alloggio-core' )
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'alloggio-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'alloggio-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_main',
					'title'       => esc_html__( 'Mobile Logo - Main', 'alloggio-core' ),
					'description' => esc_html__( 'Choose main mobile logo image', 'alloggio-core' ),
					'default_value' => defined( 'ALLOGGIO_ASSETS_ROOT' ) ? ALLOGGIO_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'    => 'no'
				)
			);
			
			do_action( 'alloggio_core_action_after_mobile_logo_options_map', $page );
		}
	}
	
	add_action( 'alloggio_core_action_after_header_logo_options_map', 'alloggio_core_add_mobile_logo_options', 10, 2 );
}