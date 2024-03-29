<?php

include_once ALLOGGIO_CORE_CPT_PATH . '/room/payment-helper.php';
include_once ALLOGGIO_CORE_CPT_PATH . '/room/helper.php';

// Include search custom template
include_once ALLOGGIO_CORE_CPT_PATH . '/room/search/include.php';

// Include profile custom template
include_once ALLOGGIO_CORE_CPT_PATH . '/room/profile/helper.php';

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/dashboard/admin/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/dashboard/booking/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/templates/single/*/include.php' ) as $single_part ) {
	include_once $single_part;
}

if ( ! function_exists( 'alloggio_core_include_room_taxonomy_options' ) ) {
	/**
	 * Function that include module taxonomy options
	 */
	function alloggio_core_include_room_taxonomy_options() {
		include_once ALLOGGIO_CORE_CPT_PATH . '/room/dashboard/taxonomy/taxonomy-options.php';
	}
	
	add_action( 'alloggio_core_action_include_cpt_tax_fields', 'alloggio_core_include_room_taxonomy_options' );
}