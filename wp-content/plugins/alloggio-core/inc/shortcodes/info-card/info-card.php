<?php

if ( ! function_exists( 'alloggio_core_add_info_card_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_info_card_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreInfoCardShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_info_card_shortcode' );
}

if ( class_exists( 'AlloggioCoreShortcode' ) ) {
	class AlloggioCoreInfoCardShortcode extends AlloggioCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_SHORTCODES_URL_PATH . '/info-card' );
			$this->set_base( 'alloggio_core_info_card' );
			$this->set_name( esc_html__( 'Info Card', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds info card element', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_scripts(
				array(
					'parallax-scroll' => array(
						'registered'	=> false,
						'url'			=> ALLOGGIO_CORE_INC_URL_PATH . '/shortcodes/info-card/assets/js/plugins/jquery.parallax-scroll.js',
						'dependency'	=> array( 'jquery' )
					)
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'alloggio-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_parallax',
				'title'         => esc_html__( 'Enable Parallax Scroll', 'tiare-core' ),
				'description'=> esc_html__( 'Please note that this option will crop top and bottom 10% of an image.', 'alloggio-core' ),
				'default_value' => 'yes',
				'options'       => alloggio_core_get_select_type_options_pool( 'yes_no', false ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'image_position',
				'title'      => esc_html__( 'Image Position', 'alloggio-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'alloggio-core' ),
					'right' => esc_html__( 'Right', 'alloggio-core' ),
				),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'content_background',
				'title'      => esc_html__( 'Content Background', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2',
				'group'         => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'subtitle',
				'title'      => esc_html__( 'Subtitle', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'subtitle_tag',
				'title'         => esc_html__( 'Subtitle Tag', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'title_tag', true, array(), array( 'span' => esc_html__( 'Custom Heading', 'alloggio-core' ) ) ),
				'default_value' => 'span',
				'group'         => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'subtitle_color',
				'title'      => esc_html__( 'Subtitle Color', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle_margin_top',
				'title'      => esc_html__( 'Subtitle Margin Top', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text_field',
				'title'      => esc_html__( 'Text', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'content_image',
				'title'      => esc_html__( 'Content Image', 'alloggio-core' ),
				'group'      => esc_html__( 'Design Options', 'alloggio-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'alloggio_core_button',
				'exclude'           => array( 'custom_class' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button Options', 'alloggio-core' ),
				)
			) );
		}
		
		public function load_assets() {
			wp_enqueue_script( 'parallax-scroll');
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['content_styles']  = $this->get_content_styles( $atts );
			$atts['title_styles']    = $this->get_title_styles( $atts );
			$atts['subtitle_styles'] = $this->get_subtitle_styles( $atts );
			$atts['text_styles']     = $this->get_text_styles( $atts );
			$atts['image_params']    = $this->generate_image_params( $atts );
			$atts['button_params']   = $this->generate_button_params( $atts );
			
			return alloggio_core_get_template_part( 'shortcodes/info-card', 'templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-info-card';
			$holder_classes[] = ! empty ( $atts['image_position'] ) ? 'qodef-image--' . $atts['image_position'] : '';
			$holder_classes[] = ( $atts['enable_parallax'] == 'yes' ) ? 'qodef--has-parallax': '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_content_styles( $atts ) {
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
		
		private function get_subtitle_styles( $atts ) {
			$styles = array();
			
			if ( $atts['subtitle_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['subtitle_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['subtitle_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['subtitle_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['subtitle_color'] ) ) {
				$styles[] = 'color: ' . $atts['subtitle_color'];
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
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
				
				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1]
					);
				} else {
					$image['image_size'] = 'full';
				}
			}
			
			return $image;
		}
		
		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'alloggio_core_button',
				'exclude'        => array( 'custom_class' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}
	}
}