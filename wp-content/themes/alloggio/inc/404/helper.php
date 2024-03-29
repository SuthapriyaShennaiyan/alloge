<?php

if ( ! function_exists( 'alloggio_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_set_404_page_inner_classes( $classes ) {
		
		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_page_inner_classes', 'alloggio_set_404_page_inner_classes' );
}

if ( ! function_exists( 'alloggio_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function alloggio_get_404_page_parameters() {
		
		$params = array(
			'watermark'   => esc_html__( '404', 'alloggio' ),
			'title'       => esc_html__( 'Page not found', 'alloggio' ),
			'text'        => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'alloggio' ),
			'button_text' => esc_html__( 'Back to homepage', 'alloggio' ),
		);
		
		return apply_filters( 'alloggio_filter_404_page_template_params', $params );
	}
}
