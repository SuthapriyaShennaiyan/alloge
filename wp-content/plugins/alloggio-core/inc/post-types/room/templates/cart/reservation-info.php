<?php
$days_number = round( abs( strtotime( $check_out ) - strtotime( $check_in ) ) / ( 60 * 60 * 24 ) );
?>
<div class="qodef-reservation-info qodef-m">
	<div class="qodef-m-info qodef--date">
		<span class="qodef-m-info-label"><?php esc_html_e( 'Reservation:', 'alloggio-core' ); ?></span>
		<span class="qodef-m-info-value"><?php echo sprintf( '<span class="qodef--check-in">%s</span><span class="qodef--mark">/</span><span class="qodef--check-out">%s</span><span class="qodef--nights">(%s)</span>', esc_attr( date( alloggio_core_get_default_room_variables( 'date-format' ), strtotime( $check_in ) ) ), esc_attr( date( alloggio_core_get_default_room_variables( 'date-format' ), strtotime( $check_out ) ) ), sprintf( _n( '%s night', '%s nights', $days_number, 'alloggio-core' ), $days_number ) ); ?></span>
	</div>
	<div class="qodef-m-info qodef--guests">
		<span class="qodef-m-info-label"><?php esc_html_e( 'Guests:', 'alloggio-core' ); ?></span>
		<span class="qodef-m-info-value"><?php echo esc_attr( $guests ); ?></span>
	</div>
	<?php if ( ! empty( $extra_services ) ) { ?>
		<div class="qodef-m-info qodef--extra-services">
			<span class="qodef-m-info-label"><?php esc_html_e( 'Extra Services:', 'alloggio-core' ); ?></span>
			<span class="qodef-m-info-value"><?php echo is_string( $extra_services ) ? esc_attr( $extra_services ) : esc_attr( implode( ', ', $extra_services ) ); ?></span>
		</div>
	<?php } ?>
</div>