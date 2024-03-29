<?php

if ( ! function_exists( 'alloggio_core_is_back_to_top_enabled' ) ) {
	function alloggio_core_is_back_to_top_enabled() {
		return alloggio_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'alloggio_core_add_back_to_top_to_body_classes' ) ) {
	function alloggio_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = alloggio_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'alloggio_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'alloggio_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function alloggio_core_load_back_to_top() {
		
		if ( alloggio_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			alloggio_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'alloggio_action_before_wrapper_close_tag', 'alloggio_core_load_back_to_top' );
}