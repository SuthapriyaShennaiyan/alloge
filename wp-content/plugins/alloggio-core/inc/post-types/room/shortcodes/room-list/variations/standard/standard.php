<?php

if ( ! function_exists( 'alloggio_core_add_room_list_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_list_layouts', 'alloggio_core_add_room_list_variation_standard' );
}

if ( ! function_exists( 'alloggio_core_add_option_room_list_standard_layout' ) ) {
	/**
	 * Function that add additional options for current layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function alloggio_core_add_option_room_list_standard_layout( $options ) {
		$options[] = array(
			'field_type'  => 'text',
			'name'        => 'standard_item_bottom_margin',
			'title'       => esc_html__( 'Content Bottom Margin', 'alloggio-core' ),
			'dependency'  => array(
				'show' => array(
					'layout' => array(
						'values'        => array( 'standard' ),
						'default_value' => 'default',
					)
				)
			),
		);
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_room_list_extra_options', 'alloggio_core_add_option_room_list_standard_layout' );
}