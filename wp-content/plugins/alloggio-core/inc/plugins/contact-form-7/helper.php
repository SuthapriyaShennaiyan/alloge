<?php

if ( ! function_exists( 'alloggio_core_get_contact_form_7_forms' ) ) {
	/**
	 * Function that return array of contact form 7 forms
	 *
	 * @param bool $enable_default  - add first element empty for default value
	 *
	 * @return array
	 */
	function alloggio_core_get_contact_form_7_forms( $enable_default = true ) {
		$options       = array();
		$contact_forms = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		if ( ! empty( $contact_forms ) ) {
			if ( $enable_default ) {
				$options[''] = esc_html__( 'Default', 'alloggio-core' );
			}
			
			foreach ( $contact_forms as $contact_form ) {
				$options[ $contact_form->ID ] = esc_html( $contact_form->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No contact forms found', 'alloggio-core' );
		}
		
		return $options;
	}
}