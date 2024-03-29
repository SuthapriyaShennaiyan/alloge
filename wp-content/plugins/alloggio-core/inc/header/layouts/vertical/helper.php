<?php

if ( ! function_exists( 'alloggio_core_add_vertical_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function alloggio_core_add_vertical_header_global_option( $header_layout_options ) {
		$header_layout_options['vertical'] = array(
			'image' => ALLOGGIO_CORE_HEADER_LAYOUTS_URL_PATH . '/vertical/assets/img/vertical-header.png',
			'label' => esc_html__( 'Vertical', 'alloggio-core' )
		);
		
		return $header_layout_options;
	}
	
	add_filter( 'alloggio_core_filter_header_layout_option', 'alloggio_core_add_vertical_header_global_option' );
}

if ( ! function_exists( 'alloggio_core_register_vertical_header_layout' ) ) {
	function alloggio_core_register_vertical_header_layout( $header_layouts ) {
		$header_layout = array(
			'vertical' => 'VerticalHeader'
		);
		
		$header_layouts = array_merge( $header_layouts, $header_layout );
		
		return $header_layouts;
	}
	
	add_filter( 'alloggio_core_filter_register_header_layouts', 'alloggio_core_register_vertical_header_layout' );
}

if ( ! function_exists( 'alloggio_core_vertical_header_nav_menu_grid' ) ) {
	function alloggio_core_vertical_header_nav_menu_grid( $grid_class ) {
		$header = alloggio_core_get_post_value_through_levels( 'qodef_header_layout' );
		
		if ( $header == 'vertical' ) {
			return false;
		}
		
		return $grid_class;
	}
	
	add_filter( 'alloggio_core_filter_drop_down_grid', 'alloggio_core_vertical_header_nav_menu_grid' );
}

if ( ! function_exists( 'alloggio_core_register_vertical_menu' ) ) {
	function alloggio_core_register_vertical_menu( $menus ) {
		$menus['vertical-menu-navigation'] = esc_html__( 'Vertical Navigation', 'alloggio-core' );
		
		return $menus;
	}
	
	add_filter( 'alloggio_filter_register_navigation_menus', 'alloggio_core_register_vertical_menu' );
}

if ( ! function_exists( 'alloggio_core_vertical_header_hide_top_area' ) ) {
	function alloggio_core_vertical_header_hide_top_area( $options ) {
		$options[] = 'vertical';
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_top_area_hide_option', 'alloggio_core_vertical_header_hide_top_area' );
}

if ( ! function_exists( 'alloggio_core_vertical_header_hide_scroll_appearance' ) ) {
	function alloggio_core_vertical_header_hide_scroll_appearance( $options ) {
		$options[] = 'vertical';
		
		return $options;
	}
	
	add_filter( 'alloggio_core_filter_header_scroll_appearance_hide_option', 'alloggio_core_vertical_header_hide_scroll_appearance' );
}