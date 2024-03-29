<?php

if ( ! function_exists( 'alloggio_core_is_room_search_page_triggered' ) ) {
	/**
	 * Check is custom post type search page triggered
	 *
	 * @return bool
	 */
	function alloggio_core_is_room_search_page_triggered() {
		return is_search() && isset( $_GET['check_in'] ) && ! empty( $_GET['check_in'] ) && isset( $_GET['check_out'] ) && ! empty( $_GET['check_out'] );
	}
}

if ( ! function_exists( 'alloggio_core_add_room_cpt_search_page_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function alloggio_core_add_room_cpt_search_page_classes( $classes ) {
		
		if ( alloggio_core_is_room_search_page_triggered() ) {
			$classes[] = 'alloggio-core-room-search';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'alloggio_core_add_room_cpt_search_page_classes' );
}

if ( ! function_exists( 'alloggio_core_set_room_search_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function alloggio_core_set_room_search_sidebar_layout( $layout ) {
		
		if ( alloggio_core_is_room_search_page_triggered() ) {
			return 'no-sidebar';
		}

		return $layout;
	}

	add_filter( 'alloggio_filter_sidebar_layout', 'alloggio_core_set_room_search_sidebar_layout' );
}

if ( ! function_exists( 'alloggio_core_get_room_archive_search_arguments' ) ) {
	/**
	 * Function that return search arguments for archive pages
	 *
	 * @return array
	 */
	function alloggio_core_get_room_archive_search_arguments() {
		$params = array();
		
		// Query args
		$query_args = array(
			'check_in',
			'check_out',
			'type',
			'amount',
			'adult',
			'children',
			'infant',
		);
		
		foreach ( $query_args as $query_arg ) {
			if ( isset( $_GET[ $query_arg ] ) && ! empty( $_GET[ $query_arg ] ) ) {
				$params['query_options'][ $query_arg ] = esc_attr( strip_tags( $_GET[ $query_arg ] ) );
			}
		}
		
		// Layout args
		$layout_args = array(
			'layout',
			'columns',
			'excerpt_length',
		);
		
		foreach ( $layout_args as $layout_arg ) {
			if ( isset( $_GET[ $layout_arg ] ) && ! empty( $_GET[ $layout_arg ] ) ) {
				$params[ $layout_arg ] = sanitize_text_field( $_GET[ $layout_arg ] );
			}
		}
		
		return $params;
	}
}

if ( ! function_exists( 'alloggio_core_override_room_search_template_path' ) ) {
	/**
	 * Function that override default search page template content
	 *
	 * @param string|html $search
	 *
	 * @return string|html
	 */
	function alloggio_core_override_room_search_template_path( $search ) {
		
		if ( alloggio_core_is_room_search_page_triggered() ) {
			return alloggio_core_get_template_part( 'post-types/room/search', 'templates/search', '', alloggio_core_get_room_archive_search_arguments() );
		}

		return $search;
	}

	add_filter( 'alloggio_filter_search_archive_template', 'alloggio_core_override_room_search_template_path' );
}

if ( ! function_exists( 'alloggio_core_set_room_search_page_title_text' ) ) {
	/**
	 * Function that override current page title text for custom post type search pages
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	function alloggio_core_set_room_search_page_title_text( $title ) {
		
		if ( alloggio_core_is_room_search_page_triggered() ) {
			$title = esc_html__( 'Available Rooms', 'alloggio-core' );
		}
		
		return $title;
	}
	
	add_filter( 'alloggio_filter_page_title_text', 'alloggio_core_set_room_search_page_title_text' );
}