<?php
$is_enabled  = alloggio_core_get_post_value_through_levels( 'qodef_room_single_enable_availability' ) === 'yes';

if ( $is_enabled ) {
	$check_in_dates = alloggio_core_get_room_reserved_dates( get_the_ID(), true, 0, 'check-in' );
	?>
	<div class="qodef-e-availability">
		<h4 class="qodef-e-availability-title"><?php esc_html_e( 'Availability', 'alloggio-core' ); ?></h4>
		<div class="qodef-e-calendar-wrapper">
			<div class="qodef-e-availability-calendar qodef-datepick-calendar qodef--range-on" data-reserved-dates="<?php echo esc_attr( $check_in_dates['reserved_dates'] ); ?>" data-last-room-dates="<?php echo esc_attr( $check_in_dates['last_room_dates'] ); ?>"></div>
			<div class="qodef-e-availability-legend qodef-ei">
			<span class="qodef-ei-legend-item qodef--selected">
				<span class="qodef-ei-box"></span>
				<span class="qodef-ei-label"><?php esc_html_e( 'Selected Dates', 'alloggio-core' ); ?></span>
			</span>
				<span class="qodef-ei-legend-item qodef--available">
				<span class="qodef-ei-box"></span>
				<span class="qodef-ei-label"><?php esc_html_e( 'Available Room', 'alloggio-core' ); ?></span>
			</span>
				<span class="qodef-ei-legend-item qodef--no-available">
				<span class="qodef-ei-box"></span>
				<span class="qodef-ei-label"><?php esc_html_e( 'No Availability', 'alloggio-core' ); ?></span>
			</span>
				<span class="qodef-ei-legend-item qodef--last-room">
				<span class="qodef-ei-box"></span>
				<span class="qodef-ei-label"><?php esc_html_e( 'Last Room', 'alloggio-core' ); ?></span>
			</span>
			</div>
		</div>
	</div>
<?php } ?>
