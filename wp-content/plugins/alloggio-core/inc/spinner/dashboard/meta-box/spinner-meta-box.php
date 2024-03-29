<?php

if ( ! function_exists( 'alloggio_core_add_page_spinner_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_page_spinner_meta_box( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_spinner',
					'title'       => esc_html__( 'Enable Page Spinner', 'alloggio-core' ),
					'description' => esc_html__( 'Enable Page Spinner Effect', 'alloggio-core' ),
					'options'     => alloggio_core_get_select_type_options_pool( 'yes_no' )
				)
			);
			
			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_spinner_section',
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'alloggio-core' ),
					'options'       => apply_filters( 'alloggio_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'alloggio_core_filter_page_spinner_default_layout_option', '' ),
				)
			);
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_page_spinner_text',
					'title'         => esc_html__( 'Spinner Text', 'alloggio-core' ),
					'description'   => esc_html__( 'Choose the spinner text', 'alloggio-core' ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_page_spinner_type' => array(
								'values'        => 'textual',
								'default_value' => 'textual'
							)
						)
					)
				)
			);
		}
	}
	
	add_action( 'alloggio_core_action_after_general_page_meta_box_map', 'alloggio_core_add_page_spinner_meta_box', 9 );
}