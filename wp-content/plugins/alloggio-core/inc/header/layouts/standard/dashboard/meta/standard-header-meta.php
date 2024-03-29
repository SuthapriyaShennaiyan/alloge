<?php

if ( ! function_exists( 'alloggio_core_add_standard_header_meta' ) ) {
	function alloggio_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'alloggio-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'alloggio-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'alloggio-core' ),
				'default_value' => '',
				'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header height', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'alloggio-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'alloggio-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'alloggio-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'alloggio-core' )
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'alloggio-core' ),
				'description' => esc_html__( 'Enter header background color', 'alloggio-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'alloggio-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'alloggio-core' ),
					'left'   => esc_html__( 'Left', 'alloggio-core' ),
					'center' => esc_html__( 'Center', 'alloggio-core' ),
					'right'  => esc_html__( 'Right', 'alloggio-core' ),
				)
			)
		);

	}
	
	add_action( 'alloggio_core_action_after_page_header_meta_map', 'alloggio_core_add_standard_header_meta' );
}