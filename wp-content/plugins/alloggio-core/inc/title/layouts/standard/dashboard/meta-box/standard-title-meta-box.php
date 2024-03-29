<?php

if ( ! function_exists( 'alloggio_core_add_standard_title_layout_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_standard_title_layout_meta_box( $page ) {
		
		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'       => 'qodef_standard_title_section',
					'title'      => esc_html__( 'Standard Title', 'alloggio-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => 'standard',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle',
					'title'      => esc_html__( 'Subtitle', 'alloggio-core' )
				)
			);
			
			$section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_subtitle_tag',
					'title'         => esc_html__( 'Subtitle Tag', 'alloggio-core' ),
					'options'       => alloggio_core_get_select_type_options_pool( 'title_tag', true, array(), array( 'span' => esc_html__( 'Predefined', 'alloggio-core' ) ) ),
					'default_value' => 'span',
				)
			);
			
			$section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_subtitle_color',
					'title'      => esc_html__( 'Subtitle Color', 'alloggio-core' )
				)
			);
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_subtitle_top_margin',
					'title'       => esc_html__( 'Subtitle Top Margin', 'alloggio-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'alloggio-core' )
					)
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_standard_title_layout_meta_box_map', $section );
		}
	}
	
	add_action( 'alloggio_core_action_after_page_title_meta_box_map', 'alloggio_core_add_standard_title_layout_meta_box' );
}