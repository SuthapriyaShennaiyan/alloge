<?php

class MinimalMobileHeader extends AlloggioCoreMobileHeader {
	private static $instance;
	
	public function __construct() {
		$this->slug                  = 'minimal';
		$this->default_header_height = 70;
		
		add_action( 'alloggio_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );
		
		add_action( 'alloggio_core_after_mobile_header_logo_image', array( $this, 'set_logo_image' ) );
		
		parent::__construct();
	}
	
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	public function enqueue_additional_assets() {
	}
	
	function fullscreen_menu_template() {
		$header = alloggio_core_get_post_value_through_levels( 'qodef_header_layout' );
		
		if( $header != 'minimal' ) {
			$parameters = array(
				'fullscreen_menu_in_grid' => alloggio_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
			);
			
			alloggio_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
		}
	}
	
	function set_logo_image() {
		$logo_height         = alloggio_core_get_post_value_through_levels( 'qodef_logo_height' );
		$logo_dark_image_id  = alloggio_core_get_post_value_through_levels( 'qodef_logo_dark' );
		$logo_light_image_id = alloggio_core_get_post_value_through_levels( 'qodef_logo_light' );
		$customizer_logo     = alloggio_core_get_customizer_logo();
		
		$parameters = array(
			'logo_height'      => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'logo_dark_image'  => '',
			'logo_light_image' => '',
		);
		
		if ( ! empty( $logo_dark_image_id ) ) {
			$logo_dark_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--dark',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo dark', 'alloggio-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_dark_image_id, 'full', false, $logo_dark_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_dark_image_id, $logo_dark_image_attr );
			
			$parameters['logo_dark_image'] = $image_html;
		}
		
		if ( ! empty( $logo_light_image_id ) ) {
			$logo_light_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--light',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo light', 'alloggio-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_light_image_id, 'full', false, $logo_light_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_light_image_id, $logo_light_image_attr );
			
			$parameters['logo_light_image'] = $image_html;
		}
		
		if ( ! empty( $logo_dark_image_id ) || ! empty( $logo_light_image_id ) ) {
			alloggio_core_template_part( 'mobile-header/layouts/minimal/templates', 'parts/mobile-logo-light-dark', '', $parameters );
		} elseif ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}