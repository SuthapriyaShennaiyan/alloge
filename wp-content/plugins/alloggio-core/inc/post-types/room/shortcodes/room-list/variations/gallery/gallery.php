<?php

if ( ! function_exists( 'alloggio_core_add_room_list_variation_gallery' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function alloggio_core_add_room_list_variation_gallery( $variations ) {
		$variations['gallery'] = esc_html__( 'Gallery', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_room_list_layouts', 'alloggio_core_add_room_list_variation_gallery' );
}

if ( ! function_exists( 'alloggio_core_add_room_list_options_gallery' ) ) {
	function alloggio_core_add_room_list_options_gallery( $options ) {
		$gallery_options   = array();
		$info_visible_option      = array(
			'field_type' => 'select',
			'name'       => 'visible_info',
			'title'      => esc_html__( 'Info Initially Visible', 'alloggio-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'gallery',
						'default_value' => ''
					)
				),
			),
			'options'    => alloggio_core_get_select_type_options_pool( 'no_yes', false ),
			'group'      => esc_html__( 'Layout', 'alloggio-core' )
		);
		$gallery_options[] = $info_visible_option;
		
		return array_merge( $options, $gallery_options );
	}
	
	add_filter( 'alloggio_core_filter_room_list_extra_options', 'alloggio_core_add_room_list_options_gallery' );
}