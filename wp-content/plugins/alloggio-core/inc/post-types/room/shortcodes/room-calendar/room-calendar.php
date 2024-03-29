<?php

if ( ! function_exists( 'alloggio_core_add_room_calendar_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_room_calendar_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreRoomCalendarShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_room_calendar_shortcode' );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreRoomCalendarShortcode extends AlloggioCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/room/shortcodes/room-calendar' );
			$this->set_base( 'alloggio_core_room_calendar' );
			$this->set_name( esc_html__( 'Room Calendar', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays rooms calendar', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			
			$this->set_scripts(
				array(
					'jquery-plugin' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.plugin.min.js',
						'dependency'	=> array( 'jquery' ),
					),
					'datepick' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.datepick.min.js',
						'dependency'	=> array( 'jquery-plugin' ),
					),
				)
			);
			
			$this->set_necessary_styles(
				array(
					'datepick' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_ASSETS_URL_PATH . '/plugins/datepick/jquery.datepick.css'
					)
				)
			);
			
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' ),
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'alloggio_core_room_calendar', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			wp_enqueue_style( 'datepick' );
			
			wp_enqueue_script( 'jquery-plugin' );
			wp_enqueue_script( 'datepick' );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
		
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['reserved_dates'] = alloggio_core_get_rooms_reserved_dates( true, 'check-in' );
			
			return alloggio_core_get_template_part( 'post-types/room/shortcodes/room-calendar', 'templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-room-calendar';
			
			return implode( ' ', $holder_classes );
		}
	}
}