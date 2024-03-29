<?php

if ( ! function_exists( 'alloggio_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'alloggio_core_social_share' );
				$this->set_name( esc_html__( 'Alloggio Social Share', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_social_share $params]" ); // XSS OK
		}
	}
}