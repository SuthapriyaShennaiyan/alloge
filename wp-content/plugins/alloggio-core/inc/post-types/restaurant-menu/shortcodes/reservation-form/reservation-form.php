<?php

if ( ! function_exists( 'alloggio_core_add_reservation_form_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_reservation_form_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreReservationFormShortcode';

		return $shortcodes;
	}

	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_reservation_form_shortcode', 9 );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreReservationFormShortcode extends AlloggioCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/restaurant-menu/shortcodes/reservation-form' );
			$this->set_base( 'alloggio_core_reservation_form' );
			$this->set_name( esc_html__( 'Reservation Form', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays reservation form with provided parameters', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_scripts(
				array(
					'datepicker' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_CPT_URL_PATH . '/restaurant-menu/shortcodes/reservation-form/assets/js/plugins/datepicker.min.js',
						'dependency'	=> array( 'jquery' )
					)
				)
			);
			$this->set_necessary_styles(
				array(
					'datepicker' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_CPT_URL_PATH . '/restaurant-menu/shortcodes/reservation-form/assets/css/plugins/jQueryDatepicker.css'
					)
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'open_table_id',
				'title'      => esc_html__( 'OpenTable ID', 'alloggio-core' ),
			) );
		}

		public function load_assets() {
			wp_enqueue_script( 'datepicker' );
			wp_enqueue_style( 'datepicker' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return alloggio_core_get_template_part( 'post-types/restaurant-menu/shortcodes/reservation-form', 'templates/reservation-form', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-reservation-form';

			return implode( ' ', $holder_classes );
		}
	}
}