<?php

if ( ! function_exists( 'alloggio_core_dependency_for_mobile_menu_typography_options' ) ) {
	function alloggio_core_dependency_for_mobile_menu_typography_options() {
		return apply_filters( 'alloggio_core_filter_mobile_menu_typography_hide_option', $hide_dep_options = array() );
	}
}