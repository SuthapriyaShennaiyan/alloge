<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<h3 class="qodef-m-title"><?php esc_html_e( 'Find a Room', 'alloggio-core' ); ?></h3>
	<form role="search" class="qodef-m-form" method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php qode_framework_svg_icon( 'spinner', 'qodef-m-spinner' ); ?>
		<input type="hidden" name="s" value=""/>
		<input type="hidden" name="check_in" value=""/>
		<input type="hidden" name="check_out" value=""/>
		<div class="qodef-m-form-calendar qodef-datepick-calendar" data-reserved-dates="<?php echo esc_attr( $reserved_dates ); ?>"></div>
		<?php alloggio_core_print_room_button_element( array(
			'custom_class' => 'qodef-m-form-button',
			'text'         => ! empty( $button_label ) ? esc_html( $button_label ) : esc_html__( 'Check Availability', 'alloggio-core' ),
		) ); ?>
	</form>
</div>