<?php

if ( ! function_exists( 'alloggio_core_add_link_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_link_typography_options( $page ) {
		
		if ( $page ) {
			$link_tab = $page->add_tab_element( array(
				'name'        => 'tab-link',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Link Typography', 'alloggio-core' ),
				'description' => esc_html__( 'Set values for link', 'alloggio-core' )
			) );
			
			$link_typography_section = $link_tab->add_section_element(
				array(
					'name'  => 'qodef_link_typography_section',
					'title' => esc_html__( 'General Typography', 'alloggio-core' )
				)
			);
			
			$link_typography_row = $link_typography_section->add_row_element(
				array (
					'name'  => 'qodef_link_typography_row',
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_color',
					'title'      => esc_html__( 'Color', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_hover_color',
					'title'      => esc_html__( 'Hover Color', 'alloggio-core' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_weight',
					'title'      => esc_html__( 'Font Weight', 'alloggio-core' ),
					'options'    => alloggio_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_style',
					'title'      => esc_html__( 'Font Style', 'alloggio-core' ),
					'options'    => alloggio_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'alloggio-core' ),
					'options'    => alloggio_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_hover_text_decoration',
					'title'      => esc_html__( 'Hover Text Decoration', 'alloggio-core' ),
					'options'    => alloggio_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
		}
	}
	
	add_action( 'alloggio_core_action_after_typography_options_map', 'alloggio_core_add_link_typography_options' );
}