<?php

if ( ! function_exists( 'alloggio_core_add_room_reservation_filter_variation_revolution_slider' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_reservation_filter_variation_revolution_slider( $variations ) {
		$variations['revolution-slider'] = esc_html__( 'Revolution Slider', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_reservation_filter_layouts', 'alloggio_core_add_room_reservation_filter_variation_revolution_slider' );
}

if ( ! function_exists( 'alloggio_core_add_option_room_reservation_filter_revolution_slider_layout' ) ) {
	/**
	 * Function that add additional options for current layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function alloggio_core_add_option_room_reservation_filter_revolution_slider_layout( $options ) {
		$options[] = array(
			'field_type' => 'select',
			'name'       => 'revolution_slider',
			'title'      => esc_html__( 'Revolution Slider', 'alloggio-core' ),
			'options'    => alloggio_core_get_room_reservation_filter_revolution_sliders(),
			'dependency'  => array(
				'show' => array(
					'layout' => array(
						'values'        => 'revolution-slider',
						'default_value' => 'default',
					)
				)
			),
		);
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_room_reservation_filter_extra_options', 'alloggio_core_add_option_room_reservation_filter_revolution_slider_layout' );
}