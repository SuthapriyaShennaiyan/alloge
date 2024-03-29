<?php

class AlloggioCoreElementorSectionTitle extends AlloggioCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'alloggio_core_section_title' );

		parent::__construct( $data, $args );
	}
}

alloggio_core_register_new_elementor_widget( new AlloggioCoreElementorSectionTitle() );
