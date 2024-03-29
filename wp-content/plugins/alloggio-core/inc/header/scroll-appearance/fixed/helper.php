<?php

if ( ! function_exists( 'alloggio_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function alloggio_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'alloggio-core' );

		return $options;
	}

	add_filter( 'alloggio_core_filter_header_scroll_appearance_option', 'alloggio_core_add_fixed_header_option' );
}