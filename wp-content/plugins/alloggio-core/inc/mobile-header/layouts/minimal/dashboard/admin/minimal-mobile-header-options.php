<?php

if ( ! function_exists( 'alloggio_core_add_minimal_mobile_header_options' ) ) {
	function alloggio_core_add_minimal_mobile_header_options( $page, $general_tab ) {
		
		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'alloggio-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header height', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'alloggio-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header background color', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'alloggio-core' )
				)
			)
		);
	}
	
	add_action( 'alloggio_core_action_after_mobile_header_options_map', 'alloggio_core_add_minimal_mobile_header_options', 10, 2 );
}