<?php

if ( ! function_exists( 'alloggio_core_set_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 * 
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function alloggio_core_set_custom_sidebar_name( $sidebar_name ) {
		$option = alloggio_core_get_post_value_through_levels( 'qodef_page_custom_sidebar' );
		
		if ( ! empty( $option ) ) {
			$sidebar_name = $option;
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'alloggio_filter_sidebar_name', 'alloggio_core_set_custom_sidebar_name', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'alloggio_core_set_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function alloggio_core_set_sidebar_layout( $layout ) {
		$option = alloggio_core_get_post_value_through_levels( 'qodef_page_sidebar_layout' );
		
		if ( ! empty( $option ) ) {
			$layout = $option;
		}
		
		return $layout;
	}
	
	add_filter( 'alloggio_filter_sidebar_layout', 'alloggio_core_set_sidebar_layout', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'alloggio_core_set_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_sidebar_grid_gutter_classes( $classes ) {
		$option = alloggio_core_get_post_value_through_levels( 'qodef_page_sidebar_grid_gutter' );
		
		if ( ! empty( $option ) ) {
			$classes = 'qodef-gutter--' . esc_attr( $option );
		}
		
		return $classes;
	}
	
	add_filter('alloggio_filter_grid_gutter_classes', 'alloggio_core_set_sidebar_grid_gutter_classes', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'alloggio_core_set_page_sidebar_aside_classes' ) ) {
	/**
	 * Function that returns page sidebar aside classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_page_sidebar_aside_classes( $classes ) {
		$option = alloggio_core_get_post_value_through_levels( 'qodef_page_sidebar_bg_strip' );
		
		if ( $option === 'yes' ) {
			$classes = 'qodef--has-strip';
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_page_sidebar_aside_classes', 'alloggio_core_set_page_sidebar_aside_classes' );
}