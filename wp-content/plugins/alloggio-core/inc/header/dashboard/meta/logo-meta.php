<?php

if ( ! function_exists( 'alloggio_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function alloggio_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'alloggio-core' ),
					'description' => esc_html__( 'Logo settings', 'alloggio-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'alloggio-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'alloggio-core' ),
					'description' => esc_html__( 'Enter logo height', 'alloggio-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'alloggio-core' ),
					'description' => esc_html__( 'Choose main logo image', 'alloggio-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'alloggio-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'alloggio-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'alloggio-core' ),
					'description' => esc_html__( 'Choose light logo image', 'alloggio-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'alloggio_core_action_after_general_meta_box_map', 'alloggio_core_add_page_logo_meta_box' );
}

if ( ! function_exists( 'alloggio_core_add_general_logo_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function alloggio_core_add_general_logo_meta_box_callback( $callbacks ) {
		$callbacks['logo'] = 'alloggio_core_add_page_logo_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'alloggio_core_filter_general_meta_box_callbacks', 'alloggio_core_add_general_logo_meta_box_callback' );
}