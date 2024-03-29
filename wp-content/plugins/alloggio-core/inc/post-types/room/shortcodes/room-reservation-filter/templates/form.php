<?php
// Set main variables
$query_options = isset( $_GET ) && ! empty( $_GET ) ? array_filter( $_GET ) : array();
$room_types    = get_terms( array(
	'taxonomy'   => 'room-type',
	'hide_empty' => true
) );

// Set dates variables
$date_format = alloggio_core_get_default_room_variables( 'date-format' );
$check_in    = '';
$check_out   = '';

// Set room capacity variables
$type     = '';
$rooms    = 1;
$adult    = 1;
$children = 0;
$infant   = 0;

// Override variables with forward query
if ( ! empty( $query_options ) ) {
	
	if ( isset( $query_options['check_in'] ) && ! empty( $query_options['check_in'] ) ) {
		$check_in = date( $date_format, strtotime( $query_options['check_in'] ) );
	}
	
	if ( isset( $query_options['check_out'] ) && ! empty( $query_options['check_out'] ) ) {
		$check_out = date( $date_format, strtotime( $query_options['check_out'] ) );
	}
	
	if ( ! empty( $check_in ) && empty( $check_out ) ) {
		$check_out = date( $date_format, strtotime( $query_options['check_in'] . ' +1 days' ) );
	}
	
	if ( isset( $query_options['type'] ) && ! empty( $query_options['type'] ) ) {
		$type = esc_attr( $query_options['type'] );
	}
	
	if ( isset( $query_options['amount'] ) && ! empty( $query_options['amount'] ) ) {
		$rooms = intval( $query_options['amount'] );
	}
	
	if ( isset( $query_options['adult'] ) && ! empty( $query_options['adult'] ) ) {
		$adult = intval( $query_options['adult'] );
	}
	
	if ( isset( $query_options['children'] ) && ! empty( $query_options['children'] ) ) {
		$children = intval( $query_options['children'] );
	}
	
	if ( isset( $query_options['infant'] ) && ! empty( $query_options['infant'] ) ) {
		$infant = intval( $query_options['infant'] );
	}
}

