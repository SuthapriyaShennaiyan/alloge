<?php

if ( ! function_exists( 'alloggio_core_add_room_amenity_options' ) ) {
	/**
	 * Function that add general taxonomy options for this module
	 */
	function alloggio_core_add_room_amenity_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'amenity' ),
				'type'  => 'taxonomy',
				'slug'  => 'amenity',
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_amenity_svg_icon',
					'title'      => esc_html__( 'Amenity SVG Icon', 'alloggio-core' ),
					'options'    => alloggio_core_get_room_amenity_svg_icons(),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'textareasvg',
					'name'       => 'qodef_amenity_custom_svg_icon',
					'title'      => esc_html__( 'Amenity Custom SVG Icon', 'alloggio-core' ),
				)
			);
		}
	}
	
	add_action( 'alloggio_core_action_register_cpt_tax_fields', 'alloggio_core_add_room_amenity_options' );
}