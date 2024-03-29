<?php

if ( ! function_exists( 'alloggio_core_add_testimonials_list_variation_info_below' ) ) {
	function alloggio_core_add_testimonials_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'alloggio-core' );
		
		return $variations;
	}
	
	add_filter( 'alloggio_core_filter_testimonials_list_layouts', 'alloggio_core_add_testimonials_list_variation_info_below' );
}

if ( ! function_exists( 'alloggio_core_add_testimonials_list_options_info_below' ) ) {
	function alloggio_core_add_testimonials_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'alloggio-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'alloggio-core' )
		);
		$info_below_options[] = $margin_option;
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'alloggio_core_filter_testimonials_list_extra_options', 'alloggio_core_add_testimonials_list_options_info_below' );
}