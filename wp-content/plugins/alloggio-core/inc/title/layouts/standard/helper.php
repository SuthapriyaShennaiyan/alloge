<?php

if ( ! function_exists( 'alloggio_core_register_standard_title_layout' ) ) {
	function alloggio_core_register_standard_title_layout( $layouts ) {
		$layouts['standard'] = 'AlloggioCoreStandardTitle';
		
		return $layouts;
	}
	
	add_filter( 'alloggio_core_filter_register_title_layouts', 'alloggio_core_register_standard_title_layout');
}

if ( ! function_exists( 'alloggio_core_add_standard_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function alloggio_core_add_standard_title_layout_option( $layouts ) {
		$layouts['standard'] = esc_html__( 'Standard', 'alloggio-core' );
		
		return $layouts;
	}
	
	add_filter( 'alloggio_core_filter_title_layout_options', 'alloggio_core_add_standard_title_layout_option' );
}

if ( ! function_exists( 'alloggio_core_get_standard_title_layout_subtitle_text' ) ) {
	/**
	 * Function that render current page subtitle text
	 */
	function alloggio_core_get_standard_title_layout_subtitle_text() {
		$subtitle_meta = alloggio_core_get_post_value_through_levels( 'qodef_page_title_subtitle' );
		$subtitle_tag  = alloggio_core_get_post_value_through_levels( 'qodef_page_title_subtitle_tag' );
		
		$subtitle = array(
			'subtitle'     => ! empty( $subtitle_meta ) ? $subtitle_meta : '',
			'subtitle_tag' => ! empty( $subtitle_tag ) ? $subtitle_tag : 'p',
		);
		
		return apply_filters( 'alloggio_core_filter_standard_title_layout_subtitle_text', $subtitle );
	}
}
