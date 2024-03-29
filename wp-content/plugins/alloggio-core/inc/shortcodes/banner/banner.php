<?php

if ( ! function_exists( 'alloggio_core_add_banner_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_banner_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreBannerShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_banner_shortcode' );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreBannerShortcode extends AlloggioCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'alloggio_core_filter_banner_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_SHORTCODES_URL_PATH . '/banner' );
			$this->set_base( 'alloggio_core_banner' );
			$this->set_name( esc_html__( 'Banner', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds banner element', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
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
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link_url',
				'title'      => esc_html__( 'Link', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'content_background',
				'title'      => esc_html__( 'Content Background', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_padding',
				'title'      => esc_html__( 'Content Padding', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_alignment',
				'title'      => esc_html__( 'Content Alignment', 'alloggio-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'alloggio-core' ),
					'left'   => esc_html__( 'Left', 'alloggio-core' ),
					'center' => esc_html__( 'Center', 'alloggio-core' ),
				),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
				'group'         => esc_html__( 'Content', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text_field',
				'title'      => esc_html__( 'Text', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'text_tag',
				'title'         => esc_html__( 'Text Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'alloggio-core' ),
				'group'      => esc_html__( 'Content', 'alloggio-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'alloggio_core_button',
				'exclude'           => array( 'custom_class', 'link', 'target' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button', 'alloggio-core' ),
				)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['button_params']       = $this->generate_button_params( $atts );
			$atts['holder_classes']      = $this->get_holder_classes( $atts );
			$atts['holder_styles']       = $this->get_holder_styles( $atts );
			$atts['inner_holder_styles'] = $this->get_inner_holder_styles( $atts );
			$atts['title_styles']        = $this->get_title_styles( $atts );
			$atts['text_styles']         = $this->get_text_styles( $atts );
			
			return alloggio_core_get_template_part( 'shortcodes/banner', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-banner';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['text_field'] ) ? 'qodef--has-text' : '';
			$holder_classes[] = isset( $atts['button_params']['text'] ) && ! empty ( $atts['button_params']['text'] ) ? 'qodef--has-button' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['content_padding'];
			}
			
			if ( ! empty( $atts['content_alignment'] ) ) {
				$styles[] = 'text-align: ' . $atts['content_alignment'];
			}
			
			return $styles;
		}
		
		private function get_inner_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['content_background'] ) ) {
				$styles[] = 'background-color: ' . $atts['content_background'];
			}
			
			return $styles;
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}
		
		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'alloggio_core_button',
				'exclude'        => array( 'custom_class', 'link', 'target' ),
				'atts'           => $atts,
			) );
			
			$params['link']   = ! empty( $atts['link_url'] ) ? $atts['link_url'] : '';
			$params['target'] = ! empty( $atts['link_target'] ) ? $atts['link_target'] : '';
			
			return $params;
		}
	}
}