<?php

if ( ! function_exists( 'alloggio_core_add_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function alloggio_core_add_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'AlloggioCoreImageGalleryShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'alloggio_core_filter_register_shortcodes', 'alloggio_core_add_image_gallery_shortcode' );
}

if ( class_exists( 'AlloggioCoreListShortcode' ) ) {
	class AlloggioCoreImageGalleryShortcode extends AlloggioCoreListShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( ALLOGGIO_CORE_SHORTCODES_URL_PATH . '/image-gallery' );
			$this->set_base( 'alloggio_core_image_gallery' );
			$this->set_name( esc_html__( 'Image Gallery', 'alloggio-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image gallery element', 'alloggio-core' ) );
			$this->set_category( esc_html__( 'Alloggio Core', 'alloggio-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'images',
				'multiple'   => 'yes',
				'title'      => esc_html__( 'Images', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'alloggio-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'alloggio-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'image_action',
				'title'      => esc_html__( 'Image Action', 'alloggio-core' ),
				'options'    => array(
					''            => esc_html__( 'No Action', 'alloggio-core' ),
					'open-popup'  => esc_html__( 'Open Popup', 'alloggio-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'alloggio-core' )
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'alloggio-core' ),
				'options'       => alloggio_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency'    => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->map_list_options( array(
				'exclude_behavior' => array( 'justified-gallery' ),
				'exclude_option'   => array( 'images_proportion' ),
				'group'            => esc_html__( 'Gallery Settings', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'predefined_gallery_layout',
				'title'       => esc_html__( 'Set Predefined Layout', 'alloggio-core' ),
				'description' => esc_html__( 'Enabling this option will set predefined gallery layout. Options "Number of Columns" and "Columns Responsive" wll not work if this option is enabled.', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				'dependency'  => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'columns',
							'default_value' => 'columns'
						)
					)
				),
				'group'       => esc_html__( 'Gallery Settings', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'enable_image_border',
				'title'       => esc_html__( 'Enable Image Border', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'no_yes', false ),
				'group'       => esc_html__( 'Gallery Settings', 'alloggio-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'enable_slider_shadow',
				'title'       => esc_html__( 'Enable Image Shadow', 'alloggio-core' ),
				'options'     => alloggio_core_get_select_type_options_pool( 'no_yes' ),
				'dependency'  => array(
					'show' => array(
						'behavior' => array(
							'values'        => array( 'slider', 'columns' ),
							'default_value' => 'columns'
						)
					)
				),
				'group'       => esc_html__( 'Gallery Settings', 'alloggio-core' )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'alloggio_core_image_gallery', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			if ( $atts['predefined_gallery_layout'] === 'yes' ) {
				$atts['columns']            = 1;
				$atts['columns_responsive'] = 'predefined';
			}
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts, $atts['columns'] != ('1' || 'auto') ? array( 'loopedSlides' => intval( $atts['columns'] ) * 3) : array() );
			$atts['images']         = $this->generate_images_params( $atts );
			
			return alloggio_core_get_template_part( 'shortcodes/image-gallery', 'templates/image-gallery', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-image-gallery';
			$holder_classes[] = ! empty( $atts['image_action'] ) && $atts['image_action'] == 'open-popup' ? 'qodef-magnific-popup qodef-popup-gallery' : '';
			$holder_classes[] = $atts['predefined_gallery_layout'] == 'yes' ? 'qodef--predefined' : '';
			$holder_classes[] = $atts['enable_slider_shadow'] == 'yes' ? 'qodef--has-shadow' : '';
			$holder_classes[] = $atts['enable_image_border'] == 'yes' ? 'qodef--has-border' : '';
			$holder_classes[] = $atts['behavior'] == 'slider' && $atts['columns'] == '1' ? 'qodef--swiper-parallax' : '';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-image-wrapper';
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		private function generate_images_params( $atts ) {
			$image_ids = array();
			$images    = array();
			$i         = 0;
			
			if ( $atts['images'] !== '' ) {
				$image_ids = explode( ',', $atts['images'] );
			}
			
			$image_size = $this->generate_image_size( $atts );
			
			foreach ( $image_ids as $id ) {
				
				$image['image_id']   = intval( $id );
				$image_original      = wp_get_attachment_image_src( $id, 'full' );
				$image['url']        = $this->generate_image_url( $id, $atts, $image_original[0] );
				$image['alt']        = get_post_meta( $id, '_wp_attachment_image_alt', true );
				$image['image_size'] = $image_size;
				
				$images[ $i ] = $image;
				$i ++;
			}
			
			return $images;
		}
		
		private function generate_image_size( $atts ) {
			$image_size = trim( $atts['image_size'] );
			preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
			if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
				return $image_size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1]
				);
			} else {
				return 'full';
			}
		}
		
		private function generate_image_url( $id, $atts, $default ) {
			if ( $atts['image_action'] == 'custom-link' ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else {
				$url = $default;
			}
			
			return $url;
		}
	}
}