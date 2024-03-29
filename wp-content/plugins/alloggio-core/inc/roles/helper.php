<?php

if ( ! function_exists( 'alloggio_core_include_role_custom_fields' ) ) {
	/**
	 * Function that includes role custom fields files
	 */
	function alloggio_core_include_role_custom_fields() {
		foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/roles/*/role-fields.php' ) as $role_fields ) {
			include_once $role_fields;
		}
	}
	
	add_action( 'qode_framework_action_custom_user_fields', 'alloggio_core_include_role_custom_fields' );
}

if ( ! function_exists( 'alloggio_core_register_role_custom_fields' ) ) {
	/**
	 * Function that registers role custom fields files
	 */
	function alloggio_core_register_role_custom_fields() {
		do_action( 'alloggio_core_action_register_role_custom_fields' );
	}
	
	add_action( 'qode_framework_action_custom_user_fields', 'alloggio_core_register_role_custom_fields', 11 );
}