qode_framework_svg_icon( 'spinner', 'qodef-m-spinner' );
?>
<form role="search" class="qodef-m-form" method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="hidden" name="s" value=""/>
	<div class="qodef-m-field qodef--check-in">
		<label class="qodef-m-field-label"><?php esc_html_e( 'Check-in', 'alloggio-core' ); ?></label>
		<div class="qodef-m-field-input-wrapper">
			<input type="text" class="qodef-m-field-input qodef-datepick-calendar qodef--date qodef--check-in" name="check_in" value="<?php echo esc_attr( $check_in ); ?>" data-reserved-dates="<?php echo esc_attr( $check_in_dates ); ?>" required readonly/>
			<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/calendar', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
		</div>
	</div>
	<div class="qodef-m-field qodef--check-out">
		<label class="qodef-m-field-label"><?php esc_html_e( 'Check-out', 'alloggio-core' ); ?></label>
		<div class="qodef-m-field-input-wrapper">
			<input type="text" class="qodef-m-field-input qodef-datepick-calendar qodef--date qodef--check-out" name="check_out" value="<?php echo esc_attr( $check_out ); ?>" data-reserved-dates="<?php echo esc_attr( $check_out_dates ); ?>" required readonly/>
			<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/calendar', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
		</div>
	</div>
	<?php if ( $show_room_types === 'yes' && ! empty( $room_types ) && ! is_wp_error( $room_types ) && ! is_tax( 'room-type' ) ) { ?>
		<div class="qodef-m-field qodef--room-type">
			<label class="qodef-m-field-label"><?php esc_html_e( 'Room Type', 'alloggio-core' ); ?></label>
			<select name="type" class="qodef-e-input qodef--select2">
				<option value=""><?php esc_html_e( 'Default', 'alloggio-core' ); ?></option>
				<?php foreach ( $room_types as $room_type ) { ?>
					<option value="<?php echo esc_attr( $room_type->slug ); ?>" <?php selected( $type, $room_type->slug ); ?>><?php echo esc_html( $room_type->name ); ?></option>
				<?php } ?>
			</select>
		</div>
	<?php } ?>
	<?php if ( $show_room_amount === 'yes' ) { ?>
		<div class="qodef-m-field qodef--room-amount">
			<label class="qodef-m-field-label"><?php esc_html_e( 'Rooms', 'alloggio-core' ); ?></label>
			<select name="amount" class="qodef-e-input qodef--select2">
				<?php for ( $i = 1; $i <= 20; $i ++ ) { ?>
					<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $rooms, $i ); ?>><?php echo sprintf( _n( '%s Room', '%s Rooms', $i, 'alloggio-core' ), $i ); ?></option>
				<?php } ?>
			</select>
		</div>
	<?php } ?>
	<div class="qodef-m-field qodef--guests">
		<label class="qodef-m-field-label"><?php esc_html_e( 'Guests:', 'alloggio-core' ); ?></label>
		<div class="qodef-m-field-input-wrapper">
			<input type="text" class="qodef-m-field-input qodef--guests" name="guests" value="" readonly />
			<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/arrows-down', '', array( 'icon_class' => 'qodef-m-field-input-icon' ) ); ?>
		</div>
		<div class="qodef-m-field-persons">
			<div class="qodef-m-field-person qodef-e qodef--adult">
				<div class="qodef-e-label-text"><?php esc_html_e( 'Adults', 'alloggio-core' ); ?></div>
				<select name="adult" class="qodef-e-input qodef--select2" data-singular-label="<?php esc_attr_e( 'Adult', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Adults', 'alloggio-core' ); ?>">
					<?php for ( $i = 1; $i <= 20; $i ++ ) { ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $adult, $i ); ?>><?php echo esc_html( $i ); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="qodef-m-field-person qodef-e qodef--children">
				<div class="qodef-e-label">
					<span class="qodef-e-label-text"><?php esc_html_e( 'Children', 'alloggio-core' ); ?></span>
					<span class="qodef-e-label-description"><?php esc_html_e( '2-12 years old', 'alloggio-core' ); ?></span>
				</div>
				<select name="children" class="qodef-e-input qodef--select2" data-singular-label="<?php esc_attr_e( 'Children', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Children', 'alloggio-core' ); ?>">
					<?php for ( $i = 0; $i <= 20; $i ++ ) { ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $children, $i ); ?>><?php echo esc_html( $i ); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="qodef-m-field-person qodef-e qodef--infant">
				<div class="qodef-e-label">
					<span class="qodef-e-label-text"><?php esc_html_e( 'Infant\'s', 'alloggio-core' ); ?></span>
					<span class="qodef-e-label-description"><?php esc_html_e( '0-2 years old', 'alloggio-core' ); ?></span>
				</div>
				<select name="infant" class="qodef-e-input qodef--select2" data-singular-label="<?php esc_attr_e( 'Infant', 'alloggio-core' ); ?>" data-plural-label="<?php esc_attr_e( 'Infant\'s', 'alloggio-core' ); ?>">
					<?php for ( $i = 0; $i <= 20; $i ++ ) { ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $infant, $i ); ?>><?php echo esc_html( $i ); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="qodef-m-field-person qodef--button">
				<?php alloggio_core_print_room_button_element( array(
					'custom_class' => 'qodef-button',
					'html_type'    => 'default',
					'link'         => '#',
					'text'         => esc_html__( 'Done', 'alloggio-core' ),
				) ); ?>
			</div>
		</div>
	</div>
	<div class="qodef-m-field qodef--booking">
		<?php alloggio_core_print_room_button_element( array(
			'text' => ! empty( $button_label ) ? esc_html( $button_label ) : '',
		) ); ?>
	</div>
</form>
