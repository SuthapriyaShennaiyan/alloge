<?php

if ( ! function_exists( 'alloggio_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_icon_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreIconWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_icon'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'alloggio_core_icon' );
				$this->set_name( esc_html__( 'Alloggio Icon', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_icon $params]" ); // XSS OK
		}
	}
}
