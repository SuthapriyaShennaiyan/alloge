<?php

if ( ! function_exists( 'alloggio_core_add_room_reservation_filter_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_room_reservation_filter_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreRoomReservationFilterShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_room_reservation_filter_shortcode' );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreRoomReservationFilterShortcode extends AlloggioCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'alloggio_core_filter_room_reservation_filter_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'alloggio_core_filter_room_reservation_filter_extra_options', array() ) );
		
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_CPT_URL_PATH . '/room/shortcodes/room-reservation-filter' );
			$this->set_base( 'alloggio_core_room_reservation_filter' );
			$this->set_name( esc_html__( 'Room Reservation Filter', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays rooms reservation filter', 'alloggio-core' ) );
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
			
			$options_map = alloggio_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'alloggio-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'show_room_types',
				'title'         => esc_html__( 'Show Room Types', 'alloggio-core' ),
				'description'   => esc_html__( 'Enabling this option will show room type dropdown filter option', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'no',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'show_room_amount',
				'title'         => esc_html__( 'Show Room Amount', 'alloggio-core' ),
				'description'   => esc_html__( 'Enabling this option will show room amount dropdown filter option', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes',
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'button_label',
				'title'       => esc_html__( 'Button Label', 'alloggio-core' ),
				'description' => esc_html__( 'Default value is "Check Availability"', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'alloggio-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'alloggio-core' ),
					'light' => esc_html__( 'Light', 'alloggio-core' )
				)
			) );
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'alloggio_core_room_reservation_filter', $params );
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
		
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['holder_styles']   = $this->get_holder_styles( $atts );
			$atts['check_in_dates']  = alloggio_core_get_rooms_reserved_dates( true, 'check-in' );
			$atts['check_out_dates'] = alloggio_core_get_rooms_reserved_dates();
			
			return alloggio_core_get_template_part( 'post-types/room/shortcodes/room-reservation-filter', 'templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-room-reservation-filter';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = $atts['show_room_types'] === 'no' && $atts['show_room_amount'] === 'no' ? 'qodef-columns--3' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['content_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['content_background_color'];
			}
			
			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['content_padding'];
			}
			
			return $styles;
		}
	}
}