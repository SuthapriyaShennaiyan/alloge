<?php

if ( ! function_exists( 'alloggio_core_add_room_reservation_filter_variation_vertical' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_reservation_filter_variation_vertical( $variations ) {
		$variations['vertical'] = esc_html__( 'Vertical', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_reservation_filter_layouts', 'alloggio_core_add_room_reservation_filter_variation_vertical' );
}

if ( ! function_exists( 'alloggio_core_add_option_room_reservation_filter_vertical_layout' ) ) {
	/**
	 * Function that add additional options for current layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function alloggio_core_add_option_room_reservation_filter_vertical_layout( $options ) {
		$options[] = array(
			'field_type'  => 'text',
			'name'        => 'title_label',
			'title'       => esc_html__( 'Title Label', 'alloggio-core' ),
			'description' => esc_html__( 'Default value is "Check Availability"', 'alloggio-core' ),
			'dependency'  => array(
				'show' => array(
					'layout' => array(
						'values'        => array( 'vertical', 'split' ),
						'default_value' => 'default',
					)
				)
			),
		);
		$options[] = array(
			'field_type' => 'color',
			'name'       => 'content_background_color',
			'title'      => esc_html__( 'Content Background Color', 'alloggio-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => array( 'vertical', 'split' ),
						'default_value' => 'default',
					)
				)
			),
		);
		$options[] = array(
			'field_type' => 'text',
			'name'       => 'content_padding',
			'title'      => esc_html__( 'Content Padding', 'alloggio-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => array( 'vertical', 'split' ),
						'default_value' => 'default',
					)
				)
			),
		);
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_room_reservation_filter_extra_options', 'alloggio_core_add_option_room_reservation_filter_vertical_layout' );
}