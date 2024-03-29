<?php

if ( ! function_exists( 'alloggio_core_get_elementor_instance' ) ) {
	function alloggio_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'alloggio_core_register_new_elementor_widget' ) ) {
	/**
	 * Function that register a new widget type.
	 *
	 * @param \Elementor\Widget_Base $widget_instance Elementor Widget.
	 */
	function alloggio_core_register_new_elementor_widget( $widget_instance ) {

		if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>' ) ) {
			return alloggio_core_get_elementor_instance()->widgets_manager->register( $widget_instance );
		} else {
			return alloggio_core_get_elementor_instance()->widgets_manager->register_widget_type( $widget_instance );
		}
	}
}

if ( ! function_exists( 'alloggio_core_load_elementor_widgets' ) ) {
	function alloggio_core_load_elementor_widgets() {
		$check_code = class_exists( 'AlloggioCoreDashboard' ) ? AlloggioCoreDashboard::get_instance()->get_code() : true;
		
		if ( ! empty( $check_code ) ) {
			include_once ALLOGGIO_CORE_PLUGINS_PATH . '/elementor/class-alloggiocore-elementor-widget-base.php';

			$widgets = array();
			
			foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {
				
				if ( basename( $shortcode ) !== 'dashboard' ) {
					$is_disabled = alloggio_core_performance_get_option_value( $shortcode, 'alloggio_core_performance_shortcode_' );
					
					if ( empty( $is_disabled ) ) {
						foreach ( glob( $shortcode . '/*-elementor.php' ) as $shortcode_load ) {
							$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
						}
					}
				}
			}
			
			foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}
			
			foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {
				
				if ( basename( $post_type ) !== 'dashboard' ) {
					$is_disabled = alloggio_core_performance_get_option_value( $post_type, 'alloggio_core_performance_post_type_' );
					
					if ( empty( $is_disabled ) ) {
						foreach ( glob( $post_type . '/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
							$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
						}
					}
				}
			}
			
			foreach ( glob( ALLOGGIO_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}
			
			foreach ( glob( ALLOGGIO_CORE_PLUGINS_PATH . '/*/post-types/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}
			
			if ( ! empty( $widgets ) ) {
				ksort( $widgets );
				
				foreach ( $widgets as $widget ) {
					include_once $widget;
				}
			}
		}
	}
	
	add_action( 'elementor/widgets/widgets_registered', 'alloggio_core_load_elementor_widgets' );
}

if( ! function_exists('alloggio_core_remove_widgets_for_elementor') ){
	function alloggio_core_remove_widgets_for_elementor($black_list){
		$black_list[] = 'AlloggioCoreStickySidebarWidget';

		return $black_list;
	};

	add_filter('elementor/widgets/black_list', 'alloggio_core_remove_widgets_for_elementor');
};