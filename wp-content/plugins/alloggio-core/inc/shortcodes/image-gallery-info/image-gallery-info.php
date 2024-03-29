<?php

if ( ! function_exists( 'alloggio_core_add_image_gallery_info_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_image_gallery_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreImageGalleryInfoShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_image_gallery_info_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreImageGalleryInfoShortcode extends AlloggioCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_SHORTCODES_URL_PATH . '/image-gallery-info' );
			$this->set_base( 'alloggio_core_image_gallery_info' );
			$this->set_name( esc_html__( 'Image Gallery Info', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays image gallery info', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2'
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'subtitle',
				'title'      => esc_html__( 'Subtitle', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'subtitle_tag',
				'title'         => esc_html__( 'Subtitle Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag', true, array(), array( 'span' => esc_html__( 'Custom Heading', 'alloggio-core' ) ) ),
				'default_value' => 'span'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'button_link',
				'title'      => esc_html__( 'Button Link', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'button_text',
				'title'      => esc_html__( 'Button Text', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'button_target',
				'title'         => esc_html__( 'Button Target', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Gallery Items', 'alloggio-core' ),
				'items'   => array(
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Image', 'alloggio-core' )
					),
					array(
						'field_type' => 'textarea_html',
						'name'       => 'item_text',
						'title'      => esc_html__( 'Text', 'alloggio-core' )
					),
				)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			
			return alloggio_core_get_template_part( 'shortcodes/image-gallery-info', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-image-gallery-info';
			$holder_classes = array_merge( $holder_classes );
			
			return implode( ' ', $holder_classes );
		}
	}
}