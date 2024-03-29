<?php

if ( ! function_exists( 'alloggio_core_add_room_list_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_list_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_list_layouts', 'alloggio_core_add_room_list_variation_simple' );
}

if ( ! function_exists( 'alloggio_core_add_option_room_list_simple_layout' ) ) {
	/**
	 * Function that add additional options for current layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function alloggio_core_add_option_room_list_simple_layout( $options ) {
		$options[] = array(
			'field_type'  => 'text',
			'name'        => 'simple_item_bottom_margin',
			'title'       => esc_html__( 'Content Bottom Margin', 'alloggio-core' ),
			'dependency'  => array(
				'show' => array(
					'layout' => array(
						'values'        => array( 'simple' ),
						'default_value' => 'default',
					)
				)
			),
		);
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_room_list_extra_options', 'alloggio_core_add_option_room_list_simple_layout' );
}