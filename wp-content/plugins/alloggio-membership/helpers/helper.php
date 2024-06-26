<?php

if ( ! function_exists( 'alloggio_membership_include_membership_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function alloggio_membership_include_membership_is_installed( $installed, $plugin ) {
		
		if ( $plugin === 'membership' ) {
			return class_exists( 'AlloggioMembership' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'alloggio_membership_include_membership_is_installed', 10, 2 );
}

if ( ! function_exists( 'alloggio_membership_get_membership_redirect_url' ) ) {
	/**
	 * Function that return url for login redirection
	 *
	 * @param string $redirect_url
	 *
	 * @return string
	 */
	function alloggio_membership_get_membership_redirect_url( $redirect_url = '' ) {
		$page_id       = qode_framework_get_page_id();
		$redirect_uri  = esc_url( home_url( '/' ) );
		$dashboard_url = alloggio_membership_get_dashboard_page_url();
		
		if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
			$redirect_uri = wp_unslash( $redirect_url );
		} elseif ( ! empty( $dashboard_url ) ) {
			$redirect_uri = $dashboard_url;
		} elseif ( $page_id > 0 ) {
			$redirect_uri = get_permalink( $page_id );
		}
		
		return apply_filters( 'alloggio_membership_filter_redirect_url', esc_url( $redirect_uri ) );
	}
}

if ( ! function_exists( 'alloggio_membership_get_dashboard_page_url' ) ) {
	/**
	 * Function that return main dashboard page url
	 *
	 * @return string
	 */
	function alloggio_membership_get_dashboard_page_url() {
		$url                = '';
		$pages              = get_all_page_ids();
		$dashboard_template = apply_filters( 'alloggio_membership_filter_dashboard_template_name', '' );
		
		if ( ! empty( $dashboard_template ) && ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				if ( get_post_status( $page ) == 'publish' && get_page_template_slug( $page ) == $dashboard_template ) {
					$url = esc_url( get_the_permalink( $page ) );
					break;
				}
			}
		}
		
		return $url;
	}
}

if ( ! function_exists( 'alloggio_membership_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 */
	function alloggio_membership_template_part( $module, $template, $slug = '', $params = array() ) {
		echo alloggio_membership_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'alloggio_membership_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function alloggio_membership_get_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = ALLOGGIO_MEMBERSHIP_INC_PATH;
		
		return qode_framework_get_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'alloggio_membership_get_grid_gutter_classes' ) ) {
	/**
	 * Function that returns classes for the gutter when sidebar is enabled
	 *
	 * @return string
	 */
	function alloggio_membership_get_grid_gutter_classes() {
		return qode_framework_is_installed( 'theme' ) ? alloggio_get_grid_gutter_classes() : '';
	}
}

if ( ! function_exists( 'alloggio_membership_get_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position
	 *
	 * @param string $map
	 *
	 * @return int
	 */
	function alloggio_membership_get_admin_options_map_position( $map ) {
		return qode_framework_is_installed( 'core' ) ? alloggio_core_get_admin_options_map_position( $map ) : 10;
	}
}