<?php

if ( ! function_exists( 'alloggio_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'AlloggioCoreIconListItemWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_core_filter_register_widgets', 'alloggio_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class AlloggioCoreIconListItemWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'alloggio_core_icon_list_item',
				'exclude'   => array(
					'icon_type', 'custom_icon'
				)
			) );
			if( $widget_mapped ) {
				$this->set_base( 'alloggio_core_icon_list_item' );
				$this->set_name( esc_html__( 'Alloggio Icon List Item', 'alloggio-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'alloggio-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[alloggio_core_icon_list_item $params]" ); // XSS OK
		}
	}
}
