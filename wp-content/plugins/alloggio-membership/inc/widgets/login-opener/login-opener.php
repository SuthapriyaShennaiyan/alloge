<?php

if ( ! function_exists( 'alloggio_membership_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function alloggio_membership_add_author_info_widget( $widgets ) {
		$widgets[] = 'AlloggioMembershipLoginOpenerWidget';
		
		return $widgets;
	}
	
	add_filter( 'alloggio_membership_filter_register_widgets', 'alloggio_membership_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) && !class_exists( 'AlloggioMembershipLoginOpenerWidget' ) ) {
	class AlloggioMembershipLoginOpenerWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'alloggio_membership_login_opener' );
			$this->set_name( esc_html__( 'Alloggio Login Opener', 'alloggio-membership' ) );
			$this->set_description( esc_html__( 'Login and register membership widget', 'alloggio-membership' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'login_opener_margin',
					'title'       => esc_html__( 'Opener Margin', 'alloggio-membership' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'alloggio-membership' )
				)
			);
		}
		
		public function render( $atts ) {
			$classes = array();
			$classes[] = is_user_logged_in() ? 'qodef-user-logged--in' : 'qodef-user-logged--out';
			
			$styles = array();
			
			if ( ! empty( $atts['login_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['login_opener_margin'];
			}
			
			$dashboard_template = apply_filters( 'alloggio_membership_filter_dashboard_template_name', '' );
			
			if ( empty( $dashboard_template ) || ! is_page_template( $dashboard_template ) || ( is_page_template( $dashboard_template ) && is_user_logged_in() ) ) { ?>
				<div class="qodef-login-opener-widget <?php echo implode( ' ', $classes ); ?>" <?php qode_framework_inline_style( $styles ); ?>>
					<?php alloggio_membership_template_part( 'widgets/login-opener', 'templates/holder' ); ?>
				</div>
			<?php }
		}
	}
}
