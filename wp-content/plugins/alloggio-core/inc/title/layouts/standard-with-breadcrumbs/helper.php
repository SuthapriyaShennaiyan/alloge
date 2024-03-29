<?php

if ( ! function_exists( 'alloggio_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function alloggio_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'AlloggioCoreStandardWithBreadcrumbsTitle';

		return $layouts;
	}

	add_filter( 'alloggio_core_filter_register_title_layouts', 'alloggio_core_register_standard_with_breadcrumbs_title_layout' );
}

if ( ! function_exists( 'alloggio_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function alloggio_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard with breadcrumbs', 'alloggio-core' );

		return $layouts;
	}

	add_filter( 'alloggio_core_filter_title_layout_options', 'alloggio_core_add_standard_with_breadcrumbs_title_layout_option' );
}

