<?php

if ( ! function_exists( 'alloggio_core_register_fullscreen_menu' ) ) {
	function alloggio_core_register_fullscreen_menu( $menus ) {
		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'alloggio-core' );
		
		return $menus;
	}
	
	add_filter( 'alloggio_filter_register_navigation_menus', 'alloggio_core_register_fullscreen_menu' );
}

if ( ! function_exists( 'alloggio_core_register_sidebar_fullscreen_menu' ) ) {
	function alloggio_core_register_sidebar_fullscreen_menu() {
		register_sidebar(
			array(
				'id'            => 'qodef-fullscreen-menu-widget-area',
				'name'          => esc_html__( 'Fullscreen Menu Area', 'alloggio-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in fullscreen menu area', 'alloggio-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'alloggio_core_action_additional_header_widgets_area', 'alloggio_core_register_sidebar_fullscreen_menu' );
}

if ( ! function_exists( 'alloggio_core_set_fullscreen_menu_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function alloggio_core_set_fullscreen_menu_area_styles( $style ) {
		$styles           = array();
		$background_color = alloggio_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_color' );
		$background_image = alloggio_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_image' );
		
		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $background_image ) ) {
			$styles['background-image'] = 'url('. wp_get_attachment_image_url( $background_image, 'full' ) .')';
			$styles['background-size'] = 'cover';
		}
		
		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-fullscreen-area', $styles );
		}
		
		return $style;
	}
	
	add_filter( 'alloggio_filter_add_inline_style', 'alloggio_core_set_fullscreen_menu_area_styles' );
}

if ( ! function_exists( 'alloggio_core_set_fullscreen_menu_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function alloggio_core_set_fullscreen_menu_typography_styles( $style ) {
		$scope = ALLOGGIO_CORE_OPTIONS_NAME;
		
		$first_lvl_styles        = alloggio_core_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$first_lvl_hover_styles  = alloggio_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$second_lvl_styles       = alloggio_core_get_typography_styles( $scope, 'qodef_fullscreen_2nd_lvl' );
		$second_lvl_hover_styles = alloggio_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_2nd_lvl' );
		
		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}
		
		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a:hover', $first_lvl_hover_styles );
		}
		
		$first_lvl_active_color = alloggio_core_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_active_color' );
		
		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles = array(
				'color' => $first_lvl_active_color
			);
			
			$style .= qode_framework_dynamic_style( array(
				'.qodef-fullscreen-menu > ul >li.current-menu-ancestor > a',
				'.qodef-fullscreen-menu > ul >li.current-menu-item > a'
			), $first_lvl_active_styles );
		}
		
		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a', $second_lvl_styles );
		}
		
		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a:hover', $second_lvl_hover_styles );
		}
		
		$second_lvl_active_color = alloggio_core_get_option_value( 'admin', 'qodef_fullscreen_2nd_lvl_active_color' );
		
		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles = array(
				'color' => $second_lvl_active_color
			);
			
			$style .= qode_framework_dynamic_style( array(
				'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-ancestor > a',
				'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-item > a'
			), $second_lvl_active_styles );
		}
		
		return $style;
	}
	
	add_filter( 'alloggio_filter_add_inline_style', 'alloggio_core_set_fullscreen_menu_typography_styles' );
}