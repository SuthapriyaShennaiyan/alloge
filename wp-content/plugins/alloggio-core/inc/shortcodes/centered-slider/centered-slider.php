<?php

if ( ! function_exists( 'alloggio_core_add_centered_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_centered_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreCenteredSliderShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_centered_slider_shortcode' );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreCenteredSliderShortcode extends AlloggioCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_SHORTCODES_URL_PATH . '/centered-slider' );
			$this->set_base( 'alloggio_core_centered_slider' );
			$this->set_name( esc_html__( 'Centered Slider', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that add centered slider element', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'enable_slider_animation',
				'title'       => esc_html__( 'Enable Image Hover', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'yes_no', 'false' ),
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Slider Items', 'alloggio-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'alloggio-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Slide Image', 'alloggio-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Slide Title', 'alloggio-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_subtitle',
						'title'      => esc_html__( 'Slide Subtitle', 'alloggio-core' )
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Item Title Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'slider_navigation',
				'title'         => esc_html__( 'Slider Navigation', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'yes'
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			
			$atts['has_title'] = false;
			if ( ! empty( $atts['items'] ) ) {
				foreach ( $atts['items'] as $item ) {
					
					if ( isset( $item['item_title'] ) && ! empty( $item['item_title'] ) ) {
						$atts['has_title'] = true;
						break;
					}
				}
			}
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['this_shortcode'] = $this;
			
			return alloggio_core_get_template_part( 'shortcodes/centered-slider', 'templates/centered-slider', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-centered-slider qodef-swiper-container';
			$holder_classes[] = $atts['enable_slider_animation'] == 'yes' ? 'qodef---has-hover' : '';
			
			if ( $atts['has_title'] ) {
				$holder_classes[] = 'qodef--has-title';
			}
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_slider_data( $atts ) {
			$data = array();
			
			$data['slidesPerView']     = 'auto';
			$data['slidesPerView1440'] = 'auto';
			$data['slidesPerView1366'] = 'auto';
			$data['slidesPerView1024'] = 'auto';
			$data['slidesPerView768']  = '1';
			$data['centeredSlides']    = 'true';
			
			return json_encode( $data );
		}
	}
